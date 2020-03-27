@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">All Results</h3>
            <a href="{{route('sets.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                      <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @forelse($results as $key=>$result)
                            <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$result->student_name}}</td>
                            <td>{{$result->student_phone}}</td>
                            <td>{{$result->created_at->format('F d Y')}}</td>
                            <td>
                            <a href="{{route('results.show',$result->id)}}" class="btn btn-success btn-sm">Details</a>
                           
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