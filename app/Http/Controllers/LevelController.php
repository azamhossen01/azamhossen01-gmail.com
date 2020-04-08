<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(){
        $levels = Level::all();
        return view('level.index',compact('levels'));
       }
    
       public function create(){
          return view('level.create');
       }
    
       public function store(Request $request){
          
          $validateData = $request->validate([
             'name' => 'required|unique:levels',
             'description' => 'sometimes'
          ]);
          Level::create($validateData);
          return redirect()->route('levels.index');
       }
    
       public function edit(Level $level){
          return view('level.edit',compact('level'));
       }
    
       public function update(Request $request,Level $level){
          $validateData = $request->validate([
             'name' => 'required|unique:levels,name,'.$level->id,
             'description' => 'sometimes'
          ]);
          $level->update($validateData);
          return redirect()->route('levels.index');
       }
}
