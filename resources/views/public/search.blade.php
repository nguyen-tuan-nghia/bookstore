@extends('layout.home')
@section('content')
<div class="container" style="margin-top: 3%; margin-bottom:20%">
    <h3 class="heading-tittle">Sản phẩm tìm kiếm</h3>
    @if(count($product))
    @foreach($product as $kay =>$val)
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
@endif
</div>
@endsection

