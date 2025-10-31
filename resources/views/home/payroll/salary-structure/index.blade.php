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
                    <a href="{{ route('masters.payroll.salary-structure.create') }}" 
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-circle-plus me-2"></i> Add Salary Structure
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
                                <th>SL No.</th>
                                <th>Structure Name</th>
                                <th>Code</th>
                                <th>Employee Type</th>
                                <th>Total Components</th>
                                <th>Effective From</th>
                                <th>Status</th>
                                <th width="120" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dummy Record 1 -->
                            <tr>
                                <td>1</td>
                                <td>Standard Employee Structure</td>
                                <td>STR001</td>
                                <td>Permanent</td>
                                <td>5</td>
                                <td>2025-01-01</td>
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

                            <!-- Dummy Record 2 -->
                            <tr>
                                <td>2</td>
                                <td>Contractual Staff Structure</td>
                                <td>STR002</td>
                                <td>Contract</td>
                                <td>4</td>
                                <td>2025-03-01</td>
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

                            <!-- Dummy Record 3 -->
                            <tr>
                                <td>3</td>
                                <td>Executive Grade Structure</td>
                                <td>STR003</td>
                                <td>Permanent</td>
                                <td>6</td>
                                <td>2025-04-15</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <x-footer />
</div>

@endsection
