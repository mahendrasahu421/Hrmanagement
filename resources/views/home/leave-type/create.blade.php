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
                                    <a href="{{ route('masters.organisation.leave-type') }}"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-list-details me-2"></i> Leave Type List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST"
                            action="{{ route('masters.organisation.leave-type.store') }}">
                            @csrf

                            <div class="form-row row">
                                <!-- Company -->
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

                                <!-- Leave Type Name -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="leave_name">Leave Type Name *</label>
                                    <input type="text" class="form-control" id="leave_name" name="leave_name"
                                        value="Casual Leave" placeholder="Enter Leave Type Name" required>
                                    <div class="invalid-feedback">Please enter leave type name.</div>
                                </div>

                                <!-- Leave Code -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="leave_code">Leave Code *</label>
                                    <input type="text" class="form-control" id="leave_code" name="leave_code"
                                        value="CL-001" placeholder="Enter Leave Code" required>
                                    <div class="invalid-feedback">Please enter leave code.</div>
                                </div>
                            </div>

                            <div class="form-row row">
                                <!-- Total Leaves per Year -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="total_leaves">Total Leaves / Year *</label>
                                    <input type="number" class="form-control" id="total_leaves" name="total_leaves"
                                        value="12" placeholder="Enter Total Leaves" required>
                                    <div class="invalid-feedback">Please enter total leaves.</div>
                                </div>

                                <!-- Carry Forward -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="carry_forward">Carry Forward *</label>
                                    <select class="form-control" id="carry_forward" name="carry_forward" required>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <div class="invalid-feedback">Please select carry forward option.</div>
                                </div>

                                <!-- Encashable -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="encashable">Encashable *</label>
                                    <select class="form-control" id="encashable" name="encashable" required>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <div class="invalid-feedback">Please select encashable option.</div>
                                </div>
                            </div>

                            <div class="form-row row">
                                <!-- Applicable For -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="applicable_for">Applicable For *</label>
                                    <select class="form-control" id="applicable_for" name="applicable_for" required>
                                        <option value="">Select Option</option>
                                        <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>
                                        <option value="All">All</option>
                                    </select>
                                    <div class="invalid-feedback">Please select applicable option.</div>
                                </div>

                                <!-- Leave Type -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="leave_category">Leave Category *</label>
                                    <select class="form-control" id="leave_category" name="leave_category" required>
                                        <option value="">Select Category</option>
                                        <option value="Paid" selected>Paid Leave</option>
                                        <option value="Unpaid">Unpaid Leave</option>
                                        <option value="Special">Special Leave</option>
                                    </select>
                                    <div class="invalid-feedback">Please select leave category.</div>
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
                                        placeholder="Enter Description (optional)">Casual Leave can be taken for personal work or emergencies with prior approval.</textarea>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('masters.organisation.leave-type') }}" class="btn btn-light me-2">
                                    <i class="ti ti-arrow-left me-1"></i> Back
                                </a>
                                <button type="reset" class="btn btn-secondary me-2">
                                    <i class="ti ti-x me-1"></i> Cancel
                                </button>
                                <button class="btn btn-primary" type="submit">
                                    <i class="ti ti-device-floppy me-1"></i> Save Leave Type
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
        <p class="mb-0">2014 - {{ date('Y') }} &copy; SmartHR.</p>
        <p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
    </div>
</div>

@endsection
