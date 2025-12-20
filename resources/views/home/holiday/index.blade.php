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
                        <a href="{{ route('settings.holiday.create') }}" class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-circle-plus me-2"></i>Add Holiday
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="holidayList" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Holiday Name</th>
                                    <th>Date</th>
                                    <th>Remark</th>
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
                    <p class="mb-3">Are you sure you want to delete this holiday? This action cannot be undone.</p>
                    <input type="hidden" id="deleteHolidayId">
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

            $('#holidayList').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,

                ajax: {
                    url: "{{ route('settings.holiday.list') }}",
                    dataSrc: function(json) {
                        return json.data;
                    }
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'holiday_name',
                        name: 'holiday_name'
                    },
                    {
                        data: 'holiday_date',
                        name: 'holiday_date'
                    },
                    {
                        data: 'holiday_remark',
                        name: 'holiday_remark'
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
                        render: function(id) {

                            let editUrl = "{{ route('settings.holiday.edit', ':id') }}";
                            editUrl = editUrl.replace(':id', id);

                            return `
                        <div class="action-icon d-inline-flex">
                            <a href="${editUrl}" class="me-2">
                                <i class="ti ti-edit"></i>
                            </a>

                            <a href="javascript:void(0);" onclick="deleteHoliday(${id})">
                                <i class="ti ti-trash"></i>
                            </a>
                        </div>
                    `;
                        }
                    }
                ],

                order: [
                    [0, 'asc']
                ],
                dom: "<'row mb-2'<'col-md-6'l><'col-md-6 text-end'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
            });
        });

        function deleteHoliday(id) {
            $('#deleteHolidayId').val(id);
            $('#delete_modal').modal('show');
        }

        $('#confirmDeleteBtn').click(function() {

            var id = $('#deleteHolidayId').val();

            $.ajax({
                url: "{{ url('settings/holiday/delete') }}/" + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}"
                },

                success: function() {
                    $('#delete_modal').modal('hide');
                    $('#holidayList').DataTable().ajax.reload();
                },

                error: function(err) {
                    console.log(err.responseJSON || err);
                    alert(err.responseJSON?.message || 'Something went wrong!');
                }
            });
        });
    </script>
@endpush
