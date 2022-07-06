@extends('layout.admin')
@section('content')
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
            <form action="{{ url('/dashboard/order/status/'.$order->id) }}" method="POST">
                @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        {{-- <th></th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_detail as $key => $val)
                        <tr id="cart_item{{ $val->id }}">
                            <input type="hidden" name="order_detail_id[]" value="{{ $val->id }}">
                            <input type="hidden" name="id[]" value="{{ $val->product_id }}">
                            <td><a href="{{ url('/dashboard/product/edit/'.$val->product_id) }}">{{ $val->product_id }}</a></td>
                            <td>
                                @if (count($val->gallery) > 0)
                                    <img style="width:137px" src="{{ asset('product/thumbnails/' . $val->gallery[0]->image) }}">
                                @else
                                    <img src="{{ asset('client/images/no-image.png') }}">
                                @endif
                            </td>
                            <td>{{ $val->product->name }}</td>
                            @if($order->status!=0)
                            <input type="hidden" name="qty[]" value="{{ $val->quantity }}">
                            @endif
                            <td><input
                                @if($order->status!=0)
                                disabled
                                @else
                                name="qty[]"
                                @endif
                                type="number" class="form-control" value="{{ $val->quantity }}"></td>
                            <td>{{ $val->price }}</td>
                            {{-- <td><a>Sửa</a></td> --}}
                            <td><a onclick="cart_delete({{ $val->id }})">Xóa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <label>Trạng thía đơn hàng</label>
            <div>
                <select class="form-control" name="status">
                    <option disabled @if ($order->status == 0) selected @endif value="0">Đang xủ lý</option>
                    <option @if ($order->status == 1) selected @endif value="1">Đang vận chuyển</option>
                    <option @if ($order->status == 2) selected @endif value="2">Đã giao</option>
                    <option @if ($order->status == 4) selected @endif value="4">Hàng đã bị hoàn trả</option>
                    <option disabled @if ($order->status == 3) selected @endif value="3">Đang hủy</option>
                </select>
            </div>
            <p>Chú ý: khi cập nhật hàng ở trạng thái hoàn trả số lượng hàng đặt sẽ được them vào sô lượng tồn kho của sản pẩm</p>
            <p>khi khách hủy đơn hàng bạn sẽ không thể cập nhật trạng thái đơn hàng</p>
            <p>khi cập nhật trạng thái ở chế độ đang vận chuyển số lượng tồn cảu sản phẩm trong đơn hàng sẽ giảm</p>
            <br>
            <input type="submit" class="btn btn-primary" value="Cập nhật trạng thái">
            </form>

        </div>
    </div>
    <script>
        function cart_delete(id) {
            $.ajax({
                url: "{{ url('/dashboard/order-detail/delete') }}" + "/" + id,
                method: "GET",
                success: function() {
                    $("#cart_item" + id).remove();
                }
            });
        }
    </script>
@endsection
