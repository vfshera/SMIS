<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  public function classroom(){
      return $this->belongsTo(\App\Classroom::class ,'class_id');
  }

  public function user(){
    return $this->belongsTo(\App\User::class, 'user_id');
  }

  public function studies(){
        return $this->hasMany(\App\Study::class);
  }

}
