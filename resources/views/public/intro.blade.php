@extends('layout.home')
@section('content')
<div class="container" style="padding: 20px 0px 20px 0px">
@if($intro)
{!!$intro->content!!}
</div>
@endif
@endsection
