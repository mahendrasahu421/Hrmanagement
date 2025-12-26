@extends('layout.master')
@section('title', $title)
@section('main-section')

    <div class="page-wrapper">
        <div class="content">

            <div class="card">
                <div class="card-header">
                    <h4>{{ $title }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('settings.holiday.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Holiday Name *</label>
                                <input type="text" name="holiday_name" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Holiday Date *</label>
                                <input type="date" name="holiday_date" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Status *</label>
                                <select name="status" class="form-control select2">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Holiday Remark</label>
                                <textarea name="holiday_remark" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('settings.holiday') }}" class="btn btn-light">Back</a>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

@endsection
