<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    } // index



    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //limit failed attempt /min to 5
        $executed = RateLimiter::attempt('auth:' . $request->ip(), $perMinute = 30, function () {
        });


        if (!$executed)
            return redirect()->back()->with('fail', auth_messages('throttle_message'));

        $remember_me = $request->has('remember_me') ? true : false;

        if (!Auth::attempt($credentials, $remember_me))
            return redirect()->back()->with('fail', auth_messages('login_error'));



        //check if email is verified
        if (!Auth::user()->email_verified_at) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $request->session()->flush();
            return redirect()->back()->with('fail', auth_messages('verify_email')
                . ' <a href="/verify_email">Verify now</>');
        }

        $request->session()->regenerate();

        RateLimiter::clear('auth:' . $request->ip());

        $account_type = strtolower(Auth::user()->account_type);
        $account_type = str_replace(' ', '', $account_type);

        return redirect('/' . $account_type . '/');
    } // login
}
