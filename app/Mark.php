<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(\App\Student::class , 'student_id');
    }
}
