<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function results(){
        return $this->hasMany(Result::class);
    }
}
