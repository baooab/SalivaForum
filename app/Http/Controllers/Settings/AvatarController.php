<?php

namespace App\Http\Controllers\Settings;

use Auth;
use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvatarController extends Controller
{
    public function edit()
    {
        return view('users.settings.avatar');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image|dimensions:max_width=520,max_height=520',
        ], [
            'avatar.required' => '请先选择上传的头像。',
            'avatar.dimensions' => '上传头像的宽高都不能大于 520 像素。',
        ]);

        $avatar = $request->file('avatar');

        if ($avatar->isValid()) {
            $user = Auth::user();

            $path = Storage::putFile('public/uploads/avatars', $avatar);
            $user->avatar = Storage::url($path);
            $user->save();

            session()->put('success', '头像修改成功！');
        } else {
            session()->put('error', '上传的不是有效的图片。');
        }

        return back();
    }
}
