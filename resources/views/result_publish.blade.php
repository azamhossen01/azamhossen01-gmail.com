<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!-- <link rel="stylesheet" href="{{asset('backend/css/style1.css')}}">
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" /> -->
        <!-- <link rel="stylesheet" href="{{asset('backend/css/style2.css')}}"> -->

        <!-- Styles -->
        
    </head>
    <body>
        <div class="container">
           

            <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Total MCQ : {{count($exam->set->questions->where('type',0))}}</h4>
                                <h4>Total Descriptive : {{count($exam->set->questions->where('type',1))}}</h4>
                                <hr>    
                                <h3>    Get In MCQ : {{$exam->mark_obtain_in_mcq}}</h3>
                                <h3>    Get In Descriptive : Pending</h3>
                            </div>
                            <div class="card-body"> 
                                <!-- <form action="{{route('submit_exam',$exam->id)}}" method="post" enctype="multipart/form-data"> -->
                                @csrf 
                                
                                <hr>
                                <div class="section">   
                                    <h3>    MCQ Questions</h3>
                                    @forelse($exam->set->questions->where('type',0) as $key=>$mcq_ques) 
                                    <p>  <strong>    {{$key+1}} )</strong>{{$mcq_ques->question}} X {{$mcq_ques->marks}}</p>

                                        @forelse($mcq_ques->answers as $key1=>$answer) 
                                        
                                        <div class="custom-control custom-checkbox">
                                       
                                            <input disabled {{$answer->is_correct==1?'checked':''}} name="is_correct[]"  type="checkbox" value="{{$mcq_ques->id.'-'.$answer->id}}" class="custom-control-input" id="{{$answer->id}}">
                                            <label class="custom-control-label" for="{{$answer->id}}">
                                            <input readonly value="{{$answer->answer}}" name="answer[]" type="text" class="form-control{{$exam->exam_details->where('exam_id',$exam->id)->where('question_id',$mcq_ques->id)->where('answer_id',$answer->id)->first()?' bg-warning':''}}"  />
                                            </label>
                                            @if($answer->is_correct == 1 && $answer->id==$exam->exam_details->where('exam_id',$exam->id)->where('question_id',$mcq_ques->id)->where('answer_id',$answer->id)->first()['answer_id'])
                                                <input type="checkbox" checked>
                                            @elseif($answer->is_correct == 1 && $answer->id!==$exam->exam_details->where('exam_id',$exam->id)->where('question_id',$mcq_ques->id)->where('answer_id',$answer->id)->first()['answer_id']) 
                                            <strong class="text-danger">X</strong>
                                            @endif
                                            
                                            </div>
                                        @empty 

                                        @endforelse

                                    @empty 
                                    <h3>No MCQ Question Available</h3>
                                    @endforelse
                                </div>

                                
                               
                            </div>
                            <!-- <div class="card-footer">
                            <button class="btn btn-primary">    Submit</button>
                               
                                
                               </form>
                            </div> -->
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </body>
</html>
