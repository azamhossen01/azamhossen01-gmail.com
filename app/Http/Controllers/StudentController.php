<?php

namespace App\Http\Controllers;

use App\Exam;
use App\User;
use App\Student;
use App\ExamDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;

class StudentController extends Controller
{
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
        
        $student = Student::where('phone',$request->phone)->first();
        if(!$student){
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
        }
        // return $student;
        if($student){
            session(['phone' => $student->phone]);
            return session('phone');
        }
        
    //    $exams = Exam::all();
    //    return redirect()->back()->with('exam',$exams);
    }

    public function student_logout(Request $request){
        $request->session()->flush();
        return '1';
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
        return $exam_id;
        $exam_details = ExamDetail::where('exam_id',$exam_id)->get();
        // return $exam_details;
        return 'test';
    }


}
