<?php

namespace App\Http\Controllers\Forum;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscussionRequest;

class DiscussionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['overview', 'show']]);
    }

    public function overview()
    {
        $discussions = Discussion::with('categories')
            ->withCount('comments')
            ->orderBy('updated_at', 'desc')
            ->simplePaginate(15);

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
        if ($categories) {
            $discussion->categories()->attach($categories);
        }

        session()->put('success', '帖子发布成功！');

        return redirect()->route('discussion', ['id' => $discussion->slug]);
    }

    public function edit(Discussion $discussion)
    {
        $this->authorize('update discussions', $discussion);
        
        $categories = Category::pluck('name', 'id')->all();

        return view('forum.discussions.edit', compact('discussion', 'categories'));
    }

    public function update(Request $request)
    {

        Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|exists:discussions,slug',
            'body' => 'required',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id'
        ])->validate(); 

        $data = $request->only('title', 'body');
        $data = array_merge($data, [
            'slug' => str_slug($request->input('slug')),
            'last_user_id' => Auth::id(),
        ]);

        $discussion = Auth::user()->discussions()->where('slug', $data['slug'])->first();

        $this->authorize('update discussions', $discussion);

        $discussion->fill($data)->save();
        
        $categories = $request->input('categories');
        if ($categories) {
            $discussion->categories()->sync($categories);
        }

        session()->put('success', '帖子更新成功！');

        return redirect()->route('discussion', [$data['slug']]);
    }
}
