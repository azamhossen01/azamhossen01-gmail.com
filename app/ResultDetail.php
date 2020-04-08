<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultDetail extends Model
{
    public function question(){
        return $this->belongsTo(Question::class);
    }
}
