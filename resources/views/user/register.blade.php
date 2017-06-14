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
                    <div class="panel-heading">注册</div>
                    <div class="panel-body">

                        {{-- refer: https://laravelcollective.com/docs/master/html#installation --}}

                        {!! Form::open(['url' => url('register'), 'method' => 'post']) !!}
                            <div class="form-group">
                                {!! Form::label('name', '用户名') !!}
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', '邮箱') !!}
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', '密码') !!}
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password_confirmation', '确认密码') !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('马上注册', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        {!! Form::close() !!}

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <h4>天哪！填个表单真麻烦</h4>
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