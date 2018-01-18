@extends('layouts.default')

@section('title', $discussion->title)

@push('styles')
    @include('_partials._jumbotron_under_nav_styles')
    <style>
        body {
            font-size: 14px;
        }

        .media-heading {
            font-size: 18px;
        }

        .media-info {
            font-size: 14px;
        }

        .media-info .badge {
            font-size: 12px;
        }

        #blog-post img, #blog-comments .media-body img {
            max-width: 100%;
            max-width: 35em;
        }

        /* 帖子目录样式 */

        .BlogAnchor {
            background: #eee;
            padding: 10px;
            line-height: 180%;
        }
        .BlogAnchor p {
            margin-bottom: 0.3em;
        }

        .BlogAnchor .AnchorContent {
            padding: 5px 0px;
            list-style: none;
        }

        .BlogAnchor .AnchorContent li {
            cursor: pointer;
        }

        .BlogAnchor .AnchorContent li.active {
            background: #eee;
            border-radius: 5px;
        }

        #AnchorContentToggle {
            color: #FFF;
            display: block;
            line-height: 20px;
            background: #337ab7;
            font-style: normal;
            text-align: center;
            padding: 4px;
        }
        .BlogAnchor a:hover {
            color: #204d74;
        }
        .BlogAnchor a {
            text-decoration: none;
        }

        /* Code 满行时能够水平滚动 */
        pre code {
            overflow: auto;
            word-wrap: normal;
            white-space: pre;
        }
    </style>
@endpush

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" src="{{ asset($discussion->user->avatar) }}" alt="64x64"
                             style="width: 48px; height: 48px;">
                    </a>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">
                        {{ $discussion->title }}
                        @if(count($discussion->categories) > 0)
                            @foreach($discussion->categories as $category)
                                <span class="badge">{{ $category->name }}</span>
                            @endforeach
                        @endif
                    </h3>
                    <div class="media-info">
                        {{ $discussion->user->username }} 发布于 {{ $discussion->created_at->diffForHumans() }}
                        @if(Auth::check() && Auth::user()->id == $discussion->user->id)
                            <a href="{{ route('discussions.edit', ['id' => $discussion->slug]) }}" role="button">编辑文章 »</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div id="blog-post">
                    {!! Parsedown::instance()->text($discussion->body) !!}
                </div>

                @if(count($discussion->comments) > 0)
                    <hr>
                    <div id="blog-comments">
                        @foreach($discussion->comments as $comment)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object img-circle" src="{{ asset($comment->user->avatar) }}" alt="64x64"
                                             style="width: 64px; height: 64px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $comment->user->username }} <small>{{ $comment->created_at }}</small></h4>
                                    {!! Parsedown::instance()->setMarkupEscaped(true)->text($comment->body) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <hr>
                <div id="post-comments">
                    @if(Auth::check())
                        {!! Form::open(['url' => route('comments.store'), 'method' => 'post']) !!}
                        {!! Form::hidden('discussion_id', $discussion->id) !!}
                        <div class="form-group">
                            <label for="body">
                                <small style="display: inline-block; margin-left: .2rem;">
                                    <a href="https://help.github.com/articles/basic-writing-and-formatting-syntax/" target="_blank">Markdown 怎么写？</a>
                                </small>
                            </label>
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
            <div id="aside" class="col-md-3 col-sm-4 hidden-xs">
                <div class="BlogAnchor sticky-here">
                    <p><b id="AnchorContentToggle" title="收起" style="cursor:pointer;">目录[-]</b></p>
                    <ul class="AnchorContent" id="AnchorContent"></ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('_partials._sticky_scripts')
    @include('_partials._responsive_table_scripts')
    <script>
        $("#blog-post").find("h2,h3").each(function(i,item) {
            var tag = $(item).get(0).localName;
            $(item).attr("id", "wow" + i);
            $("#AnchorContent").append('<li><a class="new'+tag+' anchor-link" href="#wow'+ i +'" id="#wow'+i+'">'+$(this).text()+'</a></li>');
            $(".newh2").css("margin-left", 0);
            $(".newh3").css("margin-left", 20);
        });
        $("#AnchorContentToggle").click(function(){
            var text = $(this).html();
            if(text=="目录[-]"){
                $(this).html("目录[+]");
                $(this).attr({"title":"展开"});
            }else{
                $(this).html("目录[-]");
                $(this).attr({"title":"收起"});
            }
            $("#AnchorContent").toggle();
        });
        $(".anchor-link").click(function(e) {
            e.preventDefault();
            $("html,body").animate({ scrollTop: $($(this).attr("id")).offset().top }, 650);
        });

        if ($( "ul.AnchorContent" ).has( "li" ).length < 1) {
            $('#aside').hide();
        }
    </script>
@endpush
