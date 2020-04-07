@extends('frontend.layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
        <form action="{{route('result')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="exam_id" value="{{$exam_id}}">
            <input type="hidden" name="set_id" value="{{$set_id}}">
                @csrf 
                <h2>MCQ Questions : </h2>
                @forelse($mcq as $key=>$mq)
            <h5>{{$key +1 }} ) {{$mq->question->question}}</h5>
                
                    @forelse($mq->question->answers as $answer) 
                    <div class="form-check">
                    <input type="checkbox" name="mcq[]" value="{{$mq->question_id}}-{{$answer->id}}" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">{{$answer->answer}}</label>
                      </div>
                    @empty 
        
                    @endforelse
        
                @empty 
        
                @endforelse
                <hr>
                <h2>Descriptive Question : </h2>
                @forelse($descriptive as $key=>$des) 
                    <h5>{{$key+1}} ) {{$des->question->question}}</h5>
                    <input type="file" name="attachment[]" required>
                    <input type="hidden" name="descriptive_id[]" value="{{$des->question_id}}">
                    <hr>
                @empty 
        
                @endforelse
        
                <button type="submit" class="btn btn-info">Submit Answer</button>
            </form>
        </div>
    </div>
    <div class="row">
        <br><br>
    </div>

</div>

@endsection
