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
    </style>


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
                    <div class="dash-widget">
                        <div class="dash-widget-info">
                            <span>Total Jobs</span>
                            <h3 class="total_jobs">120</h3>
                        </div>
                        <div class="dash-widget-icon bg-orange">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                    </div>
                </div>

                <!-- Published Jobs -->
                <div class="col-md-4">
                    <div class="dash-widget">
                        <div class="dash-widget-info">
                            <span>Published Jobs</span>
                            <h3 class="text-success">80</h3>
                        </div>
                        <div class="dash-widget-icon bg-success">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </div>
                </div>

                <!-- Unpublished Jobs -->
                <div class="col-md-4">
                    <div class="dash-widget">
                        <div class="dash-widget-info">
                            <span>Unpublished Jobs</span>
                            <h3 class="text-danger">40</h3>
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
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Jobs List</h4>

                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="no-sort">
                                                <div class="form-check form-check-md">
                                                    <input class="form-check-input" type="checkbox" id="select-all">
                                                </div>
                                            </th>
                                            <th>Job Title</th>
                                            <th>Functional Area</th>
                                            <th>Location</th>
                                            <th>Experience</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Senior Developer</td>
                                            <td>IT / Software</td>
                                            <td>Mumbai</td>
                                            <td>3-5 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>UI/UX Designer</td>
                                            <td>Design</td>
                                            <td>Pune</td>
                                            <td>2-4 Years</td>
                                            <td><span
                                                    class="badge badge-danger d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Inactive</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Project Manager</td>
                                            <td>Management</td>
                                            <td>Bangalore</td>
                                            <td>5-7 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Business Analyst</td>
                                            <td>IT / Software</td>
                                            <td>Hyderabad</td>
                                            <td>3-6 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Quality Analyst</td>
                                            <td>IT / Software</td>
                                            <td>Chennai</td>
                                            <td>1-3 Years</td>
                                            <td><span
                                                    class="badge badge-danger d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Inactive</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>HR Manager</td>
                                            <td>Human Resources</td>
                                            <td>Delhi</td>
                                            <td>4-6 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Content Writer</td>
                                            <td>Marketing</td>
                                            <td>Kolkata</td>
                                            <td>2-4 Years</td>
                                            <td><span
                                                    class="badge badge-danger d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Inactive</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Software Tester</td>
                                            <td>IT / Software</td>
                                            <td>Chennai</td>
                                            <td>1-3 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Frontend Developer</td>
                                            <td>IT / Software</td>
                                            <td>Bangalore</td>
                                            <td>2-5 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Backend Developer</td>
                                            <td>IT / Software</td>
                                            <td>Mumbai</td>
                                            <td>3-5 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Data Analyst</td>
                                            <td>IT / Software</td>
                                            <td>Hyderabad</td>
                                            <td>2-4 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Mobile App Developer</td>
                                            <td>IT / Software</td>
                                            <td>Pune</td>
                                            <td>1-3 Years</td>
                                            <td><span
                                                    class="badge badge-danger d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Inactive</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>DevOps Engineer</td>
                                            <td>IT / Software</td>
                                            <td>Bangalore</td>
                                            <td>3-6 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Marketing Manager</td>
                                            <td>Marketing</td>
                                            <td>Delhi</td>
                                            <td>5-7 Years</td>
                                            <td><span
                                                    class="badge badge-success d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Active</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-md"><input class="form-check-input"
                                                        type="checkbox"></div>
                                            </td>
                                            <td>Graphic Designer</td>
                                            <td>Design</td>
                                            <td>Kolkata</td>
                                            <td>2-5 Years</td>
                                            <td><span
                                                    class="badge badge-danger d-inline-flex align-items-center badge-sm"><i
                                                        class="ti ti-point-filled me-1"></i>Inactive</span></td>
                                            <td>
                                                <div class="action-icon d-inline-flex">
                                                    <a href="#" class="me-2"><i class="ti ti-edit"></i></a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <x-footer />
    </div>


@endsection

@push('after_scripts')
@endpush
