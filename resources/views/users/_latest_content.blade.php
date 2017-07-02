<div class="row profile-latest-items text-center">
    <div class="col-md-4">
        <h3>最新的帖子</h3>

        @forelse ($user->latestDiscussions() as $discussion)
            <div class="list-group">
                <a href="{{ route('discussion', $discussion->slug) }}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $discussion->title }}</h4>
                    <p class="list-group-item-text">{{ str_limit($discussion->body, 100) }}</p>
                </a>
            </div>
        @empty
            <p class="text-center">{{ $user->username }} 仍没有发帖，坚持做吃瓜群众中的一员。</p>
        @endforelse
    </div>
    <div class="col-md-4">
        <h3>最新的评论</h3>

        @forelse ($user->latestComments() as $comment)
            <div class="list-group">
                <a href="{{ route('discussion', [$comment->discussion->slug]) }}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $comment->discussion->title }}</h4>
                    <p class="list-group-item-text">{{ str_limit($comment->body, 100) }}</p>
                </a>
            </div>
        @empty
            <p class="text-center">{{ $user->username }} 仍然没有任何评论。</p>
        @endforelse
    </div>
    <div class="col-md-4">
        <h3>最新的采集</h3>

        @forelse ($user->latestLinks() as $link)
            <div class="list-group">
                <a href="{{ $link->url }}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $link->title }}</h4>
                    <p class="list-group-item-text">{{ str_limit($link->description, 100) }}</p>
                </a>
            </div>
        @empty
            <p class="text-center">{{ $user->username }} 仍然没有提交任何「采集」。</p>
        @endforelse
    </div>
</div>