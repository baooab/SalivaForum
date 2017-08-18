@extends('layouts.settings')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">个人信息</div>
        <div class="panel-body">
            {!! Form::open(['route' => 'settings.profile.update', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <img class="img-circle" src="{{ asset(Auth::user()->avatar) }}" style="width: 128px; height: 128px;">
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('username', '登录名', ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('username', Auth::user()->username, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', '邮箱', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::email('email', Auth::user()->email, ['class' => 'form-control', 'required', 'readonly']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection