@extends('layouts.app')

@section('title', $user->username . ' 的个人中心')

@section('content')

<div class="row">

    <div class="col-xl-3 col-lg-3 col-md-3 hidden-sm hidden-xs">
        <div class="card">
          <img class="card-img-top " src="http://baooab.me/storage/uploads/avatars/NBdG7Yah3uaOveMhUzhl3r6c4fWI1naJNTY3NDDC.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">个人简介</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <h5 class="card-title">注册于</h5>
            <p class="card-text">January 01 1901</p>
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