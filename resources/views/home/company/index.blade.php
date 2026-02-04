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
                        <a href="{{ route('masters.organisation.company.create') }}"
                            class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-circle-plus me-2"></i> Add Company
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-3">
                                    <table id="comnayList" class="display table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Sn</th>
                                                <th>Company Logo</th>
                                                <th>Company Name</th>
                                                <th>Company Code</th>
                                                <th>Contact No</th>
                                                <th>Email</th>
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
                </div>
            </div>

            <x-footer />
        </div>

        <div class="modal fade" id="delete_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                            <i class="ti ti-trash-x fs-36"></i>
                        </span>
                        <h4 class="mb-1">Confirm Delete</h4>
                        <p class="mb-3">Are you sure you want to delete this company? This action cannot be undone.</p>
                        <input type="hidden" id="deleteCompanyId">
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
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                var table = $('#comnayList').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    ajax: "{{ route('masters.organisation.company.list') }}",
                    columns: [{
                            data: 'DT_RowIndex'
                        },
                        {
                            data: 'logo'
                        },
                        {
                            data: 'company_name'
                        },
                        {
                            data: 'company_code'
                        },
                        {
                            data: 'contact_no'
                        },
                        {
                            data: 'email'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    dom: "<'row mb-2'<'col-md-6'l><'col-md-6 text-end'f>>" +
                        "<'row'<'col-md-12'tr>>" +
                        "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
                });

                window.deleteCompany = function(id) {
                    $('#deleteCompanyId').val(id);
                    $('#delete_modal').modal('show');
                }

                $('#confirmDeleteBtn').click(function() {
                    var id = $('#deleteCompanyId').val();
                    $.ajax({
                        url: "{{ url('masters/organisation/company/delete') }}/" + id,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            $('#delete_modal').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(err) {
                            alert(err.responseJSON?.message || 'Something went wrong!');
                        }
                    });
                });
            });
        </script>
    @endpush
