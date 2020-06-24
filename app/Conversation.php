<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded = [];

    public function messages(){
        return $this->hasMany(\App\Message::class);
    }

    public function latestMessage()
    {
        return $this->hasOne(\App\Message::class)->latest();
    }
}
