<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseInfo;
use App\Models\Session;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function sessionCourseList()
    {
        $course_info = CourseInfo::select(
            'course_infos.course_info_id',
            'course_infos.course_code',
            'courses.course_title',
            'course_infos.session',
            'course_infos.created_at'
        )
            ->join('courses', 'courses.course_code', '=', 'course_infos.course_code')
            ->where('course_infos.session', currentSession())
            ->get();

        return view('panel.admin.course_info')->with([
            'course_info' => $course_info
        ]);
    } // sessionCourseList




    public function courseInfo()
    {
        //
    } // courseInfo




    public function updateSessionView(Request $request)
    {
        return view('panel.admin.update_session')->with([
            'current_session' => currentSession()
        ]);
    } // updateSessionView




    public function updateSession(Request $request)
    {
        $request->validate([
            'session' => ['required', 'regex:/^[0-9]{4,4}[\/][0-9]{4,4}$/']
        ]);


        $save = new Session;
        $save->session = $request->session;
        $save->save();

        if (!$save) {
            return redirect()->back()->with([
                'fail' => 'System error! Please try again'
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Session was update successfully'
        ]);
    } // updateSession




    public function updateSessionCourses()
    {
        $courses = Course::select('course_code')->get();

        if ($courses->count() < 1) {
            return redirect()->back()->with([
                'fail' => 'Please register some courses first'
            ]);
        }

        // $upsert = [];
        foreach ($courses as $course) {
            CourseInfo::updateOrCreate(
                [
                    'course_code' => $course->course_code,
                    'session' => currentSession()
                ],
                [
                    'course_code' => $course->course_code,
                    'session' => currentSession()
                ]
            );
        }

        return redirect()->back()->with([
            'success' => 'All courses were updated successfully'
        ]);
    } // updateSessionCourses
}
