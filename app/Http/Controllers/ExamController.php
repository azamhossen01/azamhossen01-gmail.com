<?php

namespace App\Http\Controllers;

use App\Set;
use App\Exam;
use App\ExamDetail;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(){
        $exams = Exam::all();
        return view('exam.index',compact('exams'));
    }

    public function create(){
        $sets = Set::all();
        return view('exam.create',compact('sets'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'set_id' => 'required',
            'student_name' => 'required',
            'student_phone' => 'required|unique:exams',
            'total' => 'required'
        ]);

        Exam::create($validateData);
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
}
