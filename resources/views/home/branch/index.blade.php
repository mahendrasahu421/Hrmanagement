<!-- Page Wrapper -->
@extends('layout.master')
@section('title', $title)

@section('main-section')
    <x-alert-modal />
    <div class="page-wrapper">
        <div class="content">

            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item" aria-current="page">
                                {{ $titleRoute }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{ route('masters.organisation.branch.create') }}"
                            class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Add
                            New Branch</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table id="comnayList" class="display table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Company Name</th>
                                            <th>Branch Name</th>
                                            <th>Branch Code</th>
                                            <th>Branch owner Name</th>
                                            <th>Contact No</th>
                                            <th>Email</th>
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
            </div>
        </div>
        <x-footer />
    </div>
    <!-- /Page Wrapper -->

    <div class="modal fade" id="delete_branch_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Confirm Delete</h4>
                    <p class="mb-3">Are you sure you want to delete this branch?</p>

                    <input type="hidden" id="deleteBranchId">

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" id="confirmDeleteBranch">Yes, Delete</button>
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
        $(document).ready(function() {


            var table = $('#comnayList').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ route('masters.organisation.branch.list') }}",
                    data: function(d) {

                    },
                    dataSrc: function(json) {
                        return json.data;
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'company_name'
                    },
                    {
                        data: 'branch_name'
                    },
                    {
                        data: 'branch_code'
                    },
                    {
                        data: 'branch_owner_name'
                    },
                    {
                        data: 'contact_number'
                    },

                    {
                        data: 'email'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                                    <div class="action-icon d-inline-flex">
                                        <a href="{{ url('masters/organisation/branch/edit') }}/${data}" class="me-2">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteBranch(${data})">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </div>
                                `;
                        }
                    }
                ],
                dom: "<'row mb-2'<'col-md-6'l><'col-md-6 text-end'B f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
            });

            window.fetchGenderCounts = function() {
                table.ajax.reload();
            };

        });
    </script>
    <script>
        function deleteBranch(id) {
            $('#deleteBranchId').val(id);
            $('#delete_branch_modal').modal('show');
        }

        $('#confirmDeleteBranch').click(function() {
            var id = $('#deleteBranchId').val();

            $.ajax({
                url: "{{ url('masters/organisation/branch/delete') }}/" + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    $('#delete_branch_modal').modal('hide');
                    $('#comnayList').DataTable().ajax.reload();
                },
                error: function(err) {
                    alert(err.responseJSON?.message || 'Something went wrong');
                }
            });
        });
    </script>
@endpush
