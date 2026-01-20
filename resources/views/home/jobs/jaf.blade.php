@extends('layout.master')

@section('title', $title)

@section('main-section')
    <x-alert-modal />
    <div class="page-wrapper">
        <div class="content">

            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-4">
                <div class="my-auto">
                    <h2 class="mb-1">{{ $title }}</h2>
                    <p class="text-muted mb-0">Create and manage your job-specific questions.</p>
                </div>
                <div>
                    <a href="{{ route('recruitment.jobs.create') }}"
                        class="btn btn-primary d-flex align-items-center shadow-sm">
                        <i class="fa-solid fa-plus me-2"></i> Add Job
                    </a>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <!-- Form Card -->
            <div class="card shadow-sm border-top border-3 mb-4">
                <div class="card-body">
                    <form id="questionForm" method="post" action="{{ route('jaf.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Select Job <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="job_id" name="job_id">
                                    <option value="">Select Job</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}">{{ $job->job_title }}</option>
                                    @endforeach


                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Enter Question <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="question" name="question"
                                    placeholder="Type your question...">
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Choose Form Element <span class="text-danger">*</span></label>
                                    <select class="form-select select2" id="tool" name="text_element">
                                        <option value="">Select Form Element</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="radio">Radio</option>
                                        <option value="checkbox">Checkbox</option>
                                        <option value="select">Select</option>
                                    </select>
                                </div>

                                <!-- FIXED: Correct placement of Option Box -->
                                <div class="col-md-6" id="optionBox" style="display:none;">
                                    <label class="form-label">Add Options <span class="text-danger">*</span></label>

                                    <div id="optionContainer"></div>

                                    <button type="button" class="btn btn-sm btn-success mt-2" id="addOptionBtn">
                                        Add More
                                    </button>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label">Enter Question Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="order" name="order"
                                    placeholder="Enter order number">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Is Field Mandatory? <span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center gap-3 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_required" value="Yes"
                                            checked>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_required" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end justify-content-end">
                                <button type="submit" class="btn btn-primary px-5 py-2">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>



        </div>

        <x-footer />
    </div>


@endsection


@push('after_scripts')
    <script>
        $("#addOptionBtn").on("click", function() {
            $("#optionContainer").append(`
        <div class="d-flex gap-2 mt-2 option-item">
            <input type="text" name="options[]" class="form-control" placeholder="Enter option value">
            <button type="button" class="btn btn-danger removeOptionBtn">X</button>
        </div>
    `);
        });

        $(document).on("click", ".removeOptionBtn", function() {
            $(this).closest('.option-item').remove();
        });
    </script>
    <script>
        $("#tool").on("change", function() {
            let type = $(this).val();

            if (type == 'radio' || type == 'checkbox' || type == 'select') {
                $("#optionBox").show();

                // CLEAR OLD OPTIONS
                $("#optionContainer").html("");

                // ADD FIRST OPTION AUTOMATICALLY
                $("#optionContainer").append(`
            <div class="d-flex gap-2 mt-2 option-item">
                <input type="text" name="options[]" class="form-control" placeholder="Enter option value">
                <button type="button" class="btn btn-danger removeOptionBtn">X</button>
            </div>
        `);

            } else {
                $("#optionBox").hide();
                $("#optionContainer").html("");
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            let deleteRow;

            $('.edit-btn').on('click', function(e) {
                e.preventDefault();
                const job = $(this).data('job');
                const question = $(this).data('question');
                const tool = $(this).data('tool');
                const order = $(this).data('order');
                const mandatory = $(this).data('mandatory');

                $('#editJob').val(job);
                $('#editQuestion').val(question);
                $('#editTool').val(tool);
                $('#editOrder').val(order);
                $('#editMandatory').val(mandatory);
                $('#editModal').modal('show');
            });

            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                deleteRow = $(this).closest('tr');
                $('#delete_modal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                if (deleteRow) {
                    deleteRow.fadeOut(300, function() {
                        $(this).remove();
                    });
                    $('#delete_modal').modal('hide');
                }
            });
        });
    </script>
@endpush
