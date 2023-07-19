@extends('layouts.instructor')

@php
$titleTxt = Request::segment(2) == 'add_material' ? 'Add Material' : 'Edit Material';
@endphp

@section('title') {{ $titleTxt }} @endsection

@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/instructor">Dashboard</a></li>
        <li class="breadcrumb-item"><a
            href="/instructor/course_info?course_code={{Request::get('course_code')}}&session={{Request::get('session')}}">{{Request::get('course_code')}}</a>
        </li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $titleTxt }}</a></li>
      </ol>
    </div>
    <!-- row -->
    <!-- Row starts -->
    <div class="card">
      <div class="card-header d-block d-flex">
        <h4 class="card-title">{{ $titleTxt }}</h4>
        @if (true)
        <div class="ms-auto">
          <a href="/instructor/course_info?course_code={{Request::get('course_code')}}&session={{Request::get('session')}}"
            class="btn btn-light">Go Back</a>
        </div>
        @endif
      </div>
      <div class="card-body">
        @include('components.alert')

        <h5>Course Code: {{ Request::get('course_code') }}</h5>
        <h5>Course Session: {{ Request::get('session') }}</h5>

        <div class="row justify-content-between mt-5">

          <form
            action="/instructor/add_material?course_info_id={{ 
            Request::get('course_info_id') . '&course_code=' . urlencode(Request::get('course_code')) . '&session=' . urlencode(Request::get('session'))}}"
            method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="material_id" value="{{$material->id ?? ''}}" readonly>
            @error('information')
            <span class="text-danger d-block">{{$message}}</span>
            @enderror

            <div class="row">
              <div class="col-12 form-group mb-4">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title here"
                  value="{{ old('title') ?? $material->title ?? '' }}" minlength="2" maxlength="100" required>
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-12 form-group mb-4">
                <label for="information">Information</label>
                <textarea class="form-control" rows="3" name="information" placeholder="Type here"
                  id="information">{{ old('information') ?? $material->material_information ?? '' }}</textarea>
                @error('information')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            @if ($downloads)
            <div class="h6">Old materials</div>
            @foreach ($downloads as $download)
            <div class="row file_group">
              <div class="col-md-6 mb-2">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Title</span>
                  </div>
                  <input type="text" name="old-title-{{$download->id}}" class="form-control" maxlength="100"
                    minlength="2" value="{{$download->title}}" required>
                </div>
              </div>
              <div class="col-md-6 mb-4 pb-3 col">
                <div class="input-group">
                  <input type="text" name="old-link-{{$download->id}}"
                    class="form-control {{!$download->isExternalLink ? 'bg-light' : ''}}" maxlength="100" minlength="2"
                    value="{{$download->link}}" {{!$download->isExternalLink ? 'readonly' : ''}} required>
                  <div class="input-group-append">
                    <span class="input-group-text bg-danger text-white">
                      <i class="me-2">Delete</i>
                      <input type="checkbox" name="delete-old-{{$download->id}}" id="delete-old-{{$download->id}}"
                        class="form-check-input">
                    </span>
                  </div>
                </div>
              </div>
            </div>
            @endforeach

            <div class="h6 mt-3 mb-2">New materials</div>
            @endif

            <div id="newinput"></div>

            <button id="rowAdder" type="button" class="btn btn-info">
              <span class="fa fa-plus me-2">
              </span><span id="add_file_btn">Add File</span>
            </button>

            <div class="form-group mt-5">
              <button class="btn btn-primary form-control" type="submit">{{ $titleTxt }}</button>
            </div>
          </form>
        </div>
      </div>
      <!--card-body-->
    </div>
    <!-- Row ends -->
  </div>
  <!-- container ends -->
</div>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script>
  const easyMDE = new EasyMDE({element: document.getElementById('information')});
  $('#introductionModal').on('shown.bs.modal', function () {
    easyMDE.codemirror.refresh()
  });

  var count = 0;

  $("#rowAdder").click(function () {
      newRowAdd =
        '<div class="row file_group">' +
          '<div class="col-md-6 mb-2">' +
            '<div class="input-group">' +
              '<div class="input-group-prepend">' +
                '<span class="input-group-text">Title</span>' +
              '</div>' +
                `<input type="text" name="title-${++count}" class="form-control" maxlength="100" minlength="2" required>` +
            '</div>' +
          '</div>' +
          '<div class="col-md-6 mb-4 pb-3 col">' +
            '<div class="input-group">' +
              `<input type="file" class="form-control m-input" name="file-${count}" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.gif,.jpg,.jpeg" require_d>` +
              '<div class="input-group-append">' +
                `<button class="btn btn-danger" id="DeleteRow" type="button" value="${count}"><i class="fa fa-trash"></i> Delete</button>` +
              '</div>' +
            '</div>' +
          '</div>' +
        '</div>';

      $('#newinput').append(newRowAdd);
      
      (count == 0) ? $('#add_file_btn').text('Add File') : $('#add_file_btn').text('Add More File')
  });

  $("body").on("click", "#DeleteRow", function () {
      $(this).parents(".file_group").remove();
  })
</script>
@endsection