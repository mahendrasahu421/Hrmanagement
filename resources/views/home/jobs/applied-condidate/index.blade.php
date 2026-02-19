@extends('layout.master')
@section('title', $title)
<style>
    .job-info-line {
        background: #f8f9fa;
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-block;
        color: #444;
    }

    .job-highlight-box {
        background: #f8f9fa;
        padding: 12px 15px;
        border-radius: 6px;
        border-left: 4px solid #28a745;
        font-size: 14px;
    }

    .info-item {
        display: flex;
        align-items: center;
    }

    #candidateList tbody tr.match-high>td {
        background-color: #31f85e24 !important;
        color: #000;
    }

    #candidateList tbody tr.match-medium>td {
        background-color: yellow !important;
        color: #000;
    }

    #candidateList tbody tr.match-low>td {
        background-color: #ff00001f !important;
        color: #000;
    }
</style>
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
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-end">
                        <!-- Job Filter -->
                        <div class="col-md-4">
                            <label for="jobFilter" class="form-label fw-semibold">
                                Filter by Job Title
                            </label>
                            <select id="jobFilter" class="form-select select2">
                                <option value="">--All Jobs--</option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}">
                                        {{ $job->job_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Job Details -->
                        <div class="col-md-8 position-relative" id="jobDetails" style="display:none;">

                            <!-- Recommendation Button -->
                            <div class="text-end">
                                <button id="recommendBtn" class="btn btn-sm btn-success">
                                    <i class="fa fa-thumbs-up me-1"></i> Recommendation
                                </button>
                            </div>

                            <!-- Highlighted Info Box -->
                            <div class="job-highlight-box mt-2">

                                <div class="d-flex flex-wrap gap-3">

                                    <div class="info-item">
                                        <i class="fa fa-code text-primary me-1"></i>
                                        <span id="jobSkills">N/A</span>
                                    </div>

                                    <div class="info-item">
                                        <i class="fa fa-graduation-cap text-warning me-1"></i>
                                        <span id="jobQualifications">N/A</span>
                                    </div>

                                    <div class="info-item">
                                        <i class="fa fa-briefcase text-success me-1"></i>
                                        <span id="jobExperience">N/A</span>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="card">
                <div class="card-body p-0">
                    <div id="candidateTableWrapper" style="display: none;"> <!-- HIDDEN initially -->
                        <div class="table-responsive">
                            <table id="candidateList" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Job Title</th>
                                        <th>Applied Date</th>
                                        <th>Employee Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>View CV</th>
                                        <th>Onboarding</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Initialize DataTable
            let table = $('#candidateList').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ route('jobs.applied.list') }}",
                    data: function(d) {
                        d.job_id = $('#jobFilter').val(); // pass selected job
                    },
                    dataSrc: function(json) {
                        // If no job is selected, return empty array
                        if (!$('#jobFilter').val()) {
                            return [];
                        }
                        return json.data;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'job_title'
                    },
                    {
                        data: 'applied_date'
                    },
                    {
                        data: 'first_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'gender'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'city'
                    },
                    {
                        data: 'resume',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                createdRow: function(row, data) {
                    $(row).removeClass('match-high match-medium match-low');
                    if ($('#jobFilter').val() && data.DT_RowClass) {
                        row.classList.add(data.DT_RowClass);
                    }
                },
                deferLoading: 0, // Do NOT load data initially
            });

            const jobDetailsUrl = "{{ route('jobs.details', ':id') }}";

            // Job filter change
            $('#jobFilter').on('change', function() {
                let jobId = $(this).val();

                if (!jobId) {
                    $('#jobDetails').hide();
                    table.clear().draw(); // clear table if no job selected
                    return;
                }

                // Show job details via AJAX
                let url = jobDetailsUrl.replace(':id', jobId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(res) {
                        $('#jobSkills').text(res.skills);
                        $('#jobQualifications').text(res.qualifications);
                        $('#jobExperience').text(res.experience);
                        $('#jobDetails').slideDown(); // SHOW
                    },
                    error: function() {
                        $('#jobDetails').hide();
                    }
                });

                $('#candidateTableWrapper').show(); // show table
                table.ajax.reload(); // reload candidates for selected job
            });

            // Recommendation button toggle
            $('#recommendBtn').on('click', function() {
                let jobId = $('#jobFilter').val();

                if (!jobId) {
                    alert('Please select a Job first');
                    return;
                }

                $(this).toggleClass('active'); // toggle active class
                table.ajax.reload(); // reload table with recommendation logic
            });

            // Employee drawer click
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
                        <div class="row mb-2"><div class="col-5 fw-bold">Aadhar Number:</div><div class="col-7">${res.aadhaar ?? 'N/A'}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Date of Birth:</div><div class="col-7">${res.dob}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Skill:</div><div class="col-7">${res.skills}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Tenth Percentage:</div><div class="col-7">${res.tenth_percent}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Tenth Year:</div><div class="col-7">${res.tenth_year}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Twelfth Percentage:</div><div class="col-7">${res.twelfth_percent}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Twelfth Year:</div><div class="col-7">${res.twelfth_year}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">UG Percentage:</div><div class="col-7">${res.ug_percent}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">UG Year:</div><div class="col-7">${res.ug_year}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Degree:</div><div class="col-7">${res.degree}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Institute:</div><div class="col-7">${res.institute}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Final Year:</div><div class="col-7">${res.final_year}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Experience Year:</div><div class="col-7">${res.experience_years}</div></div>
                        <div class="row mb-2"><div class="col-5 fw-bold">Experience Details:</div><div class="col-7">${res.experience_details}</div></div>
                    </div>
                </div>
                `;
                        $('#employeeDrawer').html(html).css('right', '0');
                        $('#closeDrawer').click(function() {
                            $('#employeeDrawer').css('right', '-40%');
                        });
                    },
                    error: function() {
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

        .select2 {
            width: 300px !important;
        }

        [data-select2-id="2"] {
            display: none !important;
        }
    </style>
@endpush
