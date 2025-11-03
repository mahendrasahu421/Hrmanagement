@extends('layout.master')
@section('title', $title)

@section('main-section')
<style>
    .dataTables_wrapper {
        padding: 10px 20px;
    }
    .paginate_button {
        margin: 0px 5px;
    }
</style>
    <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />

    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{ route('masters.organisation.department.create') }}"
                            class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-circle-plus me-2"></i>Add Department
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <div class="card">
                <div class="card-body p-0">
                    <div class="custom-datatable-filter table-responsive">
                        <table id="departmentTable" class="table table-bordered table-striped w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Department Name</th>
                                    <th>Code</th>
                                    <th>Reporting Department</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
                    <h4 class="mb-1">Confirm Delete</h4>
                    <p class="mb-3">Are you sure you want to delete this department? This action cannot be undone.</p>
                    <input type="hidden" id="deleteDepartmentUrl">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            let table = new DataTable('#departmentTable', {
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('masters/organisation/department/list') }}",
                    type: "GET"
                },
                columns: [{
                        data: null,
                        name: 'sn',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: 'department_code',
                        name: 'department_code'
                    },
                    {
                        data: 'department_head',
                        name: 'department_head'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]

            });
            $(document).on('click', '.deleteDepartment', function(e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('href');
                $('#deleteDepartmentUrl').val(deleteUrl);
                $('#delete_modal').modal('show');
            });
            $('#confirmDeleteBtn').on('click', function() {
                let url = $('#deleteDepartmentUrl').val();

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#confirmDeleteBtn').prop('disabled', true).text('Deleting...');
                    },
                    success: function(response) {
                        $('#confirmDeleteBtn').prop('disabled', false).text('Yes, Delete');
                        $('#delete_modal').modal('hide');

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        $('#confirmDeleteBtn').prop('disabled', false).text('Yes, Delete');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!'
                        });
                    }
                });
            });
        });
    </script>
@endsection
