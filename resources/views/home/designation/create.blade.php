@extends('layout.master')
@section('title', $title)
@section('main-section')

    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">{{ $title }}</h2>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">

                                        <a href="{{ route('masters.organisation.designation') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-list-details me-2"></i> Designation List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="card-body">
                    <form class="needs-validation" novalidate method="POST"
                        action="{{ route('masters.organisation.designation.store') }}">
                        @csrf

                        <div class="form-row row">
                            <!-- Company Name -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="company_id">Company Name *</label>
                                <select class="form-control" id="company_id" name="company_id" required>
                                    <option value="">Select Company</option>
                                    <option value="1" selected>Dreams Technologies Pvt. Ltd.</option>
                                    <option value="2">TechVision Solutions</option>
                                    <option value="3">NextGen Innovations</option>
                                </select>
                                <div class="invalid-feedback">Please select company name.</div>
                            </div>

                            <!-- Department Name -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="department_id">Department *</label>
                                <select class="form-control" id="department_id" name="department_id" required>
                                    <option value="">Select Department</option>
                                    <option value="1" selected>Human Resources</option>
                                    <option value="2">Finance</option>
                                    <option value="3">Development</option>
                                    <option value="4">Marketing</option>
                                </select>
                                <div class="invalid-feedback">Please select department.</div>
                            </div>

                            <!-- Designation Name -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="designation_name">Designation Name *</label>
                                <input type="text" class="form-control" id="designation_name" name="designation_name"
                                    value="HR Executive" placeholder="Enter Designation Name" required>
                                <div class="invalid-feedback">Please enter designation name.</div>
                            </div>
                        </div>

                        <div class="form-row row">
                            <!-- Designation Code -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="designation_code">Designation Code *</label>
                                <input type="text" class="form-control" id="designation_code" name="designation_code"
                                    value="HR-EXE-001" placeholder="Enter Designation Code" required>
                                <div class="invalid-feedback">Please enter designation code.</div>
                            </div>

                            <!-- Reporting To -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="reporting_to">Reporting To</label>
                                <select class="form-control" id="reporting_to" name="reporting_to">
                                    <option value="">Select Reporting Designation</option>
                                    <option value="1" selected>HR Manager</option>
                                    <option value="2">Admin Head</option>
                                    <option value="3">CEO</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="status">Status *</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <div class="invalid-feedback">Please select status.</div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-row row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                    placeholder="Enter Description (optional)">Responsible for managing employee records, attendance, and recruitment process.</textarea>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('masters.organisation.designation') }}" class="btn btn-light me-2">
                                <i class="ti ti-arrow-left me-1"></i> Back
                            </a>
                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> Cancel
                            </button>
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-device-floppy me-1"></i> Save Designation
                            </button>
                        </div>
                    </form>
                </div>
                    </div>
                </div>
            </div>

        </div>

         <x-footer />
    </div>

@endsection
