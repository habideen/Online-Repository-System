<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\CourseInfo;
use App\Models\CourseTutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ManageController extends Controller
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
            ->join('courses', 'courses.course_code', '=', 'course_infos.course_code')
            ->join('course_tutors', 'course_tutors.course_info_id', '=', 'course_infos.course_info_id')
            ->where('course_tutors.user_id', Auth::user()->user_id);
    } // getCourses




    private function isInstructor($course_info_id)
    {
        return CourseTutor::select('id')
            ->join('course_infos', 'course_infos.course_info_id', '=', 'course_tutors.course_info_id')
            ->whereNotNull('course_tutors.is_cordinator')
            ->where('course_tutors.user_id', Auth::user()->user_id)
            ->where('course_infos.course_info_id', $course_info_id)
            ->first();
    } // isInstructor




    public function currentSession()
    {
        $course_info = $this->getCourses()
            ->where('course_infos.session', currentSession())
            ->get();

        return view('panel.instructor.course_info')->with([
            'course_info' => $course_info
        ]);
    } // currentSession




    public function courseInfoView(Request $request)
    {
        $courseInfo =  CourseInfo::select(
            'courses.*',
            'course_infos.session',
            'course_infos.course_info_id',
            'course_infos.introduction',
            'course_infos.grading_information'
        )
            ->join('courses', 'courses.course_code', '=', 'course_infos.course_code')
            ->join('course_tutors', 'course_tutors.course_info_id', '=', 'course_infos.course_info_id')
            ->where('course_tutors.user_id', Auth::user()->user_id)
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


        return view('panel.instructor.course_info_instructor')->with([
            'instructors' => $instructors,
            'courseInfo' => $courseInfo,
            'isInstructor' => $this->isInstructor($courseInfo->course_info_id)
        ]);
    } // courseInfoView




    public function updateCourseMetadata(Request $request)
    {
        Session::flash('fail', 'Error in input supplied');
        $request->validate([
            'introductionInput' => [
                'string', 'min:2',
                Rule::requiredIf(!$request->gradingInfoInput)
            ],
            'gradingInfoInput' => [
                'string', 'min:2',
                Rule::requiredIf(!$request->introductionInput)
            ],
            'course_info_id' => ['required', 'exists:course_infos']
        ]);
        Session::remove('fail');


        if (!$this->isInstructor($request->course_info_id)) {
            return redirect()->back()->with([
                'fail' => 'You are not authorized to perform this action'
            ]);
        }


        $data = [];
        if ($request->introductionInput) {
            $data['introduction'] = $request->introductionInput;
        } else {
            $data['grading_information'] = $request->gradingInfoInput;
        }

        $update = CourseInfo::where('course_info_id', $request->course_info_id)
            ->update($data);


        if (!$update) {
            return redirect()->back()->with([
                'fail' => SERVER_ERROR
            ]);
        }

        return redirect()->back()->with([
            'success' => 'The update was successful'
        ]);
    } // updateCourseMetadata
}
