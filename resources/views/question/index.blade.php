@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">All Questions</h3>
            <a href="{{route('questions.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Question</th>
                          <th>Answer</th>
                          <th>Marks</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Marks</th>
                            <th>Action</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @forelse($questions as $key=>$question)
                            <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$question->question}}</td>
                            <td>
                              @forelse($question->answers->where('is_correct',1) as $key=>$answer) 
                                <span class="text-success">#{{$answer->answer}}</span>
                              @empty 

                              @endforelse
                            </td>
                          <td>{{$question->marks}}</td>
                            <td>
                            <a href="{{route('questions.show',$question->id)}}" class="btn btn-success btn-sm">Details</a>
                            <a href="{{route('questions.delete',$question->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                            </tr>
                        @empty 

                        @endforelse
                        
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection