@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simplemde.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css"> -->
    <style type="text/css">
        .editor-toolbar.fullscreen, .CodeMirror-fullscreen, .editor-preview-side {
            z-index:1001;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布新帖子</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => route('discussions.store'), 'method' => 'post']) !!}

                            @include('forum.form')

                            <div class="form-group">
                                {!! Form::submit('发布', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        {!! Form::close() !!}
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
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simplemde.min.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script> -->
    @include('forum.translate_script')
    @include('forum.select2_script')
    @include('forum.simplemde_script')
@endpush
