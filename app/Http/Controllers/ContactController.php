<?php

namespace App\Http\Controllers;

use App\ContactMessage;
use App\Http\Resources\ContactFormResource;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function onePost($id){
        $post = ContactMessage::findOrFail($id);
        return new ContactFormResource($post);
    }
    public function create(Request $request){
       $info = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

       ContactMessage::create($info);

       return redirect()->back();
    }

    public function index(){
        return ContactFormResource::collection(ContactMessage::orderBy('created_at' , 'desc')->paginate(6));
    }
}
