@extends('layouts.app')

@push('styles')
    <style>

        body {
            font-size: 15px;
        }

        #blog-post img {
            max-width: 100%;
        }

        /* 帖子目录样式 */

        .BlogAnchor {
            background: #f4f7f9;
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
            background-color: #eee;
            border-radius: 5px;
        }

        #AnchorContentToggle {
            color: #FFF;
            display: block;
            line-height: 20px;
            background: cornflowerblue;
            font-style: normal;
            text-align: center;
            padding: 4px;
        }
        .BlogAnchor a:hover {
            color: cornflowerblue;
        }
        .BlogAnchor a {
            text-decoration: none;
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
            <div class="col-md-9 col-sm-8">
                <div id="blog-post">
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
                                    <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at }}</small></h4>
                                    {!! Parsedown::instance()->text($comment->body) !!}
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
                <div class="BlogAnchor">
                    <p><b id="AnchorContentToggle" title="收起" style="cursor:pointer;">目录[-]</b></p>
                    <ul class="AnchorContent" id="AnchorContent"></ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script>
        // 生成帖子目录
        $("#blog-post").find("h2,h3").each(function(i,item) {
            var tag = $(item).get(0).localName;
            $(item).attr("id", "wow" + i);
            $("#AnchorContent").append('<li><a class="new'+tag+' anchor-link" href="#wow'+ i +'" id="#wow'+i+'">'+ "- "+$(this).text()+'</a></li>');
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
        } else {
            // 帖子目录悬停效果
            $(".BlogAnchor").sticky({ topSpacing: 20 });
        }
    </script>
@endpush
