@extends('layout.master')
@section('title', $title)
@section('main-section')

<div class="page-wrapper">
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('masters.payroll.applicability.store') }}">
                    @csrf

                    <div class="row">
                        <!-- Rule Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rule Name *</label>
                            <input type="text" name="rule_name" class="form-control" placeholder="Enter Rule Name"
                                value="PF Applicability" required>
                        </div>

                        <!-- Applies To -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Applies To *</label>
                            <select name="applies_to" class="form-select" required>
                                <option value="">Select Employee Type</option>
                                <option selected value="permanent">Permanent Employees</option>
                                <option value="contractual">Contractual Employees</option>
                                <option value="intern">Interns</option>
                            </select>
                        </div>

                        <!-- Condition -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Condition</label>
                            <input type="text" name="condition" class="form-control"
                                value="Salary > ₹15,000" placeholder="Enter condition (optional)">
                        </div>

                        <!-- Effective From -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Effective From *</label>
                            <input type="date" name="effective_from" class="form-control" required>
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
                                placeholder="Enter description (optional)">Applicable for employees earning above ₹15,000 per month.</textarea>
                        </div>
                    </div>

                    <!-- 🔻 Bottom Action Buttons -->
                    <div class="d-flex justify-content-end border-top pt-3 mt-4">
                        <a href="{{ route('masters.payroll.applicability') }}" class="btn btn-light me-2">
                            <i class="ti ti-arrow-left me-1"></i> Back
                        </a>
                        <button type="reset" class="btn btn-secondary me-2">
                            <i class="ti ti-x me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Save Applicability
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
</div>

@endsection
