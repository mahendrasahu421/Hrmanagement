@extends('layout.master')
@section('title', $title)

@section('main-section')

    <style>
        .dash-widget {
            background: #fff;
            padding: 18px 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef2f7;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .dash-widget:hover {
            transform: translateY(-1px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.12);
        }

        .dash-widget-info span {
            font-size: 14px;
            color: #6c757d;
        }

        .dash-widget-info h3 {
            margin-top: 5px;
            color: #1b2559;
            font-weight: 600;
        }

        .dash-widget-icon {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .bg-orange {
            background: #ff6b00 !important;
        }

        .total_jobs {
            color: #ff6b00 !important;
        }

        .job-details-drawer {
            width: 40vw !important;
            max-width: 40vw !important;
        }

        .job-drawer-body {
            background: #f8f9fb;
        }

        .job-card {
            background: #fff;
            border-radius: 10px;
            padding: 18px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .06);
        }

        .job-title {
            font-size: 18px;
            font-weight: 600;
            color: #1b2559;
        }

        .job-meta {
            font-size: 13px;
            color: #6c757d;
        }

        .job-badge {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #1b2559;
        }

        .info-row {
            font-size: 14px;
            margin-bottom: 6px;
        }


        @media (max-width: 768px) {
            .job-details-drawer {
                width: 100vw !important;
                max-width: 100vw !important;
            }
        }
    </style>


    <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')" :message="session('success') ?? session('error')" />

    <!-- Confirmation Modal -->
    <div class="modal fade" id="copyConfirmModal" tabindex="-1" aria-labelledby="copyConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="copyConfirmModalLabel">Confirm Copy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to duplicate this job? A copy of this job will be created.
                    <div id="rowPreview" class="mt-2 text-muted" style="font-size: 0.9em;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm me-2"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-outline-primary btn-sm me-2" id="reviewRow">Review</button>
                    <button type="button" class="btn btn-outline-primary btn-sm me-2" id="confirmCopy">Yes</button>
                </div>

            </div>
        </div>
    </div>


    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{ route('recruitment.jobs.create') }}" class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-circle-plus me-2"></i>Add Jobs
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <!-- Job Cards -->
            <div class="row">

                <!-- Total Jobs -->
                <div class="col-md-4">
                    <div class="dash-widget job-filter" data-status="ALL" style="cursor:pointer;">
                        <div class="dash-widget-info">
                            <span>Total Jobs</span>
                            <h3 class="total_jobs">{{ $totalJobs }}</h3>
                        </div>
                        <div class="dash-widget-icon bg-orange">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                    </div>
                </div>

                <!-- Published Jobs -->
                <div class="col-md-4">
                    <div class="dash-widget job-filter" data-status="PUBLISHED" style="cursor:pointer;">
                        <div class="dash-widget-info">
                            <span>Published Jobs</span>
                            <h3 class="text-success">{{ $publishedJobs }}</h3>
                        </div>
                        <div class="dash-widget-icon bg-success">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </div>
                </div>

                <!-- Draft Jobs -->
                <div class="col-md-4">
                    <div class="dash-widget job-filter" data-status="DRAFT" style="cursor:pointer;">
                        <div class="dash-widget-info">
                            <span>Draft Jobs</span>
                            <h3 class="text-danger">{{ $draftJobs }}</h3>
                        </div>
                        <div class="dash-widget-icon bg-danger">
                            <i class="fa-solid fa-ban"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- /Job Cards -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="jobsList" class="display table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Publish Date</th>
                                            <th>Job Title</th>
                                            <th>Functional Area</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Experience</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
    <div class="offcanvas offcanvas-end job-details-drawer" tabindex="-1" id="jobDetailsDrawer">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-semibold">Job Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
    
        <div class="offcanvas-body job-drawer-body">
            <div id="jobDetailsContent"></div>
        </div>
    </div>
    

@endsection

@push('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $(document).on('click', '#jobsList tbody .view-job', function () {
    
            let jobId = $(this).data('id');
            $('#jobDetailsContent').html('');
            let drawerEl = document.getElementById('jobDetailsDrawer');
            let drawer = bootstrap.Offcanvas.getOrCreateInstance(drawerEl);
            drawer.show();
    
            $.ajax({
                url: "{{ route('recruitment.jobs.details.ajax') }}",
                type: "GET",
                data: { id: jobId },
                beforeSend: function () {
                    $('#jobDetailsContent').html(`
                        <div class="text-center text-muted py-5">
                            <div class="spinner-border spinner-border-sm me-2"></div>
                            Fetching job details...
                        </div>
                    `);
                },
                success: function (res) {
    
                    let statusBadge =
                        res.status === 'PUBLISHED'
                            ? 'badge bg-success'
                            : 'badge bg-secondary';
    
                    let html = `
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
    
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="mb-1">${res.job_title}</h5>
                                        <small class="text-muted">${res.designation}</small>
                                    </div>
                                    <span class="${statusBadge}">
                                        ${res.status}
                                    </span>
                                </div>
    
                                <hr>
    
                                <p><strong>Experience:</strong> ${res.experience}</p>
                                <p><strong>CTC:</strong> ${res.ctc}</p>
                                <p><strong>State:</strong> ${res.state}</p>
                                <p><strong>City:</strong> ${res.cities}</p>
                                <p><strong>Skills:</strong> ${res.skills}</p>
    
                                <hr>
    
                                <h6>Description</h6>
                                <p class="text-muted">${res.description}</p>
    
                            </div>
                        </div>
                    `;
    
                    $('#jobDetailsContent').html(html);
                },
                error: function () {
                    $('#jobDetailsContent').html(`
                        <div class="alert alert-danger text-center">
                            Failed to load job details. Please try again.
                        </div>
                    `);
                }
            });
        });
    </script>
    
    <script>
        let rowToCopy = null;
        let table = null;
        let currentStatus = 'ALL';

        $(document).ready(function() {

            table = $('#jobsList').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ route('recruitment.jobs.list') }}",
                    data: function(d) {
                        d.status = currentStatus;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'publish_date'
                    },
                    {
                        data: 'job_title'
                    },
                    {
                        data: 'designation'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'city'
                    },
                    {
                        data: 'experience'
                    },
                    {
                        data: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            $('.job-filter').on('click', function() {
                currentStatus = $(this).data('status');
                table.ajax.reload();
            });

            $('#jobsList tbody').on('click', '.copy-btn', function() {

                rowToCopy = $(this).closest('tr');

                let preview = '';
                rowToCopy.find('td').each(function(index) {
                    if (index < 8) {
                        preview += $(this).text().trim() + ' | ';
                    }
                });

                $('#rowPreview').text(preview);

                new bootstrap.Modal(document.getElementById('copyConfirmModal')).show();
            });

            $('#confirmCopy').on('click', function() {

                if (!rowToCopy) return;

                let rowData = [];
                rowToCopy.find('td').each(function(index) {
                    if (index < 8) {
                        rowData.push($(this).text().trim());
                    }
                });

                navigator.clipboard.writeText(rowData.join('\t'))
                    .then(() => alert('Row copied successfully!'));

                bootstrap.Modal.getInstance(
                    document.getElementById('copyConfirmModal')
                ).hide();

                rowToCopy = null;
            });

        });
    </script>
@endpush
