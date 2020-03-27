@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">{{$exam->student_name}} Results</h3>
                <h4>Total Marks : {{$exam->total}}</h4>
                <h4>Marks Obtain in MCQ : {{$exam->mark_obtain_in_mcq}}</h4>
                <h4>Marks Obtain in Descriptive : {{$exam->mark_obtain_in_descriptive}}</h4>
            </div>
            <div class="card-body">
            <form action="{{route('results.update',$exam->id)}}" method="post">
            @csrf 
            @method('put')
                @forelse($exam->exam_details->where('attachment',true) as $key=>$exam_detail) 
                
                  <h4><span>{{$key+1}}) </span>{{$exam_detail->question->question}} ==== <span>{{$exam_detail->question->marks}}</span></h4>
                  <img src="{{asset('backend/images/answers/'.$exam_detail->attachment)}}" alt="">
                  
                
                @empty 

                @endforelse
                <div class="form-group">
                  <label for="descriptive_number">Descriptive Number</label>
                  <input type="number" {{$exam->mark_obtain_in_descriptive !== null ? 'readonly':''}} name="descriptive_number" required class="form-control" id="descriptive_number"  placeholder="Descriptive Number">
                </div>
                <button {{$exam->mark_obtain_in_descriptive !== null ? 'disabled':''}} class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection