<?php

namespace App\Http\Controllers\API;

use App\Conversation;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
        $id = auth()->user()->id;
        $chats = Conversation::where('user1', $id)->orWhere('user2' , $id)->orderBy('created_at' , 'DESC')->get();

        return ConversationResource::collection($chats);
    }

    public function read($id){
        $chats = Conversation::findOrFail($id)->messages()->where('receiver' , auth()->user()->id)->get();

        foreach ($chats as $chat){
            $chat->update(['read' => true]);

        }

        return "Read";
    }

    public function sendMessage(Request $request){
      $sender = auth()->user()->id;

      $convID = ($request->conv_id) ? $request->conv_id : Conversation::create(['user1' => $sender ,'user2' => $request->receiver_id])->id;
      $msg = $request->message;
      $conv = Conversation::findOrFail($convID)->first();
      $receiver = ($conv->user1 == $sender) ? $conv->user2 : $conv->user1;

      $created = Message::create([
                  'sender' => $sender,
                  'receiver' => $receiver,
                  'message' => $msg,
                  'conversation_id' => $convID
              ]);

          if($created){
              return "Message Created";
          }else{
              return "Unable To Create Message";
          }
    }
}
