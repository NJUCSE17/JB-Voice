@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.messages')
    <div class="card">
        <div class="card-header" style="font-family: 'Consolas', monospace;">
            cout << "Welcome to this buggy site!" << endl;
        </div>
        <div class="card-body" style="text-align: center;">
            <img src="{{ asset("image/www.jpg") }}" width="50px" class="my-3">
            <p style="text-align: center;">你知道吗这个网站是两晚上就做出来的垃圾</p>
            <p style="text-align: center;">所以请你们不要黑这个网站啊呜呜呜呜呜呜</p>
        </div>
    </div>
    <hr />
    <div class="alert alert-success" role="alert">
        请选择一个活动来提交反馈！
    </div>
    @foreach($activities as $activity)
        <a class="btn btn-outline-dark" style="width: 100%; text-align: left;"
            href="{{ route('activity', [$activity->id]) }}">
            {{ $activity->id }} - {{ $activity->name }}
        </a>
    @endforeach
</div>
@endsection
