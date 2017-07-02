<?php

namespace App\Http\Controllers\Forum;

use App\Http\Requests\DiscussionRequest;
use App\User;
use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function overview()
    {
        $discussions = Discussion::with('categories')
            ->withCount('comments')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        $users = User::withCount('discussions')
            ->orderBy('discussions_count', 'desc')
            ->take(10)
            ->get();

        return view('forum.discussions.overview', compact('discussions', 'users'));
    }

    public function show(Discussion $discussion)
    {
        return view('forum.discussions.show', compact('discussion'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();

        return view('forum.discussions.create', compact('categories'));
    }

    public function store(DiscussionRequest $request)
    {
        $data = $request->only(['title', 'body']);
        $data = array_merge($data, [
            'slug' => str_slug($request->input('slug')),
            'user_id' => Auth::id(),
            'last_user_id' => Auth::id(),
        ]);

        $discussion = Discussion::create($data);
        $categories = $request->input('categories');
        if ($categories)
        {
            $discussion->categories()->attach($categories);
        }

        return redirect()->route('discussion', ['id' => $discussion->slug]);
    }

    public function edit(Discussion $discussion)
    {
        $categories = Category::pluck('name', 'id')->all();

        return view('forum.discussions.edit', compact('discussion', 'categories'));
    }

    public function update(DiscussionRequest $request, $discussion)
    {
        $data = $request->only('title', 'body');
        $data = array_merge($data, [
            'slug' => str_slug($request->input('slug')),
            'last_user_id' => Auth::id(),
        ]);

        $discussion = Discussion::findOrFail($discussion);
        $discussion->fill($data)->save();

        $categories = $request->input('categories');
        if ($categories)
        {
            $discussion->categories()->sync($categories);
        }

        return redirect()->route('discussion', [$request->input('slug')]);
    }
}
