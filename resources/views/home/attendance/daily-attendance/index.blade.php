@extends('layout.master')
@section('title', $title)
@section('main-section')

    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">{{ $title }}</h2>
                    <p class="text-muted mb-0">View employees with consistent attendance records</p>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{ url()->current() }}" class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-refresh me-2"></i> Refresh
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-success text-white rounded-circle me-3">
                                <i class="ti ti-calendar-check fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Top Consistent</h6>
                                <h4 class="fw-bold mb-0">12</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-warning text-white rounded-circle me-3">
                                <i class="ti ti-clock fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Moderately Consistent</h6>
                                <h4 class="fw-bold mb-0">8</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-danger text-white rounded-circle me-3">
                                <i class="ti ti-alert-triangle fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Low Attendance</h6>
                                <h4 class="fw-bold mb-0">5</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-info text-white rounded-circle me-3">
                                <i class="ti ti-users fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Total Employees</h6>
                                <h4 class="fw-bold mb-0">25</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Summary Cards -->

            <!-- Filter Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row g-3 align-items-end" method="GET" action="">
                        <div class="col-md-3">
                            <label for="month" class="form-label">Month</label>
                            <select id="month" name="month" class="form-select">
                                <option value="">All Months</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="year" class="form-label">Year</label>
                            <select id="year" name="year" class="form-select">
                                @for ($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="department" class="form-label">Department</label>
                            <select id="department" name="department" class="form-select">
                                <option value="">All Departments</option>
                                <option value="HR">HR</option>
                                <option value="IT">IT</option>
                                <option value="Sales">Sales</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search me-1"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Filter Section -->

            <!-- Consistent Attendees Table -->
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Total Present Days</th>
                                    <th>Consecutive Days</th>
                                    <th>Consistency %</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><strong>Rohit Sharma</strong></td>
                                    <td>IT</td>
                                    <td>October</td>
                                    <td>2025</td>
                                    <td>28</td>
                                    <td>15</td>
                                    <td><span class="badge bg-success">95%</span></td>
                                    <td>Excellent Consistency</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><strong>Priya Verma</strong></td>
                                    <td>Marketing</td>
                                    <td>October</td>
                                    <td>2025</td>
                                    <td>25</td>
                                    <td>10</td>
                                    <td><span class="badge bg-warning text-dark">83%</span></td>
                                    <td>Good</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><strong>Vikas Mehta</strong></td>
                                    <td>Sales</td>
                                    <td>October</td>
                                    <td>2025</td>
                                    <td>20</td>
                                    <td>7</td>
                                    <td><span class="badge bg-danger">70%</span></td>
                                    <td>Needs Improvement</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Consistent Attendees Table -->

        </div>

        <!-- Footer -->
        <x-footer />

        <!-- /Footer -->
    </div>

@endsection
