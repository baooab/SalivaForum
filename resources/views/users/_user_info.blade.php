<div class="profile-user-info text-center">

    <img class="img-circle" src="{{ asset($user->avatar) }}" alt="{{ $user->username }}的头像" style="height: 128px;">

    <h2>{{ $user->username }}</h2>
    
    @if ($user->isAdmin())
        <p><span class="label label-primary">站长</span></p>
    @elseif ($user->isModerator())
        <p><span class="label label-primary">管理员</span></p>
    @endif
</div>
