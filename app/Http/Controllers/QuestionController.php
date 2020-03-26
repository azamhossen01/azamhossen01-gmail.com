<?php

namespace App\Http\Controllers;

use App\Set;
use App\Answer;
use App\Subject;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::all();
        return view('question.index',compact('questions'));
    }

    public function create(){
        $subjects = Subject::all();
        $sets = Set::all();
        return view('question.create',compact('subjects','sets'));
    }

    public function store(Request $request){
        // return $col1 = $request;
        // $correct_answers = $request->is_correct;
        // return count($correct_answers);
        $this->validate($request,[
            'subject_id' => 'required',
            'set_id' => 'required',
            'question' => 'required',
            'type' => 'required',
            'marks' => 'required'
        ]);
        $question = Question::create([
            'subject_id' => $request->subject_id,
            'set_id' => $request->set_id,
            'question' => $request->question,
            'type' => $request->type,
            'marks' => $request->marks
        ]);
        
        

        if($request->type == 1){
            $save_answer = new Answer;
            $save_answer->question_id = $question->id;
            $image_name = time().'.'.$request->attachment->getClientOriginalExtension();
            $request->attachment->move(public_path('backend/images'),$image_name);
            $save_answer->attachment = $image_name;
            $save_answer->save();
        }else{
            foreach($request->hide as $key=>$h){
                // return $key;
                $save_answer = new Answer;
                $save_answer->question_id = $question->id;
                $save_answer->answer = $request->answer[$key];
    
                
    
                if(in_array($h,$request->is_correct)){
                    $save_answer->is_correct = 1;
                }else{
                    $save_answer->is_correct = 0;
                }
    
                $save_answer->save();
            }

        }

        return redirect()->route('questions.index');

        // return array_keys($request->is_correct);
        // return array_keys($request->answer);

    }

    public function show(Question $question){
        // return $question;
        return view('question.show',compact('question'));
    }

    public function delete(Question $question){
        foreach($question->answers as $key=>$answer){
            $answer->delete();
        }
        $question->delete();
        return redirect()->route('questions.index');
    }
}
