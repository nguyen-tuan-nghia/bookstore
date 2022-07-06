@extends('layout.admin')
@section('content')
<style>
    .bg-primary{
        border-radius: 65px;
        box-shadow: 10px 10px 5px lightblue;
    }
</style>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quản lý danh mục</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="p-3 mb-2 bg-primary text-white">
                    Trang chủ
                </div>
                @foreach ($category as $key => $val)
                    @if ($val->category_parent == 0)
                        <div class="row p-3 mb-2 bg-primary text-white category-{{ $val->id }}">
                            <div class="col-sm-11">{{ $val->name }}</div>
                            <div class="col-sm-1">
                                @if ($val->status == 1)
                                    <a style="color: white" id="category_status{{ $val->id }}"
                                        onclick="category_status({{ $val->id}})">Hiển thị</a>
                                @else
                                    <a style="color: white" id="category_status{{ $val->id }}"
                                        onclick="category_status({{ $val->id}})">Ẩn</a>
                                @endif /
                                <a style="color: white" href="{{ url('/dashboard/category/edit/' . $val->id) }}">Sửa</a> /
                                <a onclick="delete_category({{ $val->id }})">Xóa</a>
                            </div>
                        </div>
                        @foreach ($category as $key2 => $val2)
                            @if ($val2->category_parent == $val->id)
                                <div style="padding:10px 0px 10px 60px" class="category-{{ $val2->id }}">
                                    <div class="row p-3 mb-2 bg-primary text-white ">
                                        <div class="col-sm-11">{{ $val2->name }}</div>
                                        <div class="col-sm-1">
                                            @if ($val2->status == 1)
                                                <a style="color: white" id="category_status{{ $val2->id }}"
                                                    onclick="category_status({{ $val2->id}})">Hiển thị</a>
                                            @else
                                                <a style="color: white" id="category_status{{ $val2->id }}"
                                                    onclick="category_status({{ $val2->id}})">Ẩn</a>
                                            @endif /
                                            <a style="color: white"
                                                href="{{ url('/dashboard/category/edit/' . $val2->id) }}">Sửa</a> / <a
                                                onclick="delete_category({{ $val2->id }})">Xóa</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function delete_category(id) {
            if (window.confirm("Bạn có chắc muốn xóa danh mục trên ?")) {
                $.ajax({
                    url: "{{ url('/dashboard/category/delete') }}" + '/' + id,
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if(res==1){
                        $('.category-' + id).remove();
                    }else{
                        alert("Có sản phẩm rằng buộc trong danh mục trên, bạn không thể xóa");
                    }
                    },
                    error: function() {
                        alert("Đã xảy ra lỗi");
                    }
                });
            }
        }
    </script>
    <script>
        function category_status(id) {
            $.ajax({
                url: "{{ url('/dashboard/category/status') }}" + "/" + id,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data == 1) {
                        $("#category_status" + id).html("Hiển thị");
                    }
                    if (data == 0) {
                        $("#category_status" + id).html("Ẩn");
                    }
                }
            });
        }
    </script>
@endsection
