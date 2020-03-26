<?php

namespace App\Http\Controllers;

use App\Set;
use Illuminate\Http\Request;

class SetController extends Controller
{
    public function index(){
        $sets = Set::all();
        return view('set.index',compact('sets'));
       }
    
       public function create(){
          return view('set.create');
       }
    
       public function store(Request $request){
          
          $validateData = $request->validate([
             'name' => 'required|unique:sets',
             'description' => 'sometimes'
          ]);
          Set::create($validateData);
          return redirect()->route('sets.index');
       }
    
       public function edit(Set $set){
          return view('set.edit',compact('set'));
       }
    
       public function update(Request $request,Set $set){
          $validateData = $request->validate([
             'name' => 'required|unique:sets,name,'.$set->id,
             'description' => 'sometimes'
          ]);
          $set->update($validateData);
          return redirect()->route('sets.index');
       }
}
