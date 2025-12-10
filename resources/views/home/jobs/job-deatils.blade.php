
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Card UI</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            padding: 30px;
        }

        .job-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: flex-start;
            gap: 16px;
            max-width: 800px;
            margin: auto;
        }

        .checkbox {
            margin-top: 6px;
        }

        .job-content {
            flex: 1;
        }

        .job-title {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin-bottom: 4px;
        }

        .company {
            color: #2c3e50;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .job-meta {
            display: flex;
            gap: 20px;
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .description {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 10px;
        }

        .tag {
            font-size: 13px;
            color: #4a4a4a;
            background: #f0f0f0;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #888;
        }

        .actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .apply-btn {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 13px;
            cursor: pointer;
        }

        .apply-btn:hover {
            background: #1d4ed8;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ffe0b2;
            background: #fff3e0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <div class="job-card">
        <input type="checkbox" class="checkbox">

        <div class="job-content">
            <div class="job-title">Laravel Developer</div>
            <div class="company">Devteam 365 Development India</div>

            <div class="job-meta">
                <div class="meta-item">
                    <i class="fa-solid fa-briefcase"></i> 1-3 Yrs
                </div>
                <div class="meta-item">
                    <i class="fa-solid fa-indian-rupee-sign"></i> 4-6 Lacs PA
                </div>
                <div class="meta-item">
                    <i class="fa-solid fa-location-dot"></i> Remote
                </div>
            </div>

            <div class="description">
                We are looking for a skilled Laravel Developer to join our remote development team...
            </div>

            <div class="tags">
                <div class="tag">Laravel</div>
                <div class="tag">Frontend Development</div>
                <div class="tag">MVC Architecture</div>
                <div class="tag">Web Developer</div>
                <div class="tag">PostgreSQL</div>
            </div>

            <div class="footer">
                <div>1 Day Ago</div>

                <div class="actions">
                    <button class="apply-btn">
                        <i class="fa-solid fa-paper-plane"></i> Apply Now
                    </button>
                </div>
            </div>
        </div>

        <div class="avatar">
            <img src="https://img.naukimg.com/logo_images/groups/v1/2724450.gif" alt="Neural Icon">
        </div>
    </div>

</body>

</html>
