@extends('layouts.admin')

@section('title') {{$user_type}} @endsection

@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <!-- Add Order -->
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$user_type}}</a></li>
      </ol>
    </div>
    <!-- Card starts -->
    <div class="card">
      <div class="card-header d-block">
        <h4 class="card-title">List {{$user_type}}</h4>
      </div>
      <div class="card-body">
        <table class="table table-responsive-md">
          <thead>
            <tr>
              <th class="width80"><strong>#</strong></th>
              <th><strong>NAME</strong></th>
              <th><strong>DATE CREATED</strong></th>
              <th><strong>STATUS</strong></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
            $count = 1;
            @endphp

            @foreach ($users as $user)
            <tr>
              <td>{{ $count++ }}</td>
              <td><a href="/admin/edit_lecturer/{{$user->user_id}}" class="link">{{
                  $user->title . ' ' . $user->first_name . ' ' . $user->middle_name . ' ' . strtoupper($user->last_name)
                  }}</a>
              </td>
              <td>{{ date('d M, Y', strtotime($user->created_at)) }}</td>
              <td><span class="badge light badge-{{ $user->enabled ? 'success' : 'danger' }}">{{ $user->enabled ?
                  'Enabled' : 'Disabled' }}</span></td>
              <td>
                <a href="/admin/edit_lecturer/{{$user->user_id}}" class="btn btn-success light sharp">
                  @component('components.svg.hr-dot3', ['height'=>'20', 'width'=>'20'])
                  @endcomponent
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- End card-body -->
    </div>
    <!-- Card ends -->
  </div>
  <!-- container ends -->
</div>
@endsection