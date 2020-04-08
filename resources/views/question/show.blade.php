@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Question Details</h3>
            <a href="{{route('questions.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      
                      <tr>
                          <th>  Class : </th>
                          <td>{{$question->level->name}}</td>
                      </tr>
                      <tr>
                          <th>  Subject : </th>
                          <td>{{$question->subject->name}}</td>
                      </tr>
                      <tr>
                          <th>  Type : </th>
                          <td>{{$question->type == 0 ? 'MCQ':'Descriptive'}}</td>
                      </tr>
                      <tr>
                          <th>  Marks : </th>
                          <td>{{$question->marks}}</td>
                      </tr>
                      </tr>
                      <tr>
                          <th>  Question : </th>
                          <td>{{$question->question}}</td>
                      </tr>
                      <div class="card">
                        <div class="card-body">
                          <form action="{{route('answers.update',$question->id)}}" method="post" enctype="multipart/form-data">
                          @csrf 
                          @method('put')
                          @if($question->type == 0)
                          <table class="table table-bordered">
                            @forelse($question->answers as $key=>$answer)
                              <tr>
                                <td>
                                <div class="custom-control custom-checkbox">
                                <input name="is_correct[]" {{$answer->is_correct==1?'checked':''}} type="checkbox" value="{{$answer->id}}" class="custom-control-input" id="{{$answer->id}}">
                                  <label class="custom-control-label" for="{{$answer->id}}">
                                    <input value="{{$answer->answer}}" name="answer[]" type="text" class="form-control col-lg-12"  />
                                  </label>
                                  </div>
                                </td>
                              </tr>
                            @empty 

                            @endforelse
                          </table>
                          @else 
                          <tr>  
                            <td><img src="{{asset('backend/images/questions/'.$question->answers->first()->attachment)}}" alt="">
                            
                            </td>
                          </tr>
                          <tr>
                            <td> <input type="file" name="attachment"> </td>
                          </tr>
                          
                          @endif

                          <tr>
                            <td><button class="btn btn-warning">Update</button></td>
                          </tr>
                          </form>
                        </div>
                      </div>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection