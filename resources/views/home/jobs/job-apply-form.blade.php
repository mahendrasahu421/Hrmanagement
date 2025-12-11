<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Job Application Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f6f7fb;
            min-height: 100vh;
            padding: 40px 15px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .form-wrapper {
            width: 100%;
            max-width: 960px;
            background: #ffffff;
            border-radius: 20px;
            padding: 20px 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.07);
        }

        .form-title {
            text-align: center;
            font-size: 30px;
            font-weight: 600;
            color: #f26522;
            margin-bottom: 6px;
        }

        .form-subtitle {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .section {
            margin-top: 30px;
        }

        .section h3 {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            position: relative;
            padding-left: 14px;
            margin-bottom: 20px;
        }

        .section h3::before {
            content: "";
            position: absolute;
            left: 0;
            top: 2px;
            height: 100%;
            width: 4px;
            border-radius: 10px;
            background: #f26522;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            position: relative;
        }

        .field label {
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
        }

        .req {
            color: #f26522;
        }

        .field input,
        .field select {
            height: 44px;
            border-radius: 12px;
            border: 1.5px solid #e5e7eb;
            padding: 0 14px;
            font-size: 14px;
            background: #fff;
            transition: 0.25s;
        }

        .field input:focus,
        .field select:focus {
            border-color: #f26522;
            box-shadow: 0 0 0 3px rgba(242, 101, 34, 0.15);
            outline: none;
        }

        .field input[type="file"] {
            padding-top: 9px;
        }

        .hint {
            font-size: 12px;
            color: #f26522;
            margin-top: -2px;
        }

        .radio-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 4px;
        }

        .radio {
            padding: 8px 14px;
            border-radius: 30px;
            border: 1.5px solid #e5e7eb;
            font-size: 14px;
            cursor: pointer;
            transition: .2s ease;
            user-select: none;
        }

        .radio input {
            display: none;
        }

        .radio.active {
            background: #fef0ea;
            border-color: #f26522;
            color: #f26522;
            font-weight: 500;
        }

        .radio span {
            pointer-events: none;
        }

        .footer {
            margin-top: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-submit {
            background: #f26522;
            border: none;
            color: #fff;
            padding: 12px 36px;
            border-radius: 35px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
        }

        .select-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .select-wrapper select {
            width: 100%;
            appearance: none;
            padding-right: 40px;
        }

        .select-wrapper::after {
            content: "\f078";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            right: 15px;
            pointer-events: none;
            color: #6b7280;
            transition: 0.3s ease;
        }

        .select-wrapper.active::after {
            transform: rotate(180deg);
            color: #f26522;
        }

        @media(max-width:600px) {
            .form-wrapper {
                padding: 25px 18px;
            }
        }
    </style>
</head>

<body>

    <div class="form-wrapper">

        <div class="form-title">Job Application</div>
        <div class="form-subtitle">Please fill all the required details</div>

        <div class="section">
            <h3>Personal Information</h3>
            <div class="grid">
                <div class="field">
                    <label>Name <span class="req">*</span></label>
                    <input type="text" placeholder="Enter full name">
                </div>

                <div class="field">
                    <label>Email</label>
                    <input type="email" placeholder="Enter email">
                </div>

                <div class="field">
                    <label>Aadhar No.</label>
                    <input type="text" placeholder="Enter Aadhar number">
                </div>

                <div class="field">
                    <label>Date of Birth <span class="req">*</span></label>
                    <input type="date">
                </div>

                <div class="field">
                    <label>Gender <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Marital Status <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select status</option>
                            <option>Married</option>
                            <option>Unmarried</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>State <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select State</option>
                            <option>State 1</option>
                            <option>State 2</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>City <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select City</option>
                            <option>City 1</option>
                            <option>City 2</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Phone <span class="req">*</span></label>
                    <input type="text" placeholder="Enter mobile number">
                </div>

                <div class="field">
                    <label>Resume</label>
                    <input type="file">
                    <div class="hint">Only .pdf, .doc, .docx allowed</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h3>Academic Information</h3>
            <div class="grid">
                <div class="field">
                    <label>10th % <span class="req">*</span></label>
                    <input type="text">
                </div>

                <div class="field">
                    <label>10th Passing Year <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select year</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>12th % <span class="req">*</span></label>
                    <input type="text">
                </div>

                <div class="field">
                    <label>12th Passing Year <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select year</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>UG % <span class="req">*</span></label>
                    <input type="text">
                </div>

                <div class="field">
                    <label>UG Passing Year <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select year</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Highest Qualification <span class="req">*</span></label>
                    <div class="radio-group">
                        <label class="radio">
                            <input type="radio" name="qualification" onclick="selectRadio(this)">
                            <span>Post Graduation</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="qualification" onclick="selectRadio(this)">
                            <span>Graduation</span>
                        </label>
                    </div>
                </div>

                <div class="field">
                    <label>Highest Degree <span class="req">*</span></label>
                    <input type="text">
                </div>

                <div class="field">
                    <label>Institute <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select institute</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Final Passing Year <span class="req">*</span></label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select year</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h3>Work Experience</h3>
            <div class="grid">
                <div class="field">
                    <label>Total Work Experience</label>
                    <div class="select-wrapper">
                        <select>
                            <option>Select</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Work Experience <span class="req">*</span></label>
                    <input type="text" placeholder="+ Add">
                </div>
            </div>
        </div>

        <div class="footer">
            <button class="btn-submit">Submit Application</button>
        </div>
    </div>

    <script>
        function selectRadio(el) {
            document.querySelectorAll('.radio').forEach(r => r.classList.remove('active'));
            el.parentElement.classList.add('active');
        }

        document.querySelectorAll('.select-wrapper select').forEach(select => {
            select.addEventListener('focus', function() {
                this.parentElement.classList.add('active');
            });

            select.addEventListener('blur', function() {
                this.parentElement.classList.remove('active');
            });
        });
    </script>

</body>

</html>
