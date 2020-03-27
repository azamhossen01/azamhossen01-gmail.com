<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(){
        $results = Exam::all();
        return view('result.index',compact('results'));
    }

    public function show(Exam $exam){
        
        return view('result.show',compact('exam'));
    }

    public function update(Request $request,Exam $exam){
        $exam->update([
            'mark_obtain_in_descriptive' => $request->descriptive_number
        ]);
        return redirect()->route('results.index');
    }
}
