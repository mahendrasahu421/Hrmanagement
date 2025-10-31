<!-- Page Wrapper -->
@extends('admin.layout.layout')
@section('title', $title)

@section('main-section')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add / Edit Permission</h5>
                            <p class="card-text">
                                Use this form to add or edit a permission. All fields marked with * are required.
                            </p>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('admin.permission.store') }}">
                                @csrf
                                <div class="form-row row">
                                    <!-- Title -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="permission">Permission *</label>
                                        <input type="text" class="form-control" id="permission" name="name"
                                            placeholder="Permission" required>
                                        <div class="invalid-feedback">
                                            Please enter a menu permission.
                                        </div>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="form-row row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="status">Status *</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Active">Active</option>
                                            <option value="Active">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select menu status.
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Save Menu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- <x-footer /> --}}

    </div>




@endsection
