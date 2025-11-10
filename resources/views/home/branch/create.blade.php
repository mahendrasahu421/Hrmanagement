@extends('layout.master')
@section('title', $title)
@section('main-section')
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
                            <!-- /Breadcrumb -->
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('masters.organisation.branch.store') }}">
                                @csrf
                                <div class="form-row row">
                                    <!-- Country Name -->

                                    
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="compney_name">Compney Name *</label>
                                        <input type="text" class="form-control" id="compney_name" name="compney_name"
                                            placeholder="Enter Compney Name" required>
                                        <div class="invalid-feedback">Please enter Compney Name.</div>
                                    </div>
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

                                    <!-- Contact Number -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="contact_no">Contact Number *</label>
                                        <input type="text" class="form-control" id="contact_no" name="contact_no"
                                            placeholder="Enter Contact Number" required>
                                        <div class="invalid-feedback">Please enter contact number.</div>
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <!-- Email -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="email">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Branch Email" required>
                                        <div class="invalid-feedback">Please enter valid email.</div>
                                    </div>

                                    <!-- GST Number -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="gst_no">GST Number</label>
                                        <input type="text" class="form-control" id="gst_no" name="gst_no"
                                            placeholder="Enter GST Number">
                                    </div>

                                    <!-- Website -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="website">Website</label>
                                        <input type="text" class="form-control" id="website" name="website"
                                            placeholder="Enter Website URL">
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <!-- Address -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="address">Address *</label>
                                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter Address" required></textarea>
                                        <div class="invalid-feedback">Please enter address.</div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="country_id">Country Name *</label>
                                        <select class="form-control" id="country_id" name="country_id" required>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">Please enter branch name.</div>
                                    </div>
                                    <!-- State -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="state_id">State *</label>
                                        <select class="form-control select2" id="state_id" name="state_id" required>


                                        </select>
                                        <div class="invalid-feedback">Please enter state.</div>
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <!-- City -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="city_id">City *</label>
                                          <select class="form-control select2" id="city_id" name="city_id" required>


                                        </select>
                                        <input type="text" class="form-control" id="city_id" name="city_id"
                                            placeholder="Enter City" required>
                                        <div class="invalid-feedback">Please enter city.</div>
                                    </div>

                                    <!-- Pin Code -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="pincode">Pin Code *</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode"
                                            placeholder="Enter Pin Code" required>
                                        <div class="invalid-feedback">Please enter pincode.</div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="status">Status *</label>
                                        <select class="form-control" id="status" name="status" required>
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
    <!-- /Page Wrapper -->






@endsection
@push('after_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 first
            $('#country_id').select2();

            // Then bind change event
            $('#country_id').on('change', function() {
                let countryId = $(this).val();


                if (countryId) {
                    $.ajax({
                        url: "{{ url('/get-state') }}/" + countryId,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            $('#state_id').html('<option>Loading...</option>');
                        },
                        success: function(data) {
                            $('#state_id').empty().append(
                                '<option value="">Select State</option>');
                            if (data && data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#state_id').append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });
                            } else {
                                $('#state_id').append(
                                    '<option value="">No states found</option>');
                            }
                        },
                        error: function() {
                            alert('Error fetching states.');
                            $('#state_id').html('<option value="">Select State</option>');
                        }
                    });
                } else {
                    $('#state_id').empty().append('<option value="">Select State</option>');
                }
            });

            $('#state_id').on('change', function() {
                let stateId = $(this).val();


                if (stateId) {
                    $.ajax({
                        url: "{{ url('/get-city') }}/" + stateId,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            $('#city_id').html('<option>Loading...</option>');
                        },
                        success: function(data) {
                            $('#city_id').empty().append(
                                '<option value="">Select City</option>');
                            if (data && data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#city_id').append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });
                            } else {
                                $('#city_id').append(
                                    '<option value="">No Citys found</option>');
                            }
                        },
                        error: function() {
                            alert('Error fetching Citys.');
                            $('#city_id').html('<option value="">Select City</option>');
                        }
                    });
                } else {
                    $('#city_id').empty().append('<option value="">Select City</option>');
                }
            });
        });
    </script>
@endpush
