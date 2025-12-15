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
                        <a href="{{ route('settings.jobskill.create') }}" class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-circle-plus me-2"></i> Add Job Skill
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="jobSkillList" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Job Skill Name</th>
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
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Confirm Delete</h4>
                    <p class="mb-3">Are you sure you want to delete this job skill?</p>
                    <input type="hidden" id="deleteId">
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
            $('#jobSkillList').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('settings.jobskill.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                        <div class="action-icon d-inline-flex">
                            <a href="{{ url('settings/jobskill/edit') }}/${data}" class="me-2">
                                <i class="ti ti-edit"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteItem(${data})">
                                <i class="ti ti-trash"></i>
                            </a>
                        </div>
                    `;
                        }
                    }
                ]
            });
        });

        function deleteItem(id) {
            $('#deleteId').val(id);
            $('#delete_modal').modal('show');
        }

        $('#confirmDeleteBtn').click(function() {
            let id = $('#deleteId').val();
            $.ajax({
                url: "{{ url('settings/jobskill/delete') }}/" + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    $('#delete_modal').modal('hide');
                    $('#jobSkillList').DataTable().ajax.reload();
                }
            });
        });
    </script>
@endpush
