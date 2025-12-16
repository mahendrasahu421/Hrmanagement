<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Jobs </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            background: #f6f7fb;
            font-family: "Segoe UI", sans-serif;
            padding: 40px;
        }

        .job-card {
            background: #fff;
            border-radius: 16px;
            padding: 22px 25px;
            max-width: 780px;
            margin: auto;
            border: 1px solid #ececec;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: 0.3s;
            margin-bottom: 25px;
        }

        .job-card:hover {
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
        }

        .top-row {
            display: flex;
            justify-content: space-between;
        }

        .job-title {
            font-size: 20px;
            font-weight: 600;
            color: #111;
        }

        .company-name {
            font-size: 13px;
            color: #444;
            /* margin-top: 5px; */
        }

        .star {
            color: #f4b400;
            margin-left: 6px;
        }

        .logo-box {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: #fff2e6;
            border: 1px solid #f5c7a8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            color: #f8863c;
            font-size: 20px;
        }

        .meta {
            display: flex;
            gap: 10px;
            font-size: 13px;
            color: #444;
        }

        .meta i {
            color: #f26522;
        }

        .tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .tag {
            background: #fff3eb;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: #f16522;
            font-weight: 500;
        }

        .bottom-row {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            font-size: 15px;
            color: #777;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div>
        @foreach ($jobs as $job)
            <div>
                @php

                    $titleSlug = Str::slug($job->job_title);
                    $branchSlug = Str::slug($job->branch_name ?? 'branch');
                    $locationSlug = Str::slug(implode('-', $job->city_names));
                    $stateSlug = Str::slug($job->state_name ?? '');
                    $expSlug = Str::slug($job->min_exp . '-to-' . $job->max_exp . '-years');

                    // unique job code like naukri
                    $jobCode = $job->id . rand(100000, 999999);

                    // final slug (Naukri.com style)
                    $finalSlug =
                        $titleSlug .
                        '-' .
                        $branchSlug .
                        '-' .
                        $locationSlug .
                        '-' .
                        $stateSlug .
                        '-' .
                        $expSlug .
                        '-' .
                        $jobCode;
                @endphp

                <a href="{{ route('recruitment.jobs.job-deatils', ['slug' => $finalSlug]) }}"
                    style="text-decoration:none;" target="_blank">


                    <div class="job-card">
                        <div class="top-row">
                            <div>
                                <div class="job-title">{{ $job->job_title }}</div>
                                <div class="company-name">
                                    {{ $job->branchName }}

                                </div>
                            </div>
                            <div class="logo-box">N</div>
                        </div>


                        <div class="meta">
                            <div class="mb-1"><i class="fa-solid fa-briefcase"></i> {{ $job->min_exp }} –
                                {{ $job->max_exp }} Yrs
                            </div>|
                            <div><i class="fa-solid fa-indian-rupee-sign"></i>
                                @if ($job->ctc_from !== null && $job->ctc_to !== null)
                                    ₹{{ number_format((float) $job->ctc_from / 100000, 2) }} LPA -
                                    ₹{{ number_format((float) $job->ctc_to / 100000, 2) }} LPA
                                @else
                                    N/A
                                @endif
                            </div>|
                            <div><i class="fa-solid fa-location-dot"></i>
                                {{ implode(', ', $job->city_names) }}- {{ $job->state_name }}


                            </div>
                        </div>

                        <div class="meta" style="color:#555;">
                            <i class="fa-regular fa-file-lines mt-1"></i>
                            {!! $job->job_description !!}

                        </div>


                        <div class="tags">
                            <div class="tags">
                                @foreach ($job->skill_names as $skill)
                                    <div class="tag">{{ $skill }}</div>
                                @endforeach
                            </div>


                        </div>
                        <div class="bottom-row">
                            Posted : {{ $job->created_at->diffForHumans() }}

                        </div>
                    </div>
                </a>
            </div>
        @endforeach



    </div>

</body>

</html>
