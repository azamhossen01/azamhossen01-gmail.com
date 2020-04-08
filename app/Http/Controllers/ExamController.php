<?php

namespace App\Http\Controllers;

use App\Set;
use App\Exam;
use App\Level;
use App\Subject;
use App\ExamDetail;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(){
        $exams = Exam::all();
        // return $exams;
        return view('exam.index',compact('exams'));
    }

    public function create(){
        // return request();

        if(request('level_id') && request('subject_id')){
           $level = Level::where('id',request('level_id'))->first();
           $subjects = [];
           foreach(request('subject_id') as $subject_id){
            array_push($subjects,Subject::where('id',$subject_id)->first());
           }
           return view('exam.create',compact('subjects','level'));
        }else{
            $levels = Level::all();
            $subjects = Subject::all();
            return view('exam.create',compact('subjects','levels'));
        }
        // return $subjects[0]->questions->where('type',0);
        
    }

    public function store(Request $request){
        // return $request->question;
        // return $request;
        

        // Exam::create($validateData);
        $exam = Exam::create([
            'name' => $request->name,
            'level_id' => $request->level_id
        ]);
        $set = Set::create([
            'name' => $request->set_name
        ]);
        if($exam && $set){
            foreach($request->question as $key=>$question){
                ExamDetail::create([
                    'exam_id' => $exam->id,
                    'set_id' => $set->id,
                    'question_id' => $question
                ]);
            }
        }
        return redirect()->route('exams.index');
    }

    public function edit(Exam $exam){
        $sets = Set::all();
        return view('exam.edit',compact('sets','exam'));
    }

    public function update(Request $request,Exam $exam){
        $validateData = $request->validate([
            'set_id' => 'required',
            'student_name' => 'required',
            'student_phone' => 'required|unique:exams,student_phone,'.$exam->id,
            'total' => 'required'
        ]);
        $exam->update($validateData);
        return redirect()->route('exams.index');
    }

    public function show(Exam $exam){

        $sets = $exam->exam_details->groupBy('set_id');
        // foreach($sets as $key=>$set){
        //     return $sets[2][0]->set->name;
        // }
        // $sets =  $exam->exam_details->groupBy('set_id');
        // foreach($sets as $set){
        //     foreach($set as $s){
        //         return $s->question->question;
        //     }
        // }
        return view('exam.show',compact('exam'));
    }

    public function start_exam(Request $request){
        $exam = Exam::where('student_phone',$request->student_phone)->first();
        if($exam){
        $mcq_questions = $exam->set->questions->where('type',0);
        $descriptive_questions = $exam->set->questions->where('type',1);
        return view('start_exam',compact('exam','mcq_questions','descriptive_questions'));
        }else{
            return redirect()->back();
        }
        
    }

    public function submit_exam(Request $request,Exam $exam){
        // return $exam;
        // return $request->is_correct;
        
        $descriptive_questions = $exam->set->questions->where('type',1);
        if($request->attachment){
            // return $request->attachment[0];
            $a = 0;
            foreach($descriptive_questions as $key=>$des_ques){
                
                
                $exam_detail = new ExamDetail;
                $exam_detail->exam_id = $exam->id;
                $exam_detail->question_id = $des_ques->id;

                $image_name = $des_ques->id.time().'.'.$request->attachment[$a]->getClientOriginalExtension();
                $request->attachment[$a]->move(public_path('backend/images/answers/'),$image_name);
                
                $exam_detail->attachment = $image_name;
                $exam_detail->save();
                $a++;
            }
        }
       
       
        $question_id = [];
        
        $answer_id = [];
        foreach($request->is_correct as $key=>$ic){
        array_push($question_id,explode('-',$ic)[0]);
        array_push($answer_id,explode('-',$ic)[1]);
        }
        foreach($question_id as $key=>$ques){
            $exam_detail = new ExamDetail;
            $exam_detail->exam_id = $exam->id;
            $exam_detail->question_id = $ques;
            $exam_detail->answer_id = $answer_id[$key];
            $exam_detail->save();
        }
        return redirect()->route('result_publish',$exam->id);
        
    }

    public function result_publish(Exam $exam){
        // return $exam->exam_details->where('attachment',null);

          $exam_details = ExamDetail::whereHas('question',function($query){
            $query->where('type',0);
         })->where('exam_id',$exam->id)->get()->groupBy('question_id');
        foreach($exam_details as $key=>$exam_detail){

            if(count($exam_detail) > 1){
                $value = true;
                foreach($exam_detail as $key=>$e_detail){
                    if($e_detail->answer->is_correct !== 1){
                        $value = false;
                    }
                    if($value == true){
                        $mark_obtain_in_mcq = $exam->mark_obtain_in_mcq + $e_detail->question->marks/count($exam_detail);
                        $exam->update([
                            'mark_obtain_in_mcq' => $mark_obtain_in_mcq
                        ]);
                    }else{
                        // return 'jasa';
                    }
                }
                $value = true;

            }else{
                // return 'single question';
                foreach($exam_detail as $key=>$ex_detail){
                    if($ex_detail->answer->is_correct == 1){
                        $mark_obtain_in_mcq = $exam->mark_obtain_in_mcq + $ex_detail->question->marks;
                        $exam->update([
                            'mark_obtain_in_mcq' => $mark_obtain_in_mcq
                        ]);
                          $exam->mark_obtain_in_mcq;
                    }
                }
            }
            
            
        }

        // return 'success';

        return view('result_publish',compact('exam'));
    }

    public function create_exam_set(Exam $exam){
        if(request('subject_id')){
            $subjects = [];
            foreach(request('subject_id') as $subject_id){
                array_push($subjects,Subject::where('id',$subject_id)->first());
               }
        }else{
            $subjects = Subject::all();
        }
        $subjects = Subject::all();
        return view('exam.create_exam_set',compact('exam','subjects'));
    }

    public function add_exam_set(Request $request,$id){
        // return $request;
        $set = Set::create([
            'name' => $request->set_name
        ]);
        foreach($request->question as $key=>$question){
            ExamDetail::create([
                'exam_id' => $id,
                'set_id' => $set->id,
                'question_id' => $question
            ]);
        }
        return redirect()->route('exams.show',$id);
    }

    public function edit_exam_set($set_id,$exam_id){
        $mcq = ExamDetail::whereHas('question',function($query){
            $query->where('type',0);
        })->where([['exam_id',$exam_id],['set_id',$set_id]])->pluck('question_id')->toArray();
        
        $descriptive = ExamDetail::whereHas('question',function($query){
            $query->where('type',1);
        })->where([['exam_id',$exam_id],['set_id',$set_id]])->pluck('question_id')->toArray();
        // return $questions;
         $set = Set::findOrFail($set_id);
        $exam = Exam::findOrFail($exam_id);
        $subjects = Subject::all();
        
        $sets = Set::all();
        return view('exam.edit_exam_set',compact('set','exam','mcq','descriptive','subjects','sets'));
    }

    public function update_exam_set(Request $request){
        $new_questions = $request->question;
        $old_questions = ExamDetail::where([['exam_id',$request->exam_id],['set_id',$request->set_id]])->get();
        foreach($old_questions as $oq){
            $oq->delete();
        }
        foreach($new_questions as $nq){
            ExamDetail::create([
                'exam_id' => $request->exam_id,
                'set_id' => $request->set_id,
                'question_id' => $nq
            ]);
        }
        return redirect()->back();
        // if(count($new_questions) > count($old_questions)){
        //     $count1 = 0;
        //     while(count($new_questions) > $count1){
        //         ExamDetail::update([
        //             'exam_id' => $request->exam_id,
        //             'set_id' => $request->set_id,
        //             'question_id' => $question->id
        //         ]);
        //     }
        // }elseif(count($new_questions) == count($old_questions)){
        //     return 'soman';
        // }else{
        //     return 'old beshi';
        // }
    }
}
