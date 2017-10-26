@extends('layouts.default')

@push('styles')
<style>
    .navbar {
        margin-bottom: 20px;
    }

    .panel-body .thumbnail a {
        display: block;
    }

    .label {
        font-size: .6875rem;
        letter-spacing: .2em;
        line-height: 1em;
    }

    .text-black {
        color: #2a2a2a;
    }

    .text-gray {
        color: #a1a1a1;
    }
</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <span>{{ $user->username }}的帖子</span>
                    </div>
                    <div class="panel-body">
                        @forelse ($discussions->chunk(4) as $chunk)
                            <div class="row"> 
                                @foreach($chunk as $discussion)
                                    <div class="col-sm-4 col-md-3">
                                        <div class="thumbnail text-center">
                                            <p class="label text-black"><span class="date">{{ $discussion->updated_at->diffForHumans() }}</span></p>
                                            <h4><a href="{{ route('discussion', [$discussion->slug] ) }}" target="_blank">{{ $discussion->title }}</a></h4>
                                                <p style="color: #333; text-shadow: 0 0.5px #eee;">
                                                    {{ str_limit($discussion->body, 120) }}
                                                </p>
                                                <p class="label text-gray">
                                                    @if(count($discussion->categories) > 0)
                                                        @foreach($discussion->categories as $category)
                                                            {{ $category->name }}
                                                            @if(! $loop->last)
                                                                |
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </p>
                                        </div>
                                    </div>
                                @endforeach 
                            </div>
                        @empty
                            <div class="row text-center">
                                暂时还没有任何内容……
                            </div>    
                        @endforelse
                        <div class="row">
                            <div class="col-md-12">
                                {{ $discussions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection