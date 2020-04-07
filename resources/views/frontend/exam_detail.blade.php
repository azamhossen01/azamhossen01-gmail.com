@extends('frontend.layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{$exam_details[0]->exam->name}} Details</div>
                <div class="card-body">
                    @forelse($exam_details->groupBy('set_id') as $set=>$exam_detail)
                    <h3>Set : {{$exam_detail[0]->set->name}}</h3>
                <a href="{{route('start_exam',['exam_id'=>$exam_detail[0]->exam_id,'set_id'=>$exam_detail[0]->set_id])}}" class="btn btn-success mb-2">Start Exam</a>
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>MCQ Question</h4>
                            @php
                                $a = 1;
                                $b = 1;
                            @endphp
                            @forelse($mcq as $key=>$mc)
                            @if($mc->set_id == $set)
                            
                        <p><span>{{$a++}} ) </span>{{$mc->question->question}}</p>
                            @endif
                            @empty

                            @endforelse
                        </div>
                        <div class="col-lg-6">
                            <h4>Descriptive Question</h4>
                            @forelse($descriptive as $key=>$mc)
                            @if($mc->set_id == $set)
                            <p><span>{{$b++}} ) </span>{{$mc->question->question}}</p>
                            @endif

                            @empty

                            @endforelse
                        </div>
                    </div>



                    <hr>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
