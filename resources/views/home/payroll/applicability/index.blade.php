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
                    <a href="{{ route('masters.payroll.applicability.create') }}"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-circle-plus me-2"></i>Add New Applicability
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
                                <th>Rule Name</th>
                                <th>Applies To</th>
                                <th>Condition</th>
                                <th>Effective From</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dummy Data -->
                            <tr>
                                <td>1</td>
                                <td>PF Applicability</td>
                                <td>All Permanent Employees</td>
                                <td>Salary &gt; ₹15,000</td>
                                <td>2024-04-01</td>
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
                                <td>ESI Applicability</td>
                                <td>All Employees</td>
                                <td>Salary ≤ ₹21,000</td>
                                <td>2024-06-01</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <a href="2) }}" class="btn btn-sm btn-primary me-1">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>TDS Applicability</td>
                                <td>All Employees</td>
                                <td>Based on Annual Income Slab</td>
                                <td>2025-01-01</td>
                                <td><span class="badge bg-warning">Inactive</span></td>
                                <td class="text-center">
                                    <a href="3) }}" class="btn btn-sm btn-primary me-1">
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
