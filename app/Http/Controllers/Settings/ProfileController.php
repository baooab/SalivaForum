<?php

namespace App\Http\Controllers\Settings;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('users.settings.profile');
    }
    
    public function update(UpdateProfileRequest $request)
    {
        $data = $request->only('username', 'email');

        Auth::user()->update($data);

        $this->success('settings.updated');

        return redirect()->route('settings.profile');
    }
}
