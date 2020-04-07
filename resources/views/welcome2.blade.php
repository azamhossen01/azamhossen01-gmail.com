<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('frontend')}}/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

    <div class="main" id="app">

 
        <router-view></router-view>

        

    </div>

    <!-- JS -->
{{-- <script src="{{asset('frontend')}}/vendor/jquery/jquery.min.js"></script> --}}
<script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('frontend')}}/js/main.js"></script>
    {{-- <script>
        function logout(){
            alert('test');
            $.ajax({
                type : 'get',
                url : "{{route('student_logout')}}",
                success : function(data){
                    console.log(data);
                    location.reload(true);
                }
            });
        }
    </script> --}}
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>