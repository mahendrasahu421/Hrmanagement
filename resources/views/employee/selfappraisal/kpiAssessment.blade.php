@extends('employee.layout.layout')
@section('title', $title)
@section('main-section')

    <x-alert-modal />

    <style>
        .custom-datatable-filter table th,
        .custom-datatable-filter table td {
            vertical-align: middle;
        }
    </style>

    <div class="page-wrapper" style="min-height: 428px;">
        <div class="content">

            <!-- Page Header -->
            <div class="mb-4">
                <h4 class="mb-2">KPI Assessment</h4>
                <h5 class="mb-3 text-muted">केपीआई मूल्यांकन</h5>
            </div>

            <div class="card mt-3">
                <div class="card-body p-0">
                    <div class="custom-datatable-filter table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="text-align:center; background:#f8f9fa;">

                                    <th rowspan="2">Sr.No.<br><small>क्रमांक</small></th>

                                    <th rowspan="2">Objective<br><small>उद्देश्य</small></th>

                                    <th rowspan="2">Key Performance Indicator<br><small>मुख्य निष्पादन संकेतक</small>
                                    </th>

                                    <th rowspan="2">Weightage<br><small>महत्व</small></th>

                                    <!-- Performance Main Heading -->
                                    <th colspan="3">
                                        Performance<br><small>प्रदर्शन</small>
                                    </th>

                                    <!-- Self KPI Main Heading -->
                                    <th colspan="3">
                                        Self KPI Score & Remarks<br><small>स्वयं केपीआई स्कोर</small>
                                    </th>
                                </tr>

                                <!-- ========== SECOND ROW (SUB HEADINGS) ========== -->
                                <tr style="text-align:center; background:#f8f9fa;">
                                    <th>Target<br><small>लक्ष्य</small></th>
                                    <th>Actual<br><small>वास्तविक</small></th>
                                    <th>Achievement%<br><small>उपलब्धि%</small></th>

                                    <th>Rating<br><small>रेटिंग</small></th>
                                    <th>Score<br><small>अंक</small></th>
                                    <th>Self Assessment Remarks
                                        <br><small>स्व-मूल्यांकन टिप्पणियाँ</small>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Improve Customer Satisfaction</td>
                                    <td>Response Time, Resolution Rate</td>
                                    <td>20%</td>

                                    <td>30%</td>
                                    <td>28%</td>
                                    <td>93%</td>

                                    <td>4.5</td>
                                    <td>Very Good</td>
                                    <td>Very Good</td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Team Coordination</td>
                                    <td>Meetings, Support, Planning</td>
                                    <td>15%</td>

                                    <td>25%</td>
                                    <td>20%</td>
                                    <td>80%</td>

                                    <td>4.0</td>
                                    <td>Good</td>
                                    <td>Good</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Team Coordination</td>
                                    <td>Meetings, Support, Planning</td>
                                    <td>15%</td>

                                    <td>25%</td>
                                    <td>20%</td>
                                    <td>80%</td>

                                    <td>4.0</td>
                                    <td>Good</td>
                                    <td>Good</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                
                <div class="card-footer text-end" style="background:#f8f9fa;">
                    <h5 class="mb-3">
                        Total Score: <strong>12.5</strong>
                    </h5>

                    <a href="{{ url('dashboard') }}}" class="btn btn-secondary">
                        Go to Dashboard
                    </a>

                    <a href="{{ route('employee.form-c') }}" class="btn btn-primary ms-2">
                        Go to Form C
                    </a>
                </div>
            </div>

        </div>

        <x-footer />
    </div>

@endsection

@push('after_scripts')
    <script></script>
@endpush
