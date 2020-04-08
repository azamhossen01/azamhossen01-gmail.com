<div class="bg-light border-right" id="sidebar-wrapper">
<div class="sidebar-heading"><a href="{{route('/')}}">Online Exam</a> </div>

    <div class="list-group list-group-flush">
      @if(session('phone'))
      
     


      @forelse(\App\Result::where('student_id',session('student_id'))->get() as $result)
    <a href="{{route('after_exam',$result->id)}}" class="list-group-item list-group-item-action bg-light">{{$result->exam->name}}</a>
      @empty 
        <h5>No Result History Available For You</h5>
        
      @endforelse
      <hr>


      @forelse(\App\Exam::where('level_id',session('level_id'))->get() as $exam)
    <a href="{{route('exam_details',$exam->id)}}" class="list-group-item list-group-item-action bg-light">{{$exam->name}}</a>
      @empty 
        <h5>No Exam Available For You</h5>
      @endforelse
    @endif
    </div>
  </div>