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
            margin-top: 15px;
            font-size: 13px;
            color: #777;
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

        @media (max-width: 992px) {
            .title {
                font-size: 22px;
            }

            .section {
                font-size: 15px;
            }

            .text,
            .tag,
            .meta,
            .footer {
                font-size: 12px;
            }

            .btn-apply {
                padding: 10px 24px;
                font-size: 13px;
            }

            .related-title {
                font-size: 14px;
            }

            .logo {
                width: 55px;
                height: 55px;
                font-size: 22px;
            }

            .related-logo {
                width: 45px;
                height: 45px;
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .title {
                font-size: 20px;
            }

            .section {
                font-size: 14px;
            }

            .text,
            .tag,
            .meta,
            .footer {
                font-size: 11px;
            }

            .btn-apply {
                padding: 8px 20px;
                font-size: 12px;
            }

            .related-title {
                font-size: 13px;
            }

            .logo {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .related-logo {
                width: 40px;
                height: 40px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="header">
                        <div>
                            <div class="title">WordPress Developer / SEO Specialist</div>
                            <div class="company">
                                11 Plus Grammar Preparation
                                <span class="rating">★ 3.4</span> | 3 Reviews
                            </div>
                        </div>
                        <div class="logo">N</div>
                    </div>

                    <div class="meta">
                        <div><i class="fa-solid fa-briefcase"></i> 1–2 Yrs</div>
                        <div><i class="fa-solid fa-indian-rupee-sign"></i> Not disclosed</div>
                        <div><i class="fa-solid fa-location-dot"></i> Remote</div>
                    </div>

                    <div class="section">Skills Required</div>
                    <div class="tags">
                        <div class="tag">SEO</div>
                        <div class="tag">Webflow</div>
                        <div class="tag">WordPress</div>
                        <div class="tag">Search Optimization</div>
                        <div class="tag">CSS</div>
                        <div class="tag">HTML</div>
                        <div class="tag">Woocommerce</div>
                    </div>

                    <div class="footer">1 Day Ago</div>

                    <div class="apply-box">
                        <a href="{{ route('recruitment.jobs.apply.form') }}" target="_blank" class="btn-apply">
                            <i class="fa-solid fa-paper-plane"></i> Apply Now
                        </a>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="section"><i class="fa-solid fa-circle-info"></i> Job Description</div>
                    <div class="text">
                        We are looking for a **WordPress Developer / SEO Specialist** to join our team. You will be
                        responsible for maintaining websites, optimizing content, and improving search engine rankings.
                    </div>

                    <div class="section"><i class="fa-solid fa-tasks"></i> Responsibilities</div>
                    <ul class="text">
                        <li>Develop, maintain, and update WordPress websites</li>
                        <li>Optimize website content for SEO, including keywords and meta tags</li>
                        <li>Monitor website performance and implement improvements</li>
                        <li>Collaborate with team members to implement business requirements</li>
                        <li>Ensure mobile responsiveness and cross-browser compatibility</li>
                    </ul>

                    <div class="section"><i class="fa-solid fa-user-check"></i> Requirements</div>
                    <ul class="text">
                        <li>1–2 years of experience in WordPress development</li>
                        <li>Strong knowledge of SEO tools and best practices</li>
                        <li>Proficient in HTML, CSS, and JavaScript</li>
                        <li>Experience with WooCommerce is a plus</li>
                        <li>Good communication skills and team player</li>
                    </ul>

                    <div class="section"><i class="fa-solid fa-gift"></i> Perks & Benefits</div>
                    <ul class="text">
                        <li>Flexible working hours and remote work</li>
                        <li>Opportunity to work with international clients</li>
                        <li>Professional growth and skill development</li>
                        <li>Friendly and collaborative work environment</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="side-card">
                    <div class="section">Jobs you might be interested in</div>

                    <div class="related">
                        <a href="">
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
                        <a href="">
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
                        <a href="">
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
                    <div class="related">
                        <a href="">
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
                        <a href="">
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
                        <a href="">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
