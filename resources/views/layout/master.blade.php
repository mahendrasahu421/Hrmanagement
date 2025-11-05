<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $title ?? 'Admin Dashboard | Chitragupta – The HR Guardian')</title>

    <meta name="description"
        content="Chitragupta Employee Portal – Manage your attendance, leaves, payroll, and profile with ease. Access payslips, apply for leave, and track performance in a secure and user-friendly HRM system.">

    <meta name="keywords"
        content="Employee dashboard, HRM employee panel, payroll management, leave tracking, attendance system, employee self service, payslip download, HR portal, profile management, Chitragupta HRMS, workforce management">

    <meta name="author" content="Chitragupta Team">
    <meta name="robots" content="index, follow">



    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontent/assets/img/apple-touch-icon.png') }}">

    <!-- Favicon -->
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('frontent') }}assets/img/favicon.png" type="image/x-icon">

    <!-- Theme Script js -->
    <script src="assets/js/theme-script.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/css/bootstrap.min.css') }}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/icons/feather/feather.css') }}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/tabler-icons/tabler-icons.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/select2/css/select2.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/css/bootstrap-datetimepicker.min.css') }}">

    <!-- Bootstrap Tagsinput CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

    <!-- Summernote CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/summernote/summernote-lite.min.css') }}">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontent/assets/plugins/%40simonwep/pickr/themes/nano.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontent/assets/css/style.css') }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">


    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    {{-- <div id="global-loader">
		<div class="page-loader"></div>
	</div> --}}

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="header">
            <div class="main-header">

                <div class="header-left">
                    <a href="index.html" class="logo">
                        <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                    </a>
                    <a href="index.html" class="dark-logo">
                        <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                    </a>
                </div>

                <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>

                <div class="header-user">
                    <div class="nav user-menu nav-list">

                        <div class="me-auto d-flex align-items-center" id="header-search">
                            <a id="toggle_btn" href="javascript:void(0);" class="btn btn-menubar me-1">
                                <i class="ti ti-arrow-bar-to-left"></i>
                            </a>
                            <!-- Search -->
                            <div class="input-group input-group-flat d-inline-flex me-1">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Search in HRMS">
                                <span class="input-group-text">
                                    <kbd>CTRL + / </kbd>
                                </span>
                            </div>
                            <!-- /Search -->
                            <div class="dropdown crm-dropdown">
                                <a href="#" class="btn btn-menubar me-1" data-bs-toggle="dropdown">
                                    <i class="ti ti-layout-grid"></i>
                                </a>
                                <div class="dropdown-menu dropdown-lg dropdown-menu-start">
                                    <div class="card mb-0 border-0 shadow-none">
                                        <div class="card-header">
                                            <h4>CRM</h4>
                                        </div>
                                        <div class="card-body pb-1">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="contacts.html"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i class="ti ti-user-shield text-default me-2"></i>Contacts
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                    <a href="deals-grid.html"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i
                                                                class="ti ti-heart-handshake text-default me-2"></i>Deals
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                    <a href="pipeline.html"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i
                                                                class="ti ti-timeline-event-text text-default me-2"></i>Pipeline
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="companies-grid.html"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i class="ti ti-building text-default me-2"></i>Companies
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                    <a href="leads-grid.html"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i class="ti ti-user-check text-default me-2"></i>Leads
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                    <a href="activity.html"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i class="ti ti-activity text-default me-2"></i>Activities
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="profile-settings.html" class="btn btn-menubar">
                                <i class="ti ti-settings-cog"></i>
                            </a>
                        </div>


                        <!-- /Horizontal Single -->

                        <div class="d-flex align-items-center">
                            <div class="me-1">
                                <a href="#" class="btn btn-menubar btnFullscreen">
                                    <i class="ti ti-maximize"></i>
                                </a>
                            </div>
                            <div class="dropdown me-1">
                                <a href="#" class="btn btn-menubar" data-bs-toggle="dropdown">
                                    <i class="ti ti-layout-grid-remove"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="card mb-0 border-0 shadow-none">
                                        <div class="card-header">
                                            <h4>Applications</h4>
                                        </div>
                                        <div class="card-body">
                                            <a href="calendar.html" class="d-block pb-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-calendar text-gray-9"></i></span>Calendar
                                            </a>
                                            <a href="todo.html" class="d-block py-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-subtask text-gray-9"></i></span>To Do
                                            </a>
                                            <a href="notes.html" class="d-block py-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-notes text-gray-9"></i></span>Notes
                                            </a>
                                            <a href="file-manager.html" class="d-block py-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-folder text-gray-9"></i></span>File Manager
                                            </a>
                                            <a href="kanban-view.html" class="d-block py-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-layout-kanban text-gray-9"></i></span>Kanban
                                            </a>
                                            <a href="invoices.html" class="d-block py-2 pb-0">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-file-invoice text-gray-9"></i></span>Invoices
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="me-1">
                                <a href="chat.html" class="btn btn-menubar position-relative">
                                    <i class="ti ti-brand-hipchat"></i>
                                    <span
                                        class="badge bg-info rounded-pill d-flex align-items-center justify-content-center header-badge">5</span>
                                </a>
                            </div>
                            <div class="me-1">
                                <a href="email.html" class="btn btn-menubar">
                                    <i class="ti ti-mail"></i>
                                </a>
                            </div>
                            <div class="me-1 notification_item">
                                <a href="#" class="btn btn-menubar position-relative me-1"
                                    id="notification_popup" data-bs-toggle="dropdown">
                                    <i class="ti ti-bell"></i>
                                    <span class="notification-status-dot"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end notification-dropdown p-4">
                                    <div
                                        class="d-flex align-items-center justify-content-between border-bottom p-0 pb-3 mb-3">
                                        <h4 class="notification-title">Notifications (2)</h4>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="text-primary fs-15 me-3 lh-1">Mark all as
                                                read</a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="bg-white dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-calendar-due me-1"></i>Today
                                                </a>
                                                <ul class="dropdown-menu mt-2 p-3">
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                            This Week
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                            Last Week
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                            Last Month
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti-content">
                                        <div class="d-flex flex-column">
                                            <div class="border-bottom mb-3 pb-3">
                                                <a href="activity.html">
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                            <img src="assets/img/profiles/avatar-27.jpg"
                                                                alt="Profile">
                                                        </span>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1"><span
                                                                    class="text-dark fw-semibold">Shawn</span>
                                                                performance in Math is below the threshold.</p>
                                                            <span>Just Now</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="border-bottom mb-3 pb-3">
                                                <a href="activity.html" class="pb-0">
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                            <img src="assets/img/profiles/avatar-23.jpg"
                                                                alt="Profile">
                                                        </span>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1"><span
                                                                    class="text-dark fw-semibold">Sylvia</span> added
                                                                appointment on 02:00 PM</p>
                                                            <span>10 mins ago</span>
                                                            <div
                                                                class="d-flex justify-content-start align-items-center mt-1">
                                                                <span class="btn btn-light btn-sm me-2">Deny</span>
                                                                <span class="btn btn-primary btn-sm">Approve</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="border-bottom mb-3 pb-3">
                                                <a href="activity.html">
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                            <img src="assets/img/profiles/avatar-25.jpg"
                                                                alt="Profile">
                                                        </span>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1">New student record <span
                                                                    class="text-dark fw-semibold"> George</span> is
                                                                created by <span
                                                                    class="text-dark fw-semibold">Teressa</span></p>
                                                            <span>2 hrs ago</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="border-0 mb-3 pb-0">
                                                <a href="activity.html">
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                            <img src="assets/img/profiles/avatar-01.jpg"
                                                                alt="Profile">
                                                        </span>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1">A new teacher record for <span
                                                                    class="text-dark fw-semibold">Elisa</span> </p>
                                                            <span>09:45 AM</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex p-0">
                                        <a href="#" class="btn btn-light w-100 me-2">Cancel</a>
                                        <a href="activity.html" class="btn btn-primary w-100">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown profile-dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center"
                                    data-bs-toggle="dropdown">
                                    <span class="avatar avatar-sm online">
                                        <img src="assets/img/profiles/avatar-12.jpg" alt="Img"
                                            class="img-fluid rounded-circle">
                                    </span>
                                </a>
                                <div class="dropdown-menu shadow-none">
                                    <div class="card mb-0">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <span class="avatar avatar-lg me-2 avatar-rounded">
                                                    <img src="assets/img/profiles/avatar-12.jpg" alt="img">
                                                </span>
                                                <div>
                                                    <h5 class="mb-0">Kevin Larry</h5>
                                                    <p class="fs-12 fw-medium mb-0"><a
                                                            href="https://smarthr.co.in/cdn-cgi/l/email-protection"
                                                            class="__cf_email__"
                                                            data-cfemail="99eef8ebebfcf7d9fce1f8f4e9f5fcb7faf6f4">[email&#160;protected]</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="profile.html">
                                                <i class="ti ti-user-circle me-1"></i>My Profile
                                            </a>
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="bussiness-settings.html">
                                                <i class="ti ti-settings me-1"></i>Settings
                                            </a>

                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="profile-settings.html">
                                                <i class="ti ti-circle-arrow-up me-1"></i>My Account
                                            </a>
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="knowledgebase.html">
                                                <i class="ti ti-question-mark me-1"></i>Knowledge Base
                                            </a>
                                        </div>
                                        <div class="card-footer">
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="{{ route('logout') }}">
                                                <i class="ti ti-login me-2"></i>Logout
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div class="dropdown mobile-user-menu">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="profile-settings.html">Settings</a>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </div>
                <!-- /Mobile Menu -->

            </div>

        </div>
        <!-- /Header -->

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- Logo -->
            <div class="sidebar-logo">
                <a href="index.html" class="logo logo-normal">
                    <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                </a>
                <a href="index.html" class="logo-small">
                    <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                </a>
                <a href="index.html" class="dark-logo">
                    <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                </a>
            </div>
            <!-- /Logo -->
            <div class="modern-profile p-3 pb-0">
                <div class="text-center rounded bg-light p-3 mb-4 user-profile">
                    <div class="avatar avatar-lg online mb-3">
                        <img src="assets/img/profiles/avatar-02.jpg" alt="Img" class="img-fluid rounded-circle">
                    </div>
                    <h6 class="fs-12 fw-normal mb-1">Adrian Herman</h6>
                    <p class="fs-10">System Admin</p>
                </div>
                <div class="sidebar-nav mb-3">
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent"
                        role="tablist">
                        <li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
                        <li class="nav-item"><a class="nav-link border-0" href="chat.html">Chats</a></li>
                        <li class="nav-item"><a class="nav-link border-0" href="email.html">Inbox</a></li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-header p-3 pb-0 pt-2">
                <div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
                    <div class="avatar avatar-md onlin">
                        <img src="assets/img/profiles/avatar-02.jpg" alt="Img" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-start sidebar-profile-info ms-2">
                        <h6 class="fs-12 fw-normal mb-1">Adrian Herman</h6>
                        <p class="fs-10">System Admin</p>
                    </div>
                </div>
                <div class="input-group input-group-flat d-inline-flex mb-4">
                    <span class="input-icon-addon">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Search in HRMS">
                    <span class="input-group-text">
                        <kbd>CTRL + / </kbd>
                    </span>
                </div>
                <div class="d-flex align-items-center justify-content-between menu-item mb-3">
                    <div class="me-3">
                        <a href="calendar.html" class="btn btn-menubar">
                            <i class="ti ti-layout-grid-remove"></i>
                        </a>
                    </div>
                    <div class="me-3">
                        <a href="chat.html" class="btn btn-menubar position-relative">
                            <i class="ti ti-brand-hipchat"></i>
                            <span
                                class="badge bg-info rounded-pill d-flex align-items-center justify-content-center header-badge">5</span>
                        </a>
                    </div>
                    <div class="me-3 notification-item">
                        <a href="activity.html" class="btn btn-menubar position-relative me-1">
                            <i class="ti ti-bell"></i>
                            <span class="notification-status-dot"></span>
                        </a>
                    </div>
                    <div class="me-0">
                        <a href="email.html" class="btn btn-menubar">
                            <i class="ti ti-message"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">

                    <ul>
                        <li class="menu-title"><span>MAIN MENU</span></li>


                        <li>
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard') }}">
                                        <i class="ti ti-layout-navbar"></i><span>Dashboard</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="menu-title"><span>ADMINISTRATION</span></li>
                        <li>
                            <ul>
                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i class="ti ti-settings"></i><span>Masters</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li class="submenu submenu-two">
                                            <a href="javascript:void(0);">Organisation<span
                                                    class="menu-arrow inside-submenu"></span></a>
                                            <ul>
                                                <li><a href="{{ route('masters.organisation.company') }}">Company</a>
                                                </li>
                                                <li><a href="{{ route('masters.organisation.branch') }}">Branch</a>
                                                </li>
                                                <li><a href="{{ route('masters.organisation.department') }}">Department
                                                    </a></li>
                                                <li><a href="{{ route('masters.organisation.designation') }}">Designation
                                                    </a></li>

                                                <li><a href="{{ route('masters.organisation.shift') }}">Shift /
                                                        Working Hours </a>
                                                </li>
                                                <li><a href="{{ route('masters.organisation.leave-type') }}">Leave
                                                        Type
                                                    </a></li>
                                                <li><a href="{{ route('masters.organisation.holiday') }}">Holiday </a>
                                                </li>
                                                <li><a href="{{ route('masters.organisation.policy') }}">Policy </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="submenu submenu-two">
                                            <a href="javascript:void(0);">Payroll
                                                <span class="menu-arrow inside-submenu"></span>
                                            </a>
                                            <ul>
                                                <!-- Salary Setup -->
                                                <li><a href="{{ route('masters.payroll.salary-component') }}">Salary
                                                        Component</a></li>
                                                <li><a href="{{ route('masters.payroll.salary-structure') }}">Salary
                                                        Structure / Template</a></li>
                                                <li><a href="{{ route('masters.payroll.calculation-rules') }}">Calculation
                                                        Rules</a></li>
                                                <li><a href="{{ route('masters.payroll.taxation') }}">Taxation &
                                                        Compliance</a></li>
                                                <li><a
                                                        href="{{ route('masters.payroll.applicability') }}">Applicability</a>
                                                </li>
                                                <li><a href="{{ route('masters.payroll.payment-frequency') }}">Payment
                                                        Frequency</a></li>
                                                <li><a href="{{ route('masters.payroll.payment-mode') }}">Payment
                                                        Mode</a></li>
                                                <li><a href="{{ route('masters.payroll.visibility') }}">Visibility &
                                                        Control</a></li>

                                                {{-- <!-- Payroll Processing -->
                                                <li><a href="{{ route('payroll.process') }}">Payroll Processing</a>
                                                </li>
                                                <li><a href="{{ route('payroll.attendance') }}">Attendance & Input</a>
                                                </li>
                                                <li><a href="{{ route('payroll.overtime') }}">Overtime Calculation</a>
                                                </li>
                                                <li><a href="{{ route('payroll.bonus') }}">Bonus / Incentive</a></li>
                                                <li><a href="{{ route('payroll.loan') }}">Loans & Advances</a></li>
                                                <li><a href="{{ route('payroll.deductions') }}">Deductions</a></li>
                                                <li><a href="{{ route('payroll.arrears') }}">Arrears</a></li> --}}

                                                <!-- Output & Reports -->
                                                {{-- <li><a href="{{ route('payroll.payslip') }}">Payslip Generation</a>
                                                </li>
                                                <li><a href="{{ route('payroll.bank-advice') }}">Bank Advice</a></li>
                                                <li><a href="{{ route('payroll.report') }}">Payroll Reports</a></li>
                                                <li><a href="{{ route('payroll.audit') }}">Payroll Audit Trail</a>
                                                </li> --}}
                                            </ul>
                                        </li>


                                    </ul>
                                </li>

                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i class="ti ti-user-star"></i><span>User Management</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('role') }}">Roles</a></li>
                                        <li><a href="{{ route('permission') }}">Permissions</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <li class="menu-title"><span>HRM</span></li>
                        <li>
                            <ul>
                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i class="ti ti-users"></i><span>Employees</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('employee.create') }}">New Employee</a></li>
                                        <li><a href="{{ route('employee') }}">Employee Lists</a></li>
                                    </ul>
                                </li>


                                <li class="submenu">
                                    <a href="javascript:void(0);" class="subdrop">
                                        <i class="ti ti-file-time"></i><span>Attendance</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li class="submenu submenu-two">
                                            <a href="javascript:void(0);" class="subdrop">Dashboard<span
                                                    class="menu-arrow inside-submenu"></span></a>
                                            <ul>
                                                <li><a href="{{ route('attendance.attendance-dashboard.summary') }}"
                                                        class="">Summary
                                                    </a></li>
                                                <li><a
                                                        href="{{ route('attendance.attendance-dashboard.org-reports') }}">Reports</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="submenu submenu-two">
                                            <a href="javascript:void(0);" class="subdrop"> Daily Attendance <span
                                                    class="menu-arrow inside-submenu"></span></a>
                                            <ul>
                                                <li><a href="{{ route('attendance.daily-attendance.consistent-attendees') }}"
                                                        class="">Consistent
                                                        Attendees
                                                    </a></li>
                                                <li><a href="{{ url('leave.setting.index') }}">Tracking</a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Geo-Fencing </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Biometric Tracking
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="submenu submenu-two">
                                            <a href="javascript:void(0);" class="subdrop"> Request<span
                                                    class="menu-arrow inside-submenu"></span></a>
                                            <ul>
                                                <li><a href="{{ url('leave.index') }}" class="">Leave Requests

                                                    </a></li>
                                                <li><a href="{{ url('leave.index') }}" class="">Missed Punch
                                                        Requests
                                                    </a></li>
                                                <li><a href="{{ url('leave.setting.index') }}">Comp-Off Requests</a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Overtime Requests</a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> WFH Requests
                                                    </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Optional Holiday
                                                        Requests
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="submenu submenu-two">
                                            <a href="javascript:void(0);" class="subdrop"> Work Schedule <span
                                                    class="menu-arrow inside-submenu"></span></a>
                                            <ul>
                                                <li><a href="{{ url('leave.index') }}" class=""> Work Shifts

                                                    </a></li>
                                                <li><a href="{{ url('leave.index') }}" class=""> Shift
                                                        Allowance
                                                    </a></li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Shift Rotation </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Shift Roster </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Week-Offs
                                                    </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Block leaves
                                                    </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Dynamic Week-Off
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ url('leave.setting.index') }}">
                                                Overtime
                                            </a>
                                        </li>
                                        <li class="submenu submenu-two">
                                            <a href="javascript:void(0);" class="subdrop"> Leave <span
                                                    class="menu-arrow inside-submenu"></span></a>
                                            <ul>
                                                <li><a href="{{ url('leave.index') }}" class=""> Leave Types

                                                    </a></li>
                                                <li><a href="{{ url('leave.index') }}" class=""> Shift
                                                        Allowance
                                                    </a></li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Shift Rotation </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Shift Roster </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Week-Offs
                                                    </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Block leaves
                                                    </a>
                                                </li>
                                                <li><a href="{{ url('leave.setting.index') }}"> Dynamic Week-Off
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i class="ti ti-school"></i><span>Performance</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ url('performance-indicator.index') }}">Performance
                                                Indicator</a></li>
                                        <li><a href="{{ url('performance-review.index') }}">Performance
                                                Review</a></li>
                                        <li><a href="{{ url('performance-appraisal.index') }}">Performance
                                                Appraisal</a></li>
                                        <li><a href="{{ url('goal-tracking.index') }}">Goal List</a></li>
                                        <li><a href="{{ url('goal-type.goal-type') }}">Goal Type</a></li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i class="ti ti-edit"></i><span>Training</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ url('training.index') }}">Training List</a></li>
                                        <li><a href="{{ url('trainers.index') }}">Trainers</a></li>
                                        <li><a href="{{ url('training-type.index') }}">Training Type</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="promotion.html">
                                        <i class="ti ti-speakerphone"></i><span>Promotion</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="resignation.html">
                                        <i class="ti ti-external-link"></i><span>Resignation</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="termination.html">
                                        <i class="ti ti-circle-x"></i><span>Termination</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-title"><span>RECRUITMENT</span></li>
                        <li>
                            <ul>
                                <li>
                                    <a href="job-grid.html">
                                        <i class="ti ti-timeline"></i><span>Jobs</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="candidates-grid.html">
                                        <i class="ti ti-user-shield"></i><span>Candidates</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="refferals.html">
                                        <i class="ti ti-ux-circle"></i><span>Referrals</span>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="menu-title"><span>CONTENT</span></li>

                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-user-star"></i><span>Reports</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="expenses-report.html">Expense Report</a></li>
                                <li><a href="invoice-report.html">Invoice Report</a></li>
                                <li><a href="payment-report.html">Payment Report</a></li>
                                <li><a href="project-report.html">Project Report</a></li>
                                <li><a href="task-report.html">Task Report</a></li>
                                <li><a href="user-report.html">User Report</a></li>
                                <li><a href="employee-report.html">Employee Report</a></li>
                                <li><a href="payslip-report.html">Payslip Report</a></li>
                                <li><a href="attendance-report.html">Attendance Report</a></li>
                                <li><a href="leave-report.html">Leave Report</a></li>
                                <li><a href="daily-report.html">Daily Report</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-settings"></i><span>Settings</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">General Settings<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="profile-settings.html">Profile</a></li>
                                        <li><a href="security-settings.html">Security</a></li>
                                        <li><a href="notification-settings.html">Notifications</a></li>
                                        <li><a href="connected-apps.html">Connected Apps</a></li>
                                    </ul>
                                </li>

                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">App Settings<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="salary-settings.html">Salary Settings</a></li>
                                        <li><a href="approval-settings.html">Approval Settings</a></li>
                                        <li><a href="invoice-settings.html">Invoice Settings</a></li>
                                        <li><a href="leave-type.html">Leave Type</a></li>
                                        <li><a href="custom-fields.html">Custom Fields</a></li>
                                    </ul>
                                </li>

                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Financial Settings<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="payment-gateways.html">Payment Gateways</a></li>
                                        <li><a href="tax-rates.html">Tax Rate</a></li>
                                        <li><a href="currencies.html">Currencies</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>



                    </ul>

                </div>
                <div class="slimScrollBar"
                    style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 30px;">
                </div>
                <div class="slimScrollRail"
                    style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                </div>
            </div>
        </div>

        <!-- /Sidebar -->


        @yield('main-section')
    </div> <!-- Bootstrap Core JS -->
    <script data-cfasync="false" src="{{ asset('frontent/assets/email-decode.min.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Feather Icon JS -->
    <script src="{{ asset('frontent/assets/js/feather.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('frontent/assets/js/jquery.slimscroll.min.js') }}"></script>
    {{-- <script src="{{ asset('frontent/assets/js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('frontent/assets/js/dataTables.bootstrap5.min.js') }}"></script> --}}

    <!-- Chart JS -->
    <script src="{{ asset('frontent/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('frontent/assets/plugins/apexchart/chart-data.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('frontent/assets/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('frontent/assets/plugins/chartjs/chart-data.js') }}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{ asset('frontent/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Daterangepikcer JS -->
    <script src="{{ asset('frontent/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Summernote JS -->
    <script src="{{ asset('frontent/assets/plugins/summernote/summernote-lite.min.js') }}"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="{{ asset('frontent/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('frontent/assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('frontent/assets/plugins/%40simonwep/pickr/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('frontent/assets/js/todo.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/theme-colorpicker.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/script.js') }}"></script>
 @stack('after_scripts')
</body>


<!-- Mirrored from smartco.in/demo/html/template/index by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Aug 2025 05:19:55 GMT -->

</html>
