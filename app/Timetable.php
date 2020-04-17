<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $guarded = [];

    public function duty(){
        return $this->belongsTo(\App\Duty::class);
    }

    public function classroom(){
        return $this->belongsTo(\App\Classroom::class);
    }

    public function term(){
        return $this->belongsTo(\App\Term::class);
    }
}
