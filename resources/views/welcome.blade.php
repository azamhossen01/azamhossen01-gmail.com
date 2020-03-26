<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <!-- Styles -->
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">Online Exam</div>
                            <div class="card-body"> 
                            <h3>    Submit Phone number to start exam</h3>
                                <form action="{{route('start_exam')}}" method="post">
                                @csrf 
                                    <div class="form-group">
                                    <label for="student_phone">Phone</label>
                                    <input type="number" name="student_phone" required class="form-control" id="student_phone"  placeholder="Student Name">
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </body>
</html>
