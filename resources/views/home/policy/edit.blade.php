@extends('layout.master')
@section('title', $title)
@section('main-section')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">{{ $title }}</h2>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">
                                        <a href="{{ route('masters.organisation.policy') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-list-details me-2"></i> Policy List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('masters.organisation.policy.update', $policy->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Policy Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="policy_title"
                                            placeholder="Enter Policy Title"
                                            value="{{ old('policy_title', $policy->policy_title) }}" required>
                                        <div class="invalid-feedback">Please enter policy title.</div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Policy Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="policy_code"
                                            placeholder="Enter Policy Code"
                                            value="{{ old('policy_code', $policy->policy_code) }}" required>
                                        <div class="invalid-feedback">Please enter policy code.</div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Department <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="department_id" required>
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ old('department_id', $policy->department_id) == $department->id ? 'selected' : '' }}>
                                                    {{ $department->department_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select department.</div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Effective From <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="effective_from"
                                            value="{{ old('effective_from', $policy->effective_from) }}" required>
                                        <div class="invalid-feedback">Please select effective date.</div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control" name="expiry_date"
                                            value="{{ old('expiry_date', $policy->expiry_date) }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Upload Policy Document (PDF)</label>
                                        <input type="file" class="form-control" name="policy_file" accept=".pdf">
                                        @if ($policy->policy_file)
                                            <a href="{{ asset($policy->policy_file) }}" target="_blank"
                                                class="d-block mt-2">
                                                View Current Document
                                            </a>
                                        @endif
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="Active"
                                                {{ old('status', $policy->status) == 'Active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="Inactive"
                                                {{ old('status', $policy->status) == 'Inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea id="policy_description" class="form-control" name="description" rows="4"
                                            placeholder="Enter policy details">{{ old('description', $policy->description) }}</textarea>
                                    </div>
                                </div>

                                <div class="text-end mt-3">
                                    <a href="{{ route('masters.organisation.policy') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Update Policy
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <x-footer />
    </div>

@endsection
@push('after_scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#policy_description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
