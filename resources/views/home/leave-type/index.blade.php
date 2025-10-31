@extends('layout.master')
@section('title', $title)
@section('main-section')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content">

        <!-- Breadcrumb -->
        <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
            <div class="my-auto mb-2">
                <h2 class="mb-1">{{ $title }}</h2>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
                <div class="mb-2">
                    <a href="{{ route('masters.organisation.leave-type.create') }}" class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-circle-plus me-2"></i> Add Leave Type
                    </a>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

        <div class="card">
            <div class="card-body p-0">
                <div class="custom-datatable-filter table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th class="no-sort">
                                    <div class="form-check form-check-md">
                                        <input class="form-check-input" type="checkbox" id="select-all">
                                    </div>
                                </th>
                                <th>Leave Type</th>
                                <th>Leave Code</th>
                                <th>Allowed Days</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check form-check-md">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td>Casual Leave</td>
                                <td><h6 class="fw-medium"><a href="#">CL01</a></h6></td>
                                <td>12 Days / Year</td>
                                <td>
                                    <span class="badge badge-success d-inline-flex align-items-center badge-sm">
                                        <i class="ti ti-point-filled me-1"></i> Active
                                    </span>
                                </td>
                                <td>
                                    <div class="action-icon d-inline-flex">
                                        <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_leave"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-md">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td>Medical Leave</td>
                                <td><h6 class="fw-medium"><a href="#">ML02</a></h6></td>
                                <td>10 Days / Year</td>
                                <td>
                                    <span class="badge badge-success d-inline-flex align-items-center badge-sm">
                                        <i class="ti ti-point-filled me-1"></i> Active
                                    </span>
                                </td>
                                <td>
                                    <div class="action-icon d-inline-flex">
                                        <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_leave"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-md">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td>Maternity Leave</td>
                                <td><h6 class="fw-medium"><a href="#">MTL03</a></h6></td>
                                <td>90 Days / Year</td>
                                <td>
                                    <span class="badge badge-danger d-inline-flex align-items-center badge-sm">
                                        <i class="ti ti-point-filled me-1"></i> Inactive
                                    </span>
                                </td>
                                <td>
                                    <div class="action-icon d-inline-flex">
                                        <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_leave"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <x-footer />
</div>
<!-- /Page Wrapper -->

<!-- Add Leave Type -->
<div class="modal fade" id="add_leave">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Leave Type</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="#">
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Leave Type Name</label>
                            <input type="text" class="form-control" placeholder="Enter Leave Type">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Leave Code</label>
                            <input type="text" class="form-control" placeholder="Enter Leave Code">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Allowed Days (per year)</label>
                            <input type="number" class="form-control" placeholder="Enter No. of Days">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Status</label>
                            <select class="select">
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Leave Type</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Leave Type -->

<!-- Edit Leave Type -->
<div class="modal fade" id="edit_leave">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Leave Type</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="#">
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Leave Type Name</label>
                            <input type="text" class="form-control" value="Casual Leave">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Leave Code</label>
                            <input type="text" class="form-control" value="CL01">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Allowed Days (per year)</label>
                            <input type="number" class="form-control" value="12">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Status</label>
                            <select class="select">
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Edit Leave Type -->

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3">You want to delete all the marked items, this can't be undone once deleted.</p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a href="#" class="btn btn-danger">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->

@endsection
