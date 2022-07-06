@extends('layout.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id='myTable'>
                <thead>
                    <tr>
                    <th>Hình ảnh</th>
                    <th>Tên</th>
                    <th>Giá nhập</th>
                    <th>Giá bán</th>
                    <th>Trạng thái</th>
                    <th>Ngày đăng</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($product as $pro)
                    <tr id="product_{{ $pro->id }}">
                        <td class="row">
                        @if(count($pro->gallery)>0)
                        <div class="col-sm-2"><img style="width:100px" src="{{ asset('product/thumbnails/'.$pro->gallery[0]->image) }}" alt=""></div>
                        @endif
                    </td>
                        <td>{{ $pro->name }}</td>
                        <td>{{ number_format($pro->cost_price,0,',','.') }} VNĐ</td>
                        <td>{{ number_format($pro->price,0,',','.') }} VNĐ</td>
                        <td>
                            @if($pro->status==1)
                            <a id="product_status{{ $pro->id }}" href="javascript:void(0)" onclick="product_status({{ $pro->id}})">Hiển thị</a>
                            @else
                            <a id="product_status{{ $pro->id }}" href="javascript:void(0)" onclick="product_status({{ $pro->id}})">Ẩn</a>
                            @endif
                        </td>
                        <td>{{ $pro->created_at }}</td>
                        <td><a href="{{ url('/dashboard/product/edit/'.$pro->id) }}">Sửa <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                          </svg></a></td>
                          <td ><a onclick="del_product({{ $pro->id }})">Xóa <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                          </svg></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function del_product(id){
        if(window.confirm("Bạn có chắc muốn xóa sản phẩm trên ?")){
            $.ajax({
                url:"{{ url('/dashboard/product/delete') }}"+'/'+id,
                method:"GET",
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                success:function(){
                    $('#product_'+id).remove();
                },
                error:function(){
                    alert("Đã xảy ra lỗi");
                }
            });
        }
    }
</script>
<script>
    function product_status(id){
        $.ajax({
            url:"{{ url('/dashboard/product/status')}}"+"/"+id,
            method:"GET",
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            success:function(data){
                if(data==1){
                    $("#product_status"+id).html("Hiển thị");
                }
                if(data==0){
                    $("#product_status"+id).html("Ẩn");
                }
            }
        });
    }
</script>
@endsection
