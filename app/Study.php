<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(\App\Student::class, 'student_id');
    }

    public function timetable(){
        return $this->belongsTo(\App\Timetable::class, 'timetable_id');
    }
}
