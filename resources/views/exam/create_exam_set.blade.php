@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Add New Set</h3>
            {{-- <a href="{{route('exams.create')}}" class="btn btn-primary float-right">Add New</a> --}}
            </div>
            <div class="card-body">
              @if(!request('subject_id'))
            <form action="{{route('exams.create.set',$exam->id)}}" method="get">
                @csrf 
                <div class="form-group">
                  <label for="subject_id">Subject</label>
                  <select name="subject_id[]" class="form-control" id="subject_id" required multiple>
                    {{-- <option value="">Select Subject</option> --}}
                    @forelse($subjects as $key=>$subject)
                  <option value="{{$subject->id}}">{{$subject->name}}</option> 
                    @empty 
                    @endforelse
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
              </form>
              @endif


              @if(request('subject_id'))
            <form action="{{route('add_exam_set.store',$exam->id)}}" method="post">
              @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                <input type="text" name="name" readonly value="{{$exam->name}}" required class="form-control" id="name"  placeholder="Exam Name">
                </div>
                <div class="form-group">
                  <label for="set_name">Set Name</label>
                <input type="text" name="set_name"  required class="form-control" id="set_name"  placeholder="Set Name">
                </div>
                
                <div class="form-group">
                  <div id="question">
                  @forelse($subjects as $key=>$subject)
                  <div class="card">
                  <div class="card-header">{{$subject->name}}</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-6">
                          <h3>MCQ Question</h3>
                          @forelse($subject->questions->where('type',0)->where('level_id',$exam->level_id) as $question) 
                            {{-- {{$question->question}} <br> --}}
                            <div class="form-check">
                            <input type="checkbox" name="question[]" value="{{$question->id}}" class="form-check-input" id="exampleCheck{{$question->id}}">
                            <a href="{{route('questions.show',$question->id)}}">
                              {{-- <label class="form-check-label" for="exampleCheck1"> --}}
                                {{$question->question}}
                              {{-- </label> --}}
                            </a>
                            </div>
                          @empty 

                          @endforelse
                        </div>
                        <div class="col-lg-6">
                          <h3>Descriptive Question</h3>
                          @forelse($subject->questions->where('type',1)->where('level_id',$exam->level_id) as $question) 
                          {{-- {{$question->question}} <br> --}}
                          <div class="form-check">
                          <input type="checkbox" name="question[]" value="{{$question->id}}" class="form-check-input" id="exampleCheck{{$question->id}}">
                            <a href="{{route('questions.show',$question->id)}}">
                              {{-- <label class="form-check-label" for="exampleCheck1"> --}}
                                {{$question->question}}
                              {{-- </label> --}}
                            </a>
                          </div>
                        @empty 

                        @endforelse
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty 

                  @endforelse
                  {{-- <div class="form-group">
                    <label for="subject_id">Subject</label>
                    <select name="subject_id" class="form-control" id="subject_id" required>
                      <option value="">Select Subject</option>
                      @forelse($subjects as $key=>$subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option> 
                      @empty 
                      @endforelse
                    </select>
                  </div> --}}
                </div>
                </div>
                
                <div class="form-group">
                   <button type="submit" class="btn btn-primary">Submit</button>
                </div>
               
              </form>

              @endif
            </div>
        </div>
    </div>
</div>
@endsection