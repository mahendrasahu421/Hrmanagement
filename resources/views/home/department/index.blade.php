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
                        <a href="{{ route('masters.organisation.department.create') }}"
                            class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-circle-plus me-2"></i>Add Department
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <div class="card">
                <div class="card-body p-0">
                    <div class="custom-datatable-filter table-responsive">
                        <table id="departmentTable" class="table table-bordered table-striped w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Department Name</th>
                                    <th>Code</th>
                                    <th>Reporting Department</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <x-footer />
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            let table = new DataTable('#departmentTable', {
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('masters/organisation/department/list') }}",
                    type: "GET"
                },
                columns: [{
                        data: 'sn',
                        name: 'sn'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: 'department_code',
                        name: 'department_code'
                    },
                    {
                        data: 'department_head',
                        name: 'department_head'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Delete Department (AJAX)
            $(document).on('click', '.deleteDepartment', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');

                if (confirm('Are you sure you want to delete this department?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                table.ajax.reload(null, false);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            alert('Something went wrong!');
                        }
                    });
                }
            });
        });
    </script>
@endsection
