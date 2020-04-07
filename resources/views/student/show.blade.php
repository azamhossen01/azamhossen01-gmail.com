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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Exam Name</th>
                          <th>Set</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>SL</th>
                          <th>Exam Name</th>
                          <th>Set</th>
                          <th>Created At</th>
                          <th>Action</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @forelse($results as $key=>$result)
                            <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$result->exam->name}}</td>
                            <td>{{$result->set->name}}</td>
                            <td>{{$result->created_at?$result->created_at->format('F d Y'):''}}</td>
                            <td>
                            <a href="{{route('students.show',$result->id)}}" class="btn btn-success btn-sm">Exam Details</a>
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