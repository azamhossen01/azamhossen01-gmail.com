@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">{{$exam->name}} Details</h3>
            <a href="{{route('exams.create.set',$exam->id)}}" class="btn btn-primary float-right">Add New Set</a>
            </div>
            <div class="card-body">
              @php
                  $sets = $exam->exam_details->groupBy('set_id');
              @endphp
              @forelse($sets as $key=>$set)
              <div class="jumbotron">
              <h1 class="display-4">SET : {{$set[$key]->set->name}}</h1>
                <p class="lead">{{$set[$key]->set->description}}</p>
                <hr class="my-4">
                <div class="row">
                  <div class="col-lg-6">
                    <p>
                      MCQ : <br>
                      @forelse($set as $exam_detail) 
                      @if($exam_detail->question->type == 0)
                    <a href="{{route('questions.show',$exam_detail->question_id)}}">{{$exam_detail->question->question}}</a><br>
                    @endif
                      @empty 
    
                      @endforelse
                    </p>
                  </div>
                  <div class="col-lg-6">
                    <p>
                      Descriptive : <br>
                      @forelse($set as $exam_detail) 
                      @if($exam_detail->question->type == 1)
                    <a href="{{route('questions.show',$exam_detail->question_id)}}">{{$exam_detail->question->question}}</a><br>
                    @endif
                      @empty 
    
                      @endforelse
                    </p>
                  </div>
                </div>
                
                <p class="lead">
                <a class="btn btn-warning btn-lg" href="{{route('exams.edit_exam_set',['set_id'=>$set[$key]->set->id,'exam_id'=>$exam->id])}}" role="button">Edit</a>
                </p>
              </div>

              @empty 

              @endforelse
            </div>
        </div>
    </div>
</div>
@endsection