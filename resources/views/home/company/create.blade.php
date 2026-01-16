@extends('layout.master')
@section('title', $title)
@section('main-section')
    <x-alert-modal />
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Breadcrumb -->
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">Company</h2>
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item" aria-current="page">
                                                Master / Organisation / Company / Create
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">
                                        <a href="{{ route('masters.organisation.company') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-circle-plus me-2"></i>Company List
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Breadcrumb -->
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('masters.organisation.company.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row row">
                                    <!-- Company Logo (Optional) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="company_logo">Company Logo</label>
                                        <input type="file" class="form-control" id="company_logo" name="company_logo">
                                    </div>

                                    <!-- Company Name (Required) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="company_name">Company Name *</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name"
                                            placeholder="Enter Company Name" required>
                                        <div class="invalid-feedback">Please enter company name.</div>
                                    </div>

                                    <!-- Company Code (Optional) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="company_code">Company Code</label>
                                        <input type="text" class="form-control" id="company_code" name="company_code"
                                            placeholder="Enter Company Code">
                                    </div>

                                    <!-- Contact Number (Required) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="contact_no">Contact Number *</label>
                                        <input type="text" class="form-control" id="contact_no" name="contact_no"
                                            placeholder="Enter Contact Number" required>
                                        <div class="invalid-feedback">Please enter contact number.</div>
                                    </div>

                                    <!-- Landline (Optional) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="landline_no">Landline Number</label>
                                        <input type="text" class="form-control" id="landline_no" name="landline_no"
                                            placeholder="Enter Landline Number">
                                    </div>

                                    <!-- Email (Required) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="email">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Company Email" required>
                                        <div class="invalid-feedback">Please enter a valid email.</div>
                                    </div>

                                    <!-- GST, PAN, CIN, IEC (Optional) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="gst_no">GST Number</label>
                                        <input type="text" class="form-control" id="gst_no" name="gst_no"
                                            placeholder="Enter GST Number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="pan_no">PAN Number</label>
                                        <input type="text" class="form-control" id="pan_no" name="pan_no"
                                            placeholder="Enter PAN Number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="cin_no">CIN Number</label>
                                        <input type="text" class="form-control" id="cin_no" name="cin_no"
                                            placeholder="Enter CIN Number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="iec">IEC Number</label>
                                        <input type="text" class="form-control" id="iec" name="iec"
                                            placeholder="Enter IEC Number">
                                    </div>

                                    <!-- Website (Optional) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="website">Website</label>
                                        <input type="text" class="form-control" id="website" name="website"
                                            placeholder="Enter Website URL">
                                    </div>

                                    <!-- Address (Required) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="address">Address *</label>
                                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter Address" required></textarea>
                                        <div class="invalid-feedback">Please enter address.</div>
                                    </div>

                                    <!-- Country / State / City (Required) -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="country">Country *</label>
                                        <select class="form-control select2" id="country" name="country" required>
                                            <option value="">Select Country</option>
                                            @foreach ($country as $countrys)
                                                <option value="{{ $countrys->id }}">{{ $countrys->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select country.</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="state">State *</label>
                                        <select class="form-control select2" id="state" name="state" required>
                                            <option value="">Select State</option>
                                        </select>
                                        <div class="invalid-feedback">Please select state.</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="city">City *</label>
                                        <select class="form-control select2" id="city" name="city" required>
                                            <option value="">Select City</option>
                                        </select>
                                        <div class="invalid-feedback">Please select city.</div>
                                    </div>

                                    <!-- Pin Code -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="pincode">Pin Code *</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode"
                                            placeholder="Enter Pin Code" required>
                                        <div class="invalid-feedback">Please enter pin code.</div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="status">Status *</label>
                                        <select class="form-control select2" id="status" name="status" required>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('masters.organisation.company') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Save Company
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
    <!-- /Page Wrapper -->

@endsection
@push('after_scripts')
    <script>
        $(document).ready(function() {
            // On page load, if country is already selected, fetch states
            let selectedCountry = $('#country').val();
            let selectedState = "{{ $selected_state ?? '' }}";

            if (selectedCountry) {
                fetchStates(selectedCountry, selectedState);
            }

            // On change country
            $('#country').on('change', function() {
                let country_id = $(this).val();
                fetchStates(country_id, '');
            });

            function fetchStates(country_id, selectedState = '') {
                if (country_id) {
                    $.ajax({
                        url: '/get-state/' + country_id,
                        type: 'GET',
                        success: function(data) {
                            let stateDropdown = $('#state');
                            stateDropdown.empty();
                            stateDropdown.append('<option value="">Select State</option>');
                            $.each(data, function(key, value) {
                                let selected = (value.id == selectedState) ? 'selected' : '';
                                stateDropdown.append('<option value="' + value.id + '" ' +
                                    selected + '>' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#state').empty().append('<option value="">Select State</option>');
                }
            }
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
@endpush
