@extends('layouts.app')

@section('title', $user->username . ' 的个人中心')

@section('content')

<div class="row">

    <div class="col-xl-3 col-lg-3 col-md-3 hidden-sm hidden-xs">
        <div class="card">
          <img class="card-img-top " src="{{ Auth::user()->avatar }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">个人简介</h5>
            <p class="card-text">{{ $user->introduction }}</p>
            <h5 class="card-title">注册于</h5>
            <p class="card-text">{{ $user->created_at->diffForHumans() }}</p>
          </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <h4 class="card-body">
            {{ $user->username }} <small>{{ $user->email }}</small>
          </h4>
        </div>

        <hr>

        <div class="card">
          <div class="card-body">
            暂无数据 ~_~
          </div>
        </div>
    </div>
</div>
@stop
