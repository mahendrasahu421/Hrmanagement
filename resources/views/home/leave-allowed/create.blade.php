@extends('layout.master')
@section('title', $title)
@section('main-section')
    <x-alert-modal />
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
                                        <a href="{{ route('settings.leave-allow') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-list-details me-2"></i> Leave Type List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('settings.leave.mapping.store') }}">
                                @csrf
                                <div class="row">

                                    <!-- Designation -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="designation_id">Designation *</label>
                                        <select class="form-control select2" id="designation_id" name="designation_id"
                                            required>
                                            <option value="">Select Designation</option>
                                            @foreach ($designation as $designations)
                                                <option value="{{ $designations->id }}">{{ $designations->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select applicable option.</div>
                                    </div>

                                    <!-- Leave type -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="leave_type_id">Leave Type *</label>
                                        <select class="form-control select2" id="leave_type_id" name="leave_type_id"
                                            required>
                                            <option value="">Leave Type</option>
                                            @foreach ($leaves as $leavestype)
                                                <option value="{{ $leavestype->id }}">{{ $leavestype->leave_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select leave Type.</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="total_leaves">Total Days *</label>
                                        <input type="text" readonly disabled class="form-control" id="total_leaves"
                                            name="total_leaves" required />


                                        <div class="invalid-feedback">Please select leave Type.</div>
                                    </div>
                                    <!-- Allow Days -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="allow_days">Allow Days *</label>
                                        <input type="text" class="form-control" placeholder="Allow Days"
                                            name="allow_days" id="allow_days" />
                                        <div class="invalid-feedback">Please select Allow Days.</div>
                                        <small id="allow_days_msg" class="text-danger" style="display:none;">
                                            You cannot enter more than Total days!
                                        </small>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="status">Status *</label>
                                        <select class="form-control select2" id="status" name="status" required>
                                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>

                                </div>


                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('settings.leave-type') }}" class="btn btn-light me-2">
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

        <x-footer />
    </div>

@endsection
@push('after_scripts')
    <script>
        $('#leave_type_id').on('change', function() {
            let leaveTypeId = $(this).val();

            if (leaveTypeId) {
                $.ajax({
                    url: "/leave-type/get-days/" + leaveTypeId,
                    type: "GET",
                    success: function(response) {
                        let allowed = response.days;

                        // Set allowed days
                        $('#total_leaves').val(allowed);

                        // Set max limit to Apply Days input
                        $('#allow_days').attr('max', allowed);

                        // Reset apply days
                        $('#allow_days').val('');
                        $('#allow_days_msg').hide();
                    }
                });
            }
        });

        // Prevent type more than max + show message
        $('#allow_days').on('input', function() {
            let max = parseInt($(this).attr('max'));
            let val = parseInt($(this).val());

            if (val > max) {
                $('#allow_days_msg').show();
                $(this).val(max);
            } else {
                $('#allow_days_msg').hide();
            }
        });
    </script>
@endpush
