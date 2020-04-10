<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'title', 'description','abbreviation',
    ];

    public function duties(){
        $this->hasMany(\App\Duty::class);
    }
}
