<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['subject_id','set_id','question','type','marks'];

    public function set(){
        return $this->belongsTo(Set::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
