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


    <!-- ================= PERSONAL INFORMATION ================= -->
    <div class="section">


        <form action="{{ route('job.application.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-wrapper">

                <h2 class="form-title">Job Application Form</h2>

                <!-- ================= PERSONAL INFORMATION ================= -->
                <div class="section">
                    <h3 class="section-title">Personal Information</h3>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Resume</label>
                        <input type="file" name="resume" id="resume" class="form-control"
                            accept=".pdf,.doc,.docx">
                        <small class="text-danger">Only .pdf, .doc, .docx allowed</small>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">First Name <span class="req">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Last Name <span class="req">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone <span class="req">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Aadhaar No. (Optional)</label>
                            <input type="text" name="aadhaar_number" id="aadhaar_number" maxlength="12"
                                class="form-control">
                        </div>

                        @php
                            $today = date('Y-m-d');
                            $maxDob = date('Y-m-d', strtotime('-18 years'));
                        @endphp

                        <div class="col-md-6">
                            <label class="form-label">Date of Birth <span class="req">*</span></label>
                            <input type="date" name="dob" id="dob" class="form-control"
                                value="{{ $today }}" max="{{ $maxDob }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender <span class="req">*</span></label>
                            <select name="gender" id="gender" class="form-select select2" required>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Marital Status <span class="req">*</span></label>
                            <select name="marital_status" id="marital_status" class="form-select select2" required>
                                @foreach ($MaritalStatus as $marital)
                                    <option value="{{ $marital->id }}">{{ $marital->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">State <span class="req">*</span></label>
                            <select name="state_id" id="state" class="form-select select2" required>
                                @foreach ($state as $states)
                                    <option value="{{ $states->id }}">{{ $states->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City <span class="req">*</span></label>
                            <select name="city_id" id="city" class="form-select select2" required>
                                <option value="">Select City</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- ================= ACADEMIC INFORMATION ================= -->
                <div class="section mt-4">
                    <h3 class="section-title">Academic Information</h3>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">10th %</label>
                            <input type="text" name="tenth_percent" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">10th Passing Year</label>
                            <select name="tenth_year" class="form-select select2">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">12th %</label>
                            <input type="text" name="twelfth_percent" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">12th Passing Year</label>
                            <select name="twelfth_year" class="form-select select2">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">UG %</label>
                            <input type="text" name="ug_percent" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">UG Passing Year</label>
                            <select name="ug_year" class="form-select select2">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Highest Qualification</label>
                            <div class="d-flex gap-2 mt-1">
                                <label class="radio-pill">
                                    <input type="radio" name="qualification" value="Post Graduation" hidden>
                                    Post Graduation
                                </label>
                                <label class="radio-pill">
                                    <input type="radio" name="qualification" value="Graduation" hidden>
                                    Graduation
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Highest Degree</label>
                            <input type="text" name="degree" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Institute</label>
                            <input type="text" name="institute" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Final Passing Year</label>
                            <select name="final_year" class="form-select select2">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <!-- ================= WORK EXPERIENCE ================= -->
                <div class="section mt-4">
                    <h3 class="section-title">Work Experience</h3>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Total Work Experience</label>
                            <select name="experience_years" class="form-select select2">
                                <option value="">Select</option>
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }}
                                        Year{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Work Experience Details</label>
                            <input type="text" name="experience_details" class="form-control"
                                placeholder="+ Add">
                        </div>
                    </div>
                </div>

                <!-- ================= JOB QUESTIONS ================= -->
                <div class="section mt-5">
                    <h3 class="section-title">Job Related Questions</h3>

                    <div class="row">
                        @foreach ($questions as $q)
                            @php
                                $isRequired = $q->is_required === 'Yes';
                                $requiredAttr = $isRequired ? 'required' : '';
                                $options = $q->options ? json_decode($q->options, true) : [];
                            @endphp

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    {{ $q->question }}
                                    @if ($isRequired)
                                        <span class="req">*</span>
                                    @endif
                                </label>

                                @if ($q->text_element === 'text')
                                    <input type="text" name="answers[{{ $q->id }}]" class="form-control"
                                        {{ $requiredAttr }}>
                                @elseif ($q->text_element === 'select')
                                    <select name="answers[{{ $q->id }}]" class="form-select"
                                        {{ $requiredAttr }}>
                                        <option value="">Select</option>
                                        @foreach ($options as $opt)
                                            <option value="{{ $opt }}">{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                @elseif ($q->text_element === 'radio')
                                    @foreach ($options as $opt)
                                        <div class="form-check">
                                            <input type="radio" name="answers[{{ $q->id }}]"
                                                value="{{ $opt }}" class="form-check-input"
                                                {{ $requiredAttr }}>
                                            <label class="form-check-label">{{ $opt }}</label>
                                        </div>
                                    @endforeach
                                @elseif ($q->text_element === 'checkbox')
                                    @foreach ($options as $opt)
                                        <div class="form-check">
                                            <input type="checkbox" name="answers[{{ $q->id }}][]"
                                                value="{{ $opt }}" class="form-check-input">
                                            <label class="form-check-label">{{ $opt }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn-submit">Submit Application</button>
                </div>

            </div>
        </form>



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
    <script>
        $(document).ready(function() {

            // Existing country → state code remains

            let selectedState = $('#state').val();
            let selectedCity = "{{ $selected_city ?? '' }}";

            // Page load: fetch cities if state already selected
            if (selectedState) {
                fetchCities(selectedState, selectedCity);
            }

            // On change state
            $('#state').on('change', function() {
                let state_id = $(this).val();
                fetchCities(state_id, '');
            });

            function fetchCities(state_id, selectedCity = '') {
                if (state_id) {
                    $.ajax({
                        url: '/get-cities/' + state_id,
                        type: 'GET',
                        success: function(data) {
                            let cityDropdown = $('#city');
                            cityDropdown.empty();
                            cityDropdown.append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
                                let selected = (value.id == selectedCity) ? 'selected' : '';
                                cityDropdown.append('<option value="' + value.id + '" ' +
                                    selected + '>' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city').empty().append('<option value="">Select City</option>');
                }
            }
        });
    </script>
</body>

</html>
