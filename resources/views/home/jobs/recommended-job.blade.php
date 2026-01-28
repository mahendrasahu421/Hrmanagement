<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Jobs</title>

    <!-- Google Fonts (Roboto for modern look) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome & Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        body {
            background: #f3f5f9;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            padding: 20px;
        }

        .job-card {
            background: #fff;
            border-radius: 16px;
            padding: 15px 30px;
            width: 100%;
            max-width: 750px;
            margin-bottom: 25px;
            border: 1px solid #e1e5eb;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
            cursor: pointer;
        }

        .job-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .top-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .job-title {
            font-size: 21px;
            font-weight: 700;
            color: #111;
        }

        .company-name {
            font-size: 14px;
            color: #555;
            margin-top: 4px;
        }

        .logo-box {
            width: 112px;
            height: 59px;
            border-radius: 14px;
            background: #ffe6d5;
            border: 1px solid #f5c7a8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            color: #f8863c;
            font-size: 22px;
            overflow: hidden;
        }

        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 14px;
        }

        .meta {
            display: flex;
            gap: 18px;
            font-size: 13px;
            color: #555;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .meta i {
            color: #f26522;
            margin-right: 4px;
        }

        .tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .tag {
            background: #fff4ed;
            padding: 6px 14px;
            border-radius: 25px;
            font-size: 13px;
            color: #f16522;
            font-weight: 500;
            transition: 0.2s;
        }

        .tag:hover {
            background: #f16522;
            color: #fff;
        }

        .bottom-row {
            margin-top: 16px;
            font-size: 14px;
            color: #777;
            font-weight: 500;
        }

        .job-description {
            margin-top: 12px;
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        h4.no-jobs {
            color: #777;
            font-weight: 500;
            margin-top: 100px;
        }

        @media (max-width: 576px) {
            .top-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .logo-box {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <x-alert-modal :type="session('success') ? 'success' : (session('error') ? 'error' : '')"
        :message="session('success') ?? session('error')" />

    @if ($jobs->isEmpty())
        <h4 class="text-center no-jobs">No jobs found!</h4>
    @else
        @foreach ($jobs as $job)
            @php
                $titleSlug = Str::slug($job->job_title);
                $branchSlug = Str::slug($job->branch_name ?? 'branch');
                $locationSlug = Str::slug(implode('-', $job->city_names ?? []));
                $stateSlug = Str::slug($job->state_name ?? '');
                $expSlug = Str::slug(($job->min_exp ?? 0) . '-to-' . ($job->max_exp ?? 0) . '-years');
                $jobCode = $job->id . rand(100000, 999999);
                $finalSlug =
                    $titleSlug . '-' .
                    $branchSlug . '-' .
                    $locationSlug . '-' .
                    $stateSlug . '-' .
                    $expSlug . '-' .
                    $jobCode;
                $jobUrl = route('recruitment.jobs.job-deatils', ['slug' => $finalSlug]);
            @endphp

            <div class="job-card" data-url="{{ $jobUrl }}">
                <div class="top-row">
                    <div>
                        <div class="job-title">{{ $job->job_title ?? 'N/A' }}</div>
                        <div class="company-name">{{ $job->branchName ?? 'N/A' }}</div>
                    </div>
                    <div class="logo-box">
                        @if ($job->company_logo && file_exists(public_path('uploads/company/' . $job->company_logo)))
                            <img src="{{ asset('uploads/company/' . $job->company_logo) }}" alt="Company Logo">
                        @else
                            <span>{{ strtoupper(substr($job->branchName ?? 'C', 0, 1)) }}</span>
                        @endif
                    </div>
                </div>

                <div class="meta">
                    <div><i class="fa-solid fa-briefcase"></i>{{ $job->min_exp ?? 0 }} – {{ $job->max_exp ?? 0 }} Yrs</div>
                    <div><i class="fa-solid fa-indian-rupee-sign"></i>
                        @if ($job->ctc_from !== null && $job->ctc_to !== null)
                            ₹{{ number_format($job->ctc_from / 100000, 2) }} LPA -
                            ₹{{ number_format($job->ctc_to / 100000, 2) }} LPA
                        @else
                            N/A
                        @endif
                    </div>
                    <div><i class="fa-solid fa-location-dot"></i>{{ implode(', ', $job->city_names ?? []) }} -
                        {{ $job->state_name ?? 'N/A' }}</div>
                </div>

                @if (!empty($job->job_description))
                    <div class="job-description">
                        {!! Str::limit($job->job_description, 200) !!}
                    </div>
                @endif

                @if (!empty($job->skill_names))
                    <div class="tags">
                        @foreach ($job->skill_names as $skill)
                            <div class="tag">{{ $skill }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="bottom-row">
                    Posted: {{ $job->created_at ? $job->created_at->diffForHumans() : 'N/A' }}
                </div>
            </div>
        @endforeach
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.job-card').forEach(card => {
                card.addEventListener('click', function () {
                    const url = this.dataset.url;
                    if (url) window.open(url, '_blank');
                });
            });
        });
    </script>

</body>

</html>
