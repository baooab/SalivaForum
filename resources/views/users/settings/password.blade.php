@extends('layouts.settings')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">密码</div>
        <div class="panel-body">
            {{ Form::open(['route' => 'settings.password.update', 'method' => 'PUT', 'class' => 'form-horizontal']) }}

            <div class="form-group">
                {!! Form::label('current_password', '现在的密码', ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::password('current_password', ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', '新密码', ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', '确认新密码', ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection