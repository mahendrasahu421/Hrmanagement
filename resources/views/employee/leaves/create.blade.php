@extends('employee.layout.layout')
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
                                    <h2 class="mb-1">{{ $title }}</h2>
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item" aria-current="page">
                                                Employee / Leave Management / leave / Apply
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
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('employee.leaves.store') }}">
                                @csrf

                                <div class="form-row row">
                                    <!-- Leave Type -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="leave_type_id">Leave Type *</label>
                                        <select class="form-control select2" id="leave_type_id" name="leave_type_id" required>
                                            <option value="">-- Select Leave Type --</option>
                                            @foreach ($leaveTypes as $leave)
                                                <option value="{{ $leave->id }}">{{ $leave->leave_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a leave type.</div>
                                    </div>

                                    <!-- From Date -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="from_date">From Date *</label>
                                        <input type="date" class="form-control" id="from_date" name="from_date" required>
                                        <div class="invalid-feedback">Please select a start date.</div>
                                    </div>

                                    <!-- To Date -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="to_date">To Date *</label>
                                        <input type="date" class="form-control" id="to_date" name="to_date" required>
                                        <div class="invalid-feedback">Please select an end date.</div>
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <!-- Reason -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label" for="reason">Reason *</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter reason for leave"
                                            required></textarea>
                                        <div class="invalid-feedback">Please enter your reason for leave.</div>
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

                                <div class="form-row row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Total Leaves</label>
                                        <input type="text" class="form-control" id="total_leaves" readonly
                                            placeholder="0">
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('employee.leaves.list') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit">
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

        <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />
        <x-footer />
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split('T')[0];
            $('#from_date').val(today).attr('min', today);
            $('#to_date').val(today).attr('min', today);

            function calculateLeaves() {
                let fromVal = $('#from_date').val();
                let toVal = $('#to_date').val();

                if (fromVal && toVal) {
                    let fromDate = new Date(fromVal);
                    let toDate = new Date(toVal);

                    if (toDate >= fromDate) {
                        let diffTime = toDate - fromDate;
                        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                        $('#total_leaves').val(diffDays);
                    } else {
                        $('#total_leaves').val(0);
                    }
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
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            toastElList.map(function(toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 30000
                });
                toast.show();
            });
        });
    </script>
@endsection
