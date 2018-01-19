@extends('layouts.app')

@section('title', '编辑个人资料')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="card">
            <div class="card-header">
                <h4 style="margin-bottom: 0;">编辑个人资料</h4>
            </div>

            @include('common.error')

            <div class="card-body">
                <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name-field">用户名</label>
                        <input class="form-control" type="text" name="username" id="name-field" value="{{ old('username', $user->username ) }}" />
                    </div>
                    <div class="form-group">
                        <label for="email-field">邮 箱</label>
                        <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email ) }}" />
                    </div>
                    <div class="form-group">
                        <label for="introduction-field">个人简介</label>
                        <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction ) }}</textarea>
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
