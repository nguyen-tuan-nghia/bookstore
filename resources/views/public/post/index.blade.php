@extends('layout.home')
@section('content')
<style>
    .flex{
        display: flex;
        flex-wrap: nowrap;
    }
</style>
<div class="container">
    @foreach($post as $val)
    <div class="flex" style="border: 1px solid #d4c8c8;margin:20px">
    <div >
        <img style="width:250px" src="{{asset('update/images/images').'/'.$val->image}}">
    </div>
    <div>
        <h3><a style="color: black; padding:20px" href="{{url('tin-chi-tiet/'.$val->slug)}}">{{$val->title}}</a></h3>
        <p style="padding-left: 650px">{{$val->created_at}}</p>
    </div>
    </div>
    @endforeach
    <br>
    {{ $post->links() }}
</div>
@endsection
