<!-- Page Wrapper -->
@extends('hr.layout.layout')
@section('title', $title)

@section('main-section')
    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">

                            <li class="breadcrumb-item">
                                {{ $title }}
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">categories Grid</li> --}}
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">


                    <div class="mb-2">
                        <a href="{{ route('role.index') }}" class="btn btn-primary d-flex align-items-center"><i
                                class="ti ti-circle-plus me-2"></i>Add Role</a>
                    </div>

                </div>
            </div>
            <!-- /Breadcrumb -->
            <!-- /Add Leaves -->
            <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />


            <div class="container mt-4">
                <div class="card shadow-sm">

                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- Role Name -->
                                <div class="col-md-4 mb-3">
                                    <label for="name">Role Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Permissions List -->
                                <div class="col-md-12 mb-3">
                                    <label for="permissions">Assign Permissions</label>
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Create Role</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>




@endsection
