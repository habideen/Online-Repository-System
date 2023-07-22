<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CourseInfo;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private function getCourses()
    {
        return CourseInfo::select(
            'course_infos.course_info_id',
            'course_infos.course_code',
            'courses.course_title',
            'courses.course_unit',
            'course_infos.session',
            'course_infos.created_at'
        )
            ->join('courses', 'courses.course_code', '=', 'course_infos.course_code');
    } // getCourses




    public function index(Request $request)
    {
        $course_info = $this->getCourses()
            ->where('course_infos.session', '=', $request->session ?? currentSession())
            ->get();


        $subscriptions = Subscription::select(
            'course_infos.course_info_id',
            'course_infos.course_code',
            'courses.course_title',
            'courses.course_unit',
            'course_infos.session',
            'course_infos.created_at'
        )
            ->join('course_infos', 'course_infos.course_info_id', '=', 'subscriptions.course_info_id')
            ->join('courses', 'courses.course_code', '=', 'course_infos.course_code')
            ->where('subscriptions.user_id', Auth::user()->user_id)
            ->get();


        return view('panel.student.index')->with([
            'course_info' => $course_info,
            'subscriptions' => $subscriptions,
        ]);
    } //index
}
