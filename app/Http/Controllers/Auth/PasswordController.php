<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class PasswordController extends Controller
{
    public function resetPasswordLink(Request $request)
    {
        $success_msg = 'We will send a reset password link to your e-mail within 10 minutes if this email is '
            . 'found in our system. Remember to check your spam box too.';

        $account = User::select('email', 'email_verified_at')
            ->where('email', $request->email)->first();

        if (!$account) {
            return redirect()->back()->with([
                'success' => $success_msg
            ]);
        }

        $token = Str::random(64);


        PasswordReset::insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
            'expired_at' => now()->addDays(1)
        ]);


        $url_data = url('/reset_password/' . base64_encode($request->email) . '/' . $token);
        $email = $request->email;

        $send = true;

        try {
            Mail::send(
                'email.forgot_password',
                [
                    'url_data' => $url_data
                ],
                function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Reset Password' . date('dmYHis') . env('APP_NAME'));
                }
            );
        } catch (Exception $ex) {
            $send = false;
        }


        if (!$send) {
            return redirect()->back()->with([
                'fail' => 'A system error occured. Please try again'
            ]);
        }

        return redirect()->back()->with([
            'success' => $success_msg
        ]);
    } // resetPasswordLink




    public function changePassword(Request $request, $email_base64, $token)
    {
        $is_present = PasswordReset::whereDate('expired_at', '>=', now())
            ->where('email', base64_decode($email_base64))
            ->where('token', $token)->count();

        if ($is_present < 1)
            return redirect('/login')->with('fail', 'The reset password link has expired or does not exist! Please generate a new link.');

        Session::flash('fail', 'Password data is incorrect');

        $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        Session::remove('fail');


        $user = [];
        $user['password'] = Hash::make($request->new_password);

        $is_update = User::where('email', base64_decode($email_base64))->update($user);

        if ($is_update) {
            PasswordReset::where('email', base64_decode($email_base64))->update(['token' => '']);

            $email = base64_decode($email_base64);


            Mail::send('email.password_reset_successful', [
                'url_data' => url('/login')
            ], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Password Reset');
            });


            return redirect('/login')->with('success', 'Password Updated successfully');
        } else
            return redirect('/login')->with('fail', 'Something went wrong');
    } // changePassword




    public function updatePasswordView()
    {
        return view('panel.update_password')->with([]);
    } // updatePasswordView




    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return redirect()->back()->with([
                'isSuccess' => false,
                'fail' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code 
        } else {
            $user = User::where('user_id', Auth::user()->user_id)->update([
                'password' => Hash::make($request->get('password'))
            ]);
            if ($user) {
                Session::flash('success', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return redirect()->back()->with([
                    'isSuccess' => true,
                    'success' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('fail', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->with([
                    'isSuccess' => true,
                    'fail' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
}
