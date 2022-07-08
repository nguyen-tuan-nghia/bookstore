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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quản lý phân quyền</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id='myTable'>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $key => $val)
                            <tr>
                                <form action="{{ url('/dashboard/phanquyen/' . $val->id) }}" method="post">
                                    @csrf
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>
                                        <div style="padding: 10px">
                                            <input id="checked{{ $val->id }}" onclick="check({{ $val->id }})"
                                                style="float:left" type="checkbox" value="">
                                            <div style="width:100px">Tất cả</div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="row">
                                            @foreach ($role as $key2 => $val2)
                                                <div class="col" style="padding: 10px">
                                                    <input class="role{{ $val->id }}" name="id[]" style="float:left"
                                                        type="checkbox" value="{{ $val2->id }}" {{-- {{$val->has_role($val2->id,$val->id) ? 'checked' : ''}} --}}
                                                        @if (count($val->admin_role) > 0) @foreach ($val->admin_role as $key3 => $val3)
                                    @if ($val3->role_id == $val2->id)
                                        checked @endif
                                                        @endforeach
                                            @endif
                                            >
                                            <div style="width:100px">{{ $val2->name }}</div>
                                        </div>
                        @endforeach
            </div>
            </td>
            <td>
                <input type="submit" value="Phân quyền">
                {{-- <a onclick="phanquyen({{ $val->id }})">Phân quyền</a> --}}
            </td>
            <td>
                <a onclick="del_admin({{ $val->id }})">Xóa</a>
            </td>
            </form>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
    </div>
    <script>
        function check(id) {
            var check = $("#checked" + id).prop('checked');
            if (check == true) {
                $(".role" + id).attr("checked", true);
            } else {
                $(".role" + id).attr("checked", false);
            }
        }

        function del_admin(id) {
            if (window.confirm("Bạn có chắc muốn xóa người dùng trên ?")) {
                $.ajax({
                    url: "{{ url('/dashboard/admin/delete') }}" + '/' + id,
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        if(res==1){
                            $('#delivery_' + id).remove();
                        }else{
                            alert("Bạn không thể xóa chính tài khoản cảu mình");
                        }
                    },
                    error: function() {
                        alert("Đã xảy ra lỗi");
                    }
                });
            }
        }
    </script>
@endsection
