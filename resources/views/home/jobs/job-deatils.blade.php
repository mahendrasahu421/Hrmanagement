<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background: #f6f7fb;
            font-family: "Segoe UI", sans-serif;
            padding: 30px 15px;
        }

        .card,
        .side-card {
            background: #fff;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #ececec;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .card:hover,
        .related:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            font-size: 23px;
            font-weight: 700;
            color: #111;
        }

        .company {
            font-size: 13px;
            color: #555;
        }

        .rating {
            color: #f4b400;
            margin-left: 6px;
        }

        .logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: #fff2e6;
            border: 1px solid #f5c7a8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            color: #f8863c;
            font-size: 24px;
        }

        .meta {
            display: flex;
            gap: 20px;
            color: #444;
            font-size: 13px;
            flex-wrap: wrap;
        }

        .meta i {
            color: #f16522;
        }

        .section {
            font-weight: 600;
            font-size: 16px;
            margin: 10px 0;
            color: #222;
        }

        .text {
            font-size: 13px;
            color: #444;
            line-height: 1.8;
        }

        .tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .tag {
            background: #fff3eb;
            padding: 7px 15px;
            border-radius: 20px;
            font-size: 12px;
            color: #f16522;
            font-weight: 500;
        }

        .footer {
            margin-top: 5px;
            font-size: 13px;
            color: #777;
        }

        .form-label {
            font-size: 13px;
            font-weight: 500;
        }

        .apply-box {
            display: flex;
            justify-content: flex-end;
        }

        .btn-apply {
            background-color: #f16522;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-apply:hover {
            background-color: #d35400;
        }

        .related {
            border: 1px solid #ececec;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 16px;
            cursor: pointer;
            transition: 0.3s;
            background: #fff;
        }

        .related-header {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
        }

        .related-logo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #fff2e6;
            border: 1px solid #f5c7a8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            color: #f8863c;
            font-size: 18px;
        }

        .related-info {
            flex: 1;
        }

        .related-title {
            font-weight: 600;
            font-size: 15px;
            color: #222;
        }

        .related-company {
            font-size: 13px;
            color: #666;
            margin: 3px 0;
        }

        .related-rating {
            font-size: 12px;
            color: #f4b400;
        }

        .related-meta {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #444;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .related-meta i {
            color: #f26522;
            margin-right: 4px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: -50%;
            width: 38%;
            height: 100vh;
            background: #ffffff;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.15);
            transition: all 0.35s ease;
            z-index: 999999;
            padding: 30px;
            overflow-y: auto;
        }

        .sidebar.open {
            right: 0;
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .sidebar-header h5 {
            font-size: 18px;
            font-weight: 700;
            color: #222;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 25px;
            cursor: pointer;
            opacity: 0.7;
        }

        .close-btn:hover {
            opacity: 1;
        }

        .form-section-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 8px;
            margin-top: 20px;
            color: #333;
            border-left: 4px solid #f16522;
            padding-left: 10px;
        }

        input.form-control,
        select.form-select {
            height: 42px;
            font-size: 13px;
            border-radius: 10px;
            border: 1px solid #dcdcdc;
            padding-left: 12px;
        }

        input.form-control:focus,
        select.form-select:focus,
        textarea:focus,
        .select2-selection:focus {
            border-color: #f16522 !important;
            box-shadow: 0 0 0 0.1rem rgba(241, 101, 34, 0.25);
            outline: none !important;
        }

        .radio-pill {
            display: inline-block;
            padding: 7px 18px;
            border: 1px solid #ddd;
            border-radius: 30px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.3s;
            background: #fafafa;
        }

        .radio-pill.active {
            background: #f16522;
            color: #fff;
            border-color: #f16522;
        }

        .btn-submit {
            background: #f16522;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #d35400;
        }
    </style>



</head>

<body>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8 col-md-12">
                {{-- Job Card --}}
                <div class="card">
                    <div class="header">
                        <div>
                            <div class="title">{{ $job['title'] }}</div>
                            <div class="company">
                                {{ $job['branch_name'] }}
                            </div>
                        </div>
                        <div class="logo">{{ strtoupper(substr($job['branch_name'], 0, 1)) }}</div>
                    </div>

                    <div class="meta">
                        <div><i class="fa-solid fa-briefcase"></i> {{ $job['min_exp'] }}–{{ $job['max_exp'] }} Yrs</div>
                        <div><i class="fa-solid fa-indian-rupee-sign"></i>
                            @if ($job['ctc_from'] && $job['ctc_to'])
                                ₹{{ number_format($job['ctc_from'] / 100000, 1) }} LPA -
                                ₹{{ number_format($job['ctc_to'] / 100000, 1) }} LPA
                            @else
                                Not Disclosed
                            @endif
                        </div>
                        <div><i class="fa-solid fa-location-dot"></i>
                            {{ implode(', ', $job['city_names'] ?? []) }} - {{ $job['state_name'] }}
                        </div>
                    </div>

                    <div class="section">Skills Required</div>
                    <div class="tags">
                        @foreach (explode(',', $job['skills']) as $skill)
                            <div class="tag">{{ trim($skill) }}</div>
                        @endforeach
                    </div>

                    <div class="footer">Posted: {{ $job['posted'] }}</div>

                    <div class="apply-box">
                        <a href="#" class="btn-apply" id="openForm">
                            <i class="fa-solid fa-paper-plane"></i> Apply Now
                        </a>
                    </div>
                </div>

                {{-- Job Description Card --}}
                <div class="card mt-4">
                    <div class="section"><i class="fa-solid fa-circle-info"></i> Job Description</div>
                    <div class="text">{!! $job['description'] !!}</div>

                    @if (!empty($job['responsibilities']))
                        <div class="section"><i class="fa-solid fa-tasks"></i> Responsibilities</div>
                        <ul class="text">
                            @foreach ($job['responsibilities'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if (!empty($job['requirements']))
                        <div class="section"><i class="fa-solid fa-user-check"></i> Requirements</div>
                        <ul class="text">
                            @foreach ($job['requirements'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if (!empty($job['benefits']))
                        <div class="section"><i class="fa-solid fa-gift"></i> Perks & Benefits</div>
                        <ul class="text">
                            @foreach ($job['benefits'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>


            <div class="col-lg-4 col-md-12">
                <div class="side-card">
                    <div class="section">Jobs you might be interested in</div>
                    <div class="related">
                        <a href="#">
                            <div class="related-header">
                                <div class="related-info">
                                    <div class="related-title">Web Developer & SEO Specialist</div>
                                    <div class="related-company">Timbre Media</div>
                                    <div class="related-rating">★ 4.5 | 3 reviews</div>
                                </div>
                                <div class="related-logo">T</div>
                            </div>
                            <div class="related-meta">
                                <div><i class="fa-solid fa-location-dot"></i> Bengaluru</div>
                                <div>Posted 16 days ago</div>
                            </div>
                        </a>
                    </div>

                    <div class="related">
                        <a href="#">
                            <div class="related-header">
                                <div class="related-info">
                                    <div class="related-title">Wordpress Developer</div>
                                    <div class="related-company">K12 Techno Services</div>
                                    <div class="related-rating">★ 3.6 | 1869 reviews</div>
                                </div>
                                <div class="related-logo">K12</div>
                            </div>
                            <div class="related-meta">
                                <div><i class="fa-solid fa-location-dot"></i> Bengaluru</div>
                                <div>Posted 6 days ago</div>
                            </div>
                        </a>
                    </div>

                    <div class="related">
                        <a href="#">
                            <div class="related-header">
                                <div class="related-info">
                                    <div class="related-title">SEO Executive</div>
                                    <div class="related-company">Show Off Retail</div>
                                    <div class="related-rating">★ 4.0 | 89 reviews</div>
                                </div>
                                <div class="related-logo">S</div>
                            </div>
                            <div class="related-meta">
                                <div><i class="fa-solid fa-location-dot"></i> Bengaluru</div>
                                <div>Posted 20 days ago</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="jobFormSidebar" class="sidebar">
        <div class="sidebar-header">
            <h5 class="fw-bold">Apply for this job</h5>
            <button id="closeForm" class="close-btn"><i class="fas fa-times"></i></button>
        </div>

        <form class="sidebar-body">

            <div class="mb-4">
                <div class="form-section-title">Resume Upload</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Resume <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" accept=".pdf,.doc,.docx">
                        <small class="text-danger">Only .pdf, .doc, .docx allowed</small>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-section-title">Personal Information</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Aadhar No.<span class="text-danger">*</span></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Marital Status <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select status</option>
                            <option>Married</option>
                            <option>Unmarried</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">State <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select State</option>
                            <option>State 1</option>
                            <option>State 2</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select City</option>
                            <option>City 1</option>
                            <option>City 2</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-section-title">Academic Information</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">10th % <span class="text-danger">*</span></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">10th Passing Year <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select year</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">12th % <span class="text-danger">*</span></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">12th Passing Year <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select year</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">UG % <span class="text-danger">*</span></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">UG Passing Year <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select year</option>
                            <option>2022</option>
                            <option>2023</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Highest Qualification <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2 mt-1 flex-wrap">
                            <label class="radio-pill" onclick="selectRadioGrp(this)">
                                <input type="radio" name="qualification" hidden>
                                Post Graduation
                            </label>

                            <label class="radio-pill" onclick="selectRadioGrp(this)">
                                <input type="radio" name="qualification" hidden>
                                Graduation
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Highest Degree <span class="text-danger">*</span></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Institute <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select institute</option>
                            <option>Institute A</option>
                            <option>Institute B</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Final Passing Year <span class="text-danger">*</span></label>
                        <select class="form-select select2">
                            <option>Select year</option>
                            <option>2022</option>
                            <option>2023</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-section-title">Work Experience</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Total Work Experience</label>
                        <select class="form-select select2">
                            <option>Select</option>
                            <option>0 Years</option>
                            <option>1 Year</option>
                            <option>2 Years</option>
                            <option>3 Years</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Work Experience <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="+ Add">
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('recruitment.jobs.job-deatils') }}" class="btn btn-secondary py-2">
                    <i class="fas fa-rotate-left me-1"></i> Reset
                </a>
                <button type="button" class="btn btn-secondary py-2" id="closeFormBottom">
                    <i class="fas fa-xmark me-1"></i> Close
                </button>
                <button type="submit" class="btn-submit">Submit</button>
            </div>

        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#openForm").on("click", function() {
                $("#jobFormSidebar").addClass("open");
            });
            $("#closeForm").on("click", function() {
                $("#jobFormSidebar").removeClass("open");
            });
            $("#closeFormBottom").on("click", function() {
                $("#jobFormSidebar").removeClass("open");
            });
            window.selectRadioGrp = function(el) {
                const $parent = $(el).parent();
                $parent.find(".radio-pill").removeClass("active");
                $(el).addClass("active");

                const $radio = $(el).find('input[type="radio"]');
                if ($radio.length) {
                    $radio.prop("checked", true);
                }
            };

        });
    </script>


</body>

</html>
