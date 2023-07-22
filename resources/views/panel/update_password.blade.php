@if (Request::segment(1) == 'instructor')
@php
$layout = 'instructor';
@endphp
@elseif (Request::segment(1) == 'admin')
@php
$layout = 'admin';
@endphp
@elseif (Request::segment(1) == 'student')
@php
$layout = 'student';
@endphp
@endif

{{-- This does not work inside the control statement --}}
@extends('layouts.' . $layout)


@section('title') Update Password @endsection

@section('content')
<div class="content-body">
	<div class="container-fluid">
		<!-- row -->
		<div class="row">
			<div class="col-lg-4 col-md-5 col-sm-6">
				<div class="card  card-bx m-b30">
					<div class="card-header">
						<h6 class="title">Update Password</h6>
					</div>

					<div class="card-body">
						@include('components.alert')

						<form method="post" action="{{ route('update_password') }}" class="mt-4">
							@csrf

							<div class="form-group">
								<label class="form-label" for="current_password">Old Password:</label>
								<input class="form-control" type="password" id="current_password" name="current_password" required>
								@error('current_password')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group mt-5">
								<label class="form-label" for="password">New Password:</label>
								<input class="form-control" type="password" id="password" name="password" minlength="8" required>
								<small class="text-muted font-size-10">Minimum of 8 characters</small>
								@error('password')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group mt-4">
								<label class="form-label">Confirm New Password:</label>
								<input class="form-control" type="password" id="password_confirmation" name="password_confirmation"
									required>
								@error('password_confirmation')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group mt-4 pt-4">
								<button class="btn btn-success" type="submit">Update Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('script')
<script>
	$(document).ready(function() {
    $('#title').val('{{ old('title') ?? Auth::user()->title }}')
    $('#gender').val('{{ old('gender') ?? Auth::user()->gender }}')
  })
</script>
@endsection