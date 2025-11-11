<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from smarthr.co.in/demo/html/template/index by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Aug 2025 05:16:08 GMT -->

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $title ?? 'Employee Dashboard | Chitragupta – The HR Guardian')</title>

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

        <!-- Header -->
        <div class="header">
            <div class="main-header">

               <div class="header-left">
                    <a href="#" class="logo">
                        <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                    </a>
                    <a href="#" class="dark-logo">
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
                                                    <a href="#"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i class="ti ti-user-shield text-default me-2"></i>Contacts
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                    <a href="#"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i
                                                                class="ti ti-heart-handshake text-default me-2"></i>Deals
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                    <a href="#"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i
                                                                class="ti ti-timeline-event-text text-default me-2"></i>Pipeline
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="#"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i class="ti ti-building text-default me-2"></i>Companies
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                    <a href="#"
                                                        class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                        <span class="d-flex align-items-center me-3">
                                                            <i class="ti ti-user-check text-default me-2"></i>Leads
                                                        </span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </a>
                                                    <a href="#"
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
                            <a href="#"
                                class="btn btn-menubar">
                                <i class="ti ti-settings-cog"></i>
                            </a>
                        </div>

                        <!-- Horizontal Single -->
                        <div class="sidebar sidebar-horizontal" id="horizontal-single">
                            <div class="sidebar-menu">
                                <div class="main-menu">
                                    <ul class="nav-menu">
                                        <li class="menu-title">
                                            <span>Main</span>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-smart-home"></i><span>Dashboard</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a href="">Admin Dashboard</a></li>
                                                <li><a
                                                        href="#">Employee
                                                        Dashboard</a></li>
                                                <li><a
                                                        href="#">Deals
                                                        Dashboard</a></li>
                                                <li><a
                                                        href="#">Leads
                                                        Dashboard</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-user-star"></i><span>Super Admin</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a
                                                        href="#">Dashboard</a>
                                                </li>
                                                <li><a
                                                        href="#">Companies</a>
                                                </li>
                                                <li><a
                                                        href="#">Subscriptions</a>
                                                </li>
                                                <li><a
                                                        href="#">Packages</a>
                                                </li>
                                                <li><a
                                                        href="#">Domain</a>
                                                </li>
                                                <li><a
                                                        href="#">Purchase
                                                        Transaction</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-layout-grid-add"></i><span>Applications</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a
                                                        href="#">Chat</a>
                                                </li>
                                                <li class="submenu submenu-two">
                                                    <a href="#">Calls<span
                                                            class="menu-arrow inside-submenu"></span></a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Voice
                                                                Call</a></li>
                                                        <li><a
                                                                href="#">Video
                                                                Call</a></li>
                                                        <li><a
                                                                href="#">Outgoing
                                                                Call</a></li>
                                                        <li><a
                                                                href="#">Incoming
                                                                Call</a></li>
                                                        <li><a
                                                                href="#">Call
                                                                History</a></li>
                                                    </ul>
                                                </li>
                                                <li><a
                                                        href="#">Calendar</a>
                                                </li>
                                                <li><a
                                                        href="#">Email</a>
                                                </li>
                                                <li><a href="#">To
                                                        Do</a></li>
                                                <li><a
                                                        href="#">Notes</a>
                                                </li>
                                                <li><a
                                                        href="#">File
                                                        Manager</a></li>
                                                <li><a
                                                        href="#">Kanban</a>
                                                </li>
                                                <li><a
                                                        href="#">Invoices</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-layout-board-split"></i><span>Layouts</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Horizontal</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Detached</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Modern</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Two Column </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Hovered</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span>Boxed</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Horizontal Single</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Horizontal Overlay</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Horizontal Box</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Menu Aside</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Transparent</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Without Header</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span>RTL</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#">
                                                        <span>Dark</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-user-star"></i><span>Projects</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a
                                                        href="#"><span>Clients</span>
                                                    </a>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Projects</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Projects</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Tasks</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Task
                                                                Board</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="#">Crm<span
                                                            class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a
                                                                href="#"><span>Contacts</span></a>
                                                        </li>
                                                        <li><a
                                                                href="#"><span>Companies</span></a>
                                                        </li>
                                                        <li><a
                                                                href="#"><span>Deals</span></a>
                                                        </li>
                                                        <li><a
                                                                href="#"><span>Leads</span></a>
                                                        </li>
                                                        <li><a
                                                                href="#"><span>Pipeline</span></a>
                                                        </li>
                                                        <li><a
                                                                href="#"><span>Analytics</span></a>
                                                        </li>
                                                        <li><a
                                                                href="#"><span>Activities</span></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Employees</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Employee
                                                                Lists</a></li>
                                                        <li><a
                                                                href="#">Employee
                                                                Grid</a></li>
                                                        <li><a
                                                                href="#">Employee
                                                                Details</a></li>
                                                        <li><a
                                                                href="#">Departments</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Designations</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Policies</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Tickets</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Tickets</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Ticket
                                                                Details</a></li>
                                                    </ul>
                                                </li>
                                                <li><a
                                                        href="#"><span>Holidays</span></a>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Attendance</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Leaves<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Leaves
                                                                        (Admin)</a></li>
                                                                <li><a
                                                                        href="#">Leave
                                                                        (Employee)</a></li>
                                                                <li><a
                                                                        href="#">Leave
                                                                        Settings</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a
                                                                href="#">Attendance
                                                                (Admin)</a></li>
                                                        <li><a
                                                                href="#">Attendance
                                                                (Employee)</a></li>
                                                        <li><a
                                                                href="#">Timesheets</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Shift
                                                                & Schedule</a></li>
                                                        <li><a
                                                                href="#">Overtime</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Performance</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Performance
                                                                Indicator</a></li>
                                                        <li><a
                                                                href="#">Performance
                                                                Review</a></li>
                                                        <li><a
                                                                href="#">Performance
                                                                Appraisal</a></li>
                                                        <li><a
                                                                href="#">Goal
                                                                List</a></li>
                                                        <li><a
                                                                href="#">Goal
                                                                Type</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Training</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Training
                                                                List</a></li>
                                                        <li><a
                                                                href="#">Trainers</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Training
                                                                Type</a></li>
                                                    </ul>
                                                </li>
                                                <li><a
                                                        href="#"><span>Promotion</span></a>
                                                </li>
                                                <li><a
                                                        href="#"><span>Resignation</span></a>
                                                </li>
                                                <li><a
                                                        href="#"><span>Termination</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-user-star"></i><span>Administration</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Sales</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Estimates</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Invoices</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Payments</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Expenses</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Provident
                                                                Fund</a></li>
                                                        <li><a
                                                                href="#">Taxes</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Accounting</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Categories</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Budgets</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Budget
                                                                Expenses</a></li>
                                                        <li><a
                                                                href="#">Budget
                                                                Revenues</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Payroll</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Employee
                                                                Salary</a></li>
                                                        <li><a
                                                                href="#">Payslip</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Payroll
                                                                Items</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Assets</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Assets</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Asset
                                                                Categories</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Help & Supports</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Knowledge
                                                                Base</a></li>
                                                        <li><a
                                                                href="#">Activities</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>User Management</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Users</a>
                                                        </li>
                                                        <li><a
                                                                href="#">Roles
                                                                & Permissions</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Reports</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Expense
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Invoice
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Payment
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Project
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Task
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">User
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Employee
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Payslip
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Attendance
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Leave
                                                                Report</a></li>
                                                        <li><a
                                                                href="#">Daily
                                                                Report</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Settings</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">General Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Profile</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Security</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Notifications</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Connected
                                                                        Apps</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Website Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Business
                                                                        Settings</a></li>
                                                                <li><a
                                                                        href="#">SEO
                                                                        Settings</a></li>
                                                                <li><a
                                                                        href="#">Localization</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Prefixes</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Preferences</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Appearance</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Language</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Authentication</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">AI
                                                                        Settings</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">App Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Salary
                                                                        Settings</a></li>
                                                                <li><a
                                                                        href="#">Approval
                                                                        Settings</a></li>
                                                                <li><a
                                                                        href="#">Invoice
                                                                        Settings</a></li>
                                                                <li><a
                                                                        href="#">Leave
                                                                        Type</a></li>
                                                                <li><a
                                                                        href="#">Custom
                                                                        Fields</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">System Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Email
                                                                        Settings</a></li>
                                                                <li><a
                                                                        href="#">Email
                                                                        Templates</a></li>
                                                                <li><a
                                                                        href="#">SMS
                                                                        Settings</a></li>
                                                                <li><a
                                                                        href="#">SMS
                                                                        Templates</a></li>
                                                                <li><a
                                                                        href="#">OTP</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">GDPR
                                                                        Cookies</a></li>
                                                                <li><a
                                                                        href="#">Maintenance
                                                                        Mode</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Financial Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Payment
                                                                        Gateways</a></li>
                                                                <li><a
                                                                        href="#">Tax
                                                                        Rate</a></li>
                                                                <li><a
                                                                        href="#">Currencies</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Other Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Custom
                                                                        CSS</a></li>
                                                                <li><a
                                                                        href="#">Custom
                                                                        JS</a></li>
                                                                <li><a
                                                                        href="#">Cronjob</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Storage</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-address#">Ban
                                                                        IP Address</a></li>
                                                                <li><a
                                                                        href="#">Backup</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Clear
                                                                        Cache</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#" class="active">
                                                <i class="ti ti-page-break"></i><span>Pages</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a
                                                        href="#"><span>Starter</span></a>
                                                </li>
                                                <li><a
                                                        href="#"><span>Profile</span></a>
                                                </li>
                                                <li><a
                                                        href="#"><span>Gallery</span></a>
                                                </li>
                                                <li><a
                                                        href="#"><span>Search
                                                            Results</span></a></li>
                                                <li><a
                                                        href="#"><span>Timeline</span></a>
                                                </li>
                                                <li><a
                                                        href="#"><span>Pricing</span></a>
                                                </li>
                                                <li><a
                                                        href="#"><span>Coming
                                                            Soon</span></a></li>
                                                <li><a
                                                        href="#"><span>Under
                                                            Maintenance</span></a></li>
                                                <li><a
                                                        href="#"><span>Under
                                                            Construction</span></a></li>
                                                <li><a href="#"><span>API
                                                            Keys</span></a></li>
                                                <li><a
                                                        href="#"><span>Privacy
                                                            Policy</span></a></li>
                                                <li><a
                                                        href="#"><span>Terms
                                                            & Conditions</span></a></li>
                                                <li class="submenu">
                                                    <a href="#"><span>Content</span> <span
                                                            class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a
                                                                href="#">Pages</a>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Blogs<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">All
                                                                        Blogs</a></li>
                                                                <li><a
                                                                        href="#">Categories</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Comments</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Tags</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Locations<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Countries</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">States</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Cities</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a
                                                                href="#">Testimonials</a>
                                                        </li>
                                                        <li><a
                                                                href="#">FAQ’S</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="#">
                                                        <span>Authentication</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);" class="">Login<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Cover</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Illustration</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Basic</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);" class="">Register<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Cover</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Illustration</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Basic</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu"><a href="javascript:void(0);">Forgot
                                                                Password<span class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Cover</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-2#">Illustration</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-3#">Basic</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Reset Password<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Cover</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-2#">Illustration</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-3#">Basic</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Email Verification<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Cover</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-2#">Illustration</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-3#">Basic</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">2 Step Verification<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#-verification#">Cover</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-verification-2#">Illustration</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-verification-3#">Basic</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a
                                                                href="#">Lock
                                                                Screen</a></li>
                                                        <li><a
                                                                href="#">404
                                                                Error</a></li>
                                                        <li><a
                                                                href="#">500
                                                                Error</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="#" class="active">
                                                        <span>UI Interface</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Base UI<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Alerts</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Accordion</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Avatar</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Badges</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Border</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Buttons</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-group#">Button
                                                                        Group</a></li>
                                                                <li><a
                                                                        href="#">Breadcrumb</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Card</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Carousel</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Colors</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Dropdowns</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Grid</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Images</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Lightbox</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Media</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Modals</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Offcanvas</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Pagination</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Popovers</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Progress</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Placeholders</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Spinner</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Sweet
                                                                        Alerts</a></li>
                                                                <li><a
                                                                        href="#-tabs#">Tabs</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Toasts</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Tooltips</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Typography</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Video</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Sortable</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Swiperjs</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);"> Advanced UI<span
                                                                    class="menu-arrow"></span>
                                                            </a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Ribbon</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Clipboard</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-drop#">Drag
                                                                        & Drop</a></li>
                                                                <li><a
                                                                        href="#">Range
                                                                        Slider</a></li>
                                                                <li><a
                                                                        href="#">Rating</a>
                                                                </li>
                                                                <li><a
                                                                        href="#-editor#">Text
                                                                        Editor</a></li>
                                                                <li><a
                                                                        href="#">Counter</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Scrollbar</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Sticky
                                                                        Note</a></li>
                                                                <li><a
                                                                        href="#">Timeline</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Forms<span
                                                                    class="menu-arrow"></span> </a>
                                                            <ul>
                                                                <li class="submenu submenu-two">
                                                                    <a href="javascript:void(0);">Form Elements<span
                                                                            class="menu-arrow inside-submenu"></span></a>
                                                                    <ul>
                                                                        <li><a
                                                                                href="#-inputs#">Basic
                                                                                Inputs</a></li>
                                                                        <li><a
                                                                                href="#-radios#">Checkbox
                                                                                & Radios</a>
                                                                        </li>
                                                                        <li><a
                                                                                href="#-groups#">Input
                                                                                Groups</a></li>
                                                                        <li><a
                                                                                href="#-gutters#">Grid
                                                                                & Gutters</a></li>
                                                                        <li><a
                                                                                href="#">Form
                                                                                Select</a></li>
                                                                        <li><a
                                                                                href="#">Input
                                                                                Masks</a></li>
                                                                        <li><a
                                                                                href="#">File
                                                                                Uploads</a></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="submenu submenu-two">
                                                                    <a href="javascript:void(0);">Layouts<span
                                                                            class="menu-arrow inside-submenu"></span></a>
                                                                    <ul>
                                                                        <li><a
                                                                                href="#">Horizontal
                                                                                Form</a></li>
                                                                        <li><a
                                                                                href="#">Vertical
                                                                                Form</a></li>
                                                                        <li><a
                                                                                href="#-labels#">Floating
                                                                                Labels</a></li>
                                                                    </ul>
                                                                </li>
                                                                <li><a
                                                                        href="#">Form
                                                                        Validation</a></li>
                                                                <li><a
                                                                        href="#">Select2</a>
                                                                </li>
                                                                <li><a
                                                                        href="#">Form
                                                                        Wizard</a></li>
                                                                <li><a
                                                                        href="#">Form
                                                                        Picker</a></li>
                                                                <li><a
                                                                        href="#">Form
                                                                        Picker</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);" class="active">Tables<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="#"
                                                                        class="active">Basic Tables </a></li>
                                                                <li><a
                                                                        href="#">Data
                                                                        Table </a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Charts<span
                                                                    class="menu-arrow"></span>
                                                            </a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Apex
                                                                        Charts</a></li>
                                                                <li><a
                                                                        href="#">Chart
                                                                        C3</a></li>
                                                                <li><a
                                                                        href="#">Chart
                                                                        Js</a></li>
                                                                <li><a
                                                                        href="#">Morris
                                                                        Charts</a></li>
                                                                <li><a
                                                                        href="#">Flot
                                                                        Charts</a></li>
                                                                <li><a
                                                                        href="#">Peity
                                                                        Charts</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Icons<span
                                                                    class="menu-arrow"></span>
                                                            </a>
                                                            <ul>
                                                                <li><a
                                                                        href="#">Fontawesome
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Tabler
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Bootstrap
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Remix
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Feather
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Ionic
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Material
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Pe7
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Simpleline
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Themify
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Weather
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Typicon
                                                                        Icons</a></li>
                                                                <li><a
                                                                        href="#">Flag
                                                                        Icons</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">
                                                                <span>Maps</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <ul>
                                                                <li>
                                                                    <a
                                                                        href="#">Vector</a>
                                                                </li>
                                                                <li>
                                                                    <a
                                                                        href="#">Leaflet</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Documentation</a></li>
                                                <li><a href="#">Change Log</a></li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Multi Level</span><span
                                                            class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a href="javascript:void(0);">Multilevel 1</a></li>
                                                        <li class="submenu submenu-two">
                                                            <a href="javascript:void(0);">Multilevel 2<span
                                                                    class="menu-arrow inside-submenu"></span></a>
                                                            <ul>
                                                                <li><a href="javascript:void(0);">Multilevel 2.1</a>
                                                                </li>
                                                                <li class="submenu submenu-two submenu-three">
                                                                    <a href="javascript:void(0);">Multilevel 2.2<span
                                                                            class="menu-arrow inside-submenu inside-submenu-two"></span></a>
                                                                    <ul>
                                                                        <li><a href="javascript:void(0);">Multilevel
                                                                                2.2.1</a></li>
                                                                        <li><a href="javascript:void(0);">Multilevel
                                                                                2.2.2</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="javascript:void(0);">Multilevel 3</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                                            <a href="#"
                                                class="d-block pb-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-calendar text-gray-9"></i></span>Calendar
                                            </a>
                                            <a href="#"
                                                class="d-block py-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-subtask text-gray-9"></i></span>To Do
                                            </a>
                                            <a href="#"
                                                class="d-block py-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-notes text-gray-9"></i></span>Notes
                                            </a>
                                            <a href="#"
                                                class="d-block py-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-folder text-gray-9"></i></span>File Manager
                                            </a>
                                            <a href="#"
                                                class="d-block py-2">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-layout-kanban text-gray-9"></i></span>Kanban
                                            </a>
                                            <a href="#"
                                                class="d-block py-2 pb-0">
                                                <span class="avatar avatar-md bg-transparent-dark me-2"><i
                                                        class="ti ti-file-invoice text-gray-9"></i></span>Invoices
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="me-1">
                                <a href="#"
                                    class="btn btn-menubar position-relative">
                                    <i class="ti ti-brand-hipchat"></i>
                                    <span
                                        class="badge bg-info rounded-pill d-flex align-items-center justify-content-center header-badge">5</span>
                                </a>
                            </div>
                            <div class="me-1">
                                <a href="#" class="btn btn-menubar"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-message"></i>
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
                                                <a href="#">
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                            <img src="#/profiles/avatar-27.jpg"
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
                                                <a href="#"
                                                    class="pb-0">
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                            <img src="#/profiles/avatar-23.jpg"
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
                                                <a href="#">
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                            <img src="#/profiles/avatar-25.jpg"
                                                                alt="Profile">
                                                        </span>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1">New student record <span
                                                                    class="text-dark fw-semibold"> George</span> is
                                                                created by <span class="text-dark fw-semibold">
                                                                    Teressa</span></p>
                                                            <span>2 hrs ago</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="border-0 mb-3 pb-0">
                                                <a href="#">
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                            <img src="#/profiles/avatar-01.jpg"
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
                                        <a href="#"
                                            class="btn btn-primary w-100">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown profile-dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center"
                                    data-bs-toggle="dropdown">
                                    <span class="avatar avatar-sm online">
                                        <img src="#/profiles/avatar-12.jpg"
                                            alt="Img" class="img-fluid rounded-circle">
                                    </span>
                                </a>
                                <div class="dropdown-menu shadow-none">
                                    <div class="card mb-0">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <span class="avatar avatar-lg me-2 avatar-rounded">
                                                    <img src="#/profiles/avatar-12.jpg"
                                                        alt="img">
                                                </span>
                                                <div>
                                                    <h5 class="mb-0">Kevin Larry</h5>
                                                    <p class="fs-12 fw-medium mb-0"><a
                                                            href="#"
                                                            class="__cf_email__"
                                                            data-cfemail="d9aeb8ababbcb799bca1b8b4a9b5bcf7bab6b4">[email&#160;protected]</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="#">
                                                <i class="ti ti-user-circle me-1"></i>My Profile
                                            </a>
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="#">
                                                <i class="ti ti-settings me-1"></i>Settings
                                            </a>
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="#">
                                                <i class="ti ti-circle-arrow-up me-1"></i>My Account
                                            </a>
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="#">
                                                <i class="ti ti-question-mark me-1"></i>Knowledge Base
                                            </a>
                                        </div>
                                        <div class="card-footer py-1">
                                            <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                                href="{{ route('employee.logout') }}"><i
                                                    class="ti ti-login me-2"></i>Logout</a>
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
                        <a class="dropdown-item" href="#">My
                            Profile</a>
                        <a class="dropdown-item"
                            href="#">Settings</a>
                        <a class="dropdown-item" href="#">Logout</a>
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
                <a href="#" class="logo logo-normal">
                    <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                </a>
                <a href="#" class="logo-small">
                    <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                </a>
                <a href="#" class="dark-logo">
                    <img src="{{ asset('frontent/assets/img/icons/logo.png') }}" alt="Logo">
                </a>
            </div>
            <!-- /Logo -->
            <div class="modern-profile p-3 pb-0">
                <div class="text-center rounded bg-light p-3 mb-4 user-profile">
                    <div class="avatar avatar-lg online mb-3">
                        <img src="#/profiles/avatar-02.jpg"
                            alt="Img" class="img-fluid rounded-circle">
                    </div>
                    <h6 class="fs-12 fw-normal mb-1">Adrian Herman</h6>
                    <p class="fs-10">System Admin</p>
                </div>
                <div class="sidebar-nav mb-3">
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent"
                        role="tablist">
                        <li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
                        <li class="nav-item"><a class="nav-link border-0"
                                href="#">Chats</a></li>
                        <li class="nav-item"><a class="nav-link border-0"
                                href="#">Inbox</a></li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-header p-3 pb-0 pt-2">
                <div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
                    <div class="avatar avatar-md onlin">
                        <img src="#/profiles/avatar-02.jpg"
                            alt="Img" class="img-fluid rounded-circle">
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
                        <a href="#" class="btn btn-menubar">
                            <i class="ti ti-layout-grid-remove"></i>
                        </a>
                    </div>
                    <div class="me-3">
                        <a href="#"
                            class="btn btn-menubar position-relative">
                            <i class="ti ti-brand-hipchat"></i>
                            <span
                                class="badge bg-info rounded-pill d-flex align-items-center justify-content-center header-badge">5</span>
                        </a>
                    </div>
                    <div class="me-3 notification-item">
                        <a href="#"
                            class="btn btn-menubar position-relative me-1">
                            <i class="ti ti-bell"></i>
                            <span class="notification-status-dot"></span>
                        </a>
                    </div>
                    <div class="me-0">
                        <a href="#" class="btn btn-menubar">
                            <i class="ti ti-message"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title"><span>Dashboard</span></li>
                        <li>
                            <ul>
                                <li>
                                    <a href="{{ url('dashboard') }}">
                                        <i class="ti ti-layout-navbar"></i><span>Dashboard</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="menu-title"><span>Leave Management</span></li>
                        <li>
                            <ul>
                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i class="ti ti-smart-home"></i><span>Leave Management</span><span
                                            class="menu-arrow"></span>
                                    </a>
                                    <ul>

                                        <li><a href="{{ route('employee.leaves.apply') }}">Apply Leaves
                                            </a></li>
                                        <li><a href="{{ route('employee.leaves') }}">Leaves List
                                            </a></li>
                                        <li><a href="#">Holiday List
                                            </a></li>

                                    </ul>
                                </li>

                            </ul>
                        </li>



                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->






        @yield('main-section')
       
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> --}}
    </div> <!-- Bootstrap Core JS -->
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('frontent/assets/js/jquery-3.7.1.min.js') }}"></script>
   

    <!-- Feather Icon JS -->
    <script src="{{ asset('frontent/assets/js/feather.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('frontent/assets/js/jquery.slimscroll.min.js') }}"></script>

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

    <!-- Custom JS -->
    <script src="{{ asset('frontent/assets/js/todo.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/theme-colorpicker.js') }}"></script>
    <script src="{{ asset('frontent/assets/js/script.js') }}"></script>
 @stack('after_scripts')
</body>


<!-- Mirrored from smarthr.co.in/demo/html/template/index by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Aug 2025 05:19:55 GMT -->

</html>
