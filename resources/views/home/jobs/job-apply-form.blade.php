<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Job Application Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            background: #f6f7fb;
            padding: 40px 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .form-wrapper {
            max-width: 960px;
            margin: auto;
            background: #fff;
            border-radius: 20px;
            padding: 25px 35px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.07);
        }

        .form-title {
            text-align: center;
            font-size: 25px;
            color: #f26522;
            font-weight: 600;
        }

        .section-title {
            font-size: 15px;
            font-weight: 600;
            position: relative;
            padding-left: 12px;
            margin-bottom: 18px;
            color: #1f2937;
        }

        .section-title::before {
            content: "";
            position: absolute;
            left: 0;
            top: 2px;
            height: 100%;
            width: 3px;
            background: #f26522;
            border-radius: 6px;
        }

        .form-label {
            font-size: 13px;
            margin-bottom: 4px;
        }

        .form-control,
        .form-select {
            font-size: 14px;
            height: 42px;
            padding: 8px 10px;
            border-radius: 5px;
            outline: none !important;
            box-shadow: none !important;
        }

        input:focus,
        select:focus,
        textarea:focus,
        .select2-selection:focus {
            outline: none !important;
            box-shadow: none !important;
            border-color: #e5e7eb !important;
        }

        .req {
            color: #f26522;
        }

        .radio-pill {
            border: 1.5px solid #e5e7eb;
            padding: 6px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: .2s;
            font-size: 13px;
        }

        .radio-pill.active {
            background: #fef0ea;
            border-color: #f26522;
            color: #f26522;
        }

        .btn-submit {
            background: #f26522;
            color: #fff;
            padding: 10px 28px;
            border-radius: 25px;
            border: 0;
            font-size: 14px;
        } 

        .select2-container .select2-selection--single {
            height: 42px !important;
            padding: 6px 10px;
            border-radius: 5px !important;
            border: 1.5px solid #e5e7eb !important;
            display: flex;
            align-items: center;
            background: #fff !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .select2-selection--single:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #111827;
            font-size: 14px;
            line-height: 42px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            top: 1px !important;
            right: 8px;
        }

        .select2-dropdown {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08) !important;
            padding: 6px 0;
        }

        .select2-results__option {
            padding: 10px 14px !important;
            font-size: 14px;
            border-radius: 8px !important;
            margin: 3px 8px !important;
        }

        .select2-results__option--highlighted {
            background: #fef0ea !important;
            color: #f26522 !important;
        }

        .select2-results__option[aria-selected=true] {
            background: #fef0ea !important;
            color: #f26522 !important;
        }
    </style>
</head>

<body>

    <div class="form-wrapper">

        <h2 class="form-title">Job Application Form</h2>

        <div class="section">
            <h3 class="section-title">Personal Information</h3>
            <div class="col-md-12">
                <label class="form-label">Resume</label>
                <input type="file" class="form-control" accept=".pdf, .doc, .docx">
                <small class="text-danger">Only .pdf, .doc, .docx allowed</small>
            </div>
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Name <span class="req">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Aadhar No.</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date of Birth <span class="req">*</span></label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Marital Status <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select status</option>
                        <option>Married</option>
                        <option>Unmarried</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">State <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select State</option>
                        <option>State 1</option>
                        <option>State 2</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">City <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select City</option>
                        <option>City 1</option>
                        <option>City 2</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone <span class="req">*</span></label>
                    <input type="text" class="form-control">
                </div>



            </div>
        </div>

        <div class="section mt-4">
            <h3 class="section-title">Academic Information</h3>

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">10th % <span class="req">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">10th Passing Year <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select year</option>
                        <option>2019</option>
                        <option>2020</option>
                        <option>2021</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">12th % <span class="req">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">12th Passing Year <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select year</option>
                        <option>2020</option>
                        <option>2021</option>
                        <option>2022</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">UG % <span class="req">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">UG Passing Year <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select year</option>
                        <option>2022</option>
                        <option>2023</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Highest Qualification <span class="req">*</span></label>

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
                    <label class="form-label">Highest Degree <span class="req">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Institute <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select institute</option>
                        <option>Institute A</option>
                        <option>Institute B</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Final Passing Year <span class="req">*</span></label>
                    <select class="form-select select2">
                        <option>Select year</option>
                        <option>2022</option>
                        <option>2023</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="section mt-4">
            <h3 class="section-title">Work Experience</h3>

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
                    <label class="form-label">Work Experience <span class="req">*</span></label>
                    <input type="text" class="form-control" placeholder="+ Add">
                </div>

            </div>
        </div>

        <div class="text-center mt-4">
            <button class="btn-submit">Submit Application</button>
        </div>

    </div>

    <script>
        function selectRadioGrp(el) {
            document.querySelectorAll('.radio-pill').forEach(rb => rb.classList.remove('active'));
            el.classList.add('active');
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".select2").select2({
                width: "100%"
            });
        });
    </script>

</body>

</html>
