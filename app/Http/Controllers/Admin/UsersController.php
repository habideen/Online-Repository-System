<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function addLecturerView()
    {
        return view('panel.admin.add_lecturer_view')->with([]);
    } //addLecturerView
}
