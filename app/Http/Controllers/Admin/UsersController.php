<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function addLecturerView(Request $request, $user_id = null)
    {
        if ($user_id) {
            $user = User::select(
                'user_id',
                'title',
                'last_name',
                'first_name',
                'middle_name',
                'gender',
                'phone_1',
                'email',
                'account_type'
            )
                ->where('user_id', $user_id)
                ->first();

            if (!$user) {
                return redirect()->back()->with([
                    'fail' => 'Invalid user selected'
                ]);
            }
        }

        return view('panel.admin.add_edit_lecturer')->with([
            'user' => $user ?? null
        ]);
    } //addLecturerView




    public function addEditLecturer(Request $request)
    {
        Session::flash('fail', 'Invalid input exist');

        $request->validate([
            'user_id' => ['nullable', 'exists:users,user_id'],
            'title' => ['required', Rule::in(TITLE)],
            'last_name' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'first_name' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'middle_name' => ['nullable', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'gender' => ['required', Rule::in(GENDER)],
            'phone' => [
                'required', 'regex:/^[0][7-9][0-9]{9,9}$/',
                Rule::unique('users', 'phone_1')
                    ->where(function ($query) use ($request) {
                        $query->where('phone_1', $request->phone_1)
                            ->orWhere('phone_2', $request->phone_1);
                    })
                    ->ignore($request->user_id, 'user_id'),
            ],
            'email' => ['required', 'email']
        ]);

        Session::remove('fail');


        if ($request->user_id) {
            $save = User::where('user_id', $request->user_id)
                ->update([
                    'title' => $request->title,
                    'last_name' => $request->last_name,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'gender' => $request->gender,
                    'phone_1' => $request->phone,
                    'email' => strtolower($request->email)
                ]);
        } else {
            $save = new User;
            $save->user_id = Str::uuid()->toString();
            $save->title = $request->title;
            $save->last_name = $request->last_name;
            $save->first_name = $request->first_name;
            $save->middle_name = $request->middle_name;
            $save->gender = $request->gender;
            $save->phone_1 = $request->phone;
            $save->email = strtolower($request->email);
            $save->department_id = '1';
            $save->account_type = 'Instructor';
            $save->enabled = '1';
            $save->password = Hash::make(Str::random(30));
            $save->save();
        }


        if (!$save) {
            return redirect()->back()->with([
                'fail' => 'An error occured! Please try again'
            ]);
        }


        return redirect()->back()->with([
            'success' => 'The registration was successful'
        ]);
    } // addEditLecturer




    public function listUsers(Request $request)
    {
        // remove the s
        $user_type = substr($request->segment(3), 0, strlen($request->segment(3)) - 1);
        $user_type = ucwords($user_type);

        if (!in_array($user_type, ['Instructor', 'Student'])) {
            return redirect()->back()->with([
                'fail' => 'Unauthrized access'
            ]);
        }

        $users = User::select(
            'user_id',
            'last_name',
            'first_name',
            'middle_name',
            'enabled',
            'created_at'
        )
            ->where('account_type', $user_type)
            ->get();

        return view('panel.admin.list_users')->with([
            'users' => $users,
            'user_type' => $user_type
        ]);
    } // listUsers
}
