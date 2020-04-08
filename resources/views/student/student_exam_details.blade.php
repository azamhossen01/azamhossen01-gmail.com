@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">All Sets</h3>
                <a href="{{route('sets.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
                @forelse($mcq as  $mc)
                    <p>{{$mc->first()->question->question}}</p>
                    @forelse($mc->first()->question->answers as $answer)
            <p class="ml-4 {{is_correct_mcq($mc->first()->result_id,$mc->first()->question_id,$answer->id)?'text-success':''}}">{{$answer->answer}}</p>
                    @empty 

                    @endforelse
                @empty 

                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
