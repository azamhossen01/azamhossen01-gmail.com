<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // protected $fillable = ['subject_id','set_id','question','type','marks'];
    protected $guarded = [];

    
    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }

}
