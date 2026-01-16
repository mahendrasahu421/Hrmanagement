@extends('layout.master')
@section('title', $title)

@section('main-section')
    <x-alert-modal />

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                                <div class="my-auto mb-2">
                                    <h2 class="mb-1">Edit Company</h2>
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                Master / Organisation / Company / Edit
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                                    <div class="mb-2">
                                        <a href="{{ route('masters.organisation.company') }}" class="btn btn-primary">
                                            Company List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('masters.organisation.company.update', $company->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <!-- Company Logo -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Company Logo</label>
                                        <input type="file" class="form-control" name="company_logo">
                                        @if ($company->company_logo)
                                            <img src="{{ asset('uploads/company/' . $company->company_logo) }}"
                                                class="mt-2" width="80">
                                        @endif
                                    </div>

                                    <!-- Company Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Company Name *</label>
                                        <input type="text" class="form-control" name="company_name"
                                            value="{{ old('company_name', $company->company_name) }}" required>
                                    </div>

                                    <!-- Company Code -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Company Code *</label>
                                        <input type="text" class="form-control" name="company_code"
                                            value="{{ old('company_code', $company->company_code) }}" required>
                                    </div>

                                    <!-- Contact Number -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Contact Number *</label>
                                        <input type="text" class="form-control" name="contact_no"
                                            value="{{ old('contact_no', $company->contact_no) }}" required>
                                    </div>

                                    <!-- Landline -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Landline Number</label>
                                        <input type="text" class="form-control" name="landline_no"
                                            value="{{ old('landline_no', $company->landline_no) }}">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email', $company->email) }}" required>
                                    </div>

                                    <!-- GST, PAN, CIN, IEC, Website -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">GST Number</label>
                                        <input type="text" class="form-control" name="gst_no"
                                            value="{{ old('gst_no', $company->gst_no) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">PAN Number</label>
                                        <input type="text" class="form-control" name="pan_no"
                                            value="{{ old('pan_no', $company->pan_no) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">CIN Number</label>
                                        <input type="text" class="form-control" name="cin_no"
                                            value="{{ old('cin_no', $company->cin_no) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">IEC Number</label>
                                        <input type="text" class="form-control" name="iec"
                                            value="{{ old('iec', $company->iec) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Website</label>
                                        <input type="text" class="form-control" name="website"
                                            value="{{ old('website', $company->website) }}">
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Address *</label>
                                        <textarea class="form-control" name="address" rows="2" required>{{ old('address', $company->address) }}</textarea>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Country *</label>
                                        <select id="country" name="country" class="form-control select2" required>
                                            <option value="">Select Country</option>
                                            @foreach ($country as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ old('country', $company->country) == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">State *</label>
                                        <select id="state" name="state" class="form-control select2" required>
                                            <option value="">Select State</option>
                                        </select>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">City *</label>
                                        <select id="city" name="city" class="form-control select2" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>

                                    <!-- Pin Code -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Pin Code *</label>
                                        <input type="text" class="form-control" name="pincode"
                                            value="{{ old('pincode', $company->pincode) }}" required>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status *</label>
                                        <select class="form-control select2" name="status" required>
                                            <option value="Active"
                                                {{ old('status', $company->status) == 'Active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="Inactive"
                                                {{ old('status', $company->status) == 'Inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('masters.organisation.company') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Update Company
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
            let selectedCountry = "{{ old('country', $company->country) }}";
            let selectedState = "{{ old('state', $company->state) }}";
            let selectedCity = "{{ old('city', $company->city) }}";

            function loadStates(country_id, state_id = null) {
                $('#state').html('<option value="">Select State</option>');
                $('#city').html('<option value="">Select City</option>');

                if (country_id) {
                    $.get('/get-state/' + country_id, function(states) {
                        $.each(states, function(key, value) {
                            let selected = (state_id == value.id) ? 'selected' : '';
                            $('#state').append('<option value="' + value.id + '" ' + selected +
                                '>' + value.name + '</option>');
                        });

                        // Load cities for pre-selected state
                        if (state_id) {
                            loadCities(state_id, selectedCity);
                        }
                    });
                }
            }

            function loadCities(state_id, city_id = null) {
                $('#city').html('<option value="">Select City</option>');
                if (state_id) {
                    $.get('/get-cities/' + state_id, function(cities) {
                        $.each(cities, function(key, value) {
                            let selected = (city_id == value.id) ? 'selected' : '';
                            $('#city').append('<option value="' + value.id + '" ' + selected + '>' +
                                value.name + '</option>');
                        });
                    });
                }
            }

            // Initial load for edit
            if (selectedCountry) {
                loadStates(selectedCountry, selectedState);
            }

            // When country changes
            $('#country').on('change', function() {
                let country_id = $(this).val();
                loadStates(country_id);
            });

            // When state changes
            $('#state').on('change', function() {
                let state_id = $(this).val();
                loadCities(state_id);
            });
        });
    </script>
@endpush
