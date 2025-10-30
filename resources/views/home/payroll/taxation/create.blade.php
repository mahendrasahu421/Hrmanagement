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
                <form method="POST" action="{{ route('masters.payroll.taxation.store') }}">
                    @csrf

                    <div class="row">
                        <!-- Tax Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tax Name *</label>
                            <input type="text" name="tax_name" class="form-control"
                                placeholder="Enter tax name (e.g., PF, ESI, TDS)" required>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="deduction">Deduction</option>
                                <option value="employer_contribution">Employer Contribution</option>
                            </select>
                        </div>

                        <!-- Applicable On -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Applicable On *</label>
                            <select name="applicable_on" class="form-select" required>
                                <option value="">Select Component</option>
                                <option value="basic">Basic Salary</option>
                                <option value="gross">Gross Salary</option>
                                <option value="net">Net Salary</option>
                            </select>
                        </div>

                        <!-- Rate -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rate (%) *</label>
                            <input type="number" name="rate" class="form-control" placeholder="Enter rate (e.g., 12)"
                                step="0.01" required>
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
                                placeholder="Enter description (optional)"></textarea>
                        </div>
                    </div>

                    <!-- 🔻 Action Buttons (Always at bottom) -->
                    <div class="d-flex justify-content-end border-top pt-3 mt-4">
                        <a href="{{ route('masters.payroll.taxation') }}" class="btn btn-light me-2">
                            <i class="ti ti-arrow-left me-1"></i> Back
                        </a>
                        <button type="reset" class="btn btn-secondary me-2">
                            <i class="ti ti-x me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Save Tax Rule
                        </button>
                    </div>
                </form>
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
