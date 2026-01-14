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
                                            <i class="ti ti-list-details me-2"></i> Leave Allow List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('settings.leave.mapping.update', $leave->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <!-- Designation -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Designation *</label>
                                        <select class="form-control select2" name="designation_id" required>
                                            <option value="">Select Designation</option>
                                            @foreach ($designation as $des)
                                                <option value="{{ $des->id }}"
                                                    {{ $leave->designation_id == $des->id ? 'selected' : '' }}>
                                                    {{ $des->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Leave Type -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Leave Type *</label>
                                        <select class="form-control select2" id="leave_type_id" name="leave_type_id"
                                            required>
                                            <option value="">Leave Type</option>
                                            @foreach ($leaves as $lt)
                                                <option value="{{ $lt->id }}"
                                                    {{ $leave->leave_type_id == $lt->id ? 'selected' : '' }}>
                                                    {{ $lt->leave_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Total Days -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Total Days *</label>
                                        <input type="text" class="form-control" readonly disabled id="total_leaves"
                                            value="{{ $leave->leaveType->total_leaves ?? 0 }}">
                                    </div>

                                    <!-- Allow Days -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Allow Days *</label>
                                        <input type="number" class="form-control" name="allow_days" id="allow_days"
                                            value="{{ $leave->allow_days }}" required>

                                        <small id="allow_days_msg" class="text-danger" style="display:none;">
                                            You cannot enter more than Total days!
                                        </small>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status *</label>
                                        <select class="form-control select2" name="status" required>
                                            <option value="Active" {{ $leave->status == 'Active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="Inactive" {{ $leave->status == 'Inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('settings.leave-allow') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Update Leave
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
                        let maxDays = response.days;

                        $('#total_leaves').val(maxDays);
                        $('#allow_days').attr('max', maxDays);

                        if (parseInt($('#allow_days').val()) > maxDays) {
                            $('#allow_days').val(maxDays);
                        }
                    }
                });
            }
        });

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

        $(document).ready(function() {
            let total = $('#total_leaves').val();
            $('#allow_days').attr('max', total);
        });
    </script>
@endpush
