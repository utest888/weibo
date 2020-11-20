<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    //
    public function showResetForm(Request $request)
    {
        $token = $request->token;
        return view('passwords.reset', compact('token'));
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $passwrodReset = PasswordReset::where('email', $request->email)->where('token', $request->token)->first();
        if (!empty($passwrodReset)) {
            $user = User::where('email', $request->email)->first();

            if (!empty($user)) {
                $user->password = bcrypt($request->password);
                $user->save();

                PasswordReset::where('email', $request->email)->where('token', $request->token)->delete();

                session()->flash('success', '密码已重置');
                return redirect()->route('login');
            } else {
                session()->flash('warning', '邮箱不正确');
            }
        } else {
            session()->flash('warning', '验证信息不正确');
        }

        return back();
    }
}
