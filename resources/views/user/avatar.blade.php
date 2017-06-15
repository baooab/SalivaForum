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
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">用户头像</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-{{ session('status')['type'] }}">
                                {{ session('status')['info'] }}
                            </div>
                        @endif

                        <img src="{{ asset(Auth::user()->avatar) }}"
                             class="img-circle img-responsive"
                             style="width: 128px;height: 128px; margin: 0 auto; margin-bottom: 1.25rem;" alt="">

                        {!! Form::open(['url' => url('user/avatar'), 'files' => 'true']) !!}
                            <div class="form-group">
                                {!! Form::file('avatar', ['class' => 'form-control']) !!}
                                {{--{!! Form::file('avatars[]', ['class' => 'form-control', 'multiple' => "multiple"]) !!}--}}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('修改', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection