<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', ['only' => [
            'create', 'store', 'edit', 'update',
        ]]);
    }

    public function home()
    {
        $discussions = Discussion::with('categories')
                    ->withCount('comments')
                    ->orderBy('updated_at', 'desc')
                    ->paginate(15);

        return view('forum.index', compact('discussions'));
    }

    public function show($id)
    {
        if (is_numeric($id))
        {
            $discussion = Discussion::with('comments', 'categories', 'user')->findOrFail($id);
        }
        else
        {
            $discussion = Discussion::with('comments', 'categories', 'user')->where('slug', $id)->firstOrfail();
        }

        return view('forum.show', compact('discussion'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();

        return view('forum.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        dd($request->all());

        $data = $request->only(['title', 'body']);
        $data = array_merge($data, [
           'slug' => str_slug($request->input('slug')),
           'user_id' => Auth::user()->id,
           'last_user_id' => Auth::user()->id,
        ]);

        $discussion = Discussion::create($data);
        $categories = $request->input('categories');
        if ($categories)
        {
            $discussion->categories()->attach($categories);
        }

        return redirect()->route('discussions.show', ['id' => $discussion->title]);
    }

    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();

        return view('forum.edit', compact('discussion', 'categories'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $data = $request->only('title', 'body');
        $data = array_merge($data, [
           'slug' => str_slug($request->input('slug')),
           'last_user_id' => Auth::user()->id,
        ]);

        $discussion = Discussion::find($id);
        Discussion::find($id)->fill($data)->save();

        $categories = $request->input('categories');
        if ($categories)
        {
            $discussion->categories()->sync($categories);
        }

        return redirect()->route('discussions.show', ['id' => $id]);
    }
}
