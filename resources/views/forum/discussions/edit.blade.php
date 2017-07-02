@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
                <div class="panel panel-default">
                    <div class="panel-heading">更新帖子</div>
                    <div class="panel-body">
                        {!! Form::Model($discussion, ['url' => route('discussions.update', [$discussion->id]), 'method' => 'PUT']) !!}

                        @include('forum.discussions._form')

                        <div class="form-group">
                            {!! Form::submit('更新', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('_partials._youdao_translate_script')
    @include('_partials._select2_select')
    @include('_partials._simplemde_editor')
@endpush
