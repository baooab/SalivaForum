<?php

namespace App\Http\Controllers\Settings;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('users.settings.password');
    }

    public function update(UpdatePasswordRequest $request)
    {
        if (! $this->checkPassword($request->input('current_password'))) {
            session()->put('error', '旧密码输入错误');

            return back();
        }

        $bcryptPassword = bcrypt($request->input('password'));

        Auth::user()->update(['password' => $bcryptPassword]);

        $this->success('settings.password.updated');

        return back();
    }

    private function checkPassword($oldPassword): bool
    {
        return Hash::check($oldPassword, Auth::user()->password);
    }
}
