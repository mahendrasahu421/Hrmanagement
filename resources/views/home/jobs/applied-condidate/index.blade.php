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

    .job-info-popup {
        position: absolute;
        bottom: 30px;
        right: 0;
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 8px 12px;
        font-size: 13px;
        white-space: nowrap;
        display: none;
        z-index: 999;
    }


    .job-info-popup div {
        padding: 5px 0;
        border-bottom: 1px solid #eee;
    }

    .job-info-popup div:last-child {
        border-bottom: none;
    }
</style>
<style>
    .rec-btn-1 {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 5px 25px;
        background: transparent;
        border: none;
        cursor: pointer;
        outline: none;
        transition: transform 0.3s ease;
    }

    .rec-btn-1::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 14px;
        padding: 2.5px;
        background: linear-gradient(135deg, #f26522, #ffb347, #f26522);
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }

    .rec-btn-1::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 14px;
        background: transparent;
        z-index: -1;
    }

    .rec-btn-1 .btn-text {
        font-size: 16px;
        font-weight: 700;
        background: linear-gradient(135deg, #f26522, #ffb347);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: 0.4px;
    }

    .rec-btn-1 .sparkle {
        position: absolute;
        right: -16px;
        top: -12px;
        filter: drop-shadow(0 0 5px #f26522aa);
        animation: sparkleAnim 2s ease-in-out infinite;
    }

    .rec-btn-1:hover {
        transform: translateY(-2px);
    }

    @keyframes gradientShift {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    @keyframes sparkleAnim {

        0%,
        100% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }

        50% {
            transform: scale(1.2) rotate(15deg);
            opacity: 0.8;
        }
    }
</style>
@section('main-section')
    <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />

    <div class="page-wrapper">
        <div class="content">

            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-end">

                        <div class="col-md-4">
                            <label for="jobFilter" class="form-label fw-semibold">
                                Filter by Job Title
                            </label>

                            <select id="jobFilter" class="form-select select2">
                                <option value="">--Choose Job--</option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" data-count="{{ $job->applications_count }}">
                                        {{ $job->job_title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-8 position-relative" id="jobDetails" style="display:none;">

                            <div class="text-end d-flex justify-content-end gap-2 position-relative align-items-center">

                                <!-- Image as clickable button -->
                                <!-- Replace your <img> tag with this -->
                                <button class="rec-btn-1" id="recommendBtn" style="cursor: pointer;">
                                    <span class="btn-text">Recommendation</span>
                                    <span class="sparkle">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 2L13.5 9.5L21 11L13.5 12.5L12 20L10.5 12.5L3 11L10.5 9.5L12 2Z"
                                                fill="#f26522" />
                                            <path d="M20 2L20.7 5.3L24 6L20.7 6.7L20 10L19.3 6.7L16 6L19.3 5.3L20 2Z"
                                                fill="#ffb347" />
                                        </svg>
                                    </span>
                                </button>

                                <!-- Info button -->
                                <button class="btn btn-sm btn-primary" id="jobInfoBtn">
                                    <i class="fa fa-info-circle"></i>
                                </button>

                                <!-- Popup -->
                                <div id="jobInfoPopup"
                                    class="job-info-popup position-absolute end-0 mt-2 p-2 border bg-white rounded shadow"
                                    style="display: none; z-index: 1000;">
                                    <span>
                                        <i class="fa fa-lightbulb text-primary me-1"></i>
                                        <span id="jobSkills">N/A</span>
                                    </span>

                                    <span class="mx-2">|</span>

                                    <span>
                                        <i class="fa fa-graduation-cap text-warning me-1"></i>
                                        <span id="jobQualifications">N/A</span>
                                    </span>

                                    <span class="mx-2">|</span>

                                    <span>
                                        <i class="fa fa-briefcase text-success me-1"></i>
                                        <span id="jobExperience">N/A</span>
                                    </span>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">

                    <div id="chooseJobMessage" class="text-center py-5">
                        <h5 class="text-muted">
                            Please choose a job to show particular job related candidates
                        </h5>
                    </div>

                    <div id="candidateTableWrapper" style="display:none;">
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
            let infoTimeout;
            $('#jobInfoBtn').on('mouseenter', function() {
                clearTimeout(infoTimeout);
                $('#jobInfoPopup').fadeIn(150);
            });
            $('#jobInfoBtn').on('mouseleave', function() {
                infoTimeout = setTimeout(function() {
                    $('#jobInfoPopup').fadeOut(150);
                }, 200);
            });
            $('#jobInfoPopup').on('mouseenter', function() {
                clearTimeout(infoTimeout);
            });
            $('#jobInfoPopup').on('mouseleave', function() {
                infoTimeout = setTimeout(function() {
                    $('#jobInfoPopup').fadeOut(150);
                }, 200);
            });

            $('.select2').select2({
                templateResult: formatJob,
                templateSelection: formatJobSelection,
                escapeMarkup: function(markup) {
                    return markup;
                }
            });

            function getBadge(count) {
                let color = 'bg-danger';
                if (count > 5) color = 'bg-success';
                else if (count > 0) color = 'bg-primary';
                return `<span class="badge ${color}">${count}</span>`;
            }

            function formatJob(job) {
                if (!job.id) return job.text;
                let count = $(job.element).data('count') ?? 0;
                return `
            <div style="display:flex;justify-content:space-between;width:100%;">
                <span>${job.text}</span>
                ${getBadge(count)}
            </div>
        `;
            }

            function formatJobSelection(job) {
                if (!job.id) return job.text;
                let count = $(job.element).data('count') ?? 0;
                return `
            <div style="display:flex;justify-content:space-between;width:100%;">
                <span>${job.text}</span>
                ${getBadge(count)}
            </div>
        `;
            }

            let table = $('#candidateList').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ route('jobs.applied.list') }}",
                    data: function(d) {
                        d.job_id = $('#jobFilter').val();
                    },
                    dataSrc: function(json) {
                        if (!$('#jobFilter').val()) return [];
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
                deferLoading: 0
            });

            const jobDetailsUrl = "{{ route('jobs.details', ':id') }}";

            $('#jobFilter').on('change', function() {

                let jobId = $(this).val();

                if (!jobId) {
                    $('#jobDetails').hide();
                    $('#candidateTableWrapper').hide();
                    $('#chooseJobMessage').show();
                    table.clear().draw();
                    return;
                }

                $('#chooseJobMessage').hide();
                $('#candidateTableWrapper').show();

                let url = jobDetailsUrl.replace(':id', jobId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(res) {
                        $('#jobSkills').text(res.skills);
                        $('#jobQualifications').text(res.qualifications);
                        $('#jobExperience').text(res.experience);
                        $('#jobDetails').slideDown();
                    },
                    error: function() {
                        $('#jobDetails').hide();
                    }
                });

                table.ajax.reload();
            });

            $('#recommendBtn').on('click', function() {
                let jobId = $('#jobFilter').val();

                if (!jobId) {
                    alert('Please select a Job first');
                    return;
                }

                table.settings()[0].ajax.data = function(d) {
                    d.job_id = jobId;
                    d.recommendation = true;
                };

                table.ajax.reload(null, false);
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