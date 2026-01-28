@extends('layout.master')
@section('title', $title)
<style>
    [data-select2-id="2"] {
        display: none !important;
    }
</style>
@section('main-section')

    <div class="page-wrapper">
        <div class="content">

            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                    <p class="text-muted mb-0">View daily employee attendance overview</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-danger text-white rounded-circle me-3">
                                <i class="ti ti-user-x fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Absent</h6>
                                <h4 class="fw-bold mb-0">{{ $onleave }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-info text-white rounded-circle me-3">
                                <i class="ti ti-plane fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">On Leave</h6>
                                <h4 class="fw-bold mb-0">{{ $onleave }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label class="form-label fw-semibold">Filter by Designation</label>
                            <select id="designationFilter" class="form-select select2">
                                <option value="">All Designations</option>
                                @foreach ($designation as $des)
                                    <option value="{{ $des->id }}">{{ $des->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <table id="tableexample" class="table table-bordered nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>Days</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="statusModal">
        <div class="modal-dialog modal-dialog-centered">
            <form id="statusForm" class="modal-content">
                @csrf
                <input type="hidden" id="leave_id" name="leave_id">
                <input type="hidden" id="new_status" name="new_status">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Status</h4>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Change status to <b id="statusText"></b>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.select2').select2();

            let table = $('#tableexample').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('leaves.list') }}",
                    data: function(d) {
                        d.designation_id = $('#designationFilter').val();
                    }
                },
                columns: [{
                        data: null,
                        render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1
                    },
                    {
                        data: 'employee'
                    },
                    {
                        data: 'leave_type'
                    },
                    {
                        data: 'days'
                    },
                    {
                        data: 'from_date'
                    },
                    {
                        data: 'to_date'
                    },
                    {
                        data: 'reason'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ]
            });

            $('#designationFilter').change(function() {
                table.ajax.reload();
            });

            $(document).on('click', '.openModal', function() {
                $('#leave_id').val($(this).data('id'));
                $('#new_status').val($(this).data('status'));
                $('#statusText').text($(this).data('status'));
                $('#statusModal').modal('show');
            });

            $('#statusForm').submit(function(e) {
                e.preventDefault();
                $.post("{{ route('leave.updateStatus') }}", $(this).serialize(), function() {
                    $('#statusModal').modal('hide');
                    table.ajax.reload(null, false);
                });
            });

        });
    </script>
@endpush
