<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'name', 'math_rep',
    ];

    public function streams(){
        return $this->hasMany(\App\Stream::class);
    }

    public function classrooms(){
        return $this->hasMany(\App\Classroom::class);
    }
}
