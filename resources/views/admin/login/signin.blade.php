<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet') }}" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        {{-- <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1> --}}
                                    </div>
                                    <form class="user" id="dangnhap">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                aria-describedby="emailHelp" placeholder="Eamil" required>
                                                <div class="text-danger" id="error_email"></div>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                placeholder="Mật khẩu" required>
                                                <div class="text-danger" id="error_password"></div>

                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">

                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Đăng nhập">
                                        <hr>
                                    </form>
                                    <hr>
                                    {{-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script>
        $("#dangnhap").submit(function(e) {
            e.preventDefault();
            $('#error_email').html("");
            $('#error_password').html("");
            var email = $("#email").val();
            var password = $("#password").val();
            $.ajax({
                url: "{{ url('/admin/signin') }}",
                method: "POST",
                data: {
                    email: email,
                    password: password
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(e) {
                    if (e == 2) {
                        $('#error_email').html("Tài khoản không tồn tại");
                    } else {
                        window.location.href="{{ url('/dashboard') }}";
                    }
                },
                error: function(e) {
                    console.log(e.responseJSON.errors);
                    $('#error_email').html(e.responseJSON.errors.email);
                    $('#error_password').html(e.responseJSON.errors.password);
                }
            });
        });
    </script>
</body>

</html>
