<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    //
    public function showLinkRequestForm()
    {
        return view('passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            session()->flash('warning', "邮箱地址不存在");
        } else {

            $passwordReset = PasswordResets::create([
                'email' => $user->email,
                'token' => Str::random(64),
                'created_at' => time()
            ]);

            $this->sendEmailResetTo($passwordReset->token, $user);
            session()->flash('success', '密码重置邮件已发送');
        }
        return back();
    }

    protected function sendEmailResetTo($token, $user)
    {
        $view = 'emails.reset';
        $data = compact('token');
        $from = 'test@test.com';
        $name = 'test';
        $to = $user->email;

        $subject = "请确认你的邮箱";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
}
