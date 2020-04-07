<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamDetail extends Model
{
    protected $guarded = [];
    public function exam(){
        return $this->belongsTo(Exam::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function answer(){
        return $this->belongsTo(Answer::class);
    }

    public function set(){
        return $this->belongsTo(Set::class);
    }
}
