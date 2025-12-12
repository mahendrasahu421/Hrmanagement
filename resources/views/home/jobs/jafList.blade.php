@extends('layout.master')

@section('title', $title)

@section('main-section')
<x-alert-modal/>
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



            <!-- Table Section -->
            <div class="card">
                <div class="card-body p-0">
                    <div class="custom-datatable-filter table-responsive">
                        <table class="table align-middle text-center" id="questionTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>
                                        <input class="form-check-input" type="checkbox" id="select-all">
                                    </th>
                                    <th>S.No.</th>
                                    <th>Question</th>
                                    <th>Tool</th>
                                    <th>Option</th>
                                    <th>Choose Max.</th>
                                    <th>Order</th>
                                    <th>Mandatory</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample Rows -->
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>1</td>
                                    <td><strong>What is your experience with Laravel?</strong></td>
                                    <td>Textarea</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>1</td>
                                    <td><span class="badge badge-success">Yes</span></td>
                                    <td>
                                        <a href="#" class="me-2 edit-btn" data-job="Web Developer"
                                            data-question="What is your experience with Laravel?" data-tool="Textarea"
                                            data-order="1" data-mandatory="Yes"><i class="ti ti-edit"></i></a>
                                        <a href="#" class="delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>1</td>
                                    <td><strong>What is your experience with Laravel?</strong></td>
                                    <td>Textarea</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>1</td>
                                    <td><span class="badge badge-success">Yes</span></td>
                                    <td>
                                        <a href="#" class="me-2 edit-btn" data-job="Web Developer"
                                            data-question="What is your experience with Laravel?" data-tool="Textarea"
                                            data-order="1" data-mandatory="Yes"><i class="ti ti-edit"></i></a>
                                        <a href="#" class="delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
