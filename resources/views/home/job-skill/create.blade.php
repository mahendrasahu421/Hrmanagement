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
                                    <a href="{{ route('settings.jobskill') }}"
                                       class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-list-details me-2"></i> JobSkill List
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /Breadcrumb -->

                    </div>

                    <div class="card-body">

                        <form class="needs-validation" novalidate method="POST"
                              action="{{ route('settings.jobskill.store') }}">
                            @csrf

                            <div class="row">

                                <!-- Job Skill Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Skill Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           placeholder="Enter Job Skill Name"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('settings.jobskill') }}" class="btn btn-light me-2">
                                    <i class="ti ti-arrow-left me-1"></i> Back
                                </a>

                                <button type="reset" class="btn btn-secondary me-2">
                                    <i class="ti ti-x me-1"></i> Cancel
                                </button>

                                <button class="btn btn-primary" type="submit">
                                    <i class="ti ti-device-floppy me-1"></i> Save JobSkill
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Footer -->
    <x-footer />
</div>

@endsection
