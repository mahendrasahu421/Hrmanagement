@extends('layout.master')
@section('title', $title)

@section('main-section')

    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{ route('settings.skills') }}" class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-list-details me-2"></i> skills List
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" novalidate method="POST"
                        action="{{ route('settings.skills.update', $jobSkill->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- Job Skill Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Job Skill Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $jobSkill->name) }}" placeholder="Enter Job Skill Name" required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                           
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('settings.skills') }}" class="btn btn-light me-2">
                                <i class="ti ti-arrow-left me-1"></i> Back
                            </a>

                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> Reset
                            </button>

                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-device-floppy me-1"></i> Update JobSkill
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <x-footer />
    </div>

@endsection
