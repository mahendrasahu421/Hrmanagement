@extends('employee.layout.layout')
@section('title', $title)
@section('main-section')
    <style>
        .custom-card {
            border: 1px solid #f1b3b3;
            border-radius: 12px;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: 0.3s ease;
        }

        .card-icon {
            width: 60px;
            margin-bottom: 5px;
        }

        .custom-btn {
            background: #f37438;
            color: #fff;
            border: none;
            padding: 8px 22px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }

        .custom-btn:hover {
            color: #fff !important;
        }
    </style>
    <x-alert-modal />

    <div class="page-wrapper" style="min-height: 428px;">
        <div class="content">

            <h4 class="mb-2">Welcome Rana Pratap to ACFL Performance Management Process.</h4>
            <h5 class="mb-4 text-muted">एसीएफएल प्रदर्शन प्रबंधन प्रक्रिया में आप का स्वागत है।</h5>

            <div class="row">
                <div class="col-lg-6">

                    <div class="row g-4">

                        <!-- Card 1 -->
                        <div class="col-lg-6 col-md-6">
                            <div class="custom-card">
                                <img src="{{ asset('frontent/assets/img/SelfAssessment.png') }}" class="card-icon"
                                    alt="">
                                <a href="{{ route('employee.competencies') }}" class="custom-btn">Start Self Appraisal</a>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-lg-6 col-md-6">
                            <div class="custom-card">
                                <img src="{{ asset('frontent/assets/img/ControlingReview.png') }}" class="card-icon"
                                    alt="">
                                <a href="{{route('employee.review.employee')}}" class="custom-btn">Review your Employee</a>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-lg-6 col-md-6">
                            <div class="custom-card">
                                <img src="{{ asset('frontent/assets/img/GiveFeedback.png') }}" class="card-icon"
                                    alt="">
                                <a href="#" class="custom-btn">View your CO Feedback</a>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-lg-6 col-md-6">
                            <div class="custom-card">
                                <img src="{{ asset('frontent/assets/img/SubmitFeedback.png') }}" class="card-icon"
                                    alt="">
                                <a href="#" class="custom-btn">Submit your Feedback</a>
                            </div>
                        </div>


                    </div>

                </div>

                <!-- Right Side Image -->
                <div class="col-lg-6 text-center mt-lg-0 mt-md-5 mt-5">
                    <img src="{{ asset('frontent/assets/img/group_12.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="mt-5">
                <h5 class="mb-2">Previous years details</h5>
                <h6 class="text-muted">पिछले वर्षों का विवरण</h6>
            </div>

            <div class="card mt-3">
                <div class="card-body p-0">
                    <div class="custom-datatable-filter table-responsive">
                        <table class="table datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.No.</th>
                                    <th>FY</th>
                                    <th>CO Name</th>
                                    <th>Monthly CTC</th>
                                    <th>Training Suggested</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2023–24</td>
                                    <td>
                                        <h6 class="fw-medium"><a href="#">Rohit Sharma</a></h6>
                                    </td>
                                    <td>₹45,000</td>
                                    <td>Leadership Training</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-sm">
                                            <i class="ti ti-point-filled me-1"></i>4.5
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>2022–23</td>
                                    <td>
                                        <h6 class="fw-medium"><a href="#">Anil Kumar</a></h6>
                                    </td>
                                    <td>₹40,000</td>
                                    <td>Technical Upskilling</td>
                                    <td>
                                        <span class="badge badge-danger d-inline-flex align-items-center badge-sm">
                                            <i class="ti ti-point-filled me-1"></i>3.8
                                        </span>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>

        <x-footer />
    </div>

@endsection
@push('after_scripts')
    <script></script>
@endpush
