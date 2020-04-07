<link rel="stylesheet" href="{{asset('css/app.css')}}">
<div class="col-md-4 col-md-offset-4" id="login">
    <section id="inner-wrapper" class="login">
        <article>
        <form method="post" action="{{route('student_register')}}">
            @csrf
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"> </i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                        <input type="number" class="form-control" name="phone" placeholder="Phone Number" required>
                    </div>
                </div>
            <input type="hidden" value="{{$exam_id}}" name="exam_id">
            <input type="hidden" value="{{$set_id}}" name="set_id">
                  <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
        </article>
    </section></div>
<script src="{{asset('js/app.js')}}"></script>