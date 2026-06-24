@extends('main.index')

@section('content-style')
    <link rel="stylesheet" href="/assets/content/css/member.css">
@endsection

@section('content')
    <div class="selection-card">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label fw-semibold"><i data-lucide="calendar" style="width:14px;height:14px;"></i>
                        Academic Year</label>
                    <select class="form-select" id="academicYearSelect">
                        @foreach ($academicYears as $year)
                            <option value="{{ $year->id }}" {{ $year->is_active ? 'selected' : '' }}>
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold"><i data-lucide="building-2" style="width:14px;height:14px;"></i>
                        House</label>
                    <select class="form-select" id="houseSelect">
                        @foreach ($houses as $house)
                            <option value="{{ $house->id }}">{{ $house->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Left: Available People -->
        <div class="col-lg-6">
            <div class="selection-card h-100">
                <div class="card-header">
                    <span><i data-lucide="users" style="width:18px;height:18px;"></i> Available People</span>
                    <span class="badge bg-primary rounded-pill" id="totalRecords">20</span>
                </div>
                <div class="card-body">
                    <div class="input-group mb-2">
                        <span class="input-group-text bg-transparent"><i data-lucide="search"
                                style="width:16px;height:16px;"></i></span>
                        <input type="text" class="form-control" placeholder="Search people..." id="searchInput">
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <select class="form-select form-select-sm" id="filterRole">
                                <option value="">All Roles</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select form-select-sm" id="filterOrg">
                                <option value="">All Organizations</option>
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select form-select-sm" id="filterGrade">
                                <option value="">All Grades</option>
                                <option value="4">Grade 4</option>
                                <option value="5">Grade 5</option>
                                <option value="6">Grade 6</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                            <span class="form-check-label small">Select All</span>
                        </label>
                        <span class="small text-muted" id="visibleCount">0</span>
                    </div>
                    <div class="people-list" id="peopleList">
                        <!-- Dynamically filled -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Selected Members -->
        <div class="col-lg-6">
            <div class="selection-card h-100">
                <div class="card-header">
                    <span><i data-lucide="check-square" style="width:18px;height:18px;"></i> Selected
                        Members</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                        <table class="selected-table" id="selectedTable">
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-footer" id="stickyFooter">
        <div class="selected-count">
            Selected Members: <span id="selectedCounter">0</span>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-light" id="cancelBtn">Cancel</button>
            <button class="btn btn-primary" id="saveMembersBtn">Save Members</button>
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        $(document).ready(function() {
            getPersonNomember();
        })

        async function getPersonNomember() {
            const yearId = $('#academicYearSelect').val();
            const houseId = $('#houseSelect').val();
            try {
                const response = await ajaxRequest({
                    url: `/person/no-member/${yearId}/${houseId}`,
                    method: 'GET',
                });
                const data = await response;
                return data;
            } catch (error) {
                console.error('Error fetching people:', error);
                return [];
            }
        }
    </script>
@endsection
