<?php

namespace App\Http\Controllers;

use App\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(){
       $info = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

       ContactMessage::create($info);
    }
}
