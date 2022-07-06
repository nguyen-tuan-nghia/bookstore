@extends('layout.home')
@section('content')
<div class="container">
    <h2 style="text-align:center">{{$post->title}}</h2>
    <p style="padding-left: 950px">{{$post->created_at}}</p>
    <hr>
    <br>
    {!!$post->content!!}
</div>
@endsection
