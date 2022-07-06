 <!-- Modal2 -->
 <style>
     .center{
         margin: auto;
     }
     .fa {
  padding: 10px;
  font-size: 25px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
}

.fa:hover {
    opacity: 0.7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}

.fa-twitter {
  background: #55ACEE;
  color: white;
}

.fa-google {
  background: #dd4b39;
  color: white;
}
 </style>
 <div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
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
                     <h3 class="agileinfo_sign">ĐĂNG KÝ</h3>
                    <div class="center">
                        <Div class="social">
                            <a href="#" class="fa fa-facebook"></a>
                            <a href="#" class="fa fa-google"></a>
                        </Div>
                    </div>
                     <p>
                        Hãy tham gia Cửa hàng tạp hóa! Hãy thiết lập Tài khoản của bạn.
                    </p>
                     <form id="Signup" method="post">
                         <div class="styled-input agile-styled-input-top">
                             <input type="text" placeholder="Tên" name="Name" id="name" required="">
                             <div class="text-danger" id="error_name"></div>
                         </div>
                         <div class="styled-input">
                             <input type="email" placeholder="E-mail" name="Email" id="email_Signup" required="">
                             <div class="text-danger" id="error_email1"></div>
                         </div>
                         <div class="styled-input">
                             <input type="password" placeholder="Mật khẩu" name="password" id="password1" required="">
                             <div class="text-danger" id="error_password1"></div>
                         </div>
                         <div class="styled-input">
                             <input type="password" placeholder="Xác nhận mật khẩu" name="Confirm Password"
                                 id="password2" required="">
                                 <div class="text-danger"></div>
                                </div>
                         <input type="submit" value="ĐĂNG KÝ">
                     </form>
                     <p>
                         {{-- <a href="#">By clicking register, I agree to your terms</a> --}}
                     </p>
                 </div>
             </div>
         </div>
         <!-- //Modal content-->
     </div>
 </div>
 <!-- //Modal2 -->
 <script>
     $(document).ready(function() {

         $('#Signup').submit(function(e) {
             e.preventDefault();
             $('#error_name').html("");
             $('#error_email1').html("");
             $('#error_password1').html("");
             var email = $('#email_Signup').val();
             var name = $('#name').val();
             var password = $('#password1').val();
             $.ajax({
                 url:"{{url('/signup')}}",
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
                    window.location.reload();
                },
                 error:function(e){
                    console.log(e.responseJSON.errors);
                    $('#error_name').html(e.responseJSON.errors.name);
                    $('#error_email1').html(e.responseJSON.errors.email);
                    $('#error_password1').html(e.responseJSON.errors.password);
                 }
             });
         });
     });
 </script>
 	<!-- password-script -->
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
	<!-- //password-script -->
