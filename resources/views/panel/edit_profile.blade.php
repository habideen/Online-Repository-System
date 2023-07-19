@if (Request::segment(1) == 'instructor')
@php
$layout = 'instructor';
@endphp
@elseif (Request::segment(1) == 'admin')
@php
$layout = 'admin';
@endphp
@endif

{{-- This does not work inside the control statement --}}
@extends('layouts.' . $layout)


@section('title') Profile @endsection

@section('content')
<div class="content-body">
	<div class="container-fluid">
		<!-- row -->
		<div class="row">
			<div class="col-12">
				<div class="card  card-bx m-b30">
					<div class="card-header">
						<h6 class="title">Account setup</h6>
					</div>

					<div class="card-body">
						@include('components.alert')

						<form class="profile-form" action="/{{Request::segment(1)}}/profile" method="POST">
							@csrf

							<div class="row">
								<div class="col-sm-6 col-lg-3 m-b30">
									<label class="form-label">Title</label>
									<select class="form-control" name="title" id="title" required>
										<option value="">Select title</option>
										@foreach (TITLE as $title)
										<option value="{{$title}}">{{$title}}</option>
										@endforeach
									</select>
									@error('title')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>
								<div class="col-sm-6 col-lg-3 m-b30">
									<label class="form-label">Last name</label>
									<input type="text" class="form-control" name="last_name" id="last_name" placeholder=""
										value="{{ old('last_name') ?? Auth::user()->last_name }}" required='true'
										pattern="^[ ]*[A-Za-z\-]{2,30}[ ]*$">
									@error('last_name')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>
								<div class="col-sm-6 col-lg-3 m-b30">
									<label class="form-label">First name</label>
									<input type="text" class="form-control" name="first_name" id="first_name" placeholder=""
										value="{{ old('first_name') ?? Auth::user()->first_name }}" required='true'
										pattern="^[ ]*[A-Za-z\-]{2,30}[ ]*$">
									@error('first_name')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>
								<div class="col-sm-6 col-lg-3 m-b30">
									<label for="middle_name">Middle Name <span class="text-muted">(Optional)</span></label>
									<input type="text" class="form-control" name="middle_name" id="middle_name" placeholder=""
										value="{{ old('middle_name') ?? Auth::user()->middle_name }}" pattern="^[ ]*[A-Za-z\-]{2,30}[ ]*$">
									@error('middle_name')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>

								<div class="col-sm-6 m-b30">
									<label class="form-label">Gender</label>
									<select class="form-control" name="gender" id="gender" required>
										<option value="">Select gender</option>
										<option value="M">Male</option>
										<option value="F">Female</option>
									</select>
									@error('gender')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>
								<div class="col-sm-6 m-b30">
									<label class="form-label">Award</label>
									<input type="text" name="awards" id="awards" class="form-control" placeholder="e.g. BSC, PHD"
										value="{{old('awards') ?? Auth::user()->awards}}" pattern="^[ ]*[A-Za-z\-,. ]{2,255}[ ]*$">
									@error('awards')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>

								<div class="col-12 mt-5"></div>

								<div class="col-sm-6 m-b30">
									<label for="phone_1">Phone number 1</label>
									<input type="text" class="form-control" name="phone_1" id="phone_1" placeholder=""
										value="{{ old('phone_1') ?? Auth::user()->phone_1 }}" pattern="^[ ]*[0][7-9][0-9]{9,9}[ ]*$"
										required>
									@error('phone_1')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>
								<div class="col-sm-6 m-b30">
									<label for="phone_2">Phone number 2 <span class="text-muted">(Optional)</span></label>
									<input type="text" class="form-control" name="phone_2" id="phone_2" placeholder=""
										value="{{ old('phone_2') ?? Auth::user()->phone_2 }}" pattern="^[ ]*[0][7-9][0-9]{9,9}[ ]*$">
									@error('phone_2')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>
								<div class="col-sm-12 m-b30">
									<label for="email">Email</label>
									<input type="email" class="form-control" name="email" id="email" placeholder=""
										value="{{ old('email') ?? Auth::user()->email }}" required>
									@error('email')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>

								<div class="col-12 m-b30">
									<label for="office_address">Office Address <span class="text-muted">(Optional)</span></label>
									<input type="text" class="form-control" name="office_address" id="office_address" placeholder=""
										value="{{ old('office_address') ?? Auth::user()->office_address }}"
										pattern="^[ ]*[A-Za-z0-9\-,.\(\) ]{2,100}[ ]*$">
									@error('office_address')
									<span class="text-danger">{{$message}}</span>
									@enderror
								</div>
							</div>

							<div class="card-footer">
								<button class="btn btn-primary btn-md">UPDATE</button>
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