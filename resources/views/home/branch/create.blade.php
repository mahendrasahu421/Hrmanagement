@extends('layout.master')
@section('title', $title)
@section('main-section')
<x-alert-modal/>
    <div class="page-wrapper" >
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">Branch</h2>
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item" aria-current="page">
                                                Master / Organisation / Branch / Create
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">
                                        <a href="{{ route('masters.organisation.branch') }}"
                                            class="btn btn-primary d-flex align-items-center">
                                            <i class="ti ti-circle-plus me-2"></i>Branch List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('masters.organisation.branch.store') }}">
                                @csrf
                                <div class="form-row row">
                                    <!-- Company -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="company_id">Company Name *</label>
                                        <select class="form-control select2" id="company_id" name="company_id" required>
                                            <option value="">Select Company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select company name.</div>
                                    </div>

                                    <!-- Branch Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="branch_name">Branch Name *</label>
                                        <input type="text" class="form-control" id="branch_name" name="branch_name"
                                            placeholder="Enter Branch Name" required>
                                        <div class="invalid-feedback">Please enter branch name.</div>
                                    </div>

                                    <!-- Branch Code -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="branch_code">Branch Code *</label>
                                        <input type="text" class="form-control" id="branch_code" name="branch_code"
                                            placeholder="Enter Branch Code" required>
                                        <div class="invalid-feedback">Please enter branch code.</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="branch_owner_name">Branch Owner Name *</label>
                                        <input type="text" class="form-control" id="branch_owner_name" name="branch_owner_name"
                                            placeholder="Enter Branch Owner Name" required>
                                        <div class="invalid-feedback">Please enter Branch Owner Name</div>
                                    </div>
                                     <!-- Contact Number -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="contact_number">Contact Number *</label>
                                        <input type="text" class="form-control" id="contact_number" name="contact_number"
                                            placeholder="Enter Contact Number" required>
                                        <div class="invalid-feedback">Please enter contact number.</div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="email">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Branch Email" required>
                                        <div class="invalid-feedback">Please enter valid email.</div>
                                    </div>

                                     <div class="col-md-4 mb-3">
                                        <label class="form-label" for="address_1">Address 1 *</label>
                                        <textarea class="form-control" id="address_1" name="address_1" rows="2" placeholder="Enter Address" required></textarea>
                                        <div class="invalid-feedback">Please enter address_1.</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="country">Country *</label>
                                        <select class="form-control select2" id="country" name="country" required>
                                            <option value="">Select Country</option>
                                            @foreach ($country as $countrys)
                                                <option value="{{ $countrys->id }}"
                                                    {{ isset($selected_country) && $selected_country == $countrys->id ? 'selected' : '' }}>
                                                    {{ $countrys->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please enter country.</div>
                                    </div>

                                    <!-- State -->
                                     <div class="col-md-4 mb-3">
                                        <label class="form-label" for="state">State *</label>
                                        <select class="form-control select2" id="state" name="state" required>
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
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="city">City *</label>
                                        <select class="form-control select2" id="city" name="city" required>
                                            <option value="">Select City</option>
                                            @if (isset($cities))
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ isset($selected_city) && $selected_city == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">Please enter city.</div>
                                    </div>
                                    <!-- Pin Code -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="pincode">Pin Code *</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode"
                                            placeholder="Enter Pin Code" required>
                                        <div class="invalid-feedback">Please enter pincode.</div>
                                    </div>
                                     <div class="col-md-4 mb-3">
                                        <label class="form-label" for="status">Status *</label>
                                        <select class="form-control select2" id="status" name="status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Please select status.</div>
                                    </div>
                                </div>


                                
                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('masters.organisation.branch') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Save Branch
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
