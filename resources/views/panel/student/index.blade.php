@extends('layouts.student')

@section('title') Dashboard @endsection

@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-md-4">
						<div class="card fun">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="num-text-sm text-black font-w600">{{ $course_info->count() }}</h2>
										<span class="fs-14">Courses</span>
									</div>
									@component('components.svg.columns', ['height'=>'26', 'width'=>'26'])
									@endcomponent
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card fun">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="num-text-sm text-black font-w600">{{ $subscriptions->count() }}</h2>
										<span class="fs-14">Subscriptions</span>
									</div>
									@component('components.svg.enrollment', ['height'=>'26', 'width'=>'26'])
									@endcomponent
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card fun">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h4 class="">{{ currentSession() }}</h4>
										<span class="fs-14">Current Session</span>
									</div>
									@component('components.svg.calendar', ['height'=>'26', 'width'=>'26'])
									@endcomponent
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card">
							<div class="card-header border-0 shadow-sm">
								<h4 class="fs-20 text-black font-w600">Subscriptions</h4>

							</div>
							<div class="card-body text-center">
								<div class="table-responsive">
									<table id="example" class="display min-w850">
										<thead>
											<tr>
												<th class="width80"><strong>#</strong></th>
												<th><strong>Code</strong></th>
												<th><strong>Title</strong></th>
												<th><strong>Unit</strong></th>
												<th><strong>Date Created</strong></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@php
											$count = 1;
											@endphp

											@foreach ($course_info as $course)
											<tr>
												<td>{{ $count++ }}</td>
												<td>{{ $course->course_code }}</td>
												<td>
													<a href="/course_details?course_info_id={{$course->course_info_id}}&course_title={{$course->course_title}}&course_code={{$course->course_code}}"
														class="link">{{
														$course->course_title
														}}</a>
												</td>
												<td>{{ $course->course_unit }}</td>
												<td>{{ date('d M, Y', strtotime($course->created_at)) }}</td>
												<td>
													<a href="/course_details?course_info_id={{$course->course_info_id}}&course_title={{$course->course_title}}&course_code={{$course->course_code}}"
														class="btn btn-light light sharp">
														<i class="flaticon-381-menu-1"></i>
													</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>



	</div>
</div>
@endsection


@section('css')
<link href="/assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
	table.dataTable.no-footer {
		border-bottom: none;
	}

	table.dataTable thead th {
		border-bottom: 1px solid #bbb;
	}
</style>
@endsection


@section('script')
<!-- Datatable -->
<script src="/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins-init/datatables.init.js"></script>
{{-- <script src="/assets/js/custom.min.js"></script> --}}
{{-- <script src="/assets/js/dlabnav-init.js"></script> --}}
{{-- <script src="/assets/js/demo.js"></script> --}}
@endsection



@section('bottom_css')
@endsection