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

<form id="product_creat" action="{{ URL::to('/dashboard/delivery/update/'.$delivery->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>Tên tỉnh, thành phố</label>
      <input type="text" value="{{ $delivery->city }}" class="form-control" disabled>
    </div>
  <div class="form-group">
    <label>Phí vận chuyển</label>
    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $delivery->price }}" placeholder="0">
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror
  </div>
<br><br>
    <button type="submit" class="btn btn-primary">Lưu</button>
  </form>
@endsection


