<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseInfo;
use App\Models\CourseTutor;
use App\Models\CourseUpload;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::select(
            'courses.course_code',
            'courses.course_title',
            'course_infos.course_info_id',
            'course_infos.session',
            'course_infos.no_of_students',
            'course_infos.no_of_lessons',
            'users.title',
            'users.last_name',
            'users.first_name',
            'users.middle_name'
        )
            ->join('course_infos', 'course_infos.course_code', '=', 'courses.course_code')
            ->join('course_tutors', 'course_tutors.course_info_id', '=', 'course_infos.course_info_id')
            ->join('users', 'users.user_id', '=', 'course_tutors.user_id')
            ->where('course_tutors.is_cordinator', '1');


        if ($request->session) {
            $courses = $courses->where('course_infos.session', currentSession());
        }

        return view('courses')->with([
            'courses' => $courses->paginate(PAGINATION)
        ]);
    } //index



    public function courseDetails(Request $request)
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
            ->where('courses.course_code', $request->course_code)
            ->where('course_infos.course_info_id', $request->course_info_id)
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

        $materials = CourseUpload::select(
            'users.title',
            'users.last_name',
            'users.first_name',
            'users.middle_name',
            'course_uploads.id',
            'course_uploads.title AS material_title',
            'course_uploads.material_information',
            'course_uploads.created_at',
        )
            ->join('users', 'users.user_id', '=', 'course_uploads.user_id')
            ->where('course_uploads.course_info_id', $courseInfo->course_info_id)
            ->get();

        $downloads = Material::select(
            'id',
            'course_upload_id',
            'title',
            'link',
            'isExternalLink',
            'updated_at'
        )
            ->whereIn('course_upload_id', $materials->pluck('id'))
            ->get();


        return view('course-details')->with([
            'instructors' => $instructors,
            'courseInfo' => $courseInfo,
            'materials' => $materials,
            'downloads' => $downloads
        ]);
    } // courseDetails
}
