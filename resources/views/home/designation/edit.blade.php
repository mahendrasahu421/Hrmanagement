@extends('layout.master')
@section('title', $title)
@section('main-section')

    <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />

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
                                <div class="mb-2">
                                    <a href="{{ route('settings.designation') }}"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-list-details me-2"></i> Designation List
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('settings.designation.update', $designation->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <!-- Company -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Company *</label>
                                        <select class="form-control select2" name="company_id" required>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ $designation->company_id == $company->id ? 'selected' : '' }}>
                                                    {{ $company->company_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Category *</label>
                                        <select class="form-control select2" id="category_id" name="category_id" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $designation->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Department -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Department *</label>
                                        <select class="form-control select2" id="department_id" name="department_id"
                                            required>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $designation->department_id == $department->id ? 'selected' : '' }}>
                                                    {{ $department->department_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Designation Name *</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $designation->name) }}" required>
                                    </div>

                                    <!-- Code -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Designation Code *</label>
                                        <input type="text" class="form-control" name="designation_code"
                                            value="{{ old('designation_code', $designation->code) }}" required>
                                    </div>

                                    <!-- KPI -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">KPI Weightage *</label>
                                        <input type="number" class="form-control" name="kpi_weightage"
                                            value="{{ old('kpi_weightage', $designation->kpi_weightage) }}" required>
                                    </div>

                                    <!-- Competency -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Competency Weight *</label>
                                        <input type="number" class="form-control" name="competency_weight"
                                            value="{{ old('competency_weight', $designation->competency_weight) }}"
                                            required>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status *</label>
                                        <select class="form-control select2" name="status" required>
                                            <option value="Active"
                                                {{ old('status', $designation->status) == 'Active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="Inactive"
                                                {{ old('status', $designation->status) == 'Inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('settings.designation') }}" class="btn btn-light me-2">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Update Designation
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
