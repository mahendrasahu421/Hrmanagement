<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Jobs</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
            margin-top: 5px;
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
            margin-top: 14px;
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
            font-size: 10px;
            color: #777;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div>
        <a href="{{route('recruitment.jobs.job-deatils')}}" style="text-decoration:none;">
            <div class="job-card">
                <div class="top-row">
                    <div>
                        <div class="job-title">WordPress Developer / SEO Specialist</div>
                        <div class="company-name">
                            11 Plus Grammar Preparation
                            <span class="star">★ 3.4</span> | 3 Reviews
                        </div>
                    </div>
                    <div class="logo-box">N</div>
                </div>

                <div class="meta">
                    <div><i class="fa-solid fa-briefcase"></i> 1–2 Yrs</div>
                    <div><i class="fa-solid fa-indian-rupee-sign"></i> Not disclosed</div>
                    <div><i class="fa-solid fa-location-dot"></i> Remote</div>
                </div>

                <div class="meta" style="margin-top:10px; color:#555;">
                    <i class="fa-regular fa-file-lines" style="margin-top:4px;"></i>
                    Must be able to work and collaborate with the team during UK business hours
                </div>

                <div class="tags">
                    <div class="tag">SEO</div>
                    <div class="tag">Webflow</div>
                    <div class="tag">Search Engine Optimization</div>
                    <div class="tag">CSS</div>
                    <div class="tag">Woocommerce</div>
                    <div class="tag">HTML</div>
                </div>

                <div class="bottom-row">
                    <span>1 Day Ago</span>
                </div>
            </div>
        </a>

        <a href="#" style="text-decoration:none;">
            <div class="job-card">
                <div class="top-row">
                    <div>
                        <div class="job-title">WordPress Developer / SEO Specialist</div>
                        <div class="company-name">
                            11 Plus Grammar Preparation
                            <span class="star">★ 3.4</span> | 3 Reviews
                        </div>
                    </div>
                    <div class="logo-box">N</div>
                </div>

                <div class="meta">
                    <div><i class="fa-solid fa-briefcase"></i> 1–2 Yrs</div>
                    <div><i class="fa-solid fa-indian-rupee-sign"></i> Not disclosed</div>
                    <div><i class="fa-solid fa-location-dot"></i> Remote</div>
                </div>

                <div class="meta" style="margin-top:10px; color:#555;">
                    <i class="fa-regular fa-file-lines" style="margin-top:4px;"></i>
                    Must be able to work and collaborate with the team during UK business hours
                </div>

                <div class="tags">
                    <div class="tag">SEO</div>
                    <div class="tag">Webflow</div>
                    <div class="tag">Search Engine Optimization</div>
                    <div class="tag">CSS</div>
                    <div class="tag">Woocommerce</div>
                    <div class="tag">HTML</div>
                </div>

                <div class="bottom-row">
                    <span>1 Day Ago</span>
                </div>
            </div>
        </a>
    </div>

</body>

</html>
