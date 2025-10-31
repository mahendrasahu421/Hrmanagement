<!-- Page Wrapper -->
@extends('layout.master')
@section('title', $title)

@section('main-section')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add / Edit Role</h5>
                            <p class="card-text">
                                Use this form to add or edit a role. All fields marked with * are required.
                            </p>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST" action="{{ route('role.store') }}">
                                @csrf
                                <div class="form-row row">
                                    <!-- Title -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="role">Role *</label>
                                        <input type="text" class="form-control" id="role" name="name"
                                            placeholder="Role" required>
                                        <div class="invalid-feedback">
                                            Please enter a menu role.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-md-12 mb-3">
                                        @if ($permissions->isNotEmpty())
                                            <label class="form-label fw-bold mb-2">Assign Permissions</label>
                                            <div class="d-flex flex-wrap">
                                                @foreach ($permissions as $permission)
                                                    <div class="form-check me-4 mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="permission_{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->name }}">
                                                        <label class="form-check-label"
                                                            for="permission_{{ $permission->id }}">
                                                            {{ ucfirst($permission->name) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">No permissions available.</p>
                                        @endif
                                    </div>
                                </div>


                               

                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- <x-footer /> --}}

    </div>




@endsection
