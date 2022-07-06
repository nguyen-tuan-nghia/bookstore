@extends('layout.admin')
@section('content')
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<form action="{{url('/intro/edit')}}" method="post"><div class="form-group col-md-12">
    @csrf
    <label>Nội dung</label>
    <textarea class="form-control " name="content" id="editor1" required>
        @if($intro)
        {!!$intro->content!!}
        @endif
    </textarea>
    @error('content')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
</div>
<input class="btn btn-dark" type="submit" value="Lưu">
</form>

@endsection
