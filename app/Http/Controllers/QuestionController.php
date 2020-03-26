<?php

namespace App\Http\Controllers;

use App\Set;
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
        return $request;
    }
}
