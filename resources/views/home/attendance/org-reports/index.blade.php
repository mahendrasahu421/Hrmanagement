@extends('layout.master')
@section('title', $title)
@section('main-section')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                    <p class="text-muted mb-0">View organization-level attendance performance and statistics</p>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="" class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-refresh me-2"></i> Refresh
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <!-- Summary Cards -->
            <!-- Include icons (if not already added in layout) -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 hover-card">
                        <div class="card-body text-center">
                            <div class="icon-circle bg-primary bg-opacity-10 text-primary mb-3 mx-auto">
                                <i class="bi bi-people-fill fs-3"></i>
                            </div>
                            <h6 class="text-muted">Total Employees</h6>
                            <h3 class="fw-bold mb-0">650</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 hover-card">
                        <div class="card-body text-center">
                            <div class="icon-circle bg-success bg-opacity-10 text-success mb-3 mx-auto">
                                <i class="bi bi-graph-up-arrow fs-3"></i>
                            </div>
                            <h6 class="text-muted">Average Attendance (%)</h6>
                            <h3 class="fw-bold text-success mb-0">92%</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 hover-card">
                        <div class="card-body text-center">
                            <div class="icon-circle bg-warning bg-opacity-10 text-warning mb-3 mx-auto">
                                <i class="bi bi-calendar-week fs-3"></i>
                            </div>
                            <h6 class="text-muted">Total Working Days</h6>
                            <h3 class="fw-bold mb-0">22</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 hover-card">
                        <div class="card-body text-center">
                            <div class="icon-circle bg-danger bg-opacity-10 text-danger mb-3 mx-auto">
                                <i class="bi bi-person-dash-fill fs-3"></i>
                            </div>
                            <h6 class="text-muted">Leaves Taken</h6>
                            <h3 class="fw-bold text-danger mb-0">47</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Styles -->
            <style>
                .icon-circle {
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .hover-card {
                    transition: all 0.3s ease;
                }

                .hover-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                }
            </style>

            <!-- /Summary Cards -->

            <!-- Filter Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row g-3 align-items-end">
                        <div class="col-md-2">
                            <label for="month" class="form-label">Select Month</label>
                            <div class="me-3">
                                <div class="input-icon-end position-relative">
                                    <input type="text" class="form-control date-range bookingrange"
                                        placeholder="dd/mm/yyyy - dd/mm/yyyy">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-chevron-down"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="branch" class="form-label">Branch</label>
                            <select id="branch" class="form-select">
                                <option>All Branches</option>
                                <option>Head Office</option>
                                <option>Mumbai</option>
                                <option>Delhi</option>
                                <option>Bangalore</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="department" class="form-label">Department</label>
                            <select id="department" class="form-select">
                                <option>All Departments</option>
                                <option>HR</option>
                                <option>IT</option>
                                <option>Sales</option>
                                <option>Finance</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Designation</label>
                            <select class="form-select">
                                <option>Select Designation</option>
                                <option>Manager</option>
                                <option>Developer</option>
                                <option>Analyst</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Select Employee</label>
                            <select class="form-select">
                                <option>Select Employee</option>
                                <option>Mahendra sahu</option>
                                <option>Ravi Shankar</option>
                                <option>Pritima Shrivastva</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search me-1"></i> Filter Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Filter Section -->

            <!-- Organization Attendance Report Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Department-wise Attendance Report</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Department</th>
                                    <th>Total Employees</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Leave</th>
                                    <th>Late</th>
                                    <th>Attendance (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>IT</td>
                                    <td>120</td>
                                    <td>110</td>
                                    <td>6</td>
                                    <td>3</td>
                                    <td>1</td>
                                    <td><span class="badge bg-success">95%</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>HR</td>
                                    <td>45</td>
                                    <td>41</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td><span class="badge bg-success">91%</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Sales</td>
                                    <td>85</td>
                                    <td>73</td>
                                    <td>8</td>
                                    <td>3</td>
                                    <td>1</td>
                                    <td><span class="badge bg-warning text-dark">86%</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Marketing</td>
                                    <td>65</td>
                                    <td>58</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td><span class="badge bg-info text-dark">89%</span></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Finance</td>
                                    <td>38</td>
                                    <td>35</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>1</td>
                                    <td><span class="badge bg-success">92%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Organization Attendance Report Table -->

            <!-- Charts Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Attendance Trends (Static Preview)</h5>
                </div>
                <div class="card-body">
                    <div class="text-center text-muted py-4">
                        <i class="ti ti-chart-bar fs-1 mb-2 text-primary"></i>
                        <p class="mb-0">Chart integration coming soon...</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
         <x-footer />
        <!-- /Footer -->

    </div>
    <!-- /Page Wrapper -->

@endsection
