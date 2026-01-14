@extends('layout.master')
@section('title', $title)

@section('main-section')
    <style>
        .select2 {
            width: 300px !important;
        }

        [data-select2-id="2"] {
            display: none !important;
        }
    </style>
    <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />

    <div class="page-wrapper">
        <div class="content">

            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{ route('settings.leave-allow.create') }}"
                            class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-circle-plus me-2"></i> Add Leave Allow
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <label for="designationFilter" class="mb-0"><b>Filter by Designation</b></label>
                    </div>
                    <div class="col-auto">
                        <select id="designationFilter" class="form-control select2">
                            <option value="">-- All Designations --</option>
                            @foreach ($designation as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="leaveTypeList" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Designation</th>
                                    <th>Leave Type</th>
                                    <th>Leave Code</th>
                                    <th>Allow days</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <x-footer />
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Confirm Delete</h4>
                    <p class="mb-3">Are you sure you want to delete this leave mapping?</p>

                    <input type="hidden" id="deleteLeaveId">

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        function deleteLeave(id) {
            $('#deleteLeaveId').val(id);
            $('#delete_modal').modal('show');
        }

        $('#confirmDeleteBtn').click(function() {
            let id = $('#deleteLeaveId').val();

            $.ajax({
                url: "{{ url('settings/leave-mapping/delete') }}/" + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    $('#delete_modal').modal('hide');
                    $('#leaveTypeList').DataTable().ajax.reload();
                },
                error: function() {
                    alert('Something went wrong!');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            var table = $('#leaveTypeList').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('settings.leave.mapping.list') }}",
                    data: function(d) {
                        d.designation_id = $('#designationFilter').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'designation',
                        name: 'designation'
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
                        data: 'allow_days',
                        name: 'allow_days'
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
                                    <a href="{{ url('settings/leave-mapping/edit') }}/${data}" class="me-2">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" onclick="deleteLeave(${data})">
                                        <i class="ti ti-trash"></i>
                                    </a>
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

            $('#designationFilter').change(function() {
                table.ajax.reload();
            });

        });
    </script>
@endpush
