@extends('layout.master')
@section('title', $title)
@section('main-section')

<div class="page-wrapper">
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('masters.payroll.payment-mode.store') }}">
                    @csrf

                    <div class="row">
                        <!-- Mode Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mode Name *</label>
                            <input type="text" name="mode_name" class="form-control" placeholder="Enter Payment Mode"
                                value="Bank Transfer" required>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Enter short description">Salary credited directly to employee’s bank account.</textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-select" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- 🔻 Bottom Buttons -->
                    <div class="d-flex justify-content-end border-top pt-3 mt-4">
                        <a href="{{ route('masters.payroll.payment-mode') }}" class="btn btn-light me-2">
                            <i class="ti ti-arrow-left me-1"></i> Back
                        </a>
                        <button type="reset" class="btn btn-secondary me-2">
                            <i class="ti ti-x me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Save Mode
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
        <p class="mb-0">2014 - {{ date('Y') }} &copy; SmartHR.</p>
        <p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
    </div>
</div>

@endsection
