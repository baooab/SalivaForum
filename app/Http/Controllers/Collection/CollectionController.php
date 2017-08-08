<?php

namespace App\Http\Controllers\Collection;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['overview']]);
    }

    public function overview()
    {
        $links = Link::with('user')->latest('updated_at')->paginate(50);

        return view('collection.overview', compact('links'));
    }

    public function create()
    {
        return view('collection.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:links',
            'url' => 'required|max:255|unique:links',
            'description' => 'present|max:255',
        ]);
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $link = new Link();
        $link->user_id = Auth::id();
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->save();

        return redirect()->route('collection.overview');
    }
}
