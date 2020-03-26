@extends('partials.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="d-inline-block">Add New Exam</h3>
            <a href="{{route('exams.create')}}" class="btn btn-primary float-right">Add New</a>
            </div>
            <div class="card-body">
            <form action="{{route('exams.store')}}" method="post">
              @csrf
                <div class="form-group">
                  <label for="student_name">Name</label>
                  <input type="text" name="student_name" required class="form-control" id="student_name"  placeholder="Student Name">
                </div>
                <div class="form-group">
                  <label for="student_phone">Phone</label>
                  <input type="number" name="student_phone" required class="form-control" id="student_phone"  placeholder="Student Name">
                </div>
                <div class="form-group">
                  <label for="set_id">Set</label>
                  <select name="set_id" class="form-control" id="set_id" required>
                    <option value="">Select Set</option>
                    @forelse($sets as $key=>$set)
                  <option value="{{$set->id}}">{{$set->name}}</option> 
                    @empty 
                    @endforelse
                  </select>
                </div>
                <div class="form-group">
                  <label for="total">Total</label>
                  <input type="number" name="total" required class="form-control" id="total"  placeholder="Total Number">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection