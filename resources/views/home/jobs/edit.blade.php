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
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">Edit Job</h2>
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">Recruitment / Job / Edit</li>
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
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('recruitment.jobs.update', $job->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Branch -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Select Branch *</label>
                                        <select class="form-select select2" name="branch_id" required>
                                            <option value="">Select Branch</option>
                                            @foreach ($branch as $branchs)
                                                <option value="{{ $branchs->id }}"
                                                    {{ $job->branch_id == $branchs->id ? 'selected' : '' }}>
                                                    {{ $branchs->branch_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please enter Branch name.</div>
                                    </div>

                                    <!-- Job Title -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Job Title *</label>
                                        <input type="text" class="form-control" name="job_title"
                                            placeholder="Enter Job Title" value="{{ $job->job_title }}" required>
                                        <div class="invalid-feedback">Please enter job title.</div>
                                    </div>

                                    <!-- Designations -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Designations *</label>
                                        <select class="form-select select2" name="designation_id" required>
                                            <option value="">Select Designations</option>
                                            @foreach ($designation as $designations)
                                                <option value="{{ $designations->id }}"
                                                    {{ $job->designation_id == $designations->id ? 'selected' : '' }}>
                                                    {{ $designations->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select Designations.</div>
                                    </div>

                                    <!-- Test Skills -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Test Skills *</label>
                                        <select class="form-select select2" name="test_skills[]" multiple required>
                                            @foreach ($jobSkills as $skill)
                                                <option value="{{ $skill->id }}"
                                                    {{ in_array($skill->id, (array) $job->test_skills) ? 'selected' : '' }}>
                                                    {{ $skill->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select at least one skill.</div>
                                    </div>

                                    <!-- No of Positions -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">No. of Positions *</label>
                                        <input type="number" class="form-control" name="positions"
                                            value="{{ $job->positions }}" placeholder="Enter Number of Positions" required
                                            min="1">
                                        <div class="invalid-feedback">Please enter number of positions.</div>
                                    </div>

                                    <!-- Job Type -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Job Type *</label>
                                        <select class="form-select select2" name="job_type_id" required>
                                            <option value="">Select Job Type</option>
                                            @foreach ($jobsType as $jobs)
                                                <option value="{{ $jobs->id }}"
                                                    {{ $job->job_type_id == $jobs->id ? 'selected' : '' }}>
                                                    {{ $jobs->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select job type.</div>
                                    </div>

                                    <!-- CTC From -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">CTC From (Lac/Year)</label>
                                        <input type="number" step="0.1" class="form-control" name="ctc_from"
                                            value="{{ $job->ctc_from }}" placeholder="Enter CTC From">
                                    </div>

                                    <!-- CTC To -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">CTC To (Lac/Year)</label>
                                        <input type="number" step="0.1" class="form-control" name="ctc_to"
                                            value="{{ $job->ctc_to }}" placeholder="Enter CTC To">
                                    </div>

                                    <!-- Min Experience -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Min Experience *</label>
                                        <select class="form-select select2" name="min_exp" required>
                                            @for ($i = 0; $i <= 20; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $job->min_exp == $i ? 'selected' : '' }}>{{ $i }} Years
                                                </option>
                                            @endfor
                                        </select>
                                        <div class="invalid-feedback">Please select minimum experience.</div>
                                    </div>

                                    <!-- Max Experience -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Max Experience *</label>
                                        <select class="form-select select2" name="max_exp" required>
                                            @for ($i = 0; $i <= 20; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $job->max_exp == $i ? 'selected' : '' }}>{{ $i }} Years
                                                </option>
                                            @endfor
                                        </select>
                                        <div class="invalid-feedback">Please select maximum experience.</div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">State *</label>
                                        <select class="form-control select2" id="state" name="state_id" required>
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}"
                                                    {{ $job->state_id == $state->id ? 'selected' : '' }}>
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select state.</div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Location *</label>
                                        <select class="form-control select2" id="city" name="city_ids[]" multiple
                                            required>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ in_array($city->id, (array) $job->city_ids) ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select city.</div>
                                    </div>

                                    <!-- Job Description -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Job Description *</label>
                                        <textarea id="job_description" class="form-control" name="job_description" rows="4" required>{{ $job->job_description }}</textarea>
                                        <div class="invalid-feedback">Please enter job description.</div>
                                    </div>

                                    <!-- Qualifications -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Select Qualification *</label>
                                        <select class="form-select select2" name="qualifications[]" multiple required>
                                            @php
                                                $jobQualifications = (array) $job->qualifications;
                                            @endphp
                                            @foreach (['High School', 'Diploma', 'Post Graduation', 'PhD', 'Certification Course', 'ITI', 'Polytechnic', 'Vocational Training', 'Diploma in Management', 'Professional Course', 'Chartered Accountant (CA)', 'Cost & Management Accountant (CMA)', 'Certified Financial Analyst (CFA)', 'Company Secretary (CS)', 'Finance Diploma / Certification', 'Other'] as $qualification)
                                                <option value="{{ $qualification }}"
                                                    {{ in_array($qualification, $jobQualifications) ? 'selected' : '' }}>
                                                    {{ $qualification }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select at least one Qualification.</div>
                                    </div>

                                    <!-- Keywords -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Keywords</label>
                                        <input type="text" class="form-control" name="keywords"
                                            value="{{ $job->keywords }}" placeholder="Enter Keywords (comma separated)">
                                    </div>

                                    <!-- Interview Date -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Interview Date <small>(Optional)</small></label>
                                        <input type="date" class="form-control" name="interview_date"
                                            value="{{ $job->interview_date ? \Carbon\Carbon::parse($job->interview_date)->format('Y-m-d') : '' }}">
                                    </div>

                                    <!-- Job Status -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Select Status *</label>
                                        <select class="form-select select2" name="status" required>
                                            <option value="DRAFT" {{ $job->status == 'DRAFT' ? 'selected' : '' }}>DRAFT
                                            </option>
                                            <option value="PUBLISHED" {{ $job->status == 'PUBLISHED' ? 'selected' : '' }}>
                                                PUBLISHED</option>
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
                                        <i class="ti ti-device-floppy me-1"></i> Update Job
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

            let selectedState = "{{ $job->state_id }}";
            let selectedCity = @json((array) $job->city_ids);

            if (selectedState) {
                fetchCities(selectedState, selectedCity);
            }

            $('#state').on('change', function() {
                let state_id = $(this).val();
                fetchCities(state_id, []);
            });

            function fetchCities(state_id, selectedCity = []) {
                if (state_id) {
                    $.ajax({
                        url: '/get-cities/' + state_id,
                        type: 'GET',
                        success: function(data) {
                            let cityDropdown = $('#city');
                            cityDropdown.empty();

                            selectedCity = selectedCity.map(Number);

                            $.each(data, function(key, value) {
                                let selected = selectedCity.includes(value.id) ? 'selected' :
                                '';
                                cityDropdown.append(
                                    `<option value="${value.id}" ${selected}>${value.name}</option>`
                                );
                            });

                            cityDropdown.trigger('change');
                        }
                    });
                } else {
                    $('#city').empty();
                }
            }

        });
        ClassicEditor
            .create(document.querySelector('#job_description'))
            .catch(error => console.error(error));
    </script>
@endpush
