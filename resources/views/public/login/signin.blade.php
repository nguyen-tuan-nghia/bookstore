	<!-- Modal1 -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body modal-body-sub_agile">
					<div class="main-mailposi">
						<span class="fa fa-envelope-o" aria-hidden="true"></span>
					</div>
					<div class="modal_body_left modal_body_left1">
						<h3 class="agileinfo_sign">Đăng nhập </h3>
                    <div class="social">
                        <a href="#" class="fa fa-facebook"></a>
                     <a href="#" class="fa fa-google"></a>
                    </div>
						<p>
                            Đăng nhập ngay bây giờ, Hãy bắt đầu Mua sắm hàng tạp hóa của bạn. Không có tài khoản?
							<a href="#" data-toggle="modal" data-target="#myModal2">
                                Đăng ký ngay</a>
						</p>
						<form id="Signin" method="post">
							<div class="styled-input agile-styled-input-top">
								<input type="email" placeholder="E-mail" id="email" name="Name" required="">
                                <div class="text-danger" id="error_email"></div>
							</div>
							<div class="styled-input">
								<input type="password" placeholder="Mật khẩu" id="password" name="password" required="">
                                <div class="text-danger" id="error_password"></div>
							</div>
							<input type="submit" value="Đăng nhập">
						</form>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- //Modal content-->
		</div>
	</div>
	<!-- //Modal1 -->
    <script>
        $(document).ready(function() {

            $('#Signin').submit(function(e) {
                e.preventDefault();
                $('#error_email').html("");
                $('#error_password').html("");
                var email = $('#email').val();
                var password = $('#password').val();
                $.ajax({
                    url:"{{url('/signin')}}",
                    data: {
                        email: email,
                        password: password
                    },
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(e){
                        if(e==2){
                            $('#error_email').html("Tài khoản không tồn tại");
                        }else{
                            window.location.reload();
                        }
                   },
                    error:function(e){
                       console.log(e.responseJSON.errors);
                       $('#error_email').html(e.responseJSON.errors.email);
                       $('#error_password').html(e.responseJSON.errors.password);
                    }
                });
            })
        });
    </script>
