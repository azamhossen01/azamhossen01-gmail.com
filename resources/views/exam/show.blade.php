@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Exam Details</h3>
            <a href="{{route('exams.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tr>  
                      <th>Student Name</th>
                      <td>{{$exam->student_name}}</td>
                    </tr>
                    <tr>  
                      <th>Student Phone</th>
                      <td>{{$exam->student_phone}}</td>
                    </tr>
                    <tr>
                      <th>Set</th>
                      <td>{{$exam->set->name}}</td>
                    </tr>
                    <tr>
                        <th>Total Number</th>
                        <td>{{$exam->total}}</td>
                    </tr>
                    <tr>
                        <th>Total MCQ</th>
                        <td>{{count($exam->set->questions->where('type',0))}}</td>
                    </tr>
                    <tr>
                        <th>Total Descriptive</th>
                        <td>{{count($exam->set->questions->where('type',1))}}</td>
                    </tr>
                  </table>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection