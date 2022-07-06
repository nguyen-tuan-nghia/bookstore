@extends('layout.admin')
@section('content')
    <style>
        .image-upload>input {
            display: none;
        }

        .upload-icon {
            width: 100px;
            height: 97px;
            border: 2px solid #5642BE;
            border-style: dotted;
            border-radius: 18px;
            float: left;
        }

        .upload-icon .icon {
            width: 60px;
            height: 60px;
            margin: 19px;
            cursor: pointer;
        }

        .prev {
            display: none;
            width: 95px;
            height: 92px;
            margin: 2px;
            border-radius: 15px;
        }

        .label-info {
            background-color: #5bc0de;
        }

        .image-upload>input {
            display: none;
        }

        .upload-icon {
            width: 100px;
            height: 97px;
            border: 2px solid black;
            border-style: dotted;
            border-radius: 18px;
        }

        .upload-icon img {
            width: 60px;
            height: 60px;
            margin: 19px;
            cursor: pointer;
        }

        .upload-icon.has-img {
            width: 100px;
            height: 97px;
            border: none;
        }

        .upload-icon.has-img img {
            width: 100%;
            height: auto;
            border-radius: 18px;
            margin: 0px;
        }
    </style>
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
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
    <form id="product_creat" action="{{ URL::to('/dashboard/post/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tên bài viết</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="name"
                value="{{ old('title') }}" onkeyup="ChangeToSlug();" placeholder="Enter name" required>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                value="{{ old('slug') }}" placeholder="Slug" required>
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Từ khóa</label>
            <input type="text" class="form-control @error('keywords') is-invalid @enderror" name="keywords"
                value="{{ old('keywords') }}" data-role="tagsinput" required>
            @error('keywords')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <label>Hình ảnh</label>
        <div class="image-upload">
            <label for="file-input">
                <div class="upload-icon">
                    <img class="icon" src="{{ asset('client/images/no-image.png') }}">
                </div>
            </label>
            <input id="file-input" type="file" name="images" />
        </div>
        @error('images')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        <br>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control " name="content" id="editor1" required>{{old('content')}}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>trạng thái</label>
            <select class="form-control  @error('status') is-invalid @enderror" name="status">
                <option value="1">Hiện</option>
                <option value="0">Ẩn</option>
            </select>
            @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
    <script language="javascript">
        function ChangeToSlug() {
            var title, slug;

            //Lấy text từ thẻ input title
            title = document.getElementById("name").value;

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
    </script>
        <script>
            $('#file-input').change(function(event) {

                if ($('#file-input')[0].files.length == 0) {
                    $("img.icon").attr('src', '{{ asset('client/images/no-image.png') }}');
                    $("img.icon").parents('.upload-icon').removeClass('has-img');

                } else {
                    $("img.icon").attr('src', URL.createObjectURL(event.target.files[0]));
                    $("img.icon").parents('.upload-icon').addClass('has-img');
                }
            });
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
