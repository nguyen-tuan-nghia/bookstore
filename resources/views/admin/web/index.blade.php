@extends('layout.admin')
@section('content')
    <style>
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
    <div class="container"></div>
    <div class="card">
        <div class="card-header">Quản lý website</div>
        <div class="card-body">
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
            <form action="{{ url('/dashboard/web/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên web site</label>
                    <input class="form-control @error('slug') is-invalid @enderror" type="text" name="name" value="{{ $web->name }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label>Logo</label>
                    <div class="image-upload">
                        <label for="file-input">
                            <div class="upload-icon">
                                @if ($web->logo!=null)
                                    <img class="icon" src="{{ asset('web/logo/'.$web->logo) }}">
                                @else
                                    <img class="icon" src="{{ asset('client/images/no-image.png') }}">
                                @endif
                            </div>
                        </label>
                        <input id="file-input" type="file" name="logo" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Từ khóa</label>
                    <input class="form-control" type="text" name="keywords" value="{{ $web->keywords }}">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input class="form-control" type="text" name="address" value="{{ $web->address }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="text" name="email" value="{{ $web->email }}">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input class="form-control" type="text" name="phone" maxlength="11" minlength="10" id="phone_format" value="{{ $web->phone }}">
                </div>
                <div class="form-group">
                    <label>Fanpage</label>
                    <textarea class="form-control" type="text" rows="6" style="width:100%" name="fan_page">{{ $web->fan_page }}</textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Lưu">
                </div>
            </form>
        </div>
    </div>
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
        <script>
            $("#phone_format").keyup(function() {
                //Filter only numbers from the input
                let cleaned = ('' + $(this).val()).replace(/\D/g, '');
                $(this).val(cleaned);
                //Check if the input is of correct length
                let match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
                let phone = '' + match[1] + '-' + match[2] + '-' + match[3];
                $(this).val(phone);
            });
        </script>
@endsection
