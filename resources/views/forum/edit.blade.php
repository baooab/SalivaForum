@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
    <style>
        .navbar {
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">更新帖子</div>
                    <div class="panel-body">
                        {!! Form::Model($discussion, ['url' => route('discussions.update', ['id' => $discussion->id]), 'method' => 'patch']) !!}

                        @include('forum.form')

                        <div class="form-group">
                            {!! Form::submit('更新', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <h4>天哪！发个帖子真麻烦</h4>
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
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    @include('forum.translate_script')
    @include('forum.select2_script')
@endpush
