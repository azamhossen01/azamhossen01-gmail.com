<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['student_name','student_phone','set_id','total'];

    public function set(){
        return $this->belongsTo(Set::class);
    }
}
