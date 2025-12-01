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

                            <select id="designation" class="form-select select2" name="designation">
                                <option value="">All Designations</option>
                                @foreach ($designation as $designations)
                                    <option value="{{ $designations->id }}">{{ $designations->name }}</option>
                                @endforeach

                            </select>
                            <div class="page-breadcrumb"></div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search me-1"></i> Filter
                            </button>
                        </div>
                        {{-- <div id="deptSummary">
                            <!-- Data will load via Ajax -->
                        </div> --}}
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
                                    <th>Days</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>

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
        <!-- Add Goal Tracking -->
        <div class="modal fade" id="statusModal">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm Leave Status</h4>
                        <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                    <form id="statusForm">
                        @csrf
                        <input type="hidden" name="leave_id" id="leave_id">
                        <input type="hidden" name="new_status" id="new_status">
                        <div class="modal-body pb-0">
                            <p>Are you sure you want to change the leave status to <b id="statusText"></b>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes, Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /Add Goal Tracking -->

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

            // CSRF FIX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Open Modal
            $(document).on("click", ".openModal", function() {

                let leaveId = $(this).data("id");

                let newStatus = $(this).data("status");

                $("#leave_id").val(leaveId);
                $("#new_status").val(newStatus);
                $("#statusText").text(newStatus);

                $("#statusModal").modal("show");
            });

            // Submit Modal Form
            // Submit Modal Form
            $("#statusForm").on("submit", function(e) {
                console.log('working');
                e.preventDefault();

                $.ajax({
                    url: "{{ route('leave.updateStatus') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {

                        $("#statusModal").modal("hide");

                        Swal.fire({
                            icon: "success",
                            title: "Status Updated!",
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $("#tableexample").DataTable().ajax.reload(null, false); // ← FIXED ID
                    },
                    error: function(xhr) {
                        Swal.fire("Error", "Something went wrong", "error");
                    }
                });
            });


        });
    </script>
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
                        d.designation_id = $('#designation').val();
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
                    },
                    {
                        data: 'action'
                    }
                ]
            });

            // Filter button
            $('#filterBtn').click(function() {
                table.ajax.reload();
                showFilterNote();
            });

            function showFilterNote() {
                let dept = $("#designation option:selected").text() || 'All';
                if ($("#filter-note").length === 0) {
                    $(".page-breadcrumb").append(`
                <p id="filter-note" class="text-primary small mt-1">
                    Showing leave list — Filter applied: <b>${dept}</b>
                </p>
            `);
                } else {
                    $("#filter-note").html(
                        `Showing leave list — Filter applied: <b>${dept}</b>`
                    );
                }
            }

            showFilterNote(); // only note, no reload
        });
    </script>
@endpush
