<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\CourseInfo;
use App\Models\CourseTutor;
use App\Models\CourseUpload;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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




    public function currentSession()
    {
        $course_info = $this->getCourses()
            ->where('course_infos.session', currentSession())
            ->get();

        return view('panel.instructor.course_info')->with([
            'course_info' => $course_info
        ]);
    } // currentSession




    public function allSessions()
    {
        $course_info = $this->getCourses()
            ->where('course_infos.session', '!=', currentSession())
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


        return view('panel.instructor.course_info_instructor')->with([
            'instructors' => $instructors,
            'courseInfo' => $courseInfo,
            'isInstructor' => isInstructor($courseInfo->course_info_id),
            'materials' => $materials,
            'downloads' => $downloads
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


        if (!isInstructor($request->course_info_id)) {
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




    public function courseMaterialView(Request $request)
    {
        if (!isAuthorized($request->course_info_id, $request->course_code, $request->session)) {
            return redirect()->back()->with([
                'fail' => 'You are not authorized to view that course'
            ]);
        }

        if ($request->material_id && !canEdit($request->material_id)) {
            return redirect()->back()->with([
                'fail' => 'Sorry! That material doesn\'t belong to you. You cannot modify it.'
            ]);
        }

        if ($request->material_id) {
            $material = CourseUpload::select(
                'course_uploads.id',
                'course_uploads.title',
                'course_uploads.material_information'
            )
                ->join('course_infos', 'course_infos.course_info_id', '=', 'course_uploads.course_info_id')
                ->where('course_infos.course_code', $request->course_code)
                ->where('course_infos.session', $request->session)
                ->where('course_uploads.user_id', Auth::user()->user_id)
                ->where('course_uploads.id', $request->material_id)
                ->first();

            if (!$material) {
                return redirect()->back()->with([
                    'fail' => 'You are not authorized to view that course'
                ]);
            }


            $downloads = Material::select(
                'id',
                'title',
                'link',
                'isExternalLink'
            )
                ->whereIn('course_upload_id', $material->pluck('id'))
                ->get();
        }


        return view('panel.instructor.add_edit_material')->with([
            'material' => $material ?? null,
            'downloads' => $downloads ?? null
        ]);
    } // courseMaterialView




    public function courseMaterial(Request $request)
    {
        if (!isAuthorized($request->course_info_id, $request->course_code, $request->session)) {
            return redirect()->back()->with([
                'fail' => 'You are not authorized to view that course'
            ]);
        }

        if ($request->material_id && !canEdit($request->material_id)) {
            return redirect()->back()->with([
                'fail' => 'Sorry! That material doesn\'t belong to you. You cannot modify it.'
            ])->withInput($request->all());
        }

        $request->validate([
            'material_id' => ['nullable', 'integer', 'exists:course_uploads,id'],
            'course_info_id' => ['required', 'integer', 'exists:course_infos'],
            'title' => ['required', 'string', 'min:2', 'max:100'],
            'information' => ['nullable', 'string', 'min:2', 'max:5000'],
        ]);


        //START get new files
        $keys = $request->except('_token', 'course_info_id', 'information', 'course_code', 'session');
        $keys = preg_grep('/^title-/', array_keys($keys));

        $upload = [];

        foreach ($keys as $title) {
            $num = explode('-', $title)[1] ?? null;
            if (!ctype_digit($num))
                continue;

            if ($request->get('title-' . $num)) {
                if (!in_array($request->file('file-' . $num)->extension(), VALID_FILE_TYPE))
                    continue;

                array_push($upload, $num);
            }
        } //END get new files


        //START get delete files
        $keys = $request->except('_token', 'course_info_id', 'information', 'course_code', 'session');
        $keys = preg_grep('/^delete-old-/', array_keys($keys));

        $delete = [];
        $deleteFiles = [];

        foreach ($keys as $title) {
            $id = explode('old-', $title)[1] ?? null;
            if (!ctype_digit($id))
                continue;

            if ($request->get('delete-old-' . $id))
                array_push($delete, $id);

            if ($request->get('old-link-' . $id))
                array_push($deleteFiles, 'materials/' . $request->get('old-link-' . $id));
        } //END get delete files


        //START get old files
        $keys = $request->except('_token', 'course_info_id', 'information', 'course_code', 'session');
        $keys = preg_grep('/^old-title-/', array_keys($keys));

        $updateTittle = [];

        foreach ($keys as $title) {
            $id = explode('title-', $title)[1] ?? null;
            if (!ctype_digit($id) || in_array($id, $delete))
                continue;

            if ($request->get('old-title-' . $id))
                array_push($updateTittle, $id);
        } //END get old files


        if (!$request->material_id) {
            $materialInfo = new CourseUpload;
            $materialInfo->course_info_id = $request->course_info_id;
            $materialInfo->user_id = Auth::user()->user_id;
            $materialInfo->title = $request->title;
            $materialInfo->material_information = $request->information;
            $materialInfo->save();
        } else {
            $materialInfo = CourseUpload::find($request->material_id);
            $materialInfo->course_info_id = $request->course_info_id;
            $materialInfo->title = $request->title;
            $materialInfo->material_information = $request->information;
            $materialInfo->save();
        }


        if (!$materialInfo) {
            return redirect()->back()->with([
                'fail' => SERVER_ERROR
            ]);
        }


        $data = [];
        $storageError = '';
        foreach ($upload as $key) {
            $fileName = $materialInfo->id . '_' . uuid_create() . '.'
                . $request->file('file-' . $key)->extension();

            $store = $request->file('file-' . $key)->storeAs('materials', $fileName);
            if (!$store) {
                $storageError .= $storageError ? ' .' . $request->get('title-' . $key) : $request->get('title-' . $key);
                $storageError .= ' was not uploaded<br>';
                continue;
            }

            $isExternalLink = null;

            array_push($data, [
                'course_upload_id' => $materialInfo->id,
                'title' => $request->get('title-' . $key),
                'link' => $fileName,
                'isExternalLink' => $isExternalLink,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $save = Material::insert($data);


        if (!$save) {
            CourseUpload::where('id', $materialInfo->id)->delete();
            foreach ($data as $ele) {
                if (!$ele['isExternalLink'])
                    Storage::disk('local')->delete('materials/' . $ele['link']);
            }

            return redirect()->back()->with([
                'fail' => 'Material information was saved and reversed. <br>' . SERVER_ERROR
            ]);
        }


        foreach ($updateTittle as $id) {
            $save = Material::where('course_upload_id', $materialInfo->id)
                ->where('id', $id)
                ->update(['title' => $request->get('old-title-' . $id)]);
        }


        Material::whereIn('id', $delete)->delete();

        if (count($deleteFiles) > 0) {
            Storage::disk('local')->delete($deleteFiles);
        }


        if ($request->material_id) {
            return redirect()->back()->with([
                'success' => $request->material_id ? 'Material modified successfully' : 'Material uploaded successfully'
            ]);
        }

        return redirect('/instructor/course_info?course_code='
            . urlencode($request->course_code) . '&session=' . urlencode($request->session))
            ->with([
                'success' => $request->material_id ? 'Material modified successfully' : 'Material uploaded successfully'
            ]);
    } // courseMaterial
}
