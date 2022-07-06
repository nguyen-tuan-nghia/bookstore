@extends('layout.home')
@section('content')
    <style>
        .flex {
            display: flex;
            flex-wrap: nowrap;
        }

        .flex>div {
            padding: 10px
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.8/sweetalert2.css"
        integrity="sha512-40/Lc5CTd+76RzYwpttkBAJU68jKKQy4mnPI52KKOHwRBsGcvQct9cIqpWT/XGLSsQFAcuty1fIuNgqRoZTiGQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="banner-bootom-w3-agileits">
        <div class="container">
            <!-- tittle heading -->
            {{-- <h3 class="tittle-w3l">Single Page
            <span class="heading-style">
                <i></i>
                <i></i>
                <i></i>
            </span>
        </h3> --}}
            <!-- //tittle heading -->
            <div class="col-md-5 single-right-left ">
                <div class="grid images_3_of_2">
                    <div class="flexslider">
                        <ul class="slides">
                            @if (Count($product->gallery) > 0)
                                @foreach ($product->gallery as $key => $val)
                                    <li data-thumb="{{ asset('product/thumbnails/' . $val->image) }}">
                                        <div class="thumb-image">
                                            <img src="{{ asset('product/thumbnails/' . $val->image) }}"
                                                data-imagezoom="true" class="img-responsive" alt="">
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 single-right-left simpleCart_shelfItem">
                <h3>{{ $product->name }}</h3>
                <div class="rating1">
                    <span class="starRating">
                        <input id="rating5" type="radio" @if ($star == 5) checked @endif name="rating"
                            value="5">
                        <label for="rating5">5</label>
                        <input id="rating4" type="radio" @if ($star == 4) checked @endif name="rating"
                            value="4">
                        <label for="rating4">4</label>
                        <input id="rating3" type="radio" @if ($star == 3) checked @endif name="rating"
                            value="3">
                        <label for="rating3">3</label>
                        <input id="rating2" type="radio" @if ($star == 2) checked @endif name="rating"
                            value="2">
                        <label for="rating2">2</label>
                        <input id="rating1" type="radio" @if ($star == 1) checked @endif name="rating"
                            value="1">
                        <label for="rating1">1</label>
                    </span>
                </div>
                <p>
                    <span class="item_price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                    @if ($product->sale)
                        <del>{{ number_format($product->sale, 0, ',', '.') }}</del>
                    @endif
                    {{-- <label>Free delivery</label> --}}
                </p>
                {{-- <div class="single-infoagile">
                <ul>
                    <li>
                        Cash on Delivery Eligible.
                    </li>
                    <li>
                        Shipping Speed to Delivery.
                    </li>
                    <li>
                        Sold and fulfilled by Supple Tek (3.6 out of 5 | 8 ratings).
                    </li>
                    <li>
                        1 offer from
                        <span class="item_price">$950.00</span>
                    </li>
                </ul>
            </div> --}}
                <div class="product-single-w3l">
                    <p>
                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                        <label>{{ $product->category->name }}</label>
                    </p>

                    <div style="">
                        {!! $product->content !!}
                    </div>
                    {{-- <ul>
                    <li>
                        Best for Biryani and Pulao.
                    </li>
                    <li>
                        After cooking, Zeeba Basmati rice grains attain an extra ordinary length of upto 2.4 cm/~1 inch.
                    </li>
                    <li>
                        Zeeba Basmati rice adheres to the highest food afety standards as your health is paramount to us.
                    </li>
                    <li>
                        Contains only the best and purest grade of basmati rice grain of Export quality.
                    </li>
                </ul> --}}
                    <p>
                        <i class="fa fa-refresh" aria-hidden="true"></i>Tất cả các sản phẩm
                        <label>không thể trả lại..</label>
                    </p>
                </div>
                <div class="occasion-cart">
                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                        <input type="hidden" id="product_id" value="{{ $product->id }}">
                        <input type="hidden" id="product_quantity{{ $product->id }}" value="1">
                        <input type="hidden" id="product_name{{ $product->id }}" value="{{ $product->name }}">
                        @if (Count($product->gallery) > 0)
                            <input type="hidden" id="product_image{{ $product->id }}"
                                value="{{ $product->gallery[0]->image }}">
                        @else
                            <input type="hidden" id="product_image{{ $product->id }}" value="">
                        @endif
                        <input type="hidden" id="product_price{{ $product->id }}" value="{{ $product->price }}">
                        <input type="button" class="button" onclick="cartstore({{ $product->id }})"
                            value="Thêm vào giỏ hàng">
                    </div>

                </div>

            </div>

            <div class="clearfix"> </div>
            <br>
            <strong>Bình luận</strong>
            <form id="content">
                <textarea id="contenttext" cols="140" rows="7" required></textarea>
                <input style="width:1140px" class="btn btn-block" type="submit" value="Gửi">
            </form>
            <hr>
            <div id="ok">
                @foreach($com as $val)
                <div class="flex">
                    <div><strong>{{$val->name}}</strong></div>
                    <div>{{$val->content}}</div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    </div>
    <!-- FlexSlider -->
    <script src="{{ asset('client/js/jquery.flexslider.js') }}"></script>
    <script>
        // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });
    </script>
    <!-- //FlexSlider-->
    <!-- imagezoom -->
    <script src="{{ asset('client/js/imagezoom.js') }}"></script>
    <!-- //imagezoom -->

    <script>
        $("#content").submit(function(e) {
            e.preventDefault();
            const auth = '{{ Auth::user() }}';
            var contenttext = $("#contenttext").val();
            var id= '{{$product->id}}';
            var avatar=$("#avatar").text();

            if (auth) {
                $.ajax({
                    url: "{{ url('/comment/store') }}",
                    method: "POST",
                    data: { contenttext: contenttext, id :id },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        $("#ok").append(
                            "<div class='flex'> <div > <strong> "+avatar+" </strong></div><div> " +
                            contenttext + " </div> </div>");
                    }
                });
            } else {
                alert("Bạn chưa đăng nhập");
            }
        });
    </script>
@endsection
