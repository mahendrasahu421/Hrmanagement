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
                                    <a href="{{ route('masters.organisation.holiday') }}"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-list-details me-2"></i> Holiday List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST"
                            action="{{ route('masters.organisation.holiday.store') }}">
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

                                <!-- Holiday Name -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="holiday_name">Holiday Name *</label>
                                    <input type="text" class="form-control" id="holiday_name" name="holiday_name"
                                        value="Republic Day" placeholder="Enter Holiday Name" required>
                                    <div class="invalid-feedback">Please enter holiday name.</div>
                                </div>

                                <!-- Holiday Date -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="holiday_date">Holiday Date *</label>
                                    <input type="date" class="form-control" id="holiday_date" name="holiday_date"
                                        value="2025-01-26" required>
                                    <div class="invalid-feedback">Please select holiday date.</div>
                                </div>
                            </div>

                            <div class="form-row row">
                                <!-- Holiday Type -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="holiday_type">Holiday Type *</label>
                                    <select class="form-control" id="holiday_type" name="holiday_type" required>
                                        <option value="">Select Type</option>
                                        <option value="National" selected>National Holiday</option>
                                        <option value="Festival">Festival Holiday</option>
                                        <option value="Optional">Optional Holiday</option>
                                        <option value="Company">Company Holiday</option>
                                    </select>
                                    <div class="invalid-feedback">Please select holiday type.</div>
                                </div>

                                <!-- Day -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="day">Day</label>
                                    <input type="text" class="form-control" id="day" name="day"
                                        value="Sunday" placeholder="Enter Day" readonly>
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
                                        placeholder="Enter Description (optional)">National holiday celebrating the adoption of the Indian Constitution on January 26, 1950.</textarea>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('masters.organisation.holiday') }}" class="btn btn-light me-2">
                                    <i class="ti ti-arrow-left me-1"></i> Back
                                </a>
                                <button type="reset" class="btn btn-secondary me-2">
                                    <i class="ti ti-x me-1"></i> Cancel
                                </button>
                                <button class="btn btn-primary" type="submit">
                                    <i class="ti ti-device-floppy me-1"></i> Save Holiday
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
