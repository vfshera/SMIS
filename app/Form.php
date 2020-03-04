<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    public function streams(){
        return $this->hasMany(\App\Stream::class);
    }

    public function classrooms(){
        return $this->hasMany(\App\Classroom::class);
    }
}
