@extends('layout.home')
@section('content')
@include('public.banner')
	<!-- top Products -->
	<div class="ads-grid">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Những sản phẩm hàng đầu của chúng tôi
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<!-- product right -->
			<div class="agileinfo-ads-display col-md-12">
				<div class="wrapper">
					<!-- first section (nuts) -->
					<div class="product-sec1">
						<h3 class="heading-tittle">Sản phẩm mới</h3>
                        @if(count($cereals))
                        @foreach($cereals as $kay =>$val)
						<div class="col-md-4 product-men">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
                                    @if(count($val->gallery)>0)
									<img src="{{asset('product/thumbnails/'.$val->gallery[0]->image)}}" alt="{{ $val->gallery[0]->image }}" style="width:170px">
                                    @else
									<img src="{{asset('client/images/no-image.png')}}" alt="" style="width:323px">
                                    @endif
									<div class="men-cart-pro">
										<div class="inner-men-cart-pro">
											<a href="{{ url('home/'.$val->slug) }}" class="link-product-add-cart">Chi tiết</a>
										</div>
									</div>
									<span class="product-new-top">New</span>
								</div>
								<div class="item-info-product ">
									<h4>
										<a href="single.html">{{ $val->name }}</a>
									</h4>
									<div class="info-product-price">
										<span class="item_price">{{number_format($val->price,0,',','.')}} VNĐ</span>
										@if($val->sale)
                                        <del>{{number_format($val->sale,0,',','.')}}</del>
                                        @endif
									</div>
									<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                        <input type="hidden" id="product_id" value="{{ $val->id }}">
                                        <input type="hidden" id="product_quantity{{ $val->id }}" value="1">
                                        <input type="hidden" id="product_name{{ $val->id }}" value="{{ $val->name }}">
                                        @if (Count($val->gallery) > 0)
                                            <input type="hidden" id="product_image{{ $val->id }}" value="{{ $val->gallery[0]->image }}">
                                        @else
                                            <input type="hidden" id="product_image{{ $val->id }}" value="">
                                        @endif
                                        <input type="hidden" id="product_price{{ $val->id }}" value="{{ $val->price }}">
                                        <input type="button" class="button" onclick="cartstore({{ $val->id }})" value="Thêm vào giỏ hàng" >
									</div>

								</div>
							</div>
						</div>
                        @endforeach
                        @else
						<div class="col-md-4 product-men">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img src="{{asset('client/images/no-image.png')}}" alt="" style="width:323px">
									<div class="men-cart-pro">
										<div class="inner-men-cart-pro">
											<a href="/" class="link-product-add-cart">Chi tiết</a>
										</div>
									</div>
									<span class="product-new-top">New</span>
								</div>
								<div class="item-info-product ">
									<h4>
										<a href="single.html">product</a>
									</h4>
									<div class="info-product-price">
										<span class="item_price">100.000 VNĐ</span>
                                        <del>100.000 VNĐ</del>
									</div>
									<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
										<form action="#" method="post">
											<fieldset>
												<input type="hidden" name="cmd" value="_cart" />
												<input type="hidden" name="add" value="1" />
												<input type="hidden" name="business" value=" " />
												<input type="hidden" name="item_name" value="Almonds, 100g" />
												<input type="hidden" name="amount" value="149.00" />
												<input type="hidden" name="discount_amount" value="1.00" />
												<input type="hidden" name="currency_code" value="USD" />
												<input type="hidden" name="return" value=" " />
												<input type="hidden" name="cancel_return" value=" " />
												<input type="submit" name="submit" value="Add to cart" class="button" />
											</fieldset>
										</form>
									</div>

								</div>
							</div>
						</div>
                        @endif
						<div class="clearfix"></div>
					</div>
					<!-- //first section (nuts) -->
					<!-- second section (nuts special) -->
					<div class="product-sec1 product-sec2">
						<div class="col-xs-7 effect-bg">
							<h3 class="">Năng lượng thuần khiết
                            </h3>
							<h6>Tận hưởng tất cả các loại sách của nhà sách
                            </h6>
							<p>Được giảm giá thêm 10%
                            </p>
						</div>
						<h3 class="w3l-nut-middle"></h3>
						<div class="col-xs-5 bg-right-nut">
							<img src="{{asset('client/images/nut1.png')}}" alt="">
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- //second section (nuts special) -->
					<!-- third section (oils) -->
					<div class="product-sec1">
						<h3 class="heading-tittle">Các sản phẩm được quan tâm</h3>
                        @if(count($sanpham_quantam))
                        @foreach($sanpham_quantam as $kay =>$val)
						<div class="col-md-4 product-men">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
                                    @if(count($val->gallery)>0)
									<img src="{{asset('product/thumbnails/'.$val->gallery[0]->image)}}" alt="{{ $val->gallery[0]->image }}"  style="width:170px">
                                    @else
									<img src="{{asset('client/images/no-image.png')}}" alt="" style="width:323px">
                                    @endif
									<div class="men-cart-pro">
										<div class="inner-men-cart-pro">
											<a href="{{ url('home/'.$val->slug) }}" class="link-product-add-cart">Chi tiết</a>
										</div>
									</div>
									<span class="product-new-top">New</span>
								</div>
								<div class="item-info-product ">
									<h4>
										<a href="single.html">{{ $val->name }}</a>
									</h4>
									<div class="info-product-price">
										<span class="item_price">{{number_format($val->price,0,',','.')}} VNĐ</span>
										@if($val->sale)
                                        <del>{{number_format($val->sale,0,',','.')}}</del>
                                        @endif
									</div>
									<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                        <input type="hidden" id="product_id" value="{{ $val->id }}">
                                        <input type="hidden" id="product_quantity{{ $val->id }}" value="1">
                                        <input type="hidden" id="product_name{{ $val->id }}" value="{{ $val->name }}">
                                        @if (Count($val->gallery) > 0)
                                            <input type="hidden" id="product_image{{ $val->id }}" value="{{ $val->gallery[0]->image }}">
                                        @else
                                            <input type="hidden" id="product_image{{ $val->id }}" value="">
                                        @endif
                                        <input type="hidden" id="product_price{{ $val->id }}" value="{{ $val->price }}">
                                        <input type="button" class="button" onclick="cartstore({{ $val->id }})" value="Thêm vào giỏ hàng" >
									</div>

								</div>
							</div>
						</div>
                        @endforeach
                        @else
						<div class="col-md-4 product-men">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img src="{{asset('client/images/no-image.png')}}" alt="" style="width:323px">
									<div class="men-cart-pro">
										<div class="inner-men-cart-pro">
											<a href="/" class="link-product-add-cart">Chi tiết</a>
										</div>
									</div>
									<span class="product-new-top">New</span>
								</div>
								<div class="item-info-product ">
									<h4>
										<a href="single.html">product</a>
									</h4>
									<div class="info-product-price">
										<span class="item_price">100.000 VNĐ</span>
                                        <del>100.000 VNĐ</del>
									</div>
									<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
										<form action="#" method="post">
											<fieldset>
												<input type="hidden" name="cmd" value="_cart" />
												<input type="hidden" name="add" value="1" />
												<input type="hidden" name="business" value=" " />
												<input type="hidden" name="item_name" value="Almonds, 100g" />
												<input type="hidden" name="amount" value="149.00" />
												<input type="hidden" name="discount_amount" value="1.00" />
												<input type="hidden" name="currency_code" value="USD" />
												<input type="hidden" name="return" value=" " />
												<input type="hidden" name="cancel_return" value=" " />
												<input type="submit" name="submit" value="Add to cart" class="button" />
											</fieldset>
										</form>
									</div>

								</div>
							</div>
						</div>
                        @endif
						<div class="clearfix"></div>
					</div>
					<!-- //third section (oils) -->
				</div>
			</div>
			<!-- //product right -->
		</div>
	</div>
	<!-- //top products -->
	<!-- special offers -->
	<div class="featured-section" id="projects">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Ưu đãi Đặc biệt
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="content-bottom-in">
				<ul id="flexiselDemo1">
                    @foreach($sanpham_quantam as $kay =>$val)
					<li>
						<div class="w3l-specilamk">
							<div class="speioffer-agile">
								<a href="{{ url('home/'.$val->slug) }}">
                                    @if(count($val->gallery)>0)
									<img src="{{asset('product/thumbnails/'.$val->gallery[0]->image)}}" alt="{{ $val->gallery[0]->image }}" style="width:170px">
                                    @else
									<img src="{{asset('client/images/no-image.png')}}" alt="" style="width:323px">
                                    @endif								</a>
							</div>
							<div class="product-name-w3l">
								<h4>
									<a href="{{ url('home/'.$val->slug) }}">{{ $val->name }}</a>
								</h4>
								<div class="w3l-pricehkj">
                                    <h6>{{number_format($val->price,0,',','.')}} VNĐ</h6>
                                    @if($val->sale)
                                    <p>{{number_format($val->sale,0,',','.')}}</p>
                                    @endif
								</div>
								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                    <input type="hidden" id="product_id" value="{{ $val->id }}">
                                    <input type="hidden" id="product_quantity{{ $val->id }}" value="1">
                                    <input type="hidden" id="product_name{{ $val->id }}" value="{{ $val->name }}">
                                    @if (Count($val->gallery) > 0)
                                        <input type="hidden" id="product_image{{ $val->id }}" value="{{ $val->gallery[0]->image }}">
                                    @else
                                        <input type="hidden" id="product_image{{ $val->id }}" value="">
                                    @endif
                                    <input type="hidden" id="product_price{{ $val->id }}" value="{{ $val->price }}">
                                    <input type="button" class="button" onclick="cartstore({{ $val->id }})" value="Thêm vào giỏ hàng" >
								</div>
							</div>
						</div>
                    </li>
                    @endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection
