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
            </div>
            <!-- /Breadcrumb -->

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="candidateList" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Onboarding</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Employee Details  -->
            <div id="employeeDrawer"
                style="position: fixed; top: 0; right: -40%; width: 40%; height: 100%; background: #fff; 
                       box-shadow: -3px 0 6px rgba(0,0,0,0.2); z-index: 1050; transition: right 0.3s; 
                       overflow-y: auto; padding: 20px;">
            </div>

        </div>

        <x-footer />
    </div>
@endsection

@push('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#candidateList').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('jobs.applied.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'state',
                        name: 'state'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                dom: "<'row mb-2'<'col-md-6'l><'col-md-6 text-end'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
            });
            $(document).on('click', '.view-details', function() {
                let employeeId = $(this).data('id');

                $.ajax({
                    url: '/employee/details/' + employeeId,
                    type: 'GET',
                    success: function(res) {
                        let html = `
                    <div class="card border-0">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-white">Employee Details</h5>
                            <button id="closeDrawer" class="btn btn-sm btn-light text-danger">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2"><div class="col-5 fw-bold">Name:</div><div class="col-7">${res.employee_name}</div></div>
                            <div class="row mb-2"><div class="col-5 fw-bold">Email:</div><div class="col-7">${res.email}</div></div>
                            <div class="row mb-2"><div class="col-5 fw-bold">Mobile:</div><div class="col-7">${res.mobile}</div></div>
                            <div class="row mb-2"><div class="col-5 fw-bold">Gender:</div><div class="col-7">${res.gender}</div></div>
                            <div class="row mb-2"><div class="col-5 fw-bold">State:</div><div class="col-7">${res.state}</div></div>
                            <div class="row mb-2"><div class="col-5 fw-bold">City:</div><div class="col-7">${res.city}</div></div>
                            <div class="row mb-2"><div class="col-5 fw-bold">Apply Date:</div><div class="col-7">${res.applied_at}</div></div>
                      
                        </div>
                    </div>
                `;
                        $('#employeeDrawer').html(html);
                        $('#employeeDrawer').css('right', '0');

                        $('#closeDrawer').click(function() {
                            $('#employeeDrawer').css('right', '-40%');
                        });
                    },
                    error: function(err) {
                        alert('Failed to fetch employee details');
                    }
                });
            });
        });
    </script>

    <style>
        #employeeDrawer .row {
            padding: 5px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        #employeeDrawer .fw-bold {
            color: #555;
        }
    </style>
@endpush
