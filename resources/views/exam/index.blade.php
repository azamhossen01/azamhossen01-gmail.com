@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">All Exams</h3>
            <a href="{{route('exams.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Set</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                      <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Set</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @forelse($exams as $key=>$exam)
                            <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$exam->student_name}}</td>
                            <td>{{$exam->student_phone}}</td>
                            <td>{{$exam->set->name}}</td>
                            <td>{{$exam->created_at->format('F d Y')}}</td>
                            <td>
                            <a href="{{route('exams.edit',$exam->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{route('exams.show',$exam->id)}}" class="btn btn-success btn-sm">Details</a>
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