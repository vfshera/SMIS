<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = [
        'name', 'rep',
    ];

    public function forms(){
        return $this->hasMany(\App\Form::class);
    }

    public function classrooms(){
        return $this->hasMany(\App\Classroom::class);
    }
}
