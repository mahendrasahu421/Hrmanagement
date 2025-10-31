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
                    <a href="{{ route('masters.payroll.payment-frequency.create') }}"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-circle-plus me-2"></i>Add Payment Frequency
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
                                <th>Frequency Name</th>
                                <th>Days / Month</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dummy Static Data -->
                            <tr>
                                <td>1</td>
                                <td>Monthly</td>
                                <td>30</td>
                                <td>Salary processed once every month</td>
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
                                <td>Weekly</td>
                                <td>7</td>
                                <td>Salary processed every week</td>
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
                                <td>Bi-Weekly</td>
                                <td>14</td>
                                <td>Salary processed twice a month</td>
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
    <x-footer />
</div>

@endsection
