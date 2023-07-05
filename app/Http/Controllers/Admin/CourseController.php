<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function addCourseView(Request $request, $course_code = null)
    {
        if ($course_code) {
            $course = Course::select(
                'course_code',
                'course_title'
            )
                ->where('course_code', $course_code)
                ->first();

            if (!$course) {
                return redirect()->back()->with([
                    'fail' => 'Invalid course selected'
                ]);
            }
        }

        return view('panel.admin.add_edit_course')->with([
            'course' => $course ?? null
        ]);
    }
}
