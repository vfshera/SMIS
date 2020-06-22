<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    public function conversation(){
        return $this->belongsTo(\App\Conversation::class,'conversation_id');
    }

}
