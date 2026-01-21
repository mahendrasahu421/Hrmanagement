@extends('employee.layout.layout')
@section('title', $title)
@section('main-section')
    <style>
        :root {
            --fp-main: #f37438;
        }

        .flatpickr-months .flatpickr-month,
        .flatpickr-current-month input.cur-year {
            color: var(--fp-main);
        }

        .flatpickr-prev-month svg,
        .flatpickr-next-month svg {
            fill: var(--fp-main);
        }

        .flatpickr-day:hover {
            background: rgba(243, 116, 56, 0.15);
            color: #000;
            border-radius: 50px;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background: var(--fp-main);
            color: #fff;
            border-radius: 50px;
        }

        .flatpickr-day.inRange {
            background: rgba(243, 116, 56, 0.2);
            border-radius: 50px;
        }

        .flatpickr-day.today {
            border-color: var(--fp-main);
            color: var(--fp-main);
        }
    </style>

    <!-- Page Wrapper -->
    <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">

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
                                            <i class="ti ti-list me-2"></i>Leave List
                                        </a>
                                    </div>
                                </div>
                            </div>

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
                                action="{{ route('employee.leaves.store') }}">
                                @csrf

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

                                            @foreach ($leaveTypes as $leave)
                                                <option value="{{ $leave->id }}"
                                                    @if ($leave->remaining !== 'Unlimited' && (int) $leave->remaining === 0) disabled @endif>

                                                    {{ $leave->leave_name }}

                                                    @if ($leave->remaining === 'Unlimited')
                                                        (Unlimited)
                                                    @else
                                                        (Remaining: {{ $leave->remaining }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">Please select a leave type.</div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Select Date Range *</label>

                                        <input type="text" class="form-control" id="leave_range"
                                            placeholder="Select date range" required>

                                        <input type="hidden" name="from_date" id="from_date">
                                        <input type="hidden" name="to_date" id="to_date">

                                        <small id="rangeError" class="text-danger d-none">
                                            Selected date range exceeds remaining leaves.
                                        </small>

                                        <div class="invalid-feedback">Please select date range.</div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Total Leaves</label>
                                        <input type="text" class="form-control" id="total_leaves" readonly
                                            placeholder="0">
                                    </div>

                                </div>

                                <div class="form-row row">

                                    <!-- Reason -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="reason">Reason *</label>
                                        <select class="form-control select2" id="reason_id" name="reason_id" required>
                                            <option value="">-- Select Reason --</option>
                                        </select>

                                        <div class="invalid-feedback">Please select reason.</div>

                                        <div id="otherReasonDiv" style="display:none; margin-top:10px;">
                                            <textarea class="form-control" name="reason" id="other_reason" placeholder="Enter your reason here..." maxlength="250"style="resize: vertical; min-height: 100px;"></textarea>
                                            <small class="text-muted">
                                                <span id="charCount">0</span>/250 characters
                                            </small>
                                            <div class="invalid-feedback">Please enter reason.</div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="status">Status *</label>
                                        <select class="form-control select2" id="status" name="status" required>
                                            <option value="DRAFT" selected>Draft</option>
                                            <option value="SENT">Sent</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('employee.leaves') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" id="submitBtn" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Apply Leave
                                    </button>
                                </div>
                            </form>

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

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer />
    </div>
@endsection


@push('after_scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        let rangePicker;
        let remainingLeaveCount = 0;

        function initDatePicker(minDate) {

            if (rangePicker) {
                rangePicker.destroy();
            }

            setTimeout(() => {
                rangePicker = flatpickr("#leave_range", {
                    mode: "range",
                    altInput: true,
                    altFormat: "d-m-Y",
                    dateFormat: "Y-m-d",
                    minDate: minDate,
                    allowOneSidedRange: true,

                    onChange: function(selectedDates) {

                        $("#rangeError").addClass('d-none');

                        if (selectedDates.length === 1) {

                            if (remainingLeaveCount !== Infinity && remainingLeaveCount < 1) {
                                rangePicker.clear();
                                $("#from_date").val('');
                                $("#to_date").val('');
                                $("#total_leaves").val(0);
                                $("#rangeError").removeClass('d-none');
                                return;
                            }

                            let day = selectedDates[0];
                            $("#from_date").val(flatpickr.formatDate(day, "Y-m-d"));
                            $("#to_date").val(flatpickr.formatDate(day, "Y-m-d"));
                            $("#total_leaves").val(1);
                        }

                        if (selectedDates.length === 2) {

                            let start = selectedDates[0];
                            let end = selectedDates[1];

                            let diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;

                            if (remainingLeaveCount !== Infinity && diff > remainingLeaveCount) {
                                rangePicker.clear();
                                $("#from_date").val('');
                                $("#to_date").val('');
                                $("#total_leaves").val(0);
                                $("#rangeError").removeClass('d-none');
                                return;
                            }

                            $("#from_date").val(flatpickr.formatDate(start, "Y-m-d"));
                            $("#to_date").val(flatpickr.formatDate(end, "Y-m-d"));
                            $("#total_leaves").val(diff);
                        }
                    }
                });
            }, 50);
        }

        document.addEventListener("DOMContentLoaded", function() {
            initDatePicker("today");
        });
    </script>

    <script>
        $('#other_reason').on('input', function() {
            let length = $(this).val().length;
            $('#charCount').text(length);
        });
        $(document).ready(function() {

            $('#leave_type_id').on('change', function() {

                $("#rangeError").addClass('d-none');
                rangePicker?.clear();
                $("#from_date, #to_date").val('');
                $("#total_leaves").val(0);

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

            $('select[name="leave_type_id"]').on('change', function() {

                let leaveTypeId = $(this).val();

                if (leaveTypeId) {

                    let url = "{{ route('leave.balance', ['leaveTypeId' => ':id']) }}";
                    url = url.replace(':id', leaveTypeId);

                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(data) {

                            if (data.allotted === "Unlimited") {
                                remainingLeaveCount = Infinity;
                                $("#submitBtn").prop("disabled", false);
                                $("#leaveLimitMsg").hide();
                                $("#leaveInfo").hide();
                            } else {
                                remainingLeaveCount = parseInt(data.remaining);
                                $("#leaveInfo").show();
                                $("#totalLeaves").text(data.allotted);
                                $("#usedLeaves").text(data.used);
                                $("#remainingLeaves").text(data.remaining);

                                if (data.remaining == 0) {
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

            $('#leave_type_id').on('change', function() {

                let leaveTypeText = $("#leave_type_id option:selected").text().trim();

                let today = new Date();
                let tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);

                if (leaveTypeText === "Emergency Leave") {
                    initDatePicker(today);
                } else {
                    initDatePicker(tomorrow);
                }
            });

        });
    </script>
@endpush
