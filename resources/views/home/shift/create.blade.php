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

                                        <a href="{{ route('masters.organisation.shift') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-list-details me-2"></i> Shift List
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Breadcrumb -->
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('masters.organisation.shift.store') }}">
                                @csrf
                                <div class="row">

                                    <!-- Shift Name -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Shift Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="shift_name"
                                            placeholder="Enter Shift Name" value="Morning Shift" required>
                                        <div class="invalid-feedback">Please enter shift name.</div>
                                    </div>

                                    <!-- Shift Code -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Shift Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="shift_code"
                                            placeholder="Enter Shift Code" value="MS001" required>
                                        <div class="invalid-feedback">Please enter shift code.</div>
                                    </div>

                                    <!-- Start Time -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Start Time <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" name="start_time" value="08:00"
                                            required>
                                        <div class="invalid-feedback">Please select start time.</div>
                                    </div>

                                    <!-- End Time -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">End Time <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" name="end_time" value="16:00" required>
                                        <div class="invalid-feedback">Please select end time.</div>
                                    </div>

                                    <!-- Break Duration -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Break Duration (in minutes)</label>
                                        <input type="number" class="form-control" name="break_duration" value="30"
                                            placeholder="Enter Break Time">
                                    </div>

                                    <!-- Total Working Hours -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Total Working Hours</label>
                                        <input type="text" class="form-control" name="total_hours" value="7.5 Hours"
                                            readonly>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('masters.organisation.shift') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Save Shift
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shift Form -->


        </div>

        <!-- Footer -->
        <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
            <p class="mb-0">2014 - {{ date('Y') }} &copy; SmartHR.</p>
            <p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
        </div>
    </div>

@endsection
