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
                <p class="text-muted mb-0">Edit job-specific question.</p>
            </div>
            <div>
                <a href="{{ route('jaf.index') }}" class="btn btn-primary d-flex align-items-center  ">
                    <i class="fa-solid fa-arrow-left me-2"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Edit Form Card -->
        <div class="card   border-top border-3 mb-4">
            <div class="card-body">
                <form method="post" action="{{ route('jaf.update', $question->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Select Job <span class="text-danger">*</span></label>
                            <select class="form-select select2" name="job_id" id="job_id">
                                <option value="">Select Job</option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" {{ $question->job_id == $job->id ? 'selected' : '' }}>
                                        {{ $job->job_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Enter Question <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="question" id="question"
                                value="{{ $question->question }}" placeholder="Type your question...">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Choose Form Element <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="tool" name="text_element">
                                <option value="">Select Form Element</option>
                                <option value="text" {{ $question->text_element=='text' ? 'selected' : '' }}>Text</option>
                                <option value="textarea" {{ $question->text_element=='textarea' ? 'selected' : '' }}>Textarea</option>
                                <option value="radio" {{ $question->text_element=='radio' ? 'selected' : '' }}>Radio</option>
                                <option value="checkbox" {{ $question->text_element=='checkbox' ? 'selected' : '' }}>Checkbox</option>
                                <option value="select" {{ $question->text_element=='select' ? 'selected' : '' }}>Select</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="optionBox" style="display:none;">
                            <label class="form-label">Add Options <span class="text-danger">*</span></label>
                            <div id="optionContainer"></div>
                            <button type="button" class="btn btn-sm btn-success mt-2" id="addOptionBtn">
                                Add More
                            </button>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Enter Question Order <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="order" id="order"
                                value="{{ $question->order }}" placeholder="Enter order number">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Is Field Mandatory? <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_required" value="Yes"
                                        {{ $question->is_required=='Yes' ? 'checked' : '' }}>
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_required" value="No"
                                        {{ $question->is_required=='No' ? 'checked' : '' }}>
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5 py-2">Update</button>
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
$(document).ready(function() {
    // Load options if tool is radio/checkbox/select
    function renderOptions() {
        const type = $('#tool').val();
        const options = {!! $question->options ? $question->options : '[]' !!};

        if (type == 'radio' || type == 'checkbox' || type == 'select') {
            $('#optionBox').show();
            $('#optionContainer').html('');
            if (options.length > 0) {
                options.forEach(opt => {
                    $('#optionContainer').append(`
                        <div class="d-flex gap-2 mt-2 option-item">
                            <input type="text" name="options[]" class="form-control" value="${opt}" placeholder="Enter option value">
                            <button type="button" class="btn btn-danger removeOptionBtn">X</button>
                        </div>
                    `);
                });
            } else {
                $('#optionContainer').append(`
                    <div class="d-flex gap-2 mt-2 option-item">
                        <input type="text" name="options[]" class="form-control" placeholder="Enter option value">
                        <button type="button" class="btn btn-danger removeOptionBtn">X</button>
                    </div>
                `);
            }
        } else {
            $('#optionBox').hide();
            $('#optionContainer').html('');
        }
    }

    renderOptions();

    $('#tool').on('change', renderOptions);

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
});
</script>
@endpush
