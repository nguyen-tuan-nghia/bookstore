<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{  $web_detail->name  }}</title>
    <!--/tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Grocery Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!--//tags -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('web/logo/'.$web_detail->logo) }}" />
    <link href="{{ asset('client/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('client/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('client/css/font-awesome.css') }}" rel="stylesheet">
    <!--pop-up-box-->
    <link href="{{ asset('client/css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!--//pop-up-box-->
    <!-- price range -->
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/jquery-ui1.css') }}">
    <!-- jquery -->
    <link rel="stylesheet" href="{{ asset('client/css/flexslider.css') }}" type="text/css" media="screen">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('client/js/jquery-2.1.4.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.8/sweetalert2.css" />

    <!-- //jquery -->
    <!-- fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
</head>

<body>
    <!-- top-header -->
    <div class="header-most-top">
        <p>Ưu đãi hàng đầu của khu vực bán hàng và giảm giá</p>
    </div>
    <!-- //top-header -->
    <!-- header-bot-->
    <div class="header-bot">
        <div class="header-bot_inner_wthreeinfo_header_mid">
            <!-- header-bot-->
            <div class="col-md-4 logo_agile">
                <h1>
                    <a href="{{ url('/') }}">
                        {{ $web_detail->name }}
                        <img src="{{ asset('client/images/logo2.png') }}" alt=" ">
                    </a>
                </h1>
            </div>
            <!-- header-bot -->
            <div class="col-md-8 header">
                <!-- header lists -->
                <ul>
                    <li>
                        {{-- <a href="#" class="">
                            <span class="fa fa-map-marker" aria-hidden="true"></span> Shop Locator</a> --}}
                    </li>
                    <li>
                        {{-- <a href="#">
                            <span class="fa fa-truck" aria-hidden="true"></span>Track Order</a> --}}
                    </li>
                    <li>
                        <span class="fa fa-phone" aria-hidden="true"></span> {{ $web_detail->phone }}
                    </li>
                    @if (!Auth::user())
                        <li>
                            <a href="#" data-toggle="modal" data-target="#myModal1">
                                <span class="fa fa-unlock-alt" aria-hidden="true"></span> Đăng nhập </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#myModal2">
                                <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Đăng ký </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ URL::to('/cart/history') }}">
                                <div id="avatar">{{ Auth::user()->name }}</div></a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/logout') }}">
                                <span class="fa fa-pencil-square-o" aria-hidden="true"></span>Đăng xuất</a>
                        </li>
                    @endif
                </ul>
                <!-- //header lists -->
                <!-- search -->
                <div class="agileits_search">
                    <form action="{{ url('/search') }}" method="post">
                        @csrf
                        <input name="search" type="search" id="keywords" autocomplete="off" placeholder="Hôm nay tôi có thể làm gì để giúp bạn?" required="">
                        <button type="submit" class="btn btn-default" aria-label="Left Align">
                            <span class="fa fa-search" aria-hidden="true"> </span>
                        </button>
                        <div class="search-ajax" id="search_ajax"></div>
                    </form>
                </div>
                <!-- //search -->
                <!-- cart details -->
                <div class="top_nav_right">
                    <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                        {{-- <form action="#" method="post" class="last"> --}}
                        {{-- <input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="display" value="1"> --}}
                        {{-- <button class="w3view-cart" type="submit" name="submit" value=""> --}}
                        <a class="w3view-cart" id="cart"><i class="fa fa-cart-arrow-down"
                                aria-hidden="true"></i>
                        </a>
                        {{-- </button> --}}
                        {{-- </form> --}}
                    </div>
                </div>
                <!-- //cart details -->
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- signin Model -->
    @include('public.login.signin')
    <!-- //signin Model -->
    <!-- signup Model -->
    @include('public.login.signup')
    <!-- //signup Model -->
    <!-- //header-bot -->
    <!-- navigation -->
    <div class="ban-top">
        <div class="container">
            <div class="top_nav_left">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav menu__list">
                                <li class="active">
                                    <a class="nav-stylehead" href="{{ Url('/') }}">Trang chủ
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                @foreach ($danh_muc as $key => $val)
                                    @if ($val->category_parent == 0)
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle nav-stylehead" data-toggle="dropdown"
                                                role="button" aria-haspopup="true"
                                                aria-expanded="false">{{ $val->name }}
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu multi-column columns-3">
                                                <div class="agile_inner_drop_nav_info">
                                                    <div class="col-sm-4 multi-gd-img">
                                                        <ul class="multi-column-dropdown">
                                                            @foreach ($danh_muc as $key2 => $val2)
                                                                @if ($val2->category_parent == $val->id)
                                                                    <li>
                                                                        <a
                                                                            href="{{ url('danh-muc/' . $val2->slug) }}">{{ $val2->name }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                                <li>
                                    <a class="nav-stylehead" href="{{ Url('/gioi-thieu') }}">Giới thiệu
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-stylehead" href="{{ Url('/contact') }}">Liên hệ
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-stylehead" href="{{ Url('/tin-tuc') }}">Tin tức
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    @yield('content')
    <!-- //special offers -->
    <!-- newsletter -->
    <div class="footer-top">
        <div class="container-fluid">
            <div class="col-xs-8 agile-leftmk">
                <h2>Đơn hàng của bạn được giao từ các cửa hàng địa phương</h2>
                <p>Giao hàng miễn phí cho đơn hàng đầu tiên của bạn!!</p>
                <div class="newsform-w3l">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-xs-4 w3l-rightmk">
                <img src="{{ asset('client/images/tab3.png') }}" alt=" ">
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //newsletter -->
    <!-- footer -->
    <footer>
        <div class="container">
            <!-- footer first section -->
            <p class="footer-main">
                Nhà sách " Không ai từ chối hoặc ghét niềm vui bởi vì bản thân niềm vui là niềm vui, nhưng vì
                những nỗi đau lớn là kết quả của những người không biết cách theo đuổi niềm vui theo lý trí. Tôi sẽ giải
                thích những gì đã được nhà phát minh ra sự thật đó nói và, như nó đã là, kiến ​​trúc sư của cuộc sống
                may mắn.</p>
            <!-- //footer first section -->
            <!-- footer second section -->
            <div class="w3l-grids-footer">
                <div class="col-xs-4 offer-footer">
                    <div class="col-xs-4 icon-fot">
                        <span class="fa fa-map-marker" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-8 text-form-footer">
                        <h3>Theo dõi đơn hàng của bạn</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-4 offer-footer">
                    <div class="col-xs-4 icon-fot">
                        <span class="fa fa-refresh" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-8 text-form-footer">
                        <h3>Trả hàng miễn phí và dễ dàng</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-4 offer-footer">
                    <div class="col-xs-4 icon-fot">
                        <span class="fa fa-times" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-8 text-form-footer">
                        <h3>Hủy trực <br>tuyến</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- //footer second section -->
            <!-- footer third section -->
            <div class="footer-info w3-agileits-info">
                <!-- footer categories -->
                <div class="col-sm-5 address-right">
                    <div class="col-xs-6 footer-grids">
                        <h3>Danh muc</h3>
                        <ul>
                            @foreach($danh_muc as $key=> $val)
                            <li>
                                <a href="#">{{ $val->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- //footer categories -->
                <!-- quick links -->
                <div class="col-sm-5 address-right">
                    <div class="col-xs-6 footer-grids">

                    </div>
                    <div class="col-xs-8 footer-grids">
                        <h3>Liên lạc với chúng tôi</h3>
                        <ul>
                            <li>
                                <i class="fa fa-map-marker"></i> {{ $web_detail->address }}
                            </li>
                            <li>
                                <i class="fa fa-mobile"></i> {{ $web_detail->phone }}
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i>
                                <a href="mailto:example@mail.com">{{  $web_detail->email  }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- //quick links -->
                <!-- social icons -->
                <div class="col-sm-2 footer-grids  w3l-socialmk">
                    <h3>Theo dõi chúng tôi</h3>
                    <div class="social">
                        <ul>
                            <li>
                                <a class="icon fb" href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a class="icon tw" href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a class="icon gp" href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {!! $web_detail->fanpage !!}
                </div>
                <!-- //social icons -->
                <div class="clearfix"></div>
            </div>
        </div>
    </footer>
    <!-- //footer -->
    <script type="text/javascript">
        $('#keywords').keyup(function(){
            var query = $(this).val();
              if(query != '')
                {
                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                  url:"{{url('/keywords')}}",
                  method:"POST",
                  data:{query:query, _token:_token},
                  success:function(data){
                   $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                  }
                 });

                }else{

                    $('#search_ajax').fadeOut();
                }
        });

        $(document).on('click', '.li_search_ajax', function(){
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    <script>
        $("#cart").click(function(){
            var auth="{{ Auth::user() }}";
            if(auth){
                window.location.href="{{ url('/cart') }}";
            }else{
                $('#myModal1').modal('show');
            }
        });
    </script>
    <script>
        function cartstore(id) {
            var auth="{{ Auth::user() }}";
            if(auth){
            var id = id;
            var image = $("#product_image" + id).val();
            var quantity = $("#product_quantity" + id).val();
            var price = $("#product_price" + id).val();
            var name = $("#product_name" + id).val();
            $.ajax({
                url: "{{ url('/cart/store') }}",
                method: "POST",
                data: {
                    id: id,
                    image: image,
                    quantity: quantity,
                    price: price,
                    name: name
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    Swal.fire({
                        title: "",
                        text: "Bạn đã thêm sản phẩm vào giỏ hàng",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "<a style='color:white' href='{{ url('/cart') }}'><i class='la la-headphones'></i>Tới giỏ hàng</a>",
                        showCancelButton: true,
                        cancelButtonText: "<i class='la la-thumbs-down'></i> Mua tiếp",
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-default"
                        }
                    });
                }
            });
            }
            else{
                $('#myModal1').modal('show');
            }
        }
    </script>
    <!-- popup modal (for signin & signup)-->
    {{-- <script src="{{ asset('client/js/jquery.magnific-popup.js')}}"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script> --}}
    <script src="{{ asset('client/js/jquery.flexisel.js') }}"></script>
    <script>
        $(window).load(function() {
            $("#flexiselDemo1").flexisel({
                visibleItems: 3,
                animationSpeed: 1000,
                autoPlay: true,
                autoPlaySpeed: 3000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 2
                    }
                }
            });

        });
    </script>
    <!-- //flexisel (for special offers) -->
    <!-- start-smooth-scrolling -->
    <script src="{{ asset('client/js/move-top.js') }}"></script>
    <script src="{{ asset('client/js/easing.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->

    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function() {
            /*
            var defaults = {
            	containerID: 'toTop', // fading element id
            	containerHoverID: 'toTopHover', // fading element hover id
            	scrollSpeed: 1200,
            	easingType: 'linear'
            };
            */
            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.8/sweetalert2.min.js"></script>
    <script src="{{ asset('client/js/bootstrap.js') }}"></script>
    <!-- //for bootstrap working -->
    <!-- //js-files -->
</body>

</html>
