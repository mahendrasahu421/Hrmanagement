@extends('layout.master')
@section('title', $title)
@section('main-section')

<div class="page-wrapper">
    <div class="content">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $title }}</h4>
                <a href="{{ route('masters.payroll.taxation.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Add Taxation Rule
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tax Name</th>
                                <th>Type</th>
                                <th>Applicable On</th>
                                <th>Rate (%)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Provident Fund (PF)</td>
                                <td>Deduction</td>
                                <td>Basic Salary</td>
                                <td>12%</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary me-1"><i class="ti ti-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-outline-danger"><i class="ti ti-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Employee State Insurance (ESI)</td>
                                <td>Deduction</td>
                                <td>Gross Salary</td>
                                <td>0.75%</td>
                                <td><span class="badge bg-secondary">Inactive</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary me-1"><i class="ti ti-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-outline-danger"><i class="ti ti-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
