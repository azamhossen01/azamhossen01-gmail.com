@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">All Classes</h3>
            <a href="{{route('levels.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @forelse($levels as $key=>$level)
                            <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$level->name}}</td>
                            <td>{{$level->description}}</td>
                            <td>{{$level->created_at?$level->created_at->format('F d Y'):''}}</td>
                            <td>
                            <a href="{{route('levels.edit',$level->id)}}" class="btn btn-warning btn-sm">Edit</a>
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