@extends('layout.master')
@section('title', $title)
@section('main-section')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $title }}</h4>
                        <a href="{{ route('masters.payroll.calculation-rules.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Add Calculation Rule
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rule Name</th>
                                        <th>Component</th>
                                        <th>Condition</th>
                                        <th>Formula</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Basic Salary 40%</td>
                                        <td>Basic Salary</td>
                                        <td>Based on Gross</td>
                                        <td>Gross * 0.4</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary me-1">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>PF Deduction</td>
                                        <td>Provident Fund</td>
                                        <td>Basic ≤ ₹15,000</td>
                                        <td>Basic * 0.12</td>
                                        <td><span class="badge bg-secondary">Inactive</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary me-1">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">
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
        </div>
    </div>
     <x-footer />
</div>
@endsection
