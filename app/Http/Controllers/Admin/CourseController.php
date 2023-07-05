<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

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




    public function addEditCourse(Request $request)
    {
        Session::flash('fail', 'Invalid input exist');

        $course_code = preg_replace('/\s+/', ' ', $request->course_code);
        $course_code = strtoupper($course_code);

        $request->validate([
            'edit_course_code' => ['nullable', 'exists:courses,course_code'],
            'course_code' => [
                'required', 'regex:/^[A-Za-z]{3,3}[ ]*[0-9]{3,3}$/',
                // Rule::unique('courses')
                //     ->where('course_code', $course_code)
                //     ->ignore($course_code, 'course_code')
                function (string $attribute, mixed $value, Closure $fail) use ($request, $course_code) {
                    $check = Course::select('course_code')
                        ->where('course_code', $course_code)
                        ->where('course_code', '!=', $request->edit_course_code)
                        ->first();
                    if ($check) {
                        $fail("The course code already exist.");
                    }
                }
            ],
            'course_title' => ['required', 'regex:/^[A-Za-z0-9 \(\)\-]{2,100}$/']
        ]);

        Session::remove('fail');


        if ($request->edit_course_code) {
            $save = Course::where('course_code', $request->edit_course_code)
                ->update([
                    'course_code' => $course_code,
                    'course_title' => preg_replace('/\s+/', ' ', $request->course_title)
                ]);
        } else {
            $save = new Course;
            $save->course_code = $course_code;
            $save->course_title = preg_replace('/\s+/', ' ', $request->course_title);
            $save->added_by = Auth::user()->user_id;
            $save->save();
        }


        if (!$save) {
            return redirect()->back()->with([
                'fail' => 'An error occured! Please try again'
            ]);
        }


        if ($request->edit_course_code) {
            return redirect('/admin/edit_course/' . $course_code)->with([
                'success' => 'The update was successful'
            ]);
        }

        return redirect()->back()->with([
            'success' => 'The registration was successful'
        ]);
    } // addEditCourse




    public function listCourse(Request $request)
    {
        $courses = Course::select(
            'course_code',
            'course_title',
            'created_at'
        )
            ->get();

        return view('panel.admin.list_courses')->with([
            'courses' => $courses
        ]);
    } // listCourse
}
