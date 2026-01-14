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
                                    <a href="{{ route('settings.category') }}" class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-circle-plus me-2"></i>Category List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-alert-modal />
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('settings.category.update', $category->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="name">Category Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                                    <div class="invalid-feedback">Please enter Category name.</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="status">Status *</label>
                                    <select class="form-control select2" id="status" name="status" required>
                                        <option value="Active" {{ old('status', $category->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status', $category->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">Please select status.</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('settings.category') }}" class="btn btn-light me-2">
                                    <i class="ti ti-arrow-left me-1"></i> Back
                                </a>
                                <button type="reset" class="btn btn-secondary me-2">
                                    <i class="ti ti-x me-1"></i> Cancel
                                </button>
                                <button class="btn btn-primary" type="submit">
                                    <i class="ti ti-device-floppy me-1"></i> Update Category
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
