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

                    <form method="POST" action="{{ route('settings.holiday.update', $holiday->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Holiday Name *</label>
                                <input type="text" name="holiday_name"
                                    value="{{ old('holiday_name', $holiday->holiday_name) }}" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Holiday Date *</label>
                                <input type="date" name="holiday_date"
                                    value="{{ old('holiday_date', $holiday->holiday_date?->format('Y-m-d')) }}"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Status *</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{ $holiday->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $holiday->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Remark</label>
                                <textarea name="holiday_remark" class="form-control" rows="3">{{ old('holiday_remark', $holiday->holiday_remark) }}</textarea>
                            </div>

                        </div>

                        <div class="text-end">
                            <a href="{{ route('settings.holiday') }}" class="btn btn-light">Back</a>
                            <button class="btn btn-primary">Update</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
