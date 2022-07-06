 <!-- banner -->
 <div id="myCarousel" class="carousel slide" data-ride="carousel">
     <!-- Indicators-->
     <ol class="carousel-indicators">
         <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
         <li data-target="#myCarousel" data-slide-to="1" class=""></li>
         <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        
     </ol>
     <div class="carousel-inner" role="listbox">
         <div class="item active"
             style="	background:url({{ asset('client/images/book1.jpeg') }}) no-repeat;background-size:cover;
            ">
             <div class="container">
                 <div class="carousel-caption">
                     <h3>
                         <span>TIẾT KIỆM LỚN</span>
                     </h3>
                     <p>Nhận tiền hoàn lại lên đến
                         <span>10%</span>
                     </p>
                     <a class="button2" href="#">Shop Now </a>
                 </div>
             </div>
         </div>
         <div class="item item2"
             style="	background:url({{ asset('client/images/banner2.jpg') }}) no-repeat;background-size:cover;
         ">
             <div class="container">
                 <div class="carousel-caption">
                     <h3>
                         <span>TIẾT KIỆM SỨC KHỎE</span>
                     </h3>
                     <p>Giảm giá lên đên
                         <span>30%</span>
                     </p>
                     <a class="button2" href="#">Mua Ngay </a>
                 </div>
             </div>
         </div>
         <div class="item item3"
             style="	background:url({{ asset('client/images/book8.jpg') }}) no-repeat;background-size:cover;
         ">
             <div class="container">
                 <div class="carousel-caption">
                     <h3>
                         <span>Giao dịch</span>
                     </h3>
                     <p>Nhận ưu đãi tốt nhất tối đa
                         <span>20%</span>
                     </p>
                     <a class="button2" href="#">Mua Ngay </a>
                 </div>
             </div>
         </div>
         {{-- <div class="item item4">
				<div class="container">
					<div class="carousel-caption">
						<h3>Today
							<span>Discount</span>
						</h3>
						<p>Get Now
							<span>40%</span> Discount</p>
						<a class="button2" href="#">Shop Now </a>
					</div>
				</div>
			</div> --}}
     </div>
     <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
         <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
     </a>
     <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
         <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
     </a>
 </div>
 <!-- //banner -->
