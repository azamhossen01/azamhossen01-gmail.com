<?php

namespace App\Http\Controllers;

use App\Set;
use App\Exam;
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
        $mcq_questions = $exam->set->questions->where('type',0);
        $descriptive_questions = $exam->set->questions->where('type',1);
        return view('start_exam',compact('exam','mcq_questions','descriptive_questions'));
    }

    public function submit_exam(Request $request,Exam $exam){
        // return $exam;
        $question_id = [];
        
        $answer_id = [];
        foreach($request->is_correct as $key=>$ic){
        array_push($question_id,explode('-',$ic)[0]);
        array_push($answer_id,explode('-',$ic)[1]);
        }
        return $answer_id;
    }
}
