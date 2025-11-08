@extends('layout.master')
@section('title', $title)

@section('main-section')
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
                        <a href="{{ route('masters.organisation.leave-type.create') }}"
                            class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-circle-plus me-2"></i> Add Leave Type
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="leaveTypeList" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Leave Type</th>
                                    <th>Leave Code</th>
                                    <th>Allowed Days</th>
                                    <th>Carry Forward</th>
                                    <th>Encashable</th>
                                    <th>Applicable For</th>
                                    <th>Leave Category</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <x-footer />
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Confirm Delete</h4>
                    <p class="mb-3">Are you sure you want to delete this leave type? This action cannot be undone.</p>
                    <input type="hidden" id="deleteLeaveUrl">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#leaveTypeList').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('masters.organisation.leave-type.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'leave_name',
                        name: 'leave_name'
                    },
                    {
                        data: 'leave_code',
                        name: 'leave_code'
                    },
                    {
                        data: 'total_leaves',
                        name: 'total_leaves'
                    },
                    {
                        data: 'carry_forward',
                        name: 'carry_forward'
                    },
                    {
                        data: 'encashable',
                        name: 'encashable'
                    },
                    {
                        data: 'applicable_for',
                        name: 'applicable_for'
                    },
                    {
                        data: 'leave_category',
                        name: 'leave_category'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        render: function(data) {
                            return `
                        <div class="action-icon d-inline-flex">
                            <a href="{{ url('masters/organisation/leave-type/edit') }}/` + data + `" class="me-2"><i class="ti ti-edit"></i></a>
                            <a href="javascript:void(0);" onclick="deleteLeave(` + data + `)"><i class="ti ti-trash"></i></a>
                        </div>
                    `;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ]
            });
        });

        function deleteLeave(id) {
            $('#deleteLeaveUrl').val(id);
            $('#delete_modal').modal('show');
        }

        $('#confirmDeleteBtn').click(function() {
            var id = $('#deleteLeaveUrl').val();
            $.ajax({
                url: "{{ url('masters/organisation/leave-type/delete') }}/" + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    $('#delete_modal').modal('hide');
                    $('#leaveTypeList').DataTable().ajax.reload();
                },
                error: function(err) {
                    alert(err.responseJSON?.message || 'Something went wrong!');
                }
            });
        });
    </script>
@endpush
