@extends('layouts.admin')

@section('title') Session @endsection

@section('content')
<div class="content-body">
  <!-- container starts -->
  <div class="container-fluid">
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Session</a></li>
      </ol>
    </div>
    <!-- row -->
    <!-- Row starts -->
    <div class="card">
      <div class="card-header d-block">
        <h4 class="card-title">Update Session</h4>
      </div>
      <div class="card-body">

        @include('components.alert')

        <h3>Current Session: <b>{{currentSession() ?? 'No session set yet'}}</b></h3>

        <div class="row justify-content-between mt-5">

          <form action="/admin/update_session" method="post" class="">
            @csrf

            <div class="row">
              <div class="col-sm-6 col-md-5 form-group mb-4">
                <label for="session">Select Session</label>
                <select class="form-control" name="session" id="session">
                  <option value="">Select title</option>
                  @php
                  $date2=date('Y', strtotime('+1 Years'));
                  @endphp
                  @for ($i=date('Y', strtotime('-3 Years')); $i<$date2;$i++) <!-- -->
                    @php //
                    $x=$i.'/'.($i+1); //
                    @endphp //
                    <option value="{{$x}}">{{$x}}</option>
                    @endfor
                </select>
                @error('session')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="col-12"></div>

              <div class="col-sm-6 col-md-5 form-group mt-3">
                <button class="btn btn-primary form-control" type="submit">Update</button>
              </div>
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
    //
  })
</script>
@endsection