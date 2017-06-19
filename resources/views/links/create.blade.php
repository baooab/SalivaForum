@extends('layouts.app')

@push('styles')
    <style>
        .navbar {
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">新的采集</div>
                    <div class="panel-body">
                        <form action="{{ url('links/store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">标题</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">介绍</label>
                                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">创建</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection