@extends('layout.admin')
@section('content')
    <div class="container">
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
        <form action="{{ url('/dashboard/doimatkhau') }}" method="post">
            @csrf
            <div class="form-group"> <input class="form-control" type="email" disabled value="{{ $admin->email }}">
            </div>
            <div class="form-group"> <input class="form-control" name="name" type="text" value="{{ $admin->name }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group"> <input class="form-control" name="password" type="password"
                    value="{{ $admin->password }}">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group"> <input type="submit" class="btn btn-primary" value="Lưu">
            </div>
        </form>
    </div>
@endsection
