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
                                    <h2 class="mb-1">Edit Branch</h2>
                                    <nav>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                Master / Organisation / Branch / Edit
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
                                action="{{ route('masters.organisation.branch.update', $branch->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-row row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Company Name *</label>
                                        <select class="form-control select2" name="company_id" required>
                                            <option value="">Select Company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ $branch->company_id == $company->id ? 'selected' : '' }}>
                                                    {{ $company->company_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Branch Name *</label>
                                        <input type="text" class="form-control" name="branch_name"
                                            value="{{ $branch->branch_name }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Branch Code *</label>
                                        <input type="text" class="form-control" name="branch_code"
                                            value="{{ $branch->branch_code }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Branch Owner Name *</label>
                                        <input type="text" class="form-control" name="branch_owner_name"
                                            value="{{ $branch->branch_owner_name }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Contact Number *</label>
                                        <input type="text" class="form-control" name="contact_number"
                                            value="{{ $branch->contact_number }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $branch->email }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Address *</label>
                                        <textarea class="form-control" rows="2" name="address_1" required>{{ $branch->address_1 }}</textarea>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Country *</label>
                                        <select class="form-control select2" id="country" name="country" required>
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ $branch->country == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">State *</label>
                                        <select class="form-control select2" id="state" name="state"
                                            required></select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">City *</label>
                                        <select class="form-control select2" id="city" name="city"
                                            required></select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Pin Code *</label>
                                        <input type="text" class="form-control" name="pincode"
                                            value="{{ $branch->pincode }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status *</label>
                                        <select class="form-control select2" name="status" required>
                                            <option value="1" {{ $branch->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $branch->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('masters.organisation.branch') }}" class="btn btn-light me-2">
                                        <i class="ti ti-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="reset" class="btn btn-secondary me-2">
                                        <i class="ti ti-x me-1"></i> Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-device-floppy me-1"></i> Update Branch
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

            let selectedCountry = $('#country').val();
            let selectedState = "{{ $branch->state }}";
            let selectedCity = "{{ $branch->city }}";

            if (selectedCountry) {
                fetchStates(selectedCountry, selectedState);
            }

            $('#country').change(function() {
                fetchStates($(this).val(), '');
            });

            $('#state').change(function() {
                fetchCities($(this).val(), '');
            });

            function fetchStates(country_id, selectedState = '') {
                $.get('/get-state/' + country_id, function(data) {
                    $('#state').empty().append('<option value="">Select State</option>');
                    $.each(data, function(i, v) {
                        $('#state').append(
                            `<option value="${v.id}" ${v.id == selectedState ? 'selected' : ''}>${v.name}</option>`
                        );
                    });

                    if (selectedState) {
                        fetchCities(selectedState, selectedCity);
                    }
                });
            }

            function fetchCities(state_id, selectedCity = '') {
                $.get('/get-cities/' + state_id, function(data) {
                    $('#city').empty().append('<option value="">Select City</option>');
                    $.each(data, function(i, v) {
                        $('#city').append(
                            `<option value="${v.id}" ${v.id == selectedCity ? 'selected' : ''}>${v.name}</option>`
                        );
                    });
                });
            }
        });
    </script>
@endpush
