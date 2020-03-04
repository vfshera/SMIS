<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function form(){
        return $this->belongsTo(\App\Form::class);
    }

    public function stream(){
        return $this->belongsTo(\App\Stream::class);
    }

    public function students(){
        return $this->hasMany(\App\Student::class);
    }
}

