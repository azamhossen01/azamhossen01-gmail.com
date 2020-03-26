<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
   public function index(){
    $subjects = Subject::all();
    return view('subject.index',compact('subjects'));
   }

   public function create(){
      return view('subject.create');
   }

   public function store(Request $request){
      
      $validateData = $request->validate([
         'name' => 'required|unique:subjects',
         'description' => 'sometimes'
      ]);
      Subject::create($validateData);
      return redirect()->route('subjects.index');
   }

   public function edit(Subject $subject){
      return view('subject.edit',compact('subject'));
   }

   public function update(Request $request,Subject $subject){
      $validateData = $request->validate([
         'name' => 'required|unique:subjects,name,'.$subject->id,
         'description' => 'sometimes'
      ]);
      $subject->update($validateData);
      return redirect()->route('subjects.index');
   }
}
