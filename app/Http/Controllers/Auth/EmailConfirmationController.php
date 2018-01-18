<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendEmailConfirmation;
use App\Http\Controllers\Controller;

class EmailConfirmationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'send']);
    }

    public function send()
    {
        if (Auth::user()->isConfirmed()) {
            $this->error('auth.confirmation.already_confirmed');
        } else {
            $this->dispatchNow(new SendEmailConfirmation(Auth::user()));

            $this->success('auth.confirmation.sent', Auth::user()->email);
        }

        return redirect()->route('dashboard');
    }

    public function confirm(User $user, string $code)
    {
        if ($user->matchesConfirmationCode($code)) {
            
            $user->confirm();

            $this->success('auth.confirmation.success');
        } else {
            $this->error('auth.confirmation.no_match');
        }

        return Auth::check() ? redirect()->route('dashboard') : redirect('/');
    }
}
