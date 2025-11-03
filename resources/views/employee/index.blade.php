@extends('employee.layout.layout')
@section('title', $title)

@section('main-section')
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
        @if (session('success'))
            <div class="toast align-items-center text-white bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="toast align-items-center text-white bg-danger border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif
    </div>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">

                            <li class="breadcrumb-item">
                                Dashboard
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Employee Dashboard</li> --}}
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
                    <div class="me-2 mb-2">
                        <div class="dropdown">
                            <a href="javascript:void(0);"
                                class="dropdown-toggle btn btn-white d-inline-flex align-items-center"
                                data-bs-toggle="dropdown">
                                <i class="ti ti-file-export me-1"></i>Export
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                                            class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                                            class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="input-icon w-120 position-relative mb-2">
                        <span class="input-icon-addon">
                            <i class="ti ti-calendar text-gray-9"></i>
                        </span>
                        <input type="text" class="form-control datetimepicker" value="15 Apr 2025">
                    </div>
                    <div class="ms-2 head-icons">
                        <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="Collapse" id="collapse-header">
                            <i class="ti ti-chevrons-up"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <div class="alert bg-secondary-transparent alert-dismissible fade show mb-4">
                Your Leave Request on“24th April 2024”has been Approved!!!
                <button type="button" class="btn-close fs-14" data-bs-dismiss="alert" aria-label="Close"><i
                        class="ti ti-x"></i></button>
            </div>
            <div class="row">
                <div class="col-xl-4 d-flex">
                    <div class="card position-relative flex-fill">
                        <div class="card-header bg-dark">
                            <div class="d-flex align-items-center">
                                <span
                                    class="avatar avatar-lg avatar-rounded border border-white border-2 flex-shrink-0 me-2">
                                    <img src="{{ $imageUrl }}" alt="Img">
                                </span>
                                <div>
                                    <h5 class="text-white mb-1">{{ Auth::user()->name }}</h5>
                                    <div class="d-flex align-items-center">
                                        <p class="text-white fs-12 mb-0">Senior Manager & Company Secretary</p>
                                        <span class="mx-1"><!-- resources/views/layouts/partials/status-dot.blade.php -->

                                            @auth
                                                <i class="ti ti-point-filled text-success" title="Online"></i>
                                            @else
                                                <i class="ti ti-point-filled text-danger" title="Offline"></i>
                                            @endauth

                                        </span>
                                        <p class="fs-12">Designation</p>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-icon btn-sm text-white rounded-circle edit-top"><i
                                    class="ti ti-edit"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="d-block mb-1 fs-13">Phone Number</span>
                                <p class="text-gray-9">{{ Auth::user()->phone }}</p>
                            </div>
                            <div class="mb-3">
                                <span class="d-block mb-1 fs-13">Email Address</span>
                                <p class="text-gray-9"><a href="{{ Auth::user()->email }}" class="__cf_email__"
                                        data-cfemail="fba88f9e8b9e899f9ecac9cfbb9e839a968b979ed5989496">{{ Auth::user()->email }}</a>
                                </p>
                            </div>
                            <div class="mb-3">
                                <span class="d-block mb-1 fs-13">Report Office</span>
                                <p class="text-gray-9">Patna</p>
                            </div>
                            <div>
                                <span class="d-block mb-1 fs-13">Joined on</span>
                                <p class="text-gray-9">{{ Auth::user()->created_at->format('d-m-Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                <h5>Leave Details</h5>
                                <div class="dropdown">
                                    <a href="javascript:void(0);"
                                        class="btn btn-white border btn-sm d-inline-flex align-items-center"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-calendar me-1"></i>2024
                                    </a>
                                    <ul class="dropdown-menu  dropdown-menu-end p-3">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2024</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2023</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2022</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <p class="d-flex align-items-center"><i
                                                    class="ti ti-circle-filled fs-8 text-dark me-1"></i>
                                                <span class="text-gray-9 fw-semibold me-1">1254</span>
                                                on time
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <p class="d-flex align-items-center"><i
                                                    class="ti ti-circle-filled fs-8 text-success me-1"></i>
                                                <span class="text-gray-9 fw-semibold me-1">32</span>
                                                Late Attendance
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <p class="d-flex align-items-center"><i
                                                    class="ti ti-circle-filled fs-8 text-primary me-1"></i>
                                                <span class="text-gray-9 fw-semibold me-1">658</span>
                                                Work From Home
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <p class="d-flex align-items-center"><i
                                                    class="ti ti-circle-filled fs-8 text-danger me-1"></i>
                                                <span class="text-gray-9 fw-semibold me-1">14</span>
                                                Absent
                                            </p>
                                        </div>
                                        <div>
                                            <p class="d-flex align-items-center"><i
                                                    class="ti ti-circle-filled fs-8 text-warning me-1"></i>
                                                <span class="text-gray-9 fw-semibold me-1">68</span>
                                                Sick Leave
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 d-flex justify-content-md-end">
                                        <div id="leaves_chart"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="todo1">
                                        <label class="form-check-label" for="todo1">Better than <span
                                                class="text-gray-9">85%</span> of Employees</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                <h5>Leave Details</h5>
                                <div class="dropdown">
                                    <a href="javascript:void(0);"
                                        class="btn btn-white border btn-sm d-inline-flex align-items-center"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-calendar me-1"></i>2024
                                    </a>
                                    <ul class="dropdown-menu  dropdown-menu-end p-3">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2024</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2023</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2022</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <span class="d-block mb-1">Total Leaves</span>
                                        <h4>16</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <span class="d-block mb-1">Taken</span>
                                        <h4>10</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <span class="d-block mb-1">Absent</span>
                                        <h4>2</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <span class="d-block mb-1">Request</span>
                                        <h4>0</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <span class="d-block mb-1">Worked Days</span>
                                        <h4>240</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <span class="d-block mb-1">Loss of Pay</span>
                                        <h4>2</h4>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div>
                                        <a href="#" class="btn btn-dark w-100" data-bs-toggle="modal"
                                            data-bs-target="#add_leaves">Apply New Leave</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                <h5>Performance</h5>
                                <div class="dropdown">
                                    <a href="javascript:void(0);"
                                        class="btn btn-white border btn-sm d-inline-flex align-items-center"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-calendar me-1"></i>2024
                                    </a>
                                    <ul class="dropdown-menu  dropdown-menu-end p-3">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2024</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2023</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2022</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="bg-light d-flex align-items-center rounded p-2">
                                    <h3 class="me-2">98%</h3>
                                    <span
                                        class="badge badge-outline-success bg-success-transparent rounded-pill me-1">12%</span>
                                    <span>vs last years</span>
                                </div>
                                <div id="performance_chart2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                <h5>My Skills</h5>
                                <div class="dropdown">
                                    <a href="javascript:void(0);"
                                        class="btn btn-white border btn-sm d-inline-flex align-items-center"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-calendar me-1"></i>2024
                                    </a>
                                    <ul class="dropdown-menu  dropdown-menu-end p-3">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2024</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2023</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">2022</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="border border-dashed bg-transparent-light rounded p-2 mb-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span
                                                class="d-block border border-2 h-12 border-primary rounded-5 me-2"></span>
                                            <div>
                                                <h6 class="fw-medium mb-1">Presentation skills</h6>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="border border-dashed bg-transparent-light rounded p-2 mb-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span
                                                class="d-block border border-2 h-12 border-success rounded-5 me-2"></span>
                                            <div>
                                                <h6 class="fw-medium mb-1">Leadership skills</h6>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="border border-dashed bg-transparent-light rounded p-2 mb-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="d-block border border-2 h-12 border-purple rounded-5 me-2"></span>
                                            <div>
                                                <h6 class="fw-medium mb-1">Time management - Prioratising tasks</h6>

                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 d-flex">
                    <div class="flex-fill">
                        <div class="card card-bg-5 bg-dark mb-3">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="text-white mb-4">Team Birthday</h5>
                                    <span class="avatar avatar-xl avatar-rounded mb-2">
                                        <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-35.jpg"
                                            alt="Img">
                                    </span>
                                    <div class="mb-3">
                                        <h6 class="text-white fw-medium mb-1">Mahendra Sahu</h6>
                                        <p>IOS Developer</p>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-primary">Send Wishes</a>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-secondary mb-3">
                            <div class="card-body d-flex align-items-center justify-content-between p-3">
                                <div>
                                    <h5 class="text-white mb-1">Leave Policy</h5>
                                    <p class="text-white">Last Updated : Today</p>
                                </div>
                                <a href="#" class="btn btn-white btn-sm px-3">View All</a>
                            </div>
                        </div>
                        <div class="card bg-warning">
                            <div class="card-body d-flex align-items-center justify-content-between p-3">
                                <div>
                                    <h5 class="mb-1">Next Holiday</h5>
                                    <p class="text-gray-9">Diwali, 15 Sep 2025</p>
                                </div>
                                <a href="https://smarthr.co.in/demo/html/template/holidays.html"
                                    class="btn btn-white btn-sm px-3">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <h5>Team Members</h5>
                                <div>
                                    <a href="#" class="btn btn-light btn-sm">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-27.jpg"
                                            class="rounded-circle border border-2" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Mahendra sahu</a>
                                        </h6>
                                        <p class="fs-13">Sales</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-light btn-icon btn-sm me-2"><i
                                            class="ti ti-phone fs-16"></i></a>
                                    <a href="#" class="btn btn-light btn-icon btn-sm me-2"><i
                                            class="ti ti-mail-bolt fs-16"></i></a>
                                    <a href="#" class="btn btn-light btn-icon btn-sm"><i
                                            class="ti ti-brand-hipchat fs-16"></i></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-42.jpg"
                                            class="rounded-circle border border-2" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Pranshi</a></h6>
                                        <p class="fs-13">Manager</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-light btn-icon btn-sm me-2"><i
                                            class="ti ti-phone fs-16"></i></a>
                                    <a href="#" class="btn btn-light btn-icon btn-sm me-2"><i
                                            class="ti ti-mail-bolt fs-16"></i></a>
                                    <a href="#" class="btn btn-light btn-icon btn-sm"><i
                                            class="ti ti-brand-hipchat fs-16"></i></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-43.jpg"
                                            class="rounded-circle border border-2" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Sheetanshu
                                                Shrivastva</a></h6>
                                        <p class="fs-13">Team Leader</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-light btn-icon btn-sm me-2"><i
                                            class="ti ti-phone fs-16"></i></a>
                                    <a href="#" class="btn btn-light btn-icon btn-sm me-2"><i
                                            class="ti ti-mail-bolt fs-16"></i></a>
                                    <a href="#" class="btn btn-light btn-icon btn-sm"><i
                                            class="ti ti-brand-hipchat fs-16"></i></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-11.jpg"
                                            class="rounded-circle border border-2" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Pritima
                                                Shrivastava</a></h6>
                                        <p class="fs-13">Admin</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-light btn-icon btn-sm me-2"><i
                                            class="ti ti-phone fs-16"></i></a>
                                    <a href="#" class="btn btn-light btn-icon btn-sm me-2"><i
                                            class="ti ti-mail-bolt fs-16"></i></a>
                                    <a href="#" class="btn btn-light btn-icon btn-sm"><i
                                            class="ti ti-brand-hipchat fs-16"></i></a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-xl-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <h5>Notifications</h5>
                                <div>
                                    <a href="#" class="btn btn-light btn-sm">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-4">
                                <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                    <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-27.jpg"
                                        class="rounded-circle border border-2" alt="img">
                                </a>
                                <div class="ms-2">
                                    <h6 class="fs-14 fw-medium text-truncate mb-1">Lex Murphy requested access to UNIX
                                    </h6>
                                    <p class="fs-13 mb-2">Today at 9:42 AM</p>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="avatar avatar-sm border flex-shrink-0 me-2"><img
                                                src="https://smarthr.co.in/demo/html/template/assets/img/social/pdf-icon.svg"
                                                class="w-auto h-auto" alt="Img"></a>
                                        <h6 class="fw-normal"><a href="#">EY_review.pdf</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-4">
                                <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                    <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-28.jpg"
                                        class="rounded-circle border border-2" alt="img">
                                </a>
                                <div class="ms-2">
                                    <h6 class="fs-14 fw-medium text-truncate mb-1">Lex Murphy requested access to UNIX
                                    </h6>
                                    <p class="fs-13 mb-0">Today at 10:00 AM</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-4">
                                <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                    <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-29.jpg"
                                        class="rounded-circle border border-2" alt="img">
                                </a>
                                <div class="ms-2">
                                    <h6 class="fs-14 fw-medium text-truncate mb-1">Lex Murphy requested access to UNIX
                                    </h6>
                                    <p class="fs-13 mb-2">Today at 10:50 AM</p>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="btn btn-primary btn-sm me-2">Approve</a>
                                        <a href="#" class="btn btn-outline-primary btn-sm">Decline</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-4">
                                <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                    <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-30.jpg"
                                        class="rounded-circle border border-2" alt="img">
                                </a>
                                <div class="ms-2">
                                    <h6 class="fs-14 fw-medium text-truncate mb-1">Lex Murphy requested access to UNIX
                                    </h6>
                                    <p class="fs-13 mb-0">Today at 12:00 PM</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                    <img src="https://smarthr.co.in/demo/html/template/assets/img/users/user-33.jpg"
                                        class="rounded-circle border border-2" alt="img">
                                </a>
                                <div class="ms-2">
                                    <h6 class="fs-14 fw-medium text-truncate mb-1">Lex Murphy requested access to UNIX
                                    </h6>
                                    <p class="fs-13 mb-0">Today at 05:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                <h5>Meetings Schedule</h5>
                                <div class="dropdown">
                                    <a href="javascript:void(0);"
                                        class="btn btn-white border btn-sm d-inline-flex align-items-center"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-calendar me-1"></i>Today
                                    </a>
                                    <ul class="dropdown-menu  dropdown-menu-end p-3">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">Today</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">This Month</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">This Year</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body schedule-timeline">
                            <div class="d-flex align-items-start">
                                <div class="d-flex align-items-center active-time">
                                    <span>09:25 AM</span>
                                    <span><i class="ti ti-point-filled text-primary fs-20"></i></span>
                                </div>
                                <div class="flex-fill ps-3 pb-4 timeline-flow">
                                    <div class="bg-light p-2 rounded">
                                        <p class="fw-medium text-gray-9 mb-1">Marketing Strategy Presentation</p>
                                        <span>Marketing</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="d-flex align-items-center active-time">
                                    <span>09:20 AM</span>
                                    <span><i class="ti ti-point-filled text-secondary fs-20"></i></span>
                                </div>
                                <div class="flex-fill ps-3 pb-4 timeline-flow">
                                    <div class="bg-light p-2 rounded">
                                        <p class="fw-medium text-gray-9 mb-1">Design Review Hospital, doctors Management
                                            Project</p>
                                        <span>Review</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="d-flex align-items-center active-time">
                                    <span>09:18 AM</span>
                                    <span><i class="ti ti-point-filled text-warning fs-20"></i></span>
                                </div>
                                <div class="flex-fill ps-3 pb-4 timeline-flow">
                                    <div class="bg-light p-2 rounded">
                                        <p class="fw-medium text-gray-9 mb-1">Birthday Celebration of Employee</p>
                                        <span>Celebration</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="d-flex align-items-center active-time">
                                    <span>09:10 AM</span>
                                    <span><i class="ti ti-point-filled text-success fs-20"></i></span>
                                </div>
                                <div class="flex-fill ps-3 timeline-flow">
                                    <div class="bg-light p-2 rounded">
                                        <p class="fw-medium text-gray-9 mb-1">Update of Project Flow</p>
                                        <span>Development</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer />

    </div>
    <!-- /Page Wrapper -->

    <!-- Add Leaves -->
    <div class="modal fade" id="add_leaves">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Leave</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body pb-0">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Medical Leave</option>
                                        <option>Casual Leave</option>
                                        <option>Annual Leave</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">From </label>
                                    <div class="input-icon-end position-relative">
                                        <input type="text" class="form-control datetimepicker"
                                            placeholder="dd/mm/yyyy">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-calendar text-gray-7"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">To </label>
                                    <div class="input-icon-end position-relative">
                                        <input type="text" class="form-control datetimepicker"
                                            placeholder="dd/mm/yyyy">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-calendar text-gray-7"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No of Days</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Remaining Days</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Reason</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leaves</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Leaves -->




@endsection
@push('after_scripts')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('employee.dashboard.data') }}", // backend route
            type: "GET",
            dataType: "json",
            success: function(response) {
                $('#totalEmployees').text(response.total_employees);
                $('#pendingLeaves').text(response.pending_leaves);
                $('#approvedLeaves').text(response.approved_leaves);
            },
            error: function() {
                console.log('Error loading dashboard data');
            }
        });
    });
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            toastElList.map(function(toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 2000
                }); // 4 sec
                toast.show();
            })
        });
    </script>
@endpush
