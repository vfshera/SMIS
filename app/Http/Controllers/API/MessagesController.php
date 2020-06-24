<?php

namespace App\Http\Controllers\API;

use App\Conversation;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\UserResource;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
        $id = auth()->user()->id;
        $chats = Conversation::where('user1', $id)->orWhere('user2' , $id)->with('latestMessage')->get()->sortByDesc('latestMessage.created_at');

        return ConversationResource::collection($chats);
    }
    public function receivers(){
        $users = User::where('access' , '!=' , 1)->where('id','!=',auth()->user()->id)->get();
        $conversations = Conversation::where('user1', auth()->user()->id)->orWhere('user2' , auth()->user()->id)->get();

        $unchat = [];

            $IDs = [];
            foreach ($conversations as $conv){
                $possibleID = ($conv->user1 == auth()->user()->id) ? $conv->user2 :$conv->user1;
                array_push($IDs,$possibleID);
            }

            foreach ($users as $user){
               if(in_array($user->id ,$IDs)){

               }else{
                   array_push($unchat,$user);
               }
            }

        return UserResource::collection($unchat);
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

          if(($request->conv_id)){
              $receiver = ($conv->user1 == $sender) ? $conv->user2 : $conv->user1;
          }else{
              $receiver = $request->receiver_id;
          }

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
