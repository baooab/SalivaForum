@extends('layouts.default')

@section('title', $user->username)

@section('content')
    <div class="container">
        <div id="profile">
            @include('users._user_info')
            @include('users._latest_content')
        </div>
    </div>
@endsection
