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
                                            You have used all available leaves for <span class="leaveName"></span>.<br>
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

                                    <!-- Date Range Picker -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Select Date Range *</label>
                                        <input type="text" class="form-control" id="leave_range"
                                            placeholder="Select date range" required>
                                        <input type="hidden" name="from_date" id="from_date"
                                            value="{{ $leave->from_date }}">
                                        <input type="hidden" name="to_date" id="to_date" value="{{ $leave->to_date }}">
                                        <div class="invalid-feedback">Please select date range.</div>
                                    </div>

                                    <!-- Total Leaves -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Total Leaves</label>
                                        <input type="text" class="form-control" id="total_leaves" readonly
                                            value="{{ $leave->to_date && $leave->from_date ? \Carbon\Carbon::parse($leave->to_date)->diffInDays(\Carbon\Carbon::parse($leave->from_date)) + 1 : 0 }}">
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <!-- Reason -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="reason_id">Reason *</label>
                                        <select class="form-control select2" id="reason_id" name="reason_id" required>
                                            <option value="">-- Select Reason --</option>

                                            @foreach ($reasons as $r)
                                                <option value="{{ $r->id }}"
                                                    {{ $leave->reasons_id == $r->id ? 'selected' : '' }}>
                                                    {{ $r->reason }}
                                                </option>
                                            @endforeach
                                            @if (!$leave->reasons_id && $leave->reason)
                                                <option value="Others" selected>Others</option>
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">Please select reason.</div>

                                        <!-- Textarea for Other reason -->
                                        <div id="otherReasonDiv"
                                            style="margin-top:10px; display:{{ !$leave->reasons_id && $leave->reason ? 'block' : 'none' }};">
                                            <textarea class="form-control" name="reason" id="other_reason" placeholder="Enter your reason here...">{{ !$leave->reasons_id && $leave->reason ? $leave->reason : '' }}</textarea>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        let rangePicker;

        function parseDate(dateStr) {
            return dateStr ? new Date(dateStr) : null;
        }

        function initDatePicker(minDate, preStart, preEnd) {
            if (rangePicker) rangePicker.destroy();

            setTimeout(() => {
                rangePicker = flatpickr("#leave_range", {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    minDate: minDate,
                    allowOneSidedRange: true,
                    defaultDate: preStart && preEnd ? [preStart, preEnd] : preStart ? [preStart] : null,
                    onChange: function(selectedDates) {
                        if (selectedDates.length === 1) {
                            let day = selectedDates[0];
                            $("#from_date").val(flatpickr.formatDate(day, "Y-m-d"));
                            $("#to_date").val(flatpickr.formatDate(day, "Y-m-d"));
                            $("#total_leaves").val(1);
                        }
                        if (selectedDates.length === 2) {
                            let start = selectedDates[0];
                            let end = selectedDates[1];
                            $("#from_date").val(flatpickr.formatDate(start, "Y-m-d"));
                            $("#to_date").val(flatpickr.formatDate(end, "Y-m-d"));
                            let diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                            $("#total_leaves").val(diff);
                        }
                    }
                });
            }, 50);
        }

        document.addEventListener("DOMContentLoaded", function() {
            let leaveTypeText = $("#leave_type_id option:selected").text().trim();
            let from = "{{ $leave->from_date }}";
            let to = "{{ $leave->to_date }}";
            let today = new Date();
            let tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);

            // Show saved date range in input
            if (from && to) {
                $('#leave_range').val(from + " to " + to);
            } else if (from) {
                $('#leave_range').val(from);
            }

            if (leaveTypeText === "Emergency Leave") {
                initDatePicker(today, parseDate(from), parseDate(to));
            } else {
                initDatePicker(tomorrow, parseDate(from), parseDate(to));
            }

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

                let leaveTypeText = $("#leave_type_id option:selected").text().trim();
                let today = new Date().toISOString().split('T')[0];
                let tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                tomorrow = tomorrow.toISOString().split('T')[0];

                if (leaveTypeText === "Emergency Leave") {
                    $('#from_date, #to_date').attr('min', today).val(today);
                    initDatePicker(today);
                } else {
                    $('#from_date, #to_date').attr('min', tomorrow).val(tomorrow);
                    initDatePicker(tomorrow);
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

            $('#from_date, #to_date').on('change', calculateLeaves);
            calculateLeaves();
        });
    </script>
@endpush
