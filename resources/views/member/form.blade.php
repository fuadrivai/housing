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
                    <select class="form-select" id="academicYearSelect" {{ $yearId ? 'disabled' : '' }}>
                        @foreach ($academicYears as $year)
                            <option value="{{ $year->id }}"
                                {{ $year->is_active || $year->id == $yearId ? 'selected' : '' }}>
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold"><i data-lucide="building-2" style="width:14px;height:14px;"></i>
                        House</label>
                    <select class="form-select" id="houseSelect" {{ $houseId ? 'disabled' : '' }}>
                        @foreach ($houses as $house)
                            <option value="{{ $house->id }}" {{ $house->id == $houseId ? 'selected' : '' }}>
                                {{ $house->name }}
                            </option>
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
                                <option value="Grade 4">Grade 4</option>
                                <option value="Grade 5">Grade 5</option>
                                <option value="Grade 6">Grade 6</option>
                                <option value="Grade 7">Grade 7</option>
                                <option value="Grade 8">Grade 8</option>
                                <option value="Grade 9">Grade 9</option>
                                <option value="Grade 10">Grade 10</option>
                                <option value="Grade 11">Grade 11</option>
                                <option value="Grade 12">Grade 12</option>
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
            <button class="btn btn-primary" id="saveMembersBtn" onclick="postMembers()">Save Members</button>
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        let peopleData = [];
        let selectedMembers = [];
        let houseId = $('#houseSelect').val();
        let yearId = $('#academicYearSelect').val();


        $(document).ready(function() {
            getMembersByHouseIdAndYearId(houseId, yearId);
            getPersonNoMember();

            $('#searchInput, #filterRole, #filterOrg, #filterGrade').on('input change',
                applyFilters);
            $('#selectAllCheckbox').on('change', function() {
                const $visibleCheckboxes = $('#peopleList .person-checkbox');
                if ($(this).is(':checked')) {
                    const ids = $visibleCheckboxes.map(function() {
                        return parseInt($(this).closest('.list-item').data('id'));
                    }).get();
                    addSelectedByIds(ids);
                } else {
                    const ids = $visibleCheckboxes.map(function() {
                        return parseInt($(this).closest('.list-item').data('id'));
                    }).get();
                    removeSelectedByIds(ids);
                }
            });
            $("#peopleList").on('change', '.person-checkbox', function() {
                const id = parseInt($(this).closest('.list-item').data('id'));
                if ($(this).is(':checked')) {
                    addSelectedByIds([id]);
                } else {
                    removeSelectedByIds([id]);
                }
            });
            $("#selectedTable").on('click', '.btn-remove-member', function() {
                const id = parseInt($(this).data('id'));
                removeSelectedByIds([id]);
            });
            $("#selectedTable").on('change', '.house-role-select', function() {
                const id = parseInt($(this).data('id'));
                const newRole = $(this).val();
                const member = selectedMembers.find(m => m.people_id === id);
                if (member) member.houseRole = newRole;
                // No need to re-render everything, just update counter maybe
            });
        })

        function applyFilters() {
            const filtered = getFilteredPeople(peopleData);
            renderAvailableList(filtered);
        }

        async function getPersonNoMember() {
            const yearId = $('#academicYearSelect').val();
            const houseId = $('#houseSelect').val();
            blockUI();
            try {
                const response = await ajaxRequest({
                    url: `/person/yearId/${yearId}`,
                    method: 'GET',
                });
                peopleData = await response;
                const filtered = getFilteredPeople(peopleData);
                renderAvailableList(filtered);
            } catch (error) {
                peopleData = [];
                renderAvailableList([]);
            }
        }

        function getFilteredPeople(data) {
            const search = $('#searchInput').val().toLowerCase();
            const roleFilter = $('#filterRole').val();
            const orgFilter = $('#filterOrg').val();
            const gradeFilter = $('#filterGrade').val();

            return data.filter(p => {
                const matchSearch = !search || p.fullname.toLowerCase().includes(search) || p.role
                    .includes(search);
                const matchRole = !roleFilter || p.role === roleFilter;
                const matchOrg = !orgFilter || p.organization.id === parseInt(orgFilter);
                const matchGrade = !gradeFilter || (p.grade && p.grade.includes(gradeFilter));
                return matchSearch && matchRole && matchOrg && matchGrade;
            });
        }

        function renderAvailableList(filteredData) {
            const $list = $('#peopleList');
            $list.empty();
            if (filteredData.length === 0) {
                $list.append('<div class="p-3 text-center text-muted">No people found.</div>');
                return;
            }
            filteredData.forEach(person => {

                const initials = getInitials(person.fullname);
                const isSelected = selectedMembers.some(m => m.people_id === person.id);

                const isDisabled =
                    person.member !== null &&
                    person.member.house_id != $('#houseSelect').val();

                const html = `
                    <div class="list-item ${isSelected ? 'selected' : ''} ${isDisabled ? 'disabled opacity-50' : ''}"
                        data-id="${person.id}">

                        <input type="checkbox"class="form-check-input me-1 person-checkbox"
                            ${isSelected ? 'checked' : ''}
                            ${isDisabled ? 'disabled' : ''}
                            id="person-${person.id}">

                        <div class="avatar">${initials}</div>

                        <label for="person-${person.id}" class="name">
                            ${person.fullname}
                        </label>

                        <span class="badge badge-role ${roleBadgeClass(person.role)}">
                            ${person.role}
                        </span>

                        ${person.grade ? `<span class="small text-muted ms-1">${person.grade}</span>` : ''}

                        ${isDisabled ? `
                                                                <span class="badge bg-secondary ms-2">
                                                                    Already in another house
                                                                </span>
                                                            ` : ''}
                    </div>
                `;

                $list.append(html);
            });
            $('#visibleCount').text(filteredData.length);
            updateSelectAllCheckbox();
        }

        function updateSelectAllCheckbox() {
            const $visibleCheckboxes = $('#peopleList .person-checkbox');
            const allChecked = $visibleCheckboxes.length > 0 && $visibleCheckboxes.length === $visibleCheckboxes
                .filter(':checked').length;
            $('#selectAllCheckbox').prop('checked', allChecked);
        }

        function getInitials(name) {
            const parts = name.split(' ');
            return (parts[0][0] + (parts[1] ? parts[1][0] : '')).toUpperCase();
        }

        function roleBadgeClass(role) {
            if (role === 'student') return 'badge-student';
            if (role === 'teacher') return 'badge-teacher';
            return 'badge-staff';
        }

        function addSelectedByIds(ids) {
            ids.forEach(id => {
                const person = peopleData.find(p => p.id === id);
                if (person && !selectedMembers.some(m => m.people_id === id)) {
                    selectedMembers.push({
                        people_id: person.id,
                        fullname: person.fullname,
                        role: person.role,
                        organization: person.organization,
                        grade: person.grade || "",
                        houseRole: 'member',
                        house_id: $('#houseSelect').val(),
                        academic_year_id: $('#academicYearSelect').val(),
                    });
                }
            });
            updateAllViews();
        }

        function updateAllViews() {
            applyFilters();
            renderSelectedTable();
        }

        function renderSelectedTable() {
            const $tbody = $('#selectedTable tbody');
            $tbody.empty();
            if (selectedMembers.length === 0) {
                $tbody.append(
                    '<tr><td colspan="5" class="text-center text-muted py-3">No members selected.</td></tr>'
                );
            } else {
                selectedMembers.forEach(member => {
                    const initials = getInitials(member.fullname);
                    const html = `
                            <tr>
                                <td><div class="avatar-sm">${initials}</div></td>
                                <td class="fw-semibold">${member.fullname}</td>
                                <td><span class="badge badge-role ${roleBadgeClass(member.role)}">${member.role}</span> ${member.grade ? `<span class="small text-muted ms-1">${member.grade}</span>` : ''}</td>
                                <td>
                                    <select class="form-select form-select-sm house-role-select" data-id="${member.people_id}">
                                        <option value="member" ${member.houseRole === 'member' ? 'selected' : ''}>Member</option>
                                        <option value="captain" ${member.houseRole === 'captain' ? 'selected' : ''}>Captain</option>
                                        <option value="vice_captain" ${member.houseRole === 'vice_captain' ? 'selected' : ''}>Vice Captain</option>
                                        <option value="advisor" ${member.houseRole === 'advisor' ? 'selected' : ''}>Advisor</option>
                                        <option value="supervisor" ${member.houseRole === 'supervisor' ? 'selected' : ''}>Supervisor</option>
                                    </select>
                                </td>
                                <td><button class="btn-remove-member" data-id="${member.people_id}"><i data-lucide="x-circle" style="width:16px;height:16px;"></i></button></td>
                            </tr>
                        `;
                    $tbody.append(html);
                });
            }
            $('#selectedCounter').text(selectedMembers.length);
            lucide.createIcons();
        }

        function removeSelectedByIds(ids) {
            selectedMembers = selectedMembers.filter(m => !ids.includes(m.people_id));
            updateAllViews();
        }

        async function postMembers() {
            blockUI();
            try {
                const response = await ajaxRequest({
                    url: '/member',
                    method: 'POST',
                    data: JSON.stringify(selectedMembers),
                    contentType: 'application/json'
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message || 'Members saved successfully.',
                    timer: 1000,
                    showConfirmButton: false
                });
                //Redirect ke halaman member
                setTimeout(() => {
                    window.location.href = '/member';
                }, 1000);

            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: error.message || 'Something went wrong'
                });
            }
        }

        async function getMembersByHouseIdAndYearId(houseId, yearId) {
            blockUI();
            try {
                const response = await ajaxRequest({
                    url: `/member/${houseId}/${yearId}`,
                    method: 'GET',
                });
                let data = await response;
                selectedMembers = data.map(member => ({
                    people_id: member.people_id,
                    fullname: member.person.fullname,
                    role: member.person.role,
                    organization: member.person.organization,
                    grade: member.person.grade || "",
                    houseRole: member.role,
                    house_id: member.house_id,
                    academic_year_id: member.academic_year_id,
                }));
                renderSelectedTable();
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: error.message || 'Something went wrong'
                });
            }
        }
    </script>
@endsection
