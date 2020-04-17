<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $guarded = [];

    public function timetables(){
        return $this->hasMany(\App\Timetable::class);
    }
}
