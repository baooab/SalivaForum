<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('users.profile', compact('user'));
    }

    public function discussions(User $user)
    {
        $discussions = Discussion::with('user', 'categories')
            ->where('user_id', $user->id)
            ->latest('updated_at')
            ->paginate(24);

        return view('users.profile_discussions', compact('discussions', 'user'));
    }
}
