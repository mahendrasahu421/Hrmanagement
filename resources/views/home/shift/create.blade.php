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
                                        <a href="{{ route('settings.shift') }}"
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
                                action="{{ route('settings.shift.store') }}">
                                @csrf

                                <div class="row">

                                    <!-- Shift Name -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Shift Name <span class="text-danger">*</span></label>
                                        <input type="text" name="shift_name" class="form-control"
                                            placeholder="Enter Shift Name" value="{{ old('shift_name') }}" required>
                                        @error('shift_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Shift Code -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Shift Code <span class="text-danger">*</span></label>
                                        <input type="text" name="shift_code" class="form-control"
                                            placeholder="Enter Shift Code" value="{{ old('shift_code') }}" required>
                                        @error('shift_code')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Start Time -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Start Time <span class="text-danger">*</span></label>
                                        <input type="time" name="start_time" class="form-control"
                                            value="{{ old('start_time') }}" required>
                                        @error('start_time')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- End Time -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">End Time <span class="text-danger">*</span></label>
                                        <input type="time" name="end_time" class="form-control"
                                            value="{{ old('end_time') }}" required>
                                        @error('end_time')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Break Duration -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Break Duration (in minutes)</label>
                                        <input type="number" name="break_duration" class="form-control"
                                            placeholder="Enter Break Time" value="{{ old('break_duration') }}">
                                        @error('break_duration')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Total Working Hours -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Total Working Hours</label>
                                        <input type="number" step="0.1" name="total_working_hours" class="form-control"
                                            placeholder="Enter Total Hours" value="{{ old('total_working_hours') }}">
                                        @error('total_working_hours')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control select2" required>
                                            <option value="">Select Status</option>
                                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>

                                        @error('status')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('settings.shift') }}" class="btn btn-light me-2">
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

        </div>

        <!-- Footer -->
        <x-footer />

    </div>

@endsection
