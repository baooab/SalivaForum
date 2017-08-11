@extends('layouts.settings')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">更改头像</div>
        <div class="panel-body">
            <img src="{{ asset(Auth::user()->avatar) }}"
                 class="img-circle img-responsive"
                 style="width: 128px;height: 128px; margin: 0 auto; margin-bottom: 1.25rem;" alt="用户头像">
            {!! Form::open(['url' => route('settings.avatar.update'), 'files' => 'true', 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::file('avatar', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('点击上传', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection