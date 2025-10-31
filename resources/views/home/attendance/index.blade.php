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
                    <p class="text-muted mb-0">View daily employee attendance overview</p>
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
            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-success text-white rounded-circle me-3">
                                <i class="ti ti-user-check fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Present</h6>
                                <h4 class="fw-bold mb-0">142</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-danger text-white rounded-circle me-3">
                                <i class="ti ti-user-x fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Absent</h6>
                                <h4 class="fw-bold mb-0">18</h4>
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
                                <h6 class="mb-1">Late</h6>
                                <h4 class="fw-bold mb-0">9</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md bg-info text-white rounded-circle me-3">
                                <i class="ti ti-plane fs-20"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">On Leave</h6>
                                <h4 class="fw-bold mb-0">7</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Summary Cards -->

            <!-- Filter Section -->
            <div class="card mb-4">
                <div class="card-body">
					
                    <form class="row g-3 align-items-end">
						
                        <div class="input-icon-end position-relative">
                            <input type="text" class="form-control date-range bookingrange"
                                placeholder="dd/mm/yyyy - dd/mm/yyyy">
                            <span class="input-icon-addon">
                                <i class="ti ti-chevron-down"></i>
                            </span>
                        </div>
                        <div class="col-md-3">
                            <label for="department" class="form-label">Department</label>
                            <select id="department" class="form-select">
                                <option>All Departments</option>
                                <option>HR</option>
                                <option>IT</option>
                                <option>Sales</option>
                                <option>Marketing</option>
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

            <!-- Attendance Summary Table -->
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><strong>Rohit Sharma</strong></td>
                                    <td>IT</td>
                                    <td>2025-10-29</td>
                                    <td>09:02 AM</td>
                                    <td>06:00 PM</td>
                                    <td><span class="badge bg-success">Present</span></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><strong>Anjali Singh</strong></td>
                                    <td>HR</td>
                                    <td>2025-10-29</td>
                                    <td>09:45 AM</td>
                                    <td>06:10 PM</td>
                                    <td><span class="badge bg-warning text-dark">Late</span></td>
                                    <td>Traffic Delay</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><strong>Vikas Mehta</strong></td>
                                    <td>Sales</td>
                                    <td>2025-10-29</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td><span class="badge bg-danger">Absent</span></td>
                                    <td>Uninformed Leave</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><strong>Priya Verma</strong></td>
                                    <td>Marketing</td>
                                    <td>2025-10-29</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td><span class="badge bg-info text-dark">On Leave</span></td>
                                    <td>Approved Leave</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Attendance Summary Table -->

        </div>

        <!-- Footer -->
         <x-footer />
        <!-- /Footer -->
    </div>
    <!-- /Page Wrapper -->

@endsection
