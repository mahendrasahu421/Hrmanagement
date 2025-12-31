@extends('employee.layout.layout')
@section('title', $title)
@section('main-section')
    <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />

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
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item" aria-current="page">
                                                {{ $titleRoute }}
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">
                                        <a href="{{ route('employee.leaves') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-circle-plus me-2"></i>Leave List
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Breadcrumb -->
                        </div>

                        <div class="card-body">
                            <div id="leaveInfo" style="display:none;">
                                <div class="row mt-3 g-3">
                                    <div class="col-md-4">
                                        <div class="card text-center shadow-sm border-primary rounded-3 bg-light">
                                            <div class="card-body py-3">
                                                <h6 class="text-primary fw-medium mb-2">Total Leaves</h6>
                                                <h3 class="text-primary mb-0 fw-bold" id="totalLeaves">0</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card text-center shadow-sm border-warning rounded-3 bg-light">
                                            <div class="card-body py-3">
                                                <h6 class="text-warning fw-medium mb-2">Used Leaves</h6>
                                                <h3 class="text-warning mb-0 fw-bold" id="usedLeaves">0</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card text-center shadow-sm border-success rounded-3 bg-light">
                                            <div class="card-body py-3">
                                                <h6 class="text-success fw-medium mb-2">Remaining</h6>
                                                <h3 class="text-success mb-0 fw-bold" id="remainingLeaves">0</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('employee.leaves.update', $leave->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-row row">
                                    <div id="leaveLimitMsg" class="text-danger" style="display:none;">
                                        <small>
                                            You have used all available leaves for <span class="leaveName"></span>.
                                            <br>
                                            <span style="color:#b30000;">Please select another leave type.</span>
                                        </small>
                                    </div>

                                    <!-- Leave Type -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="leave_type_id">Leave Type *</label>
                                        <select class="form-control select2" id="leave_type_id" name="leave_type_id"
                                            required>
                                            <option value="">-- Select Leave Type --</option>
                                            @foreach ($leaveTypes as $l)
                                                <option value="{{ $l->id }}"
                                                    {{ $leave->leave_type_id == $l->id ? 'selected' : '' }}>
                                                    {{ $l->leave_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a leave type.</div>
                                    </div>

                                    <!-- From Date -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="from_date">From Date *</label>
                                        <input type="date" class="form-control" id="from_date" name="from_date"
                                            value="{{ $leave->from_date }}" required>
                                        <div class="invalid-feedback">Please select a start date.</div>
                                    </div>

                                    <!-- To Date -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="to_date">To Date *</label>
                                        <input type="date" class="form-control" id="to_date" name="to_date"
                                            value="{{ $leave->to_date }}" required>
                                        <div class="invalid-feedback">Please select an end date.</div>
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Total Leaves</label>
                                        <input type="text" class="form-control" id="total_leaves" readonly
                                            value="{{ $leave->to_date && $leave->from_date ? \Carbon\Carbon::parse($leave->to_date)->diffInDays(\Carbon\Carbon::parse($leave->from_date)) + 1 : 0 }}">
                                    </div>

                                    <!-- Reason -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="reason">Reason *</label>
                                        <select class="form-control select2" id="reason_id" name="reason_id" required>
                                            <option value="">-- Select Reason --</option>
                                            @if ($leave->reason_id)
                                                <option value="{{ $leave->reason_id }}" selected>{{ $leave->reason }}
                                                </option>
                                            @endif
                                        </select>

                                        <div class="invalid-feedback">Please select reason.</div>

                                        <div id="otherReasonDiv"
                                            style="display:{{ $leave->reason_id == null ? 'block' : 'none' }}; margin-top:10px;">
                                            <textarea class="form-control" name="reason" id="other_reason" placeholder="Enter your reason here...">{{ $leave->reason_id == null ? $leave->reason : '' }}</textarea>
                                            <div class="invalid-feedback">Please enter reason.</div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="status">Status *</label>
                                        <select class="form-control select2" id="status" name="status" required>
                                            <option value="DRAFT" {{ $leave->status == 'DRAFT' ? 'selected' : '' }}>Draft
                                            </option>
                                            <option value="SENT" {{ $leave->status == 'SENT' ? 'selected' : '' }}>Sent
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('employee.leaves') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" id="submitBtn" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Update Leave
                                    </button>
                                </div>
                            </form>

                            <x-footer />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after_scripts')
    <!-- Validation -->
    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    <!-- Reason Handling -->
    <script>
        $(document).ready(function() {
            $('#leave_type_id').on('change', function() {
                let leaveTypeId = $(this).val();
                $("#reason_id").empty().append('<option value="">-- Select Reason --</option>');
                $("#otherReasonDiv").hide();
                $('#other_reason').val('').prop('required', false);

                if (leaveTypeId) {
                    let url = "{{ route('employee.leave.reasons', ':id') }}";
                    url = url.replace(':id', leaveTypeId);

                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(res) {
                            if (res.length > 0) {
                                $.each(res, function(key, value) {
                                    $("#reason_id").append('<option value="' + value
                                        .id + '">' + value.reason + '</option>');
                                });
                                $("#reason_id").append(
                                '<option value="Others">Others</option>');
                            } else {
                                $("#reason_id").append(
                                    '<option value="">No Reasons Found</option>');
                            }
                        }
                    });
                }
            });

            $('#reason_id').on('change', function() {
                if (this.value === 'Others') {
                    $("#otherReasonDiv").slideDown();
                    $('#other_reason').prop('required', true);
                } else {
                    $("#otherReasonDiv").slideUp();
                    $('#other_reason').prop('required', false).val('');
                }
            });
        });
    </script>

    <!-- Leave Balance & Info -->
    <script>
        $(document).ready(function() {
            $('select[name="leave_type_id"]').on('change', function() {
                let leaveTypeId = $(this).val();
                if (leaveTypeId) {
                    let url = "{{ route('leave.balance', ['leaveTypeId' => ':id']) }}";
                    url = url.replace(':id', leaveTypeId);

                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(data) {
                            $("#leaveLimitMsg span.leaveName").text(data.leave_name);

                            if (data.allotted === "Unlimited") {
                                $("#submitBtn").prop("disabled", false);
                                $("#leaveLimitMsg").hide();
                                $("#leaveInfo").hide();
                            } else {
                                $("#leaveInfo").show();
                                $("#totalLeaves").text(data.allotted);
                                $("#usedLeaves").text(data.used);
                                $("#remainingLeaves").text(data.remaining);

                                if (data.allotted == data.used) {
                                    $("#submitBtn").prop("disabled", true);
                                    $("#leaveLimitMsg").show();
                                } else {
                                    $("#submitBtn").prop("disabled", false);
                                    $("#leaveLimitMsg").hide();
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>

    <!-- Calculate Total Leaves -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function calculateLeaves() {
                let fromVal = $('#from_date').val();
                let toVal = $('#to_date').val();
                if (fromVal && toVal) {
                    let diffDays = (new Date(toVal) - new Date(fromVal)) / (1000 * 60 * 60 * 24) + 1;
                    $('#total_leaves').val(diffDays);
                } else {
                    $('#total_leaves').val(0);
                }
            }

            $('#from_date, #to_date').on('change', function() {
                if ($('#to_date').val() < $('#from_date').val()) {
                    $('#to_date').val($('#from_date').val());
                }
                calculateLeaves();
            });

            calculateLeaves();

            $('#leave_type_id').on('change', function() {
                let leaveTypeText = $("#leave_type_id option:selected").text().trim();
                let today = new Date().toISOString().split('T')[0];
                let tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                tomorrow = tomorrow.toISOString().split('T')[0];

                if (leaveTypeText === "Emergency Leave") {
                    $('#from_date, #to_date').attr('min', today).val(today);
                } else {
                    $('#from_date, #to_date').attr('min', tomorrow).val(tomorrow);
                }
                $('#from_date, #to_date').trigger('change');
            });
        });
    </script>
@endpush
