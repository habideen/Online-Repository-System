<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    } // index



    /**
     * Register user
     * @param request
     * @param api_username, api_password
     * @return login token and user profile data
     */
    public function register(Request $request)
    {
        $request->validate([
            'last_name' => ['required', 'min:2', 'regex:/^([a-zA-Z\-])*$/'],
            'first_name' => ['required', 'min:2', 'regex:/^([a-zA-Z\-])*$/'],
            'middle_name' => ['nullable', 'min:2', 'regex:/^([a-zA-Z\-])*$/'],
            'gender' => ['required', Rule::in(GENDER)],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'phone' => [
                'required', 'regex:/^[+]{0,1}[0-9]{6,19}$/',
                Rule::unique('users', 'phone_1'),
                Rule::unique('users', 'phone_2')
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $save = new User;
        $save->user_id = Str::uuid()->toString();
        $save->last_name = $request->last_name;
        $save->first_name = $request->first_name;
        $save->middle_name = $request->middle_name;
        $save->gender = $request->gender;
        $save->email = $request->email;
        $save->email_verified_at = now();
        $save->phone_1 = $request->phone;
        $save->account_type = 'Student';
        $save->department_id = '1';
        $save->enabled = '1';
        $save->password = bcrypt($request->password);
        $save->save();


        if (!$save) {
            return redirect()->back()->withInput($request->all())->with([
                'fail' => SERVER_ERROR
            ]);
        }


        return redirect('/login')->with([
            'success' => 'Account created successfully.'
        ]);
    } //register
}
