@extends('layout.master')
@section('title', $title)
@section('main-section')

    <div class="page-wrapper">
        <div class="content">


            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Breadcrumb -->
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">{{ $title }}</h2>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">
                                        <a href="{{ route('masters.payroll.salary-component') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-list-details me-2"></i> Salary Component List
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Breadcrumb -->
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('masters.payroll.salary-component.store') }}">
                                @csrf

                                <div class="row">
                                    <!-- Component Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Component Name *</label>
                                        <input type="text" name="component_name" class="form-control"
                                            value="Basic Salary" placeholder="Enter Component Name" required>
                                    </div>

                                    <!-- Component Code -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Component Code *</label>
                                        <input type="text" name="component_code" class="form-control" value="BASIC001"
                                            placeholder="Enter Component Code" required>
                                    </div>

                                    <!-- Type -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Type *</label>
                                        <select name="type" class="form-select" required>
                                            <option value="">Select Type</option>
                                            <option value="earning" selected>Earning</option>
                                            <option value="deduction">Deduction</option>
                                        </select>
                                    </div>

                                    <!-- Calculation Type -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Calculation Type *</label>
                                        <select name="calculation_type" class="form-select" required>
                                            <option value="">Select Calculation Type</option>
                                            <option value="percentage" selected>Percentage</option>
                                            <option value="fixed">Fixed Amount</option>
                                        </select>
                                    </div>

                                    <!-- Percentage -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Percentage (%)</label>
                                        <input type="number" name="percentage" class="form-control" value="40"
                                            placeholder="Enter Percentage">
                                    </div>

                                    <!-- Fixed Amount -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Fixed Amount (₹)</label>
                                        <input type="number" name="fixed_amount" class="form-control" value=""
                                            placeholder="Enter Fixed Amount">
                                    </div>

                                    <!-- Taxable -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Taxable *</label>
                                        <select name="taxable" class="form-select" required>
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status *</label>
                                        <select name="status" class="form-select" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Enter Description (optional)">Main salary component of employees.</textarea>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('masters.payroll.salary-component') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Save Component
                                    </button>
                                </div>
                            </form>
                        </div>
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