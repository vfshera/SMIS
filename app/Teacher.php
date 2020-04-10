<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function duties(){
       return $this->hasMany(\App\Duty::class);
    }
}
