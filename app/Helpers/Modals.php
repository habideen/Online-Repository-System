<?php

use App\Models\CourseTutor;
use App\Models\CourseUpload;
use Illuminate\Support\Facades\Auth;

if (!function_exists('isAuthorized')) {
  function isAuthorized(String $course_info_id, String $course_code = null, String $course_session = null)
  {
    $isAuthorised = CourseTutor::select('id')
      ->join('course_infos', 'course_infos.course_info_id', '=', 'course_tutors.course_info_id')
      ->where('course_tutors.user_id', Auth::user()->user_id)
      ->where('course_infos.course_info_id', $course_info_id);

    if ($course_code) {
      $isAuthorised = $isAuthorised->where('course_infos.course_code', $course_code);
    }

    if ($course_session) {
      $isAuthorised = $isAuthorised->where('course_infos.session', $course_session);
    }

    return $isAuthorised->first();
  }
} // isAuthorized




if (!function_exists('isInstructor')) {
  function isInstructor($course_info_id)
  {
    return CourseTutor::select('id')
      ->join('course_infos', 'course_infos.course_info_id', '=', 'course_tutors.course_info_id')
      ->whereNotNull('course_tutors.is_cordinator')
      ->where('course_tutors.user_id', Auth::user()->user_id)
      ->where('course_infos.course_info_id', $course_info_id)
      ->first();
  }
} // isInstructor




if (!function_exists('canEdit')) {
  function canEdit($material_id)
  {
    return $canEdit = CourseUpload::select('id')
      ->where('user_id', Auth::user()->user_id)
      ->where('id', $material_id)
      ->first();
  }
}// canEdit