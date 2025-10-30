@extends('layout.master')
@section('title', $title)
@section('main-section')

<div class="page-wrapper">
    <div class="content">

        <!-- Breadcrumb -->
        <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
            <div class="my-auto mb-2">
                <h2 class="mb-1">{{ $title }}</h2>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                <div class="mb-2">
                    <a href="{{ route('masters.payroll.payment-mode.create') }}"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-circle-plus me-2"></i>Add Payment Mode
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
                                <th>#</th>
                                <th>Mode Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dummy Static Data -->
                            <tr>
                                <td>1</td>
                                <td>Bank Transfer</td>
                                <td>Salary credited directly to employee’s bank account</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <a href="" class="btn btn-sm btn-primary me-1">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Cheque</td>
                                <td>Salary paid through company cheque</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <a href="" class="btn btn-sm btn-primary me-1">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Cash</td>
                                <td>Salary distributed in cash manually</td>
                                <td><span class="badge bg-warning">Inactive</span></td>
                                <td class="text-center">
                                    <a href="" class="btn btn-sm btn-primary me-1">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
        <p class="mb-0">2014 - {{ date('Y') }} &copy; SmartHR.</p>
        <p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
    </div>
</div>

@endsection
