<!-- Page Wrapper -->
@extends('layout.master')
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

                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">

                    <div class="mb-2">
                        <a href="{{ route('permission.create') }}" class="btn btn-primary d-flex align-items-center"><i
                                class="ti ti-circle-plus me-2"></i>Add
                            Permission</a>
                    </div>

                </div>
            </div>
            <!-- /Breadcrumb -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                            <h5>Permission</h5>

                        </div>
                        <div class="card-body p-0">
                            <div class="custom-datatable-filter table-responsive">
                                <div class="table-responsive ">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Permission Name</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $key => $permission)
                                                <tr>
                                                    <td>{{ $permissions->firstItem() + $key }}</td>
                                                    <td>{{ $permission->name }}</td>

                                                    <td>{{ $permission->created_at->format('d M, Y') }}</td>
                                                    <td>
                                                        <!-- Example: Edit & Delete Buttons -->
                                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>

                                                        <form action="{{ route('permissions.destroy', $permission->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this permission?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>

                                                    {{-- <td>{{ $permission->created_at }}</td> --}}

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-end">
                                        {!! $permissions->links() !!}
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Wrapper -->

    <!-- Add categories -->

    @if (session('success'))
        <!-- Success Modal -->
        <div class="modal fade" id="success_modal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center p-4">
                        <span
                            class="avatar avatar-lg avatar-rounded bg-success mb-3 d-inline-flex align-items-center justify-content-center"
                            style="width:60px; height:60px;">
                            <i class="ti ti-check fs-24 text-white"></i>
                        </span>
                        <h5 class="mb-2">{{ session('success') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Auto Show Script -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var successModal = new bootstrap.Modal(document.getElementById('success_modal'));
                successModal.show();
            });
        </script>
    @endif




    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Confirm Delete</h4>
                    <p class="mb-3">You want to delete all the marked items, this cant be undone once you delete.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <a href="#" class="btn btn-danger">Yes,
                            Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->
@endsection





<script>
    document.addEventListener("DOMContentLoaded", function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        toastElList.map(function(toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                delay: 2000
            }); // 4 sec
            toast.show();
        })
    });
</script>
