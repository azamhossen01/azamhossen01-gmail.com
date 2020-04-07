<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = ['name','description'];

    // public function questions(){
    //     return $this->hasMany(Question::class);
    // }
}
