@extends('layouts.admin')

@php
$titleTxt = Request::segment(2) == 'add_lecturer' ? 'Add Lecturer' : 'Edit Lecturer';
@endphp

@section('title') {{ $titleTxt }} @endsection

@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $titleTxt }}</a></li>
      </ol>
    </div>
    <!-- row -->
    <!-- Row starts -->
    <div class="card">
      <div class="card-header d-block d-flex">
        <h4 class="card-title">{{ $titleTxt }}</h4>
        @if ($user && $user->user_id)
        <div class="ms-auto">
          <a href="/admin/list/{{strtolower($user->account_type)}}s" class="btn btn-light">Go Back</a>
        </div>
        @endif
      </div>
      <div class="card-body">

        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif

        <div class="row justify-content-between">

          <form action="/admin/create_or_update_lecturer" method="post" enctype="multipart/form-data" class="">
            @csrf

            <input type="text" name="user_id" value="{{$user->user_id ?? ''}}" class="d-none" readonly>

            <div class="row">
              <div class="col-sm-6 form-group mb-4">
                <label for="title">Title</label>
                <select class="form-control" name="title" id="title">
                  <option value="">Select title</option>
                  @foreach (TITLE as $title)
                  <option value="{{$title}}">{{$title}}</option>
                  @endforeach
                </select>
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-sm-6 form-group mb-4">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder=""
                  value="{{ old('last_name') ?? $user->last_name ?? '' }}" required='true'
                  pattern="^[ ]*[A-Za-z\-]{2,30}[ ]*$">
                @error('last_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-sm-6 form-group mb-4">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder=""
                  value="{{ old('first_name') ?? $user->first_name ?? '' }}" required='true'
                  pattern="^[ ]*[A-Za-z\-]{2,30}[ ]*$">
                @error('first_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-sm-6 form-group mb-4">
                <label for="middle_name">Middle Name <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder=""
                  value="{{ old('middle_name') ?? $user->middle_name ?? '' }}" pattern="^[ ]*[A-Za-z\-]{2,30}[ ]*$">
                @error('middle_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-sm-6 form-group mb-4">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender" id="gender" required>
                  <option value="">Select gender</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>
                @error('gender')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="row mt-5">
              <div class="col-sm-6 form-group mb-4">
                <label for="phone">Phone number</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder=""
                  value="{{ old('phone') ?? $user->phone_1 ?? '' }}" pattern="^[ ]*[0][7-9][0-9]{9,9}[ ]*$" required>
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-sm-6 form-group mb-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder=""
                  value="{{ old('email') ?? $user->email ?? '' }}" required>
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

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


@section('script')
<script>
  $(document).ready(function() {
    $('#title').val('{{ old('title') ?? $user->title ?? '' }}')
    $('#gender').val('{{ old('gender') ?? $user->gender ?? '' }}')
  })
</script>
@endsection