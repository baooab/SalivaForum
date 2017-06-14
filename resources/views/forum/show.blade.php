@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" src="{{ asset($discussion->user->avatar) }}" alt="64x64"
                             style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">
                        {{ $discussion->title }}
                        @if(Auth::check() && Auth::user()->id == $discussion->user->id)
                            <a class="btn btn-lg btn-primary pull-right"
                                href="{{ route('discussions.edit', ['id' => $discussion->id]) }}" role="button">
                                修改帖子 »
                            </a>
                        @endif
                    </h3>
                    @if(count($discussion->categories) > 0)
                        @foreach($discussion->categories as $category)
                            <span class="badge">{{ $category->name }}</span>
                            @if($loop->last)
                                <br>
                            @endif
                        @endforeach
                    @endif
                    <i>{{ $discussion->user->name }}</i> {{ $discussion->updated_at }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-post">
                    {!! Parsedown::instance()->text($discussion->body) !!}
                </div>

                @if(count($discussion->comments) > 0)
                    <hr>
                    <div class="blog-comments">
                        @foreach($discussion->comments as $comment)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object img-circle" src="{{ asset($comment->user->avatar) }}" alt="64x64"
                                             style="width: 64px; height: 64px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $comment->user->name }}</h4>
                                    {!! Parsedown::instance()->text($comment->body) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <hr>
                <div id="reply" class="post-comments">
                    @if(Auth::check())
                        {!! Form::open(['url' => route('comments.store'), 'method' => 'post']) !!}
                            {!! Form::hidden('discussion_id', $discussion->id) !!}
                            <div class="form-group">
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => '支持Markdown格式']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('发表评论', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        {!! Form::close() !!}
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block">登录参与评论</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
