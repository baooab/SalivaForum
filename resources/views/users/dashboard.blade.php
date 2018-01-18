@extends('layouts.default')

@section('title', $user->username)

@section('content')
    <div class="container text-center">
        <h1> 欢迎你，{{ $user->username }}！</h1>
        <hr>

        <div class="row">
            <div class="col-xs-4">
                <div class="panel panel-default panel-counter">
                    <div class="panel-heading">帖子数</div>
                    <div class="panel-body">{{ $user->countDiscussions() }}</div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="panel panel-default panel-counter">
                    <div class="panel-heading">评论数</div>
                    <div class="panel-body">{{ $user->countComments() }}</div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="panel panel-default panel-counter">
                    <div class="panel-heading">采集数</div>
                    <div class="panel-body">{{ $user->countLinks() }}</div>
                </div>
            </div>
        </div>

        @include('users._latest_content', compact('user'))
    </div>
@endsection
