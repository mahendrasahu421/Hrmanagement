@extends('employee.layout.layout')
@section('title', $title)
@section('main-section')

    <style>
        .holiday-event {
            background: #ffe7e7 !important;
            color: #d80000 !important;
            border-radius: 6px !important;
            padding: 3px 6px !important;
            font-size: 12px !important;
            border: none !important;
            font-weight: 500;
        }

        .fc-event-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fc-daygrid-event {
            margin: 2px 0 !important;
        }

        .fc-daygrid-event-harness a {
            text-decoration: none !important;
        }
    </style>

    <div class="page-wrapper">
        <div class="content">
            <x-alert-modal />
            <!-- Breadcrumb -->
            <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
                <div class="my-auto mb-2">
                    <h2 class="mb-1">Calendar</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12 col-xl-12 theiaStickySidebar">
                    <div class="card border-0">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
            <p class="mb-0">2014 - 2025 &copy; SmartHR.</p>
            <p>Designed &amp; Developed By <a href="#" class="text-primary">Dreams</a></p>
        </div>
    </div>



@endsection
@push('after_scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth",
                height: "auto",
                displayEventTime: false,
                events: @json($events),
            });

            calendar.render();
        });
    </script>
@endpush
