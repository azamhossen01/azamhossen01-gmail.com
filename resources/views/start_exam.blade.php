<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <!-- Styles -->
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Total MCQ : {{count($mcq_questions)}}</h4>
                                <h4>Total Descriptive : {{count($descriptive_questions)}}</h4>
                            </div>
                            <div class="card-body"> 
                                <form action="{{route('submit_exam',$exam->id)}}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <div class="section">
                                    <h3>    Description Questions</h3>
                                    @forelse($descriptive_questions as $key=>$des_ques) 
                                  <p>  <strong>    {{$key}} )</strong>{{$des_ques->question}} X {{$des_ques->marks}}</p>
                                  <input type="file" name="attachment[]">
                                    @empty 
                                        <h3>No Descriptive Question Available</h3>
                                    @endforelse
                                </div>
                                <hr>
                                <div class="section">   
                                    <h3>    MCQ Questions</h3>
                                    @forelse($mcq_questions as $key=>$mcq_ques) 
                                    <p>  <strong>    {{$key}} )</strong>{{$mcq_ques->question}} X {{$mcq_ques->marks}}</p>

                                        @forelse($mcq_ques->answers as $key=>$answer) 
                                        <div class="custom-control custom-checkbox">
                                            <input name="is_correct[]"  type="checkbox" value="{{$mcq_ques->id.'-'.$answer->id}}" class="custom-control-input" id="{{$answer->id}}">
                                            <label class="custom-control-label" for="{{$answer->id}}">
                                                <input value="{{$answer->answer}}" name="answer[]" type="text" class="form-control"  />
                                            </label>
                                            </div>
                                        @empty 

                                        @endforelse

                                    @empty 
                                    <h3>No MCQ Question Available</h3>
                                    @endforelse
                                </div>

                                <button class="btn btn-primary">    Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </body>
</html>
