<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'form_id', 'stream_id',
    ];

    public function getClassName(){
        return $this->form() + " " + $this->stream();

    }

    public function form(){
        return $this->belongsTo(\App\Form::class);
    }

    public function stream(){
        return $this->belongsTo(\App\Stream::class);
    }

    public function students(){
        return $this->hasMany(\App\Student::class, 'class_id');
    }

    public function timetables(){
        return $this->hasMany(\App\Timetable::class);
    }
}

