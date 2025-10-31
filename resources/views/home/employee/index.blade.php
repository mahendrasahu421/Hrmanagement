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
                    <a href="{{ route('employee.create') }}" class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-circle-plus me-2"></i>Add Employee
                    </a>
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
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td>EMP001</td>
                                <td><h6 class="fw-medium"><a href="#">John Doe</a></h6></td>
                                <td>john.doe@example.com</td>
                                <td>HR</td>
                                <td>HR Manager</td>
                                <td>
                                    <span class="badge badge-success d-inline-flex align-items-center badge-sm">
                                        <i class="ti ti-point-filled me-1"></i>Active
                                    </span>
                                </td>
                                <td>
                                    <div class="action-icon d-inline-flex">
                                        <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td>EMP002</td>
                                <td><h6 class="fw-medium"><a href="#">Jane Smith</a></h6></td>
                                <td>jane.smith@example.com</td>
                                <td>IT</td>
                                <td>Software Engineer</td>
                                <td>
                                    <span class="badge badge-success d-inline-flex align-items-center badge-sm">
                                        <i class="ti ti-point-filled me-1"></i>Active
                                    </span>
                                </td>
                                <td>
                                    <div class="action-icon d-inline-flex">
                                        <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td>EMP003</td>
                                <td><h6 class="fw-medium"><a href="#">Robert Brown</a></h6></td>
                                <td>robert.brown@example.com</td>
                                <td>Finance</td>
                                <td>Accountant</td>
                                <td>
                                    <span class="badge badge-danger d-inline-flex align-items-center badge-sm">
                                        <i class="ti ti-point-filled me-1"></i>Inactive
                                    </span>
                                </td>
                                <td>
                                    <div class="action-icon d-inline-flex">
                                        <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td>EMP004</td>
                                <td><h6 class="fw-medium"><a href="#">Emily Davis</a></h6></td>
                                <td>emily.davis@example.com</td>
                                <td>Marketing</td>
                                <td>SEO Executive</td>
                                <td>
                                    <span class="badge badge-success d-inline-flex align-items-center badge-sm">
                                        <i class="ti ti-point-filled me-1"></i>Active
                                    </span>
                                </td>
                                <td>
                                    <div class="action-icon d-inline-flex">
                                        <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td>EMP005</td>
                                <td><h6 class="fw-medium"><a href="#">Michael Johnson</a></h6></td>
                                <td>michael.johnson@example.com</td>
                                <td>Operations</td>
                                <td>Team Lead</td>
                                <td>
                                    <span class="badge badge-success d-inline-flex align-items-center badge-sm">
                                        <i class="ti ti-point-filled me-1"></i>Active
                                    </span>
                                </td>
                                <td>
                                    <div class="action-icon d-inline-flex">
                                        <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0);"><i class="ti ti-trash"></i></a>
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
