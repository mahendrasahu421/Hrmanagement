@extends('layout.master')
@section('title', $title)
@section('main-section')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Breadcrumb -->
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">Department</h2>
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item" aria-current="page">
                                                Master / Organisation / Department / Create
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">
                                        <a href="{{ route('masters.organisation.department') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-circle-plus me-2"></i>Department List
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Breadcrumb -->
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('masters.organisation.department.store') }}">
                                @csrf

                                <div class="form-row row">
                                    <!-- Select Company -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="company_id">Select Company *</label>
                                        <select class="form-control" id="company_id" name="company_id" required>
                                            <option value="">Select Company</option>
                                            {{-- @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach --}}
                                        </select>
                                        <div class="invalid-feedback">Please select a company.</div>
                                    </div>

                                    <!-- Department Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="department_name">Department Name *</label>
                                        <input type="text" class="form-control" id="department_name"
                                            name="department_name" placeholder="Enter Department Name" required>
                                        <div class="invalid-feedback">Please enter department name.</div>
                                    </div>

                                    <!-- Department Code -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="department_code">Department Code *</label>
                                        <input type="text" class="form-control" id="department_code"
                                            name="department_code" placeholder="Enter Department Code" required>
                                        <div class="invalid-feedback">Please enter department code.</div>
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <!-- Department Head -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="department_head">Department Head</label>
                                        <input type="text" class="form-control" id="department_head"
                                            name="department_head" placeholder="Enter Department Head">
                                    </div>

                                    <!-- Contact Number -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="contact_no">Contact Number</label>
                                        <input type="text" class="form-control" id="contact_no" name="contact_no"
                                            placeholder="Enter Contact Number">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Department Email">
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <!-- Description -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="2" placeholder="Enter Description"></textarea>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="status">Status *</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('masters.organisation.department') }}"
                                        class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Save Department
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
            <p class="mb-0">2014 - 2025 &copy; SmartHR.</p>
            <p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
        </div>

    </div>
    <!-- /Page Wrapper -->






@endsection
