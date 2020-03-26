@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Edit Set</h3>
            <a href="{{route('subjects.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
            <form action="{{route('subjects.update',$subject->id)}}" method="post">
              @csrf
              @method('put')
                <div class="form-group">
                  <label for="name">Name</label>
                <input type="text" value="{{$subject->name}}" required name="name" class="form-control" id="name"  placeholder="Subject Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Subject Description">{{$subject->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection