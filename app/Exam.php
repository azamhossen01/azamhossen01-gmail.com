<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['student_name','student_phone','set_id','total','mark_obtain_in_mcq'];

    public function set(){
        return $this->belongsTo(Set::class);
    }

    public function exam_details(){
        return $this->hasMany(ExamDetail::class);
    }
}
