<div class="bg-light border-right" id="sidebar-wrapper">
<div class="sidebar-heading"><a href="{{route('/')}}">Online Exam</a> </div>

    <div class="list-group list-group-flush">
      @if(!session('phone'))
      @forelse(\App\Exam::all() as $exam)
    <a href="{{route('exam_details',$exam->id)}}" class="list-group-item list-group-item-action bg-light">{{$exam->name}}</a>
      @empty 
      @endforelse
    @endif
    </div>
  </div>