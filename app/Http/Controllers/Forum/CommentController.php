<?php

namespace App\Http\Controllers\Forum;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $data = $request->only('body', 'discussion_id');
        $data = array_merge($data, [
            'user_id' => Auth::id(),
        ]);

        Discussion::find($data['discussion_id'])->update([
        	'last_user_id'=> Auth::id()
        ]);

        Comment::create($data);

        return back();
    }
}
