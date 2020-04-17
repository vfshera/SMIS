<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    protected $guarded = [];

    public function teacher(){
        return $this->belongsTo(\App\Teacher::class, 'teacher_id');
    }

    public function subject(){
        return $this->belongsTo(\App\Subject::class, 'subject_id');
    }

    public function timetables(){
        return $this->hasMany(\App\Timetable::class);
    }
}
