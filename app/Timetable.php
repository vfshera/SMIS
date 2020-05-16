<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $guarded = [];

    public function duty(){
        return $this->belongsTo(\App\Duty::class , 'duty_id');
    }

    public function classroom(){
        return $this->belongsTo(\App\Classroom::class , 'class_id');
    }

    public function term(){
        return $this->belongsTo(\App\Term::class);
    }

    public function studies(){
        return $this->hasMany(\App\Study::class);
    }
}
