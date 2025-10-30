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
                                        <a href="{{ route('masters.payroll.salary-structure') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-list-details me-2"></i> Salary Structure List
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Breadcrumb -->
                        </div>

                        <div class="card-body">
                            <form method="POST" action="#">
                                @csrf

                                <div class="row">
                                    <!-- Structure Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Structure Name *</label>
                                        <input type="text" name="structure_name" class="form-control"
                                            placeholder="Enter Structure Name" value="Default Salary Structure" required>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="description" class="form-control"
                                            placeholder="Enter Description" value="Default structure for employees">
                                    </div>

                                    <!-- Department -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Applicable Department</label>
                                        <select name="department" class="form-select">
                                            <option value="">Select Department</option>
                                            <option selected>All Departments</option>
                                            <option>HR</option>
                                            <option>Finance</option>
                                            <option>IT</option>
                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <h5 class="mb-3">Salary Components</h5>

                                <!-- Row 1 -->
                                <div class="row align-items-end border-bottom pb-3 mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Component Name</label>
                                        <input type="text" class="form-control" name="components[0][name]"
                                            value="Basic Salary">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Type</label>
                                        <select class="form-select" name="components[0][type]">
                                            <option value="earning" selected>Earning</option>
                                            <option value="deduction">Deduction</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Calculation Type</label>
                                        <select class="form-select" name="components[0][calc_type]">
                                            <option value="percentage" selected>Percentage</option>
                                            <option value="fixed">Fixed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Value</label>
                                        <input type="text" class="form-control" name="components[0][value]"
                                            value="40%">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Taxable</label>
                                        <select class="form-select" name="components[0][taxable]">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="row align-items-end border-bottom pb-3 mb-3">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="components[1][name]"
                                            value="HRA">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" name="components[1][type]">
                                            <option value="earning" selected>Earning</option>
                                            <option value="deduction">Deduction</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" name="components[1][calc_type]">
                                            <option value="percentage" selected>Percentage</option>
                                            <option value="fixed">Fixed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="components[1][value]"
                                            value="20%">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" name="components[1][taxable]">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Row 3 -->
                                <div class="row align-items-end border-bottom pb-3 mb-3">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="components[2][name]"
                                            value="Professional Tax">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" name="components[2][type]">
                                            <option value="earning">Earning</option>
                                            <option value="deduction" selected>Deduction</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" name="components[2][calc_type]">
                                            <option value="percentage">Percentage</option>
                                            <option value="fixed" selected>Fixed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="components[2][value]"
                                            value="₹200">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" name="components[2][taxable]">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="text-end mt-4">
                                    <a href="{{ route('masters.payroll.salary-structure') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Save Structure
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
                <p class="mb-0">2014 - {{ date('Y') }} &copy; SmartHR.</p>
                <p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
            </div>
        </div>
    </div>

@endsection
