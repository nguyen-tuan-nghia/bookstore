@extends('layout.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý đơn hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id='myTable'>
                <thead>
                    <tr>
                    <th>Mã đơn hàng</th>
                    <th>Hình thức thanh toán</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($order as $key=>$val)
                    <tr id="order_item{{ $val->id }}">
                        <td><a>{{ $val->id }}</a></td>
                        <td>{{ $val->payment_type }}</td>
                        @if($val->status==0)
                        <td>Đang Xử lý</td>
                        @elseif($val->status==1)
                        <td>Đang vận chuyển</td>
                        @elseif($val->status==2)
                        <td>Đã giao</td>
                        @endif
                        <td>{{ $val->created_at }}</td>
                        <td><a href="{{ url('/dashboard/order/detail/'.$val->id) }}">Chi tiết</a></td>
                        <td>
                            @if($val->status==0)
                            <a onclick="order_delete({{ $val->id }})">Xóa</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function order_delete(id) {
        $.ajax({
            url: "{{ url('/dashboard/order/delete') }}" + "/" + id,
            method: "GET",
            success: function() {
                $("#order_item" + id).remove();
            }
        });
    }
</script>
@endsection
