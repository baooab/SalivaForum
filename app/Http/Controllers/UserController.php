<?php

namespace App\Http\Controllers;

use Image;
use App\Http\Requests\UserSigninRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Mail\ConfirmUserEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function register()
    {
        return view('user.register');
    }

    public function confirm($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();

        if (is_null($user))
        {
            return redirect('/');
        }

        $user->is_confirmed = true;
        $user->confirm_code = str_random(48);
        $user->save();

        return redirect()->route('user.login')
            ->with('status', [
                'type' => 'success',
                'info'=> '账号激活成功，请使用 ' . $user->email . ' 账号登录体验！'
            ]);
    }

    public function login()
    {
        return view('user.login');
    }

    public function signin(UserSigninRequest $request)
    {
        $data = $request->only(['email', 'password']);

        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
            'is_confirmed' => 1
        ]))
        {
            return redirect('/');
        }

        return back()->withInput()->with('status', ['type' => 'danger', 'info' => '用户登录失败']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        $data = $request->only('name', 'email', 'password');
        $data = array_merge($data, [
            'confirm_code' => str_random(48),
            'avatar' => '/images/default-avatar.png',
        ]);

        $user = User::create($data);
        Mail::to($user)->send(new ConfirmUserEmail($user));

        return redirect()->route('home');
    }

    public function getAvatar()
    {
        return view('user.avatar');
    }

    public function changeAvatar(Request $request)
    {
        $avatar = $request->file('avatar');

        if ($avatar->isValid())
        {
//            $AVATAR_DIR = 'avatars';
//            $AVATAR_DELETED_DIR = 'deleted';

            $user = Auth::user();

//            if(Storage::disk('local')->exists($user->avatar))
//            {
//                $contents = Storage::disk('local')->get($user->avatar);
//                $deletedAvatarName = 'user_' . $user->id . '_' . date('Ymd_His') . '.jpg';
//                Storage::put($AVATAR_DIR . DIRECTORY_SEPARATOR . $AVATAR_DELETED_DIR . DIRECTORY_SEPARATOR . $deletedAvatarName, $contents);
//            }

            $originExt = $avatar->getClientOriginalExtension();
            // 新文件名。例如：'586f2d753dfbd.jpg'
            $newName = uniqid() . '.' . $originExt;
            Storage::putFileAs('public/uploads/avatars', $avatar, $newName);

            $user->avatar = 'storage/uploads/avatars/' . $newName;
            $user->save();

//            dd(Image::make('uploads/avatars/' . $newName));

//            Storage::prepend('uploads.log',
//                Carbon::now() . ' ' . $user->email . '(' . $user->id . ') 上传头像至 ' . DIRECTORY_SEPARATOR . $AVATAR_DIR . $newName
//            );

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
