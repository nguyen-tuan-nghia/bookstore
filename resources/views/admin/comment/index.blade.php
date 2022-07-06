@extends('layout.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý bài viết</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id='myTable'>
                <thead>
                    <tr>
                    <th>Tên</th>
                    <th>Tiêu đề</th>
                    <th>Ngày đăng</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($comment as $pro)
                    <tr id="product_{{ $pro->id }}">
                    <td>{{$pro->name}}</td>
                        <td>{{ $pro->content }}</td>
                        <td>{{ $pro->created_at }}</td>
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
        if(window.confirm("Bạn có chắc muốn xóa bài viết trên ?")){
            $.ajax({
                url:"{{ url('/dashboard/comment/delete') }}"+'/'+id,
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
@endsection
