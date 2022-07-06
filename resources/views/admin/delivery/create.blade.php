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

<form id="product_creat" action="{{ URL::to('/dashboard/delivery/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>Tên tỉnh, thành phố</label>
      <select name="city" id="" class="form-control @error('city') is-invalid @enderror">
          @foreach($city as $key =>$val)
          <option value="{{ $val->name }}">{{ $val->name }}</option>
          @endforeach
      </select>
      @error('city')
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror
    </div>
  <div class="form-group">
    <label>Phí vận chuyển</label>
    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="0">
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror
  </div>
<br><br>
    <button type="submit" class="btn btn-primary">Lưu</button>
  </form>
@endsection


