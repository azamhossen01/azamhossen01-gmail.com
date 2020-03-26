@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Add New Question</h3>
            <a href="{{route('questions.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
            <form action="{{route('questions.store')}}" method="post">
              @csrf
                <div class="form-group">
                  <label for="subject_id">Subject</label>
                  <select name="subject_id" class="form-control" id="subject_id">
                    <option value="">Select Subject</option>
                    @forelse($subjects as $key=>$subject)
                  <option value="{{$subject->id}}">{{$subject->name}}</option> 
                    @empty 
                    @endforelse
                  </select>
                </div>
                <div class="form-group">
                  <label for="set_id">Set</label>
                  <select name="set_id" class="form-control" id="set_id">
                    <option value="">Select Set</option>
                    @forelse($sets as $key=>$set)
                  <option value="{{$set->id}}">{{$set->name}}</option> 
                    @empty 
                    @endforelse
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="question">Question</label>
                  <input type="text" name="question" required class="form-control" id="question"  placeholder="Question">
                </div>

                <div class="form-group">
                  <label for="type">Type</label>
                  <select name="type" class="form-control" id="type" onchange="get_answer_type(this.value)">
                    <option value="">Select Question Type</option>
                  <option value="0">MCQ</option> 
                  <option value="1">Descrptive</option> 
                  </select>
                </div>

                <div class="form-group">
                  <label for="answers">Add Answers</label>
                  <span>
                    <button onclick="add_options()" type="button" class="btn btn-success ml-2 btn-sm"><b>+</b></button>
                  </span>
                  
                  <div class="custom-control custom-checkbox" id="mcq_question" style="display:none">
                    {{-- <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label> --}}
                  </div>
                  <div id="descriptive_question" style="display:none">
                    <input type="file" name="attachment" >
                  </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
  <script>
    function add_options(){
      
     var num1 = Math.round(new Date().getTime() + (Math.random() * 100));
     var num2 = Math.round(new Date().getTime() + (Math.random() * 101));
      $('#mcq_question').append(
        `<div id="${num2}">
          <input name="is_correct[]" type="checkbox" class="custom-control-input" id="${num1}">
              <label class="custom-control-label" for="${num1}">
                <input name="answer[]" type="text" class="form-control"  />
              </label>
              <span>
              <button onclick="remove_options(${num2})" type="button" class="btn btn-danger ml-2 btn-sm"><b>X</b></button>
            </span>
        </div>
          `
      );
     
    }

    function remove_options(num2){
       console.log(num2);
       $("#"+num2).remove();
    }

    function get_answer_type(type){
      if(type == '0'){
        $('#mcq_question').css('display','block');
        $('#descriptive_question').css('display','none');
      }else{
        $('#mcq_question').css('display','none');
        $('#descriptive_question').css('display','block');
      }
    }
  </script>
@endpush