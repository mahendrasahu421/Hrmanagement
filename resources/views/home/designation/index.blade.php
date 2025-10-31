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
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                <div class="mb-2">
                    <a href="{{ route('masters.organisation.designation.create') }}"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-circle-plus me-2"></i>Add Designation
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
                                <th>Designation Name</th>
                                <th>Code</th>
                                <th>Department</th>
                                <th>Reporting To</th>
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
                                <td>HR Executive</td>
                                <td><h6 class="fw-medium"><a href="#">HR-EXE-001</a></h6></td>
                                <td>Human Resources</td>
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
                                <td>
                                    <div class="form-check form-check-md">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td>Software Engineer</td>
                                <td><h6 class="fw-medium"><a href="#">DEV-ENG-002</a></h6></td>
                                <td>Development</td>
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

                            <tr>
                                <td>
                                    <div class="form-check form-check-md">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td>Sales Manager</td>
                                <td><h6 class="fw-medium"><a href="#">SLS-MGR-003</a></h6></td>
                                <td>Sales</td>
                                <td>Director Sales</td>
                                <td>
                                    <span class="badge badge-warning d-inline-flex align-items-center badge-sm">
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
                                <td>
                                    <div class="form-check form-check-md">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td>Accountant</td>
                                <td><h6 class="fw-medium"><a href="#">FIN-ACC-004</a></h6></td>
                                <td>Finance</td>
                                <td>Finance Head</td>
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
