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
                                        <a href="{{ route('masters.organisation.branch') }}"
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
                                        <select class="form-control" id="leave_type_id" name="leave_type_id" required>
                                            <option value="">-- Select Leave Type --</option>
                                            @foreach ($leaveTypes as $leave)
                                                <option value="{{ $leave->id }}">{{ $leave->name }}</option>
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
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Pending" selected>Pending</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
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
                                // Bootstrap client-side validation
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
    

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        toastElList.map(function(toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                delay: 2000
            }); // 4 sec
            toast.show();
        })
    });
</script>
