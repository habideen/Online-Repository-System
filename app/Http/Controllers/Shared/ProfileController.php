<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('panel.edit_profile');
    } // index




    public function update(Request $request)
    {
        $request->validate([
            'title' => ['required', Rule::in(TITLE)],
            'last_name' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'first_name' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'middle_name' => ['nullable', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'gender' => ['required', Rule::in(GENDER)],
            'awards' => ['nullable', 'regex:/^[A-Za-z\-,. ]{2,255}$/'],
            'phone_1' => [
                'required', 'regex:/^[0][7-9][0-9]{9,9}$/',
                Rule::unique('users')
                    ->where(function ($query) use ($request) {
                        $query->where('phone_1', $request->phone_1)
                            ->orWhere('phone_2', $request->phone_1);
                    })
                    ->ignore(Auth::user()->user_id, 'user_id'),
            ],
            'phone_2' => [
                'nullable', 'regex:/^[0][7-9][0-9]{9,9}$/',
                Rule::unique('users')
                    ->where(function ($query) use ($request) {
                        $query->where('phone_2', $request->phone_2)
                            ->orWhere('phone_1', $request->phone_2);
                    })
                    ->ignore(Auth::user()->user_id, 'user_id'),
            ],
            'email' => [
                'required', 'email',
                Rule::unique('users')->ignore(Auth::user()->user_id, 'user_id')
            ],
            'office_address' => ['nullable', 'regex:/^[A-Za-z0-9\-,.\(\) ]{2,100}$/']
        ]);


        $save = User::where('user_id', Auth::user()->user_id)
            ->update($request->except('_token'));


        if (!$save) {
            return redirect()->back()->with([
                'fail' => SERVER_ERROR
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Profile update was successful'
        ]);
    } //update
}
