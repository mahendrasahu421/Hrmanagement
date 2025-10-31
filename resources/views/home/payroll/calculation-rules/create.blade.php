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
                        <a href="{{ route('masters.payroll.calculation-rules') }}" class="btn btn-primary">
                            <i class="ti ti-list-details me-2"></i>Calculation Rules List
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('masters.payroll.calculation-rules.store') }}">
                            @csrf

                            <div class="row">
                                <!-- Rule Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rule Name *</label>
                                    <input type="text" name="rule_name" class="form-control"
                                        placeholder="Enter rule name" value="Basic Salary 40%" required>
                                </div>

                                <!-- Component -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Component *</label>
                                    <select name="component" class="form-select" required>
                                        <option value="">Select Component</option>
                                        <option value="basic">Basic Salary</option>
                                        <option value="hra">HRA</option>
                                        <option value="pf">PF</option>
                                        <option value="esi">ESI</option>
                                        <option value="bonus">Bonus</option>
                                    </select>
                                </div>

                                <!-- Condition -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Condition</label>
                                    <input type="text" name="condition" class="form-control"
                                        placeholder="e.g. Basic ≤ ₹15,000" value="">
                                </div>

                                <!-- Formula -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Formula *</label>
                                    <input type="text" name="formula" class="form-control"
                                        placeholder="e.g. Gross * 0.4" value="Gross * 0.4" required>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status *</label>
                                    <select name="status" class="form-select" required>
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3"
                                        placeholder="Enter rule description">Basic salary calculated as 40% of gross pay.</textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-secondary me-2">
                                    <i class="ti ti-x me-1"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i> Save Rule
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
