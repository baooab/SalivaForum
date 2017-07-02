@extends('layouts.default')

@push('styles')
    @include('_partials._jumbotron_under_nav_styles')
@endpush

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
                <div class="row">
                    <div class="col-md-12">
                        @foreach($discussions as $discussion)
                            <div class="media">
                                <div class="media-left media-middle">
                                    <img class="media-object img-circle" src="{{ asset($discussion->user->avatar) }}" alt="64x64"
                                         style="width: 64px; height: 64px;">
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading" style="font-size: 1.718rem;">
                                        <a href="{{ route('discussion', ['id' => $discussion->slug] ) }}"
                                           style="display: block;">
                                            {{ $discussion->title }}
                                        </a>
                                    </h3>
                                    <div class="media-conversation-meta">
                                        <span class="media-conversation-replies">
                                            <a href="{{ route('discussion', ['id' => $discussion->slug] ) }}#post-comments">{{ $discussion->comments_count }}</a>
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
                                    <i>{{ $discussion->user->username }}</i> {{ $discussion->updated_at }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        {{ $discussions->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="margin-bottom: 1.25rem;">
                <div id="user-ranking" class="panel panel-default sticky-here">
                    <div class="panel-heading text-center">贡献榜</div>
                    <div class="panel-body">
                        @foreach($users as $user)
                            <div class="media" style="padding: 6px 3px;">
                                <div class="media-left media-middle">
                                    <a href="{{ route('profile', [$user->username]) }}">
                                        <img class="media-object img-circle"
                                             src="{{ asset($user->avatar) }}" alt="avatar"
                                             style="width: 32px; height: 32px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <span class="media-heading" style="display: block; margin-top: 6px;">
                                        <a href="{{ route('profile.discussions', [$user->username]) }}" style="display: block;">
                                            <strong>{{ $user->username }}</strong>
                                            <span style="color: #999;">{{ $user->discussions_count }}篇帖</span>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('_partials._sticky_scripts')
@endpush
