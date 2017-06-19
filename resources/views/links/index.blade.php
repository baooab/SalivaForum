@extends('layouts.app')

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
                    <span>采集<a class="btn btn-primary btn-xs pull-right" href="{{ url('links/create') }}">添加</a></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($links as $link)
                            <div class="col-sm-4 col-md-3">
                                <div class="thumbnail text-center">
                                    <p class="label text-black">Tutorial / <span class="date">{{ $link->created_at }}</span></p>
                                    <h4><a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a></h3>
                                    @if ($link->description)
                                        <p>{{ $link->description }}</h4>
                                    @endif
                                    <p class="label text-gray">Added by {{ $link->user->name }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            {{ $links->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection