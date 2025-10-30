@extends('layout.master')
@section('title', $title)
@section('main-section')

    <div class="page-wrapper">
        <div class="content">

            <div class="card">
                <div class="card-header">
                    <div class="d-md-flex d-block align-items-center justify-content-between">
                        <h4 class="mb-0">{{ $title }}</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('masters.payroll.visibility.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rule Name *</label>
                                <input type="text" name="rule_name" class="form-control" placeholder="Enter Rule Name"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Applies To *</label>
                                <select name="applies_to" class="form-select" required>
                                    <option value="">Select Department/Role</option>
                                    <option value="HR Department">HR Department</option>
                                    <option value="Managers">Managers</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Employees">Employees</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Access Level *</label>
                                <select name="access_level" class="form-select" required>
                                    <option value="">Select Level</option>
                                    <option value="Full Access">Full Access</option>
                                    <option value="Read Only">Read Only</option>
                                    <option value="Restricted">Restricted</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status *</label>
                                <select name="status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Enter description (optional)"></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('masters.payroll.visibility') }}" class="btn btn-light me-2">
                                <i class="ti ti-arrow-left me-1"></i> Back
                            </a>
                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Save Rule
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
            <p class="mb-0">2014 - {{ date('Y') }} &copy; SmartHR.</p>
            <p>Designed &amp; Developed By <a href="#" class="text-primary">Dreams</a></p>
        </div>
    </div>

@endsection
