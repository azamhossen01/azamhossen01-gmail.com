<?php

namespace App\Http\Controllers;

use App\Exam;
use App\User;
use App\Result;
use App\Student;
use App\Question;
use App\ExamDetail;
use App\ResultDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;
use App\Level;

class StudentController extends Controller
{

    public function student_home(){
        if(session('phone')){
            return redirect()->back();
        }else{
            $levels = Level::all();
            return view('frontend.student_register',compact('levels'));
        }
        // $exams = Exam::all();
        // return view('frontend/welcome',compact('exams'));
    }

    public function student_register(Request $request){
        // return $request;
        // session(['phone' => $request->phone]);

        // return session('phone');
        // $request->session()->flush();
        // return session('phone');
        // if($request->email){
        //     $email = $request->email;
        // }else{
        //     $lower_name = strtolower($request->name);
        //     $explode_name = explode(' ',$lower_name);
        //     $email = implode('',$explode_name).rand(1,100).'@gmail.com';
        // }
        
        $student = Student::where([['level_id',$request->level_id],['phone',$request->phone]])->first();
        if(!$student){
            $student = Student::create([
                'level_id' => $request->level_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
        }
        // return $student;
        if($student){
            session(['student_id'=>$student->id,'phone' => $student->phone,'level_id'=>$student->level_id]);
            // $this->start_exam($request->exam_id,$request->set_id);
            // return redirect('start_exam/'.$request->exam_id.'/'.$request->set_id);
            return view('frontend.welcome');
        }
        
    //    $exams = Exam::all();
    //    return redirect()->back()->with('exam',$exams);
    }

    public function student_logout(Request $request){
        $request->session()->flush();
        return redirect()->route('/');
    }

    public function check_user_session(){
        if(session('phone')){
            $student = Student::where('phone',session('phone'))->first();
            return response()->json(['session'=>session('phone'),'student'=>$student]);
        }else{
            return '0';
        }
    }

    public function get_all_exams(){
        $exams = Exam::all();
        return response()->json(['exams'=>$exams]);
    }

    public function exam_details($exam_id){
        $exam_details = ExamDetail::where('exam_id',$exam_id)->get();
         $mcq = ExamDetail::whereHas('question',function($query){
            $query->where('type',0);
        })->where('exam_id',$exam_id)->get();
        $descriptive = ExamDetail::whereHas('question',function($query){
            $query->where('type',1);
        })->where('exam_id',$exam_id)->get();
        
        // return $exam_details->groupBy('set_id');
        // $mcq = $exam_details->where()->get();
       

        return view('frontend.exam_detail',compact('exam_details','mcq','descriptive'));
    }

    public function start_exam($exam_id,$set_id){
         $session_data = session()->get('phone');
         if($session_data){
            $mcq = ExamDetail::whereHas('question',function($query){
                $query->where('type',0);
            })->where('exam_id',$exam_id)->where('set_id',$set_id)->get();
            $descriptive = ExamDetail::whereHas('question',function($query){
                $query->where('type',1);
            })->where('exam_id',$exam_id)->where('set_id',$set_id)->get();
             return view('frontend.start_exam',compact('session_data','mcq','descriptive','exam_id','set_id'));
         }else{
             return view('frontend.student_register',compact('exam_id','set_id'));
         }
    }

    public function result(Request $request){
        $student = Student::where([['phone',session('phone')],['level_id',session('level_id')]])->first();
        // return $request;
        
        $exam_id = $request->exam_id;
        $set_id = $request->set_id;
        $result = Result::create([
            'exam_id' => $exam_id,
            'set_id' => $set_id,
            'student_id' => $student->id,
        ]);

        foreach($request->descriptive_id as $key=>$ques_id){
            $result_detail = new ResultDetail;
            $result_detail->result_id = $result->id;
            $result_detail->question_id = $ques_id;

            $image_name = $ques_id.time().'.'.$request->attachment[$key]->getClientOriginalExtension();
            $request->attachment[$key]->move(public_path('backend/images/results/'),$image_name);
            
            $result_detail->attachment = $image_name;
            $result_detail->save();
        }

        $question_id = [];
        $answer_id = [];
        foreach($request->mcq as $mc){
            array_push($question_id,explode('-',$mc)[0]);
            array_push($answer_id,explode('-',$mc)[1]);
        }
        foreach($question_id as $key=>$ques){
            $result_detail = new ResultDetail;
            $result_detail->result_id = $result->id;
            $result_detail->question_id = $ques;
            $result_detail->answer_id = $answer_id[$key];
            $result_detail->save();
        }

        
        
        
        return redirect('after_exam/'.$result->id);
        // return view('frontend.after_exam',compact('session_data','mcq','descriptive','exam_id','set_id'));
        // return redirect()->route('student_logout');
    }

    public function after_exam($result_id){
        $result = Result::findOrFail($result_id);
        $student = Student::find($result->student_id);
        
        $exam_id = $result->exam_id;
        $set_id = $result->set_id;
        $mcq = ExamDetail::whereHas('question',function($query){
            $query->where('type',0);
        })->where('exam_id',$exam_id)->where('set_id',$set_id)->get();
        $descriptive = ExamDetail::whereHas('question',function($query){
            $query->where('type',1);
        })->where('exam_id',$exam_id)->where('set_id',$set_id)->get();

        return view('frontend.after_exam',compact('mcq','descriptive','exam_id','set_id','result'));
    }



    public function index(){
        $students = Student::all();
        return view('student.index',compact('students'));
    }

    public function show(Student $student){
        //  $student;
        $results = $student->results;
        return view('student.show',compact('results','student'));
    }

    public function student_exam_details(Result $result){
            
          $mcq = ResultDetail::where([['result_id',$result->id],['attachment',null]])->get()->groupBy('question_id');
        $descriptive = ResultDetail::where([['result_id',$result->id],['attachment','!=',null]])->get();
        // return $mcq;
        // foreach($mcq as $key=>$mc){
        //     return $mcq[$key];
        // }
        // return $mcq;
        // return $mcq;

        
        return view('student.student_exam_details',compact('mcq','descriptive','result'));
    }


}
