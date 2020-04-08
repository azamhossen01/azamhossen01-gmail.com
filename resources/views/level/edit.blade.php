@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Edit Class</h3>
            <a href="{{route('levels.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
            <form action="{{route('levels.update',$level->id)}}" method="post">
              @csrf
              @method('put')
                <div class="form-group">
                  <label for="name">Name</label>
                <input type="text" value="{{$level->name}}" required name="name" class="form-control" id="name"  placeholder="Level Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Level Description">{{$level->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection