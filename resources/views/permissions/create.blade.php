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
                        <a href="{{ route('permission.index') }}" class="btn btn-primary d-flex align-items-center"><i
                                class="ti ti-circle-plus me-2"></i>Add Permission</a>
                    </div>

                </div>
            </div>
            <!-- /Breadcrumb -->
            <!-- /Add Leaves -->
            <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />


            <div class="container mt-4">
                <div class="card shadow-sm">

                    <div class="card-body">
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('title') }}"
                                        required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Create</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>




@endsection
