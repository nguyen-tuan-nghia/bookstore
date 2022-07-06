@extends('layout.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý khách hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id='myTable'>
                <thead>
                    <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số đơn hàng</th>
                    <th>Số tiền đã chi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($customer as $key=> $val)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->email }}</td>
                        <td>{{ $val->order }}</td>
                        <Td>{{ number_format($val->money_spent,0,',','.') }} VNĐ</Td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
