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
@endsection

@push('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
