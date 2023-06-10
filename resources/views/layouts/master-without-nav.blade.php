<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <style>
        body {
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            font-family: Montserrat;
        }
        input {
            background-color: rgba(42, 39, 56, 1)!important; /* Set the desired color here */
        }

        .bg-dark-blue {
            background-color: rgba(53, 57, 114, 1) !important;
        }
    </style>
</head>
<body>
{{--<header class="navbar navbar-expand-lg navbar-dark bg-dark">--}}
{{--    <div class="sidebar-brand-wrapper fixed-top mb-5">--}}
{{--        <a class="sidebar-brand brand-logo" ><img src="{{ asset('assets/current_tech_logo.png')}}" alt="" width="150" height="66"></a>--}}
{{--    </div>--}}
{{--</header>--}}
<div class="content">
    @yield('contents')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</div>
<!-- /Page Content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#pass_button").click(function(){
            var password_id = document.getElementById("password");
            if (password_id.type === "password") {
                password_id.type = "text";
                $("#pass_button").attr('class', 'input-group-text pt-1 text-white fa fa-eye-slash');
            } else {
                password_id.type = "password";
                $("#pass_button").attr('class', 'input-group-text pt-1 text-white fa fa-eye');
            }
        });

        $("#pass_button_confirm").click(function(){
            var password_id_2 = document.getElementById("password_2");

            if (password_id_2.type === "password") {
                password_id_2.type = "text";
                $("#pass_button_confirm").attr('class', 'input-group-text pt-1 text-white fa fa-eye-slash');
            } else {
                password_id_2.type = "password";
                $("#pass_button_confirm").attr('class', 'input-group-text pt-1 text-white fa fa-eye');
            }
        });

    })
</script>
@yield('scripts')
</body>
</html>
