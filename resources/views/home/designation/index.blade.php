@extends('layout.master')
@section('title', $title)
@section('main-section')

    <x-alert-modal 
        :type="session('success') ? 'success' : (session('error') ? 'error' : '')" 
        :message="session('success') ?? session('error')" 
    />

    <div class="page-wrapper">
        <div class="content">
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                </div>
                <div class="mb-2">
                    <a href="{{ route('masters.organisation.designation.create') }}"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-circle-plus me-2"></i>Add Designation
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <table id="designationTable" class="table table-bordered table-striped w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr.No</th>
                                <th>Designation Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <x-footer />
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4>Confirm Delete</h4>
                    <p>Are you sure you want to delete this designation?</p>
                    <input type="hidden" id="deleteDesignationUrl">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function() {
            let table = $('#designationTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('masters.organisation.designation.list') }}",
                columns: [
                    {
                        data: null,
                        render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1
                    },
                    { data: 'designation_name', name: 'designation_name' },
                    { data: 'designation_code', name: 'designation_code' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
            $(document).on('click', '.deleteDesignation', function(e) {
                e.preventDefault();
                $('#deleteDesignationUrl').val($(this).attr('href'));
                $('#delete_modal').modal('show');
            });

            // Confirm Delete
            $('#confirmDeleteBtn').click(function() {
                let url = $('#deleteDesignationUrl').val();

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        $('#delete_modal').modal('hide');

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // ✅ Instantly remove deleted row
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        $('#delete_modal').modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Something went wrong. Please try again.'
                        });
                    }
                });
            });
        });
    </script>
@endsection
