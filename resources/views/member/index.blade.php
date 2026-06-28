@extends('main.index')


@section('content-style')
    <link rel="stylesheet" href="/assets/content/css/member.css">
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
    <div class="row g-3">
        <!-- Lions Card -->
        @foreach ($houses as $house)
            <div class="col-md-6 col-xl-3">
                <div class="house-card">
                    <div class="house-header">
                        <span class="house-emoji">🦁</span>
                        <span class="house-title">{{ $house->name }}</span>
                        <span class="house-meta">{{ $house->members->count() }} members</span>
                    </div>
                    <ul class="member-list">
                        @if (count($house->members) === 0)
                            <li class="member-item">
                                <span class="member-name">No members yet</span>
                            </li>
                        @else
                            @foreach ($house->members->take(7) as $member)
                                <li class="member-item">
                                    <span class="member-name">{{ $member->person->fullname ?? '' }}</span>
                                    <span class="member-role">{{ $member->role }}</span>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <div class="p-3 text-center">
                        <a href="/member/house/{{ $house->id }}/academic/{{ $academicYears->id }}"
                            class="btn btn-sm btn-outline-primary rounded-pill">View detail</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('content-script')
@endsection
