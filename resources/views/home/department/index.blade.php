@extends('layout.master')
@section('title', $title)
@section('main-section')
    		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content">

				<!-- Breadcrumb -->
				<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
					<div class="my-auto mb-2">
						<h2 class="mb-1">{{ $title }}</h2>
						
					</div>
					<div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
						<div class="mb-2">
							<a href="{{ route('masters.organisation.department.create') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Add Department</a>
						</div>
						
					</div>
				</div>
				<!-- /Breadcrumb -->


				<div class="card">
					
					<div class="card-body p-0">
						<div class="custom-datatable-filter table-responsive">
							<table class="table datatable">
								<thead class="thead-light">
									<tr>
										<th class="no-sort">
											<div class="form-check form-check-md">
												<input class="form-check-input" type="checkbox" id="select-all">
											</div>
										</th>
										<th>Department Name</th>
										<th>Code</th>
										<th>Reporting Department</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="form-check form-check-md">
												<input class="form-check-input" type="checkbox">
											</div>
										</td>
										<td>Department Name</td>
										<td>
											<h6 class="fw-medium"><a href="#">DN</a></h6>
										</td>
										<td>Mr. XYZ</td>
										<td>
											<span class="badge badge-success d-inline-flex align-items-center badge-sm">
												<i class="ti ti-point-filled me-1"></i>Active
											</span>
										</td>
										<td>
											<div class="action-icon d-inline-flex">
												<a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_holiday"><i class="ti ti-edit"></i></a>
												<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-check form-check-md">
												<input class="form-check-input" type="checkbox">
											</div>
										</td>
										<td>Department Name</td>
										<td>
											<h6 class="fw-medium"><a href="#">DN</a></h6>
										</td>
										<td>Mr. XYZ</td>
										<td>
											<span class="badge badge-success d-inline-flex align-items-center badge-sm">
												<i class="ti ti-point-filled me-1"></i>Active
											</span>
										</td>
										<td>
											<div class="action-icon d-inline-flex">
												<a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_holiday"><i class="ti ti-edit"></i></a>
												<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
											</div>
										</td>
									</tr>
                                    <tr>
										<td>
											<div class="form-check form-check-md">
												<input class="form-check-input" type="checkbox">
											</div>
										</td>
										<td>Department Name</td>
										<td>
											<h6 class="fw-medium"><a href="#">BN</a></h6>
										</td>
										<td>Mr. XYZ</td>
										<td>
											<span class="badge badge-success d-inline-flex align-items-center badge-sm">
												<i class="ti ti-point-filled me-1"></i>Active
											</span>
										</td>
										<td>
											<div class="action-icon d-inline-flex">
												<a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_holiday"><i class="ti ti-edit"></i></a>
												<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>

			 <x-footer />

		</div>
		<!-- /Page Wrapper -->

		

		

	
@endsection