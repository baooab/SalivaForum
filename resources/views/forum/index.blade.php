@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>
                咕噜咕噜乱炖
                <a class="btn btn-lg btn-primary pull-right" href="{{ route('discussions.create') }}" role="button">发布新帖 »</a>
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="{{ asset($discussion->user->avatar) }}" alt="64x64"
                                    style="width: 64px; height: 64px;">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ route('discussions.show', ['id' => $discussion->slug] ) }}">
                                    {{ $discussion->title }}
                                </a>
                            </h4>
                            <div class="media-conversation-meta">
                                <span class="media-conversation-replies">
                                    <a href="{{ route('discussions.show', ['id' => $discussion->slug] ) }}#reply">{{ count($discussion->comments) }}</a>
                                回复
                                </span>
                            </div>
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
                @endforeach
            </div>
            <div class="col-md-12">
                {{ $discussions->links() }}
            </div>
        </div>
    </div>
@endsection
