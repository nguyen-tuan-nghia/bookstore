<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet')}}" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="{{ asset('admin/vendor/jquery/jquery.min.js')}}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng ký!</h1>
                            </div>
                            <form class="user" id="Signup">
                                <div class="form-group">
                                    <input type="name" class="form-control form-control-user" id="name"
                                        placeholder="Họ tên">
                                        <div class="text-danger" id="error_name"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email"
                                        placeholder="Email">
                                        <div class="text-danger" id="error_email"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password1" placeholder="Mật khẩu">
                                            <div class="text-danger" id="error_password"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="password2" placeholder="Xác nhận mật khẩu">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Đăng ký">

                                <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js')}}"></script>
<script>
             $('#Signup').submit(function(e) {
             e.preventDefault();
             $('#error_name').html("");
             $('#error_email').html("");
             $('#error_password').html("");
             var email = $('#email').val();
             var name = $('#name').val();
             var password = $('#password1').val();
             $.ajax({
                 url:"{{url('/admin/signup')}}",
                 data: {
                     email: email,
                     name: name,
                     password: password
                 },
                 method: "POST",
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 success:function(){
                    window.location.href="{{ url('/admin/dangnhap') }}";
                },
                 error:function(e){
                    console.log(e.responseJSON.errors);
                    $('#error_name').html(e.responseJSON.errors.name);
                    $('#error_email').html(e.responseJSON.errors.email);
                    $('#error_password').html(e.responseJSON.errors.password);
                 }
             });
         });
</script>
<script>
    window.onload = function () {
        document.getElementById("password1").onchange = validatePassword;
        document.getElementById("password2").onchange = validatePassword;
    }

    function validatePassword() {
        var pass2 = document.getElementById("password2").value;
        var pass1 = document.getElementById("password1").value;
        if (pass1 != pass2)
            document.getElementById("password2").setCustomValidity("Passwords Don't Match");
        else
            document.getElementById("password2").setCustomValidity('');
        //empty string means no validation error
    }
</script>
</body>

</html>
