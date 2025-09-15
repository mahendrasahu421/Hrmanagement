<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from smarthr.co.in/demo/html/template/index by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Aug 2025 05:16:08 GMT -->

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRXpert Dashboard | HRM, Payroll & CRM Admin Template</title>

    <meta name="description"
        content="HRXpert - A responsive Bootstrap 5 admin dashboard template for HRM, payroll, attendance, recruitment, and team management. Streamline your workforce management with an intuitive interface.">
    <meta name="keywords"
        content="HR dashboard, HRM admin template, Bootstrap 5 HR template, employee management, payroll, attendance, recruitment, HR analytics, CRM dashboard, team management">
    <meta name="author" content="HRXpert">
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
    <link rel="stylesheet" href="{{ asset('frontent/assets/css/animate.css') }}">

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
    <link rel="stylesheet" href="{{ asset('frontent/assets/css/dataTables.bootstrap5.min.css') }}">

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


    <link rel="stylesheet" href="{{ asset('datatables/dataTables.css') }}" />
    @section('styles')

    @show

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

                        <!-- Horizontal Single -->
                        <div class="sidebar sidebar-horizontal" id="horizontal-single">
                            <div class="sidebar-menu">
                                <div class="main-menu">
                                    <ul class="nav-menu">
                                        <li class="menu-title">
                                            <span>Main</span>
                                        </li>
                                        <li class="submenu">
                                            <a href="#" class="active">
                                                <i class="ti ti-smart-home"></i><span>Dashboard</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a href="index.html" class="active">Admin Dashboard</a></li>
                                                <li><a href="employee-dashboard.html">Employee Dashboard</a></li>
                                                <li><a href="deals-dashboard.html">Deals Dashboard</a></li>
                                                <li><a href="leads-dashboard.html">Leads Dashboard</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-user-star"></i><span>Super Admin</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a href="dashboard.html">Dashboard</a></li>
                                                <li><a href="companies.html">Companies</a></li>
                                                <li><a href="subscription.html">Subscriptions</a></li>
                                                <li><a href="packages.html">Packages</a></li>
                                                <li><a href="domain.html">Domain</a></li>
                                                <li><a href="purchase-transaction.html">Purchase Transaction</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-layout-grid-add"></i><span>Applications</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a href="chat.html">Chat</a></li>
                                                <li class="submenu submenu-two">
                                                    <a href="call.html">Calls<span
                                                            class="menu-arrow inside-submenu"></span></a>
                                                    <ul>
                                                        <li><a href="voice-call.html">Voice Call</a></li>
                                                        <li><a href="video-call.html">Video Call</a></li>
                                                        <li><a href="outgoing-call.html">Outgoing Call</a></li>
                                                        <li><a href="incoming-call.html">Incoming Call</a></li>
                                                        <li><a href="call-history.html">Call History</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="calendar.html">Calendar</a></li>
                                                <li><a href="email.html">Email</a></li>
                                                <li><a href="todo.html">To Do</a></li>
                                                <li><a href="notes.html">Notes</a></li>
                                                <li><a href="file-manager.html">File Manager</a></li>
                                                <li><a href="kanban-view.html">Kanban</a></li>
                                                <li><a href="invoices.html">Invoices</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-layout-board-split"></i><span>Layouts</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="layout-horizontal.html">
                                                        <span>Horizontal</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-detached.html">
                                                        <span>Detached</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-modern.html">
                                                        <span>Modern</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-two-column.html">
                                                        <span>Two Column </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-hovered.html">
                                                        <span>Hovered</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-box.html">
                                                        <span>Boxed</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-horizontal-single.html">
                                                        <span>Horizontal Single</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-horizontal-overlay.html">
                                                        <span>Horizontal Overlay</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-horizontal-box.html">
                                                        <span>Horizontal Box</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-horizontal-sidemenu.html">
                                                        <span>Menu Aside</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-vertical-transparent.html">
                                                        <span>Transparent</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-without-header.html">
                                                        <span>Without Header</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-rtl.html">
                                                        <span>RTL</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="layout-dark.html">
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
                                                    <a href="clients-grid.html"><span>Clients</span>
                                                    </a>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Projects</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="projects-grid.html">Projects</a></li>
                                                        <li><a href="tasks.html">Tasks</a></li>
                                                        <li><a href="task-board.html">Task Board</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="call.html">Crm<span class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a href="contacts-grid.html"><span>Contacts</span></a></li>
                                                        <li><a href="companies-grid.html"><span>Companies</span></a>
                                                        </li>
                                                        <li><a href="deals-grid.html"><span>Deals</span></a></li>
                                                        <li><a href="leads-grid.html"><span>Leads</span></a></li>
                                                        <li><a href="pipeline.html"><span>Pipeline</span></a></li>
                                                        <li><a href="analytics.html"><span>Analytics</span></a></li>
                                                        <li><a href="activity.html"><span>Activities</span></a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Employees</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="employees.html">Employee Lists</a></li>
                                                        <li><a href="employees-grid.html">Employee Grid</a></li>
                                                        <li><a href="employee-details.html">Employee Details</a></li>
                                                        <li><a href="departments.html">Departments</a></li>
                                                        <li><a href="designations.html">Designations</a></li>
                                                        <li><a href="policy.html">Policies</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Tickets</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="tickets.html">Tickets</a></li>
                                                        <li><a href="ticket-details.html">Ticket Details</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="holidays.html"><span>Holidays</span></a></li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Attendance</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Leaves<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="leaves.html">Leaves (Admin)</a></li>
                                                                <li><a href="leaves-employee.html">Leave (Employee)</a>
                                                                </li>
                                                                <li><a href="leave-settings.html">Leave Settings</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="attendance-admin.html">Attendance (Admin)</a></li>
                                                        <li><a href="attendance-employee.html">Attendance
                                                                (Employee)</a></li>
                                                        <li><a href="timesheets.html">Timesheets</a></li>
                                                        <li><a href="schedule-timing.html">Shift & Schedule</a></li>
                                                        <li><a href="overtime.html">Overtime</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Performance</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="performance-indicator.html">Performance
                                                                Indicator</a></li>
                                                        <li><a href="performance-review.html">Performance Review</a>
                                                        </li>
                                                        <li><a href="performance-appraisal.html">Performance
                                                                Appraisal</a></li>
                                                        <li><a href="goal-tracking.html">Goal List</a></li>
                                                        <li><a href="goal-type.html">Goal Type</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Training</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="training.html">Training List</a></li>
                                                        <li><a href="trainers.html">Trainers</a></li>
                                                        <li><a href="training-type.html">Training Type</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="promotion.html"><span>Promotion</span></a></li>
                                                <li><a href="resignation.html"><span>Resignation</span></a></li>
                                                <li><a href="termination.html"><span>Termination</span></a></li>
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
                                                        <li><a href="estimates.html">Estimates</a></li>
                                                        <li><a href="invoices.html">Invoices</a></li>
                                                        <li><a href="payments.html">Payments</a></li>
                                                        <li><a href="expenses.html">Expenses</a></li>
                                                        <li><a href="provident-fund.html">Provident Fund</a></li>
                                                        <li><a href="taxes.html">Taxes</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Accounting</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="categories.html">Categories</a></li>
                                                        <li><a href="budgets.html">Budgets</a></li>
                                                        <li><a href="budget-expenses.html">Budget Expenses</a></li>
                                                        <li><a href="budget-revenues.html">Budget Revenues</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Payroll</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="employee-salary.html">Employee Salary</a></li>
                                                        <li><a href="payslip.html">Payslip</a></li>
                                                        <li><a href="payroll.html">Payroll Items</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Assets</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="assets/index.html">Assets</a></li>
                                                        <li><a href="asset-categories.html">Asset Categories</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Help & Supports</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="knowledgebase.html">Knowledge Base</a></li>
                                                        <li><a href="activity.html">Activities</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>User Management</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li><a href="users.html">Users</a></li>
                                                        <li><a href="roles-permissions.html">Roles & Permissions</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"><span>Reports</span>
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
                                                    <a href="javascript:void(0);"><span>Settings</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <ul>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">General Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="profile-settings.html">Profile</a></li>
                                                                <li><a href="security-settings.html">Security</a></li>
                                                                <li><a
                                                                        href="notification-settings.html">Notifications</a>
                                                                </li>
                                                                <li><a href="connected-apps.html">Connected Apps</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Website Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="bussiness-settings.html">Business
                                                                        Settings</a></li>
                                                                <li><a href="seo-settings.html">SEO Settings</a></li>
                                                                <li><a
                                                                        href="localization-settings.html">Localization</a>
                                                                </li>
                                                                <li><a href="prefixes.html">Prefixes</a></li>
                                                                <li><a href="preferences.html">Preferences</a></li>
                                                                <li><a href="performance-appraisal.html">Appearance</a>
                                                                </li>
                                                                <li><a href="language.html">Language</a></li>
                                                                <li><a
                                                                        href="authentication-settings.html">Authentication</a>
                                                                </li>
                                                                <li><a href="ai-settings.html">AI Settings</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">App Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="salary-settings.html">Salary Settings</a>
                                                                </li>
                                                                <li><a href="approval-settings.html">Approval
                                                                        Settings</a></li>
                                                                <li><a href="invoice-settings.html">Invoice
                                                                        Settings</a></li>
                                                                <li><a href="leave-type.html">Leave Type</a></li>
                                                                <li><a href="custom-fields.html">Custom Fields</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">System Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="email-settings.html">Email Settings</a>
                                                                </li>
                                                                <li><a href="email-template.html">Email Templates</a>
                                                                </li>
                                                                <li><a href="sms-settings.html">SMS Settings</a></li>
                                                                <li><a href="sms-template.html">SMS Templates</a></li>
                                                                <li><a href="otp-settings.html">OTP</a></li>
                                                                <li><a href="gdpr.html">GDPR Cookies</a></li>
                                                                <li><a href="maintenance-mode.html">Maintenance
                                                                        Mode</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Financial Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="payment-gateways.html">Payment
                                                                        Gateways</a></li>
                                                                <li><a href="tax-rates.html">Tax Rate</a></li>
                                                                <li><a href="currencies.html">Currencies</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Other Settings<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="custom-css.html">Custom CSS</a></li>
                                                                <li><a href="custom-js.html">Custom JS</a></li>
                                                                <li><a href="cronjob.html">Cronjob</a></li>
                                                                <li><a href="storage-settings.html">Storage</a></li>
                                                                <li><a href="ban-ip-address.html">Ban IP Address</a>
                                                                </li>
                                                                <li><a href="backup.html">Backup</a></li>
                                                                <li><a href="clear-cache.html">Clear Cache</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="#">
                                                <i class="ti ti-page-break"></i><span>Pages</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a href="starter.html"><span>Starter</span></a></li>
                                                <li><a href="profile.html"><span>Profile</span></a></li>
                                                <li><a href="gallery.html"><span>Gallery</span></a></li>
                                                <li><a href="search-result.html"><span>Search Results</span></a></li>
                                                <li><a href="timeline.html"><span>Timeline</span></a></li>
                                                <li><a href="pricing.html"><span>Pricing</span></a></li>
                                                <li><a href="coming-soon.html"><span>Coming Soon</span></a></li>
                                                <li><a href="under-maintenance.html"><span>Under Maintenance</span></a>
                                                </li>
                                                <li><a href="under-construction.html"><span>Under
                                                            Construction</span></a></li>
                                                <li><a href="api-keys.html"><span>API Keys</span></a></li>
                                                <li><a href="privacy-policy.html"><span>Privacy Policy</span></a></li>
                                                <li><a href="terms-condition.html"><span>Terms & Conditions</span></a>
                                                </li>
                                                <li class="submenu">
                                                    <a href="#"><span>Content</span> <span
                                                            class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a href="pages.html">Pages</a></li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Blogs<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="blogs.html">All Blogs</a></li>
                                                                <li><a href="blog-categories.html">Categories</a></li>
                                                                <li><a href="blog-comments.html">Comments</a></li>
                                                                <li><a href="blog-tags.html">Tags</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Locations<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="countries.html">Countries</a></li>
                                                                <li><a href="states.html">States</a></li>
                                                                <li><a href="cities.html">Cities</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="testimonials.html">Testimonials</a></li>
                                                        <li><a href="faq.html">FAQ’S</a></li>
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
                                                                <li><a href="login.html">Cover</a></li>
                                                                <li><a href="login-2.html">Illustration</a></li>
                                                                <li><a href="login-3.html">Basic</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);" class="">Register<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="register.html">Cover</a></li>
                                                                <li><a href="register-2.html">Illustration</a></li>
                                                                <li><a href="register-3.html">Basic</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu"><a href="javascript:void(0);">Forgot
                                                                Password<span class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="forgot-password.html">Cover</a></li>
                                                                <li><a href="forgot-password-2.html">Illustration</a>
                                                                </li>
                                                                <li><a href="forgot-password-3.html">Basic</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Reset Password<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="reset-password.html">Cover</a></li>
                                                                <li><a href="reset-password-2.html">Illustration</a>
                                                                </li>
                                                                <li><a href="reset-password-3.html">Basic</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">Email Verification<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="email-verification.html">Cover</a></li>
                                                                <li><a
                                                                        href="email-verification-2.html">Illustration</a>
                                                                </li>
                                                                <li><a href="email-verification-3.html">Basic</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="submenu">
                                                            <a href="javascript:void(0);">2 Step Verification<span
                                                                    class="menu-arrow"></span></a>
                                                            <ul>
                                                                <li><a href="two-step-verification.html">Cover</a></li>
                                                                <li><a
                                                                        href="two-step-verification-2.html">Illustration</a>
                                                                </li>
                                                                <li><a href="two-step-verification-3.html">Basic</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="lock-screen.html">Lock Screen</a></li>
                                                        <li><a href="error-404.html">404 Error</a></li>
                                                        <li><a href="error-500.html">500 Error</a></li>
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
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 264px;">
                <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 232px;">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="menu-title"><span>MAIN MENU</span></li>
                           
                           
                            <li>
                                <ul>
                                    <li>
                                        <a href="{{ route('hr.dashboard') }}">
                                            <i class="ti ti-layout-navbar"></i><span>Dashboard</span>
                                        </a>
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
                                            <li><a href="{{ route('hr.employee.index') }}">Employee Lists</a></li>
                                           
                                            {{-- <li><a href="{{ route('hr.employee-details') }}">Employee Details</a></li> --}}
                                            <li><a href="{{ route('hr.employee.departments') }}">Departments</a></li>
                                            <li><a href="{{ route('hr.employee.designations') }}">Designations</a></li>
                                            <li><a href="{{ route('hr.employee.policy') }}">Policies</a></li>
                                         
                                        </ul>
                                    </li>
                                    
                                    <li>
                                        <a href="holidays.html">
                                            <i class="ti ti-calendar-event"></i><span>Holidays</span>
                                        </a>
                                    </li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);" class="active subdrop">
                                            <i class="ti ti-file-time"></i><span>Attendance</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul>
                                            <li class="submenu submenu-two">
                                                <a href="javascript:void(0);" class="active subdrop">Leaves<span
                                                        class="menu-arrow inside-submenu"></span></a>
                                                <ul>
                                                    <li><a href="leaves.html" class="active">Leaves (Admin)</a></li>
                                                    <li><a href="leaves-employee.html">Leave (Employee)</a></li>
                                                    <li><a href="leave-settings.html">Leave Settings</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="attendance-admin.html">Attendance (Admin)</a></li>
                                            <li><a href="attendance-employee.html">Attendance (Employee)</a></li>
                                            <li><a href="timesheets.html">Timesheets</a></li>
                                            <li><a href="schedule-timing.html">Shift &amp; Schedule</a></li>
                                            <li><a href="overtime.html">Overtime</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);">
                                            <i class="ti ti-school"></i><span>Performance</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul>
                                            <li><a href="performance-indicator.html">Performance Indicator</a></li>
                                            <li><a href="performance-review.html">Performance Review</a></li>
                                            <li><a href="performance-appraisal.html">Performance Appraisal</a></li>
                                            <li><a href="goal-tracking.html">Goal List</a></li>
                                            <li><a href="goal-type.html">Goal Type</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);">
                                            <i class="ti ti-edit"></i><span>Training</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul>
                                            <li><a href="training.html">Training List</a></li>
                                            <li><a href="trainers.html">Trainers</a></li>
                                            <li><a href="training-type.html">Training Type</a></li>
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
                           
                            <li class="menu-title"><span>ADMINISTRATION</span></li>
                            <li>
                                <ul>
                                  
                                   
                                    <li class="submenu">
                                        <a href="javascript:void(0);">
                                            <i class="ti ti-user-star"></i><span>User Management</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul>
                                            <li><a href="users.html">Users</a></li>
                                            <li><a href="roles-permissions.html">Roles &amp; Permissions</a></li>
                                        </ul>
                                    </li>
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
                            </li>
                            <li class="menu-title"><span>CONTENT</span></li>
                         
                           
                        
                           
                            
                        </ul>
                    </div>
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
    @section('script')
    @show
</body>


<!-- Mirrored from smarthr.co.in/demo/html/template/index by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Aug 2025 05:19:55 GMT -->

</html>
