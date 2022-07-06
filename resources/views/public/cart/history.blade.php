@extends('layout.home')
@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Kiểu thanh toán</th>
                <th>Trạng thái đơn hàng</th>
                <th>Ngày đặt hàng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $key=>$val)
            <tr>
                <td><a href={{ url('/cart/history-detail/'.$val->id) }}>{{ $val->id }}</a></td>
                @if($val->status==0)
                <td>Đang xử lý</td>
                @elseif($val->status==1)
                <td>Đang vận chuyển</td>
                @elseif($val->status==2)
                <td>Đã giao</td>
                @elseif($val->status==3)
                <td>Đang hủy</td>
                @elseif($val->status==4)
                <td>Hàng đã bị hoàn trả</td>
                @endif
                <td>{{ $val->payment_type }}</td>
                <td>{{ $val->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
