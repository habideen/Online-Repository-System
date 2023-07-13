@extends('layouts.instructor')

@section('title') Dashboard @endsection

@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<!-- Add Order -->
		<div class="modal fade" id="addOrderModalside">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Create Project</h5>
						<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label class="text-black font-w500">Project Name</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label class="text-black font-w500">Deadline</label>
								<input type="date" class="form-control">
							</div>
							<div class="form-group">
								<label class="text-black font-w500">Client Name</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<button type="button" class="btn btn-primary">CREATE</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-md-6 col-lg-3">
						<div class="card fun">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="num-text-sm text-black font-w600">187M</h2>
										<span class="fs-14">Donation Count</span>
									</div>
									@component('components.svg.naira', ['height'=>'26', 'width'=>'26'])
									@endcomponent
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="card fun">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="num-text-sm text-black font-w600">64.23K</h2>
										<span class="fs-14">Blogs</span>
									</div>
									@component('components.svg.chat', ['height'=>'26', 'width'=>'26'])
									@endcomponent
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="card fun">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="num-text-sm text-black font-w600">67</h2>
										<span class="fs-14">Events</span>
									</div>
									@component('components.svg.columns', ['height'=>'26', 'width'=>'26'])
									@endcomponent
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="card fun">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="num-text-sm text-black font-w600">4</h2>
										<span class="fs-14">Users</span>
									</div>
									@component('components.svg.user', ['height'=>'26', 'width'=>'26'])
									@endcomponent
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card">
							<div class="card-header border-0 shadow-sm">
								<h4 class="fs-20 text-black font-w600">Donation</h4>
								<div class="dropdown">
									<a href="/" class="btn btn-success">Donation List</a>
								</div>
							</div>
							<div class="card-body text-center">
								<canvas id="areaChart_1" class="max-h80"></canvas>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card">
							<div class="card-header border-0 shadow-sm">
								<h4 class="fs-20 text-black font-w600">Event JST Target</h4>
								<div class="dropdown">
									<a href="/" class="btn btn-success">Targets</a>
								</div>
							</div>
							<div class="card-body text-center">
								<div id="radialChart"></div>
							</div>
						</div>
					</div>

					<!-- Start donation table -->
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Recent Donations</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-responsive-md">
										<thead>
											<tr>
												<th class="width80"><strong>#</strong></th>
												<th><strong>NAME</strong></th>
												<th><strong>DATE</strong></th>
												<th><strong>STATUS</strong></th>
												<th><strong>PRICE</strong></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><strong>01</strong></td>
												<td>Dr. Jackson</td>
												<td>01 August 2020</td>
												<td><span class="badge light badge-success">Successful</span></td>
												<td>$21.56</td>
												<td>
													<a href="#" class="btn btn-success light sharp" data-bs-toggle="dropdown">
														@component('components.svg.hr-dot3', ['height'=>'20', 'width'=>'20'])
														@endcomponent
													</a>
												</td>
											</tr>
											<tr>
												<td><strong>02</strong></td>
												<td>Dr. Jackson</td>
												<td>01 August 2020</td>
												<td><span class="badge light badge-danger">Canceled</span></td>
												<td>$21.56</td>
												<td>
													<a href="#" class="btn btn-success light sharp" data-bs-toggle="dropdown">
														@component('components.svg.hr-dot3', ['height'=>'20', 'width'=>'20'])
														@endcomponent
													</a>
												</td>
											</tr>
											<tr>
												<td><strong>02</strong></td>
												<td>Dr. Jackson</td>
												<td>01 August 2020</td>
												<td><span class="badge light badge-danger">Canceled</span></td>
												<td>$21.56</td>
												<td>
													<a href="#" class="btn btn-success light sharp" data-bs-toggle="dropdown">
														@component('components.svg.hr-dot3', ['height'=>'20', 'width'=>'20'])
														@endcomponent
													</a>
												</td>
											</tr>
											<tr>
												<td><strong>02</strong></td>
												<td>Dr. Jackson</td>
												<td>01 August 2020</td>
												<td><span class="badge light badge-danger">Canceled</span></td>
												<td>$21.56</td>
												<td>
													<a href="#" class="btn btn-success light sharp" data-bs-toggle="dropdown">
														@component('components.svg.hr-dot3', ['height'=>'20', 'width'=>'20'])
														@endcomponent
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- End donation table -->

				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('script_top')
<script>
	var donationData = [25, 20, 60, 41, 66, 45, 80, 23, 78, 200, 13, 82]
</script>
@endsection