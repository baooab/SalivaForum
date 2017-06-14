@extends('layouts.app')

@push('styles')
    <style>
        .navbar {
            margin-bottom: 50px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">登录</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-{{ session('status')['type'] }}">
                                {{ session('status')['info'] }}
                            </div>
                        @endif

                        {!! Form::open(['url' => url('login'), 'method' => 'post']) !!}
                            <div class="form-group">
                                {!! Form::label('email', '邮箱') !!}
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', '密码') !!}
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('登录', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        {!! Form::close() !!}

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <h4>天哪！登录真麻烦</h4>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection