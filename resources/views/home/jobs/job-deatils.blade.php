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
            margin: 5px 0;
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

        .resume-input {
            height: 35px !important;
        }

        .form-select:focus,
        .form-control:focus {
            box-shadow: none !important;
            border: 1px solid #f16522 !important;
        }

        .resume-control {
            height: 33px !important;
        }

        input.form-control,
        select.form-select {
            height: 42px;
            font-size: 13px;
            border-radius: 10px;
            border: 1px solid #dcdcdc;
            padding-left: 12px;
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
                        <div class="logo">
                            @if (!empty($job['company_logo']))
                                <img src="{{ asset('uploads/company/' . $job['company_logo']) }}" alt="Company Logo"
                                    style="width: 100%; height: 100%; object-fit: contain; border-radius: 12px;">
                            @else
                                <span>{{ strtoupper(substr($job['branch_name'], 0, 1)) }}</span>
                            @endif
                        </div>

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
                        @foreach ($job['skills'] as $skill)
                            <div class="tag">{{ $skill }}</div>
                        @endforeach
                    </div>

                    <div class="footer">Posted: {{ $job['posted'] }}</div>
                    @php
                        if (empty($job['title']) || empty($job['id'])) {
                            // job invalid
                            return;
                        }

                        $cities = is_array($job['city_names'] ?? null) ? $job['city_names'] : [];

                        $finalSlug = implode(
                            '-',
                            array_filter([
                                Str::slug($job['title']),
                                Str::slug($job['branch_name'] ?? 'branch'),
                                Str::slug(implode('-', $cities)),
                                Str::slug($job['state_name'] ?? ''),
                                Str::slug(($job['min_exp'] ?? 0) . '-to-' . ($job['max_exp'] ?? 0) . '-years'),
                                $job['id'], // ✅ UNIQUE & STABLE
                            ]),
                        );
                    @endphp


                    <div class="apply-box">
                        <div class="apply-box">
                            <a href="{{ url('/recruitment/jobs/' . $finalSlug . '/apply') }}" target="_blank"
                                class="btn-apply">
                                <i class="fa-solid fa-paper-plane"></i> Apply Now
                            </a>
                        </div>


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








</body>

</html>
