@extends('layout.home')
@section('content')
    <div class="container">
        <br>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Đơn hàng số {{ $order->id }}
            </div>
            <br>
            <div class="card-body">
                <label>Thông tin người nhận</label>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tến người nhận</th>
                            <th>Số điện thoại</th>
                            <th>Thành phố</th>
                            <th>Đại chỉ chi tiết</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $ship->name }}</td>
                            <td>{{ $ship->phone }}</td>
                            <td>{{ $ship->city }}</td>
                            <td>{{ $ship->address }}</td>
                            <td>{{ $ship->note }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <label>Thông tin đơn hàng</label>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Đánh giá sản phẩm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_detail as $key => $val)
                            <tr id="cart_item{{ $val->id }}">
                                <input type="hidden" name="id[]" value="{{ $val->id }}">
                                <td>{{ $val->id }}</td>
                                <td>
                                    @if (count($val->gallery) > 0)
                                        <img src="{{ asset('product/thumbnails/' . $val->gallery[0]->image) }}"
                                            style="width:170px">
                                    @else
                                        <img src="{{ asset('client/images/no-image.png') }}">
                                    @endif
                                </td>
                                <td>{{ $val->product->name }}</td>
                                <td><input name="qty[]" disabled type="number" class="form-control"
                                        value="{{ $val->quantity }}"></td>
                                <td>{{ $val->price }}</td>
                                <td>
                                    @if ($order->status == 2)
                                        <div class="rating1">
                                            <span class="starRating">
                                                <input id="rating5" type="radio" name="rating"
                                                    onclick="danhgia({{ $val->product->id }},5)" value="5">
                                                <label for="rating5">5</label>
                                                <input id="rating4" type="radio" name="rating"
                                                    onclick="danhgia({{ $val->product->id }},4)" value="4">
                                                <label for="rating4">4</label>
                                                <input id="rating3" type="radio" name="rating"
                                                    onclick="danhgia({{ $val->product->id }},3)" value="3">
                                                <label for="rating3">3</label>
                                                <input id="rating2" type="radio" name="rating"
                                                    onclick="danhgia({{ $val->product->id }},2)" value="2">
                                                <label for="rating2">2</label>
                                                <input id="rating1" type="radio" name="rating"
                                                    onclick="danhgia({{ $val->product->id }},1)" value="1">
                                                <label for="rating1">1</label>
                                            </span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($order->status == 0)
                    <a class="btn btn-primary" href="{{ url('/cart/status/' . $order->id) }}">Hủy đơn hàng</a>
                @endif
            </div>
        </div>
    </div>
    <br>
    <script>
        function danhgia(product_id,star) {
            var product_id = product_id;
            var order_id = "{{ $order->id }}";
            var star = star;
            $.ajax({
                url: "{{ url('/star/store') }}",
                method: "POST",
                data: {
                    star: star,
                    order_id: order_id,
                    product_id: product_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    Swal.fire({
                        title: "",
                        text: "Cảm ơn bạn vì đã nhận xét",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "<a style='color:white' href='{{ url('/') }}'><i class='la la-headphones'></i>Mua ngay</a>",
                        showCancelButton: true,
                        // cancelButtonText: "<i class='la la-thumbs-down'></i> Mua tiếp",
                        customClass: {
                            confirmButton: "btn btn-success",
                            // cancelButton: "btn btn-default"
                        }
                    });
                }
            });
        }
    </script>
@endsection
