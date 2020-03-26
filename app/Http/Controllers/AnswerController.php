<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function update(Request $request,$id){
        if($request->attachment){
            $answer = Answer::where('question_id',$id)->first();
            if($answer->attachment){
                $old_image = public_path('backend/images/').$answer->attachment;
                unlink($old_image);
            }
            $image_name = time().'.'.$request->attachment->getClientOriginalExtension();
            $request->attachment->move(public_path('backend/images'),$image_name);
            $answer->question_id = $id;
            $answer->attachment = $image_name;
            $answer->update();
        }else{
            $answers = Answer::where('question_id',$id)->get();
            foreach($answers as $key=>$answer){
                    $answer->question_id = $id;
                    $answer->answer = $request->answer[$key];
                    if(in_array($answer->id,$request->is_correct)){
                        $answer->is_correct = 1;
                    }else{
                        $answer->is_correct = 0;
                    }
                    $answer->update();
            }
        }
        
        return redirect()->route('questions.show',$id);
    }
}
