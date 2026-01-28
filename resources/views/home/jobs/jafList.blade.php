@extends('layout.master')
@section('title', $title)

@section('main-section')
    <x-alert-modal />

    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                </div>
                <div>
                    <a href="{{ route('create-job-questionaire') }}" class="btn btn-primary">
                        <i class="ti ti-circle-plus me-2"></i>Add Question
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="jafTable" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Job</th>
                                    <th>Question</th>
                                    <th>Tool</th>
                                    <th width="150">Options</th>
                                    <th>Order</th>
                                    <th>Mandatory</th>
                                    <th>Action</th>
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

    <!-- Delete Confirmation Modal for Questions -->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Confirm Delete</h4>
                    <p class="mb-3">Are you sure you want to delete this question? This action cannot be undone.</p>
                    <input type="hidden" id="deleteId">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
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
        $(function() {
            let table = $('#jafTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('jaf.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'job',
                        name: 'job'
                    },
                    {
                        data: 'question',
                        name: 'question'
                    },
                    {
                        data: 'text_element',
                        name: 'text_element'
                    },
                    {
                        data: 'options',
                        name: 'options'
                    },
                    {
                        data: 'order',
                        name: 'order'
                    },
                    {
                        data: 'is_required',
                        name: 'is_required',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(id) {
                            return `
                        <a href="{{ url('recruitment/jobs/create-job-questionaire/edit') }}/${id}" class="me-2">
                            <i class="ti ti-edit"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="deleteRow(${id})">
                            <i class="ti ti-trash"></i>
                        </a>`;
                        }
                    }
                ]
            });

            window.deleteRow = function(id) {
                $('#deleteId').val(id);
                $('#delete_modal').modal('show');
            }

            $('#confirmDeleteBtn').click(function() {
                let id = $('#deleteId').val();
                $.ajax({
                    url: "{{ url('recruitment/jobs/create-job-questionaire/delete') }}/" + id,
                    type: "POST",
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        $('#delete_modal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(err) {
                        console.log(err.responseJSON || err);
                        alert(err.responseJSON?.message || 'Something went wrong!');
                    }
                });
            })
        });
    </script>
@endpush
