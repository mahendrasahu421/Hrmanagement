@extends('employee.layout.layout')
@section('title', $title)
@section('main-section')

    <x-alert-modal />

    <style>

    </style>

    <div class="page-wrapper" style="min-height: 428px;">
        <div class="content">

            <!-- Page Header -->
            <div class="mb-4">
                <h4 class="mb-2">Form C</h4>
                <h5 class="mb-3 text-muted">फॉर्म सी</h5>
            </div>

        </div>

        <x-footer />
    </div>

@endsection

@push('after_scripts')
    <script></script>
@endpush
