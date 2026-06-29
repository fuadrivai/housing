@extends('main.index')


@section('content-style')
    <link rel="stylesheet" href="/assets/content/css/point.css">
@endsection

@section('content')
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <label class="form-label">Academic Year : {{ $academicYears->name ?? '' }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        @foreach ($houses as $house)
            <div class="col-md-6 col-xl-3">
                <div class="house-point-card">
                    <div class="house-emoji">🦁</div>
                    <div class="house-name">{{ $house->name }}</div>
                    <div class="total-points">{{ number_format($house->total_points) }}</div>
                    <div class="point-label">Total Points</div>
                    <div class="member-count"><i data-lucide="users"
                            style="width:14px;height:14px; vertical-align:middle;"></i>
                        {{ $house->members->count() }} members</div>
                    <a href="/point/house/{{ $house->id }}/academic/{{ $academicYears->id ?? '' }}"
                        class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('content-script')
@endsection
