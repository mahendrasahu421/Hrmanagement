@extends('layout.master')
@section('title', $title)

@section('main-section')

    <div class="page-wrapper">
        <div class="content">
            <x-alert-modal />
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header">
                            <!-- Breadcrumb -->
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">Create Job</h2>
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item" aria-current="page">
                                                Recruitment / Job / Create
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">
                                        <a href="{{ route('recruitment.jobs') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-list me-2"></i> Job List
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Breadcrumb -->
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('recruitment.jobs.store') }}">
                                @csrf

                                <div class="row">
                                    <!-- Branch -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Select Branch *</label>
                                        <select class="form-select select2" name="branch_id" required>
                                            <option value="">Select Branch</option>
                                            @foreach ($branch as $branchs)
                                                <option value="{{ $branchs->id }}">{{ $branchs->branch_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please enter Branch name.</div>
                                    </div>

                                    <!-- Job Title -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Job Title *</label>
                                        <input type="text" class="form-control" name="job_title"
                                            placeholder="Enter Job Title" required>
                                        <div class="invalid-feedback">Please enter job title.</div>
                                    </div>

                                    <!-- Designations -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Designations *</label>
                                        <select class="form-select select2" name="designation_id" required>
                                            <option value="">Select Designations</option>
                                            @foreach ($designation as $designations)
                                                <option value="{{ $designations->id }}">{{ $designations->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select Designations.</div>
                                    </div>

                                    <!-- Test Skills (tags) -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Test Skills *</label>
                                        <input type="text" class="form-control" name="test_skills"
                                            placeholder="Enter Test Skills (comma separated)" required>
                                        <div class="invalid-feedback">Please enter test skills.</div>
                                    </div>

                                    <!-- No of Positions -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">No. of Positions *</label>
                                        <input type="number" class="form-control" name="positions"
                                            placeholder="Enter Number of Positions" required min="1">
                                        <div class="invalid-feedback">Please enter number of positions.</div>
                                    </div>

                                    <!-- Job Type -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Job Type *</label>
                                        <select class="form-select select2" name="job_type_id" required>
                                            <option value="">Select Job Type</option>
                                            @foreach ($jobsType as $jobs)
                                                <option value="{{ $jobs->id }}">{{ $jobs->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select job type.</div>
                                    </div>

                                    <!-- CTC From -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">CTC From (Lac/Year)</label>
                                        <input type="number" step="0.1" class="form-control" name="ctc_from"
                                            placeholder="Enter CTC From">
                                    </div>

                                    <!-- CTC To -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">CTC To (Lac/Year)</label>
                                        <input type="number" step="0.1" class="form-control" name="ctc_to"
                                            placeholder="Enter CTC To">
                                    </div>

                                    <!-- Min Experience -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Min Experience *</label>
                                        <select class="form-select select2" name="min_exp" required>
                                            <option value="">Select Min Experience</option>
                                            @for ($i = 0; $i <= 20; $i++)
                                                <option value="{{ $i }}">{{ $i }} Years</option>
                                            @endfor
                                        </select>
                                        <div class="invalid-feedback">Please select minimum experience.</div>
                                    </div>

                                    <!-- Max Experience -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Max Experience *</label>
                                        <select class="form-select select2" name="max_exp" required>
                                            <option value="">Select Max Experience</option>
                                            @for ($i = 0; $i <= 20; $i++)
                                                <option value="{{ $i }}">{{ $i }} Years</option>
                                            @endfor
                                        </select>
                                        <div class="invalid-feedback">Please select maximum experience.</div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="state">State *</label>
                                        <select class="form-control select2" id="state" name="state_id" required>
                                            <option value="">Select State</option>
                                            @if (isset($states))
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        {{ isset($selected_state) && $selected_state == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">Please enter state.</div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="city">City *</label>
                                        <select class="form-control select2" id="city" name="city_ids[]" multiple
                                            required>
                                            <option value="">Select City</option>
                                            @if (isset($cities))
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ isset($selected_city) && in_array($city->id, (array) $selected_city) ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">Please enter city.</div>
                                    </div>

                                    <!-- Job Description -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Job Description *</label>
                                        <textarea id="job_description" class="form-control" name="job_description" rows="4" required
                                            placeholder="Enter Job Description"></textarea>
                                        <div class="invalid-feedback">Please enter job description.</div>
                                    </div>

                                    <!-- Qualification -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Select Qualification *</label>
                                        <select class="form-select select2" name="qualifications[]" multiple required>
                                            <option value="High School">High School</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="Post Graduation">Post Graduation</option>
                                            <option value="PhD">PhD</option>
                                            <option value="Certification Course">Certification Course</option>
                                            <option value="ITI">ITI</option>
                                            <option value="Polytechnic">Polytechnic</option>
                                            <option value="Vocational Training">Vocational Training</option>
                                            <option value="Diploma in Management">Diploma in Management</option>
                                            <option value="Professional Course">Professional Course</option>
                                            <option value="Chartered Accountant (CA)">Chartered Accountant (CA)</option>
                                            <option value="Cost & Management Accountant (CMA)">Cost & Management Accountant
                                                (CMA)</option>
                                            <option value="Certified Financial Analyst (CFA)">Certified Financial Analyst
                                                (CFA)</option>
                                            <option value="Company Secretary (CS)">Company Secretary (CS)</option>
                                            <option value="Finance Diploma / Certification">Finance Diploma / Certification
                                            </option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div class="invalid-feedback">Please select at least one Qualification.</div>
                                    </div>

                                    <!-- Keywords -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Keywords</label>
                                        <input type="text" class="form-control" name="keywords"
                                            placeholder="Enter Keywords (comma separated)">
                                    </div>

                                    <!-- Interview Date -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Interview Date <small>(Optional)</small></label>
                                        <input type="date" class="form-control" name="interview_date">
                                    </div>

                                    <!-- Job Status -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Select Status *</label>
                                        <select class="form-select select2" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="DRAFT">DRAFT</option>
                                            <option value="PUBLISHED">PUBLISHED</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('recruitment.jobs') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Save Job
                                    </button>
                                </div>
                            </form>



                        </div>

                    </div>
                </div>
            </div>

        </div>

        <x-footer />
    </div>

@endsection
@push('after_scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
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
    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        toastElList.map(function(toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                delay: 30000
            });
            toast.show();
        });
        ClassicEditor
            .create(document.querySelector('#job_description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
