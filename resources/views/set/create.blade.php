@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Add New Set</h3>
            <a href="{{route('sets.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
            <form action="{{route('sets.store')}}" method="post">
              @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" required class="form-control" id="name"  placeholder="Subject Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Subject Description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection