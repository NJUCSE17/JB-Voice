@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">JB Voice</div>
            <div class="card-body">
                <img src="{{ asset("image/www.jpg") }}" width="50px">
                <p>你知道吗这个网站是一晚上就做出来的垃圾</p>
                <p>请你们不要黑这个网站啊呜呜呜呜呜呜呜呜</p>
                <div>
                    @auth
                        <a class="btn btn-outline-primary" href="{{ url('/home') }}">进入</a>
                    @else
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">登陆</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
