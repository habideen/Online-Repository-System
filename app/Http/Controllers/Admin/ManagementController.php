<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseInfo;
use App\Models\CourseTutor;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class ManagementController extends Controller
{
    public function sessionCourseList()
    {
        $course_info = CourseInfo::select(
            'course_infos.course_info_id',
            'course_infos.course_code',
            'courses.course_title',
            'courses.course_unit',
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




    public function courseInfoView(Request $request)
    {
        $courseInfo =  CourseInfo::select(
            'courses.*',
            'course_infos.session',
            'course_infos.course_info_id'
        )
            ->join('courses', 'courses.course_code', '=', 'course_infos.course_code')
            ->where('courses.course_code', $request->course_code)
            ->where('session', $request->session)
            ->first();

        if (!$courseInfo) {
            return redirect()->back()->with([
                'fail' => 'No record found for your selection'
            ]);
        }

        $instructors = CourseTutor::select(
            'course_tutors.*',
            'users.title',
            'users.last_name',
            'users.first_name',
            'users.middle_name'
        )
            ->join('users', 'users.user_id', '=', 'course_tutors.user_id')
            ->where('course_tutors.course_info_id', $courseInfo->course_info_id)
            ->get();

        $lecturers = User::select(
            'user_id',
            'users.title',
            'users.last_name',
            'users.first_name',
            'users.middle_name'
        )
            ->where('account_type', 'Instructor')
            ->get();

        return view('panel.admin.course_info_instructor')->with([
            'instructors' => $instructors,
            'courseInfo' => $courseInfo,
            'lecturers' => $lecturers
        ]);
    } // courseInfoView




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
                'fail' => SERVER_ERROR
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




    public function updateInstructor(Request $request)
    {
        FacadesSession::flash('fail', 'Please provide a valid information');

        $request->validate([
            'lecturer_id' => ['required', 'uuid', 'exists:users,user_id'],
            'course_code' => ['required'],
            'course_session' => ['required']
        ]);

        $course = CourseInfo::select('course_info_id')
            ->where('course_code', $request->course_code)
            ->where('session', $request->course_session)
            ->first();

        if (!$course) {
            return redirect()->back();
        }

        FacadesSession::remove('fail');


        $save = CourseTutor::updateOrCreate(
            [
                'user_id' => $request->lecturer_id,
                'course_info_id' => $course->course_info_id
            ],
            [
                'user_id' => $request->lecturer_id,
                'course_info_id' => $course->course_info_id
            ]
        );
        // $save->user_id = $request->lecturer_id;
        // $save->course_info_id = $course->course_info_id;
        // $save->save();


        if (!$save) {
            return redirect()->back()->with([
                'fail' => SERVER_ERROR
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Instructor added successfully'
        ]);
    } // updateInstructor




    public function setCourseCordinate(Request $request)
    {
        $course = CourseInfo::select('course_info_id')
            ->where('course_info_id', $request->course_info_id)
            ->where('session', currentSession())
            ->first();

        if (!$course) {
            return redirect()->back()->with([
                'fail' => 'Please make sure that the current session matches this course session'
            ]);
        }


        $remove = CourseTutor::where('course_info_id', $request->course_info_id)
            ->update([
                'is_cordinator' => null
            ]);


        $update = null;
        if ($remove) {
            $update = CourseTutor::where('course_info_id', $request->course_info_id)
                ->where('user_id', $request->user_id)
                ->update([
                    'is_cordinator' => 1
                ]);
        }


        if (!$update) {
            return redirect()->back()->with([
                'fail' => SERVER_ERROR
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Instructor set successfully'
        ]);
    } // setCourseCordinate




    public function deleteCourseCordinate(Request $request)
    {
        $course = CourseInfo::select('course_info_id')
            ->where('course_info_id', $request->course_info_id)
            ->where('session', currentSession())
            ->first();

        if (!$course) {
            return redirect()->back()->with([
                'fail' => 'Please make sure that the current session matches this course session'
            ]);
        }


        $delete = CourseTutor::where('course_info_id', $course->course_info_id)
            ->where('user_id', $request->user_id)
            ->delete();


        if (!$delete) {
            return redirect()->back()->with([
                'fail' => SERVER_ERROR
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Instructor is deleted from this course successfully'
        ]);
    } // deleteCourseCordinate
}
