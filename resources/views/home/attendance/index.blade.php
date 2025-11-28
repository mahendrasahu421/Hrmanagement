@extends('layout.master')
@section('title', $title)
@section('main-section')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between  mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                    <p class="text-muted mb-0">View daily employee attendance overview</p>
                </div>

            </div>
            <!-- /Breadcrumb -->

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-success text-white rounded-circle me-3">
                                <i class="ti ti-user-check fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Present</h6>
                                <h4 class="fw-bold mb-0">142</h4>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <div class="avatar avatar-md bg-warning text-white rounded-circle me-3">
                                <i class="ti ti-clock fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Late</h6>
                                <h4 class="fw-bold mb-0">9</h4>
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
            <!-- /Summary Cards -->

            <!-- Filter Section -->
            <div class="card mb-4">
                <div class="card-body">

                    <form class="row g-3 align-items-end">

                        <div class="col-md-3">

                            <select id="department" class="form-select">
                                <option>All Departments</option>
                                @foreach ($depatment as $depatments)
                                    <option value="{{ $depatments->id }}">{{ $depatments->department_name }}</option>
                                @endforeach

                            </select>
                            <div class="page-breadcrumb"></div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search me-1"></i> Filter
                            </button>
                        </div>
                        <div id="deptSummary">
                            <!-- Data will load via Ajax -->
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Filter Section -->

            <!-- Attendance Summary Table -->
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="tableexample" class="display table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Employee Name</th>
                                    <th>Leave Type</th>
                                    <th>days</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>reason</th>
                                    <th>status</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Attendance Summary Table -->

        </div>

        <!-- Footer -->
        <x-footer />
        <!-- /Footer -->
    </div>
    <!-- /Page Wrapper -->

@endsection
@push('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            var table = $('#tableexample').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ route('leaves.list') }}",
                    data: function(d) {
                        d.department_id = $('#department').val(); // 👉 Filter Send
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
                    }
                ]
            });

            // 👉 Filter button click
            $('button[type="submit"]').click(function(e) {
                e.preventDefault();
                table.ajax.reload();
                showFilterNote();
            });

            function showFilterNote() {
                let dept = $("#department option:selected").text();

                if ($("#filter-note").length === 0) {
                    $(".page-breadcrumb").append(`
                <p id="filter-note" class="text-primary small mt-1">
                    Showing daily leave list — Filter applied: <b>${dept}</b>
                </p>
            `);
                } else {
                    $("#filter-note").html(
                        `Showing daily leave list — Filter applied: <b>${dept}</b>`
                    );
                }
            }

        });
    </script>
@endpush
