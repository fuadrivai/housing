@extends('main.index')

@section('content-style')
    <link rel="stylesheet" href="/assets/content/css/house.css">
@endsection


@section('content')
    <div class="form-card">
        <h2 class="form-title">New Person</h2>
        <p class="form-subtitle">Fill in the details to add a member to the system.</p>

        <div class="alert alert-success alert-custom" id="successAlert">
            <i data-lucide="check-circle" style="width:18px;height:18px;"></i> Person added successfully!
        </div>
        <div class="alert alert-danger alert-custom" id="errorAlert">
            <i data-lucide="alert-circle" style="width:18px;height:18px;"></i> <span id="errorMessage"></span>
        </div>

        <form id="addPersonForm" novalidate>

            <input type="hidden" id="id" value="{{ isset($person) ? $person->id : '' }}">
            <!-- Full Name -->
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="user" style="width:14px;height:14px;"></i> Full
                        Name</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="user-circle" style="width:18px;height:18px;"></i></span>
                        <input type="text" value="{{ isset($person) ? $person->fullname : '' }}"
                            class="form-control-custom" id="fullName" placeholder="e.g., John Smith" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="user" style="width:14px;height:14px;"></i> NIK
                        (student/staff)</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="user-circle" style="width:18px;height:18px;"></i></span>
                        <input type="text" value="{{ isset($person) ? $person->nik : '' }}" class="form-control-custom"
                            id="nik" placeholder="e.g., 1234567890" required>
                    </div>
                </div>
            </div>

            <!-- Branch -->
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                        Branch</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="git-branch" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="branch" required>
                            <option value="" disabled selected>Select branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ isset($person) && $person->branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="building" style="width:14px;height:14px;"></i>
                        Organization</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="school" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="organization" required>
                            @foreach ($organizations as $organization)
                                <option value="{{ $organization->id }}"
                                    {{ isset($person) && $person->organization_id == $organization->id ? 'selected' : '' }}>
                                    {{ $organization->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- Grade (nullable) -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="briefcase" style="width:14px;height:14px;"></i>
                        Role</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="users" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="role" required>
                            <option value="" disabled selected>Select role</option>
                            <option value="student" {{ isset($person) && $person->role == 'student' ? 'selected' : '' }}>
                                Student
                            </option>
                            <option value="teacher" {{ isset($person) && $person->role == 'teacher' ? 'selected' : '' }}>
                                Teacher
                            </option>
                            <option value="staff" {{ isset($person) && $person->role == 'staff' ? 'selected' : '' }}>Staff
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="graduation-cap" style="width:14px;height:14px;"></i> Grade (if
                        student)</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="bookmark" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="grade">
                            <option value="">Not applicable</option>
                            <option value="Grade 4" {{ isset($person) && $person->grade == '4' ? 'selected' : '' }}>Grade 4
                            </option>
                            <option value="Grade 5" {{ isset($person) && $person->grade == '5' ? 'selected' : '' }}>Grade 5
                            </option>
                            <option value="Grade 6" {{ isset($person) && $person->grade == '6' ? 'selected' : '' }}>Grade 6
                            </option>
                            <option value="Grade 7" {{ isset($person) && $person->grade == '7' ? 'selected' : '' }}>Grade 7
                            </option>
                            <option value="Grade 8" {{ isset($person) && $person->grade == '8' ? 'selected' : '' }}>Grade 8
                            </option>
                            <option value="Grade 9" {{ isset($person) && $person->grade == '9' ? 'selected' : '' }}>Grade
                                9
                            </option>
                            <option value="Grade 10" {{ isset($person) && $person->grade == '10' ? 'selected' : '' }}>
                                Grade 10
                            </option>
                            <option value="Grade 11" {{ isset($person) && $person->grade == '11' ? 'selected' : '' }}>
                                Grade 11
                            </option>
                            <option value="Grade 12" {{ isset($person) && $person->grade == '12' ? 'selected' : '' }}>
                                Grade 12
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i data-lucide="save" style="width:18px;height:18px;"></i> Create Person
                </button>
                <button type="button" class="btn-cancel" id="cancelBtn">
                    <i data-lucide="x" style="width:18px;height:18px;"></i> Cancel
                </button>
            </div>
        </form>
    </div>
@endsection

@section('content-script')
    <script>
        $(document).ready(function() {
            $('#addPersonForm').on('submit', async function(e) {
                e.preventDefault();
                const id = $('#id').val();
                const name = $('#fullName').val().trim();
                const nik = $('#nik').val().trim();
                const role = $('#role').val();
                const branchId = $('#branch').val();
                const organizationId = $('#organization').val();
                const grade = $('#grade').val();
                if (!name) {
                    $('#modalErrorMessage').text('Full Name is required.');
                    $('#modalErrorAlert').removeClass('d-none');
                    return;
                }
                let url = '/person';
                let method = 'POST';
                let data = {
                    fullname: name,
                    nik: nik,
                    role: role,
                    branch_id: branchId,
                    organization_id: organizationId,
                    grade: grade
                };
                if (id !== '') {
                    url = '/person/' + id;
                    method = 'PUT';
                }

                try {
                    const response = await ajaxRequest({
                        url: url,
                        method: method,
                        data: data,
                        button: '#submitBtn',
                        loadingText: 'Saving...'
                    });
                    location.reload();
                } catch (err) {
                    $('#modalErrorMessage').html(err.message);
                    $('#modalErrorAlert').removeClass('d-none');
                }
            });
        });
    </script>
@endsection
