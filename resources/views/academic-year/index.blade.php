@extends('main.index')


@section('content')
    <!-- Recent Activities + Points Distribution -->
    <div class="row g-3">
        <div class="alert alert-success alert-custom" id="successAlert">
            <i data-lucide="check-circle" style="width:18px;height:18px;"></i> House created successfully!
        </div>
        <div class="alert alert-danger alert-custom" id="errorAlert">
            <i data-lucide="alert-circle" style="width:18px;height:18px;"></i> <span id="errorMessage"></span>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-12">
            <div class="dashboard-card h-100">
                <div class="card-header">
                    <span>📋 Academic Years</span>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAcademicYearModal">
                        <i data-lucide="plus-circle" style="width:18px;height:18px;"></i> Add Academic Year
                    </button>
                </div>
                <div class="card-body no-padding" style="overflow-x:auto;">
                    <table class="table-activities" aria-label="Recent activities table" id="academicYearsTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Academic Year</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($academicYears as $year)
                                <tr>
                                    <td>{{ $year->id }}</td>
                                    <td><strong>{{ $year->name }}</strong></td>
                                    <td>
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="activeSwitch{{ $year->id }}" {{ $year->is_active ? 'checked' : '' }}
                                                data-year-id="{{ $year->id }}">
                                            <label class="form-check-label" for="activeSwitch{{ $year->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="#" data-bs-toggle="modal"
                                            data-bs-target="#addAcademicYearModal"
                                            onclick="$('#id').val('{{ $year->id }}'); $('#academicYearName').val('{{ $year->name }}'); $('#activeYearSwitch').prop('checked', {{ $year->is_active ? 'true' : 'false' }});">
                                            <i data-lucide="edit"></i> edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Academic Year Modal -->
    <div class="modal fade" id="addAcademicYearModal" tabindex="-1" aria-labelledby="addAcademicYearModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom-0 px-4 pt-4 pb-2">
                    <h5 class="modal-title fw-bold" id="addAcademicYearModalLabel">
                        <i data-lucide="calendar-plus" style="width:20px;height:20px; margin-right: 6px;"></i> New Academic
                        Year
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pt-2 pb-3">
                    <form id="addAcademicYearForm" novalidate>
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <!-- Academic Year Name -->
                        <div class="mb-3">
                            <label for="academicYearName" class="form-label fw-semibold small">
                                <i data-lucide="calendar" style="width:14px;height:14px;"></i> Academic Year
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i data-lucide="book-open" style="width:18px;height:18px;"></i>
                                </span>
                                <input type="text" name="name" class="form-control" id="academicYearName"
                                    placeholder="e.g., 2026/2027" required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="fw-semibold small">
                                <i data-lucide="toggle-left" style="width:14px;height:14px;"></i> Set as Active Year
                            </span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                    id="activeYearSwitch">
                                <label class="form-check-label" for="activeYearSwitch"></label>
                            </div>
                        </div>

                        <!-- Alert -->
                        <div class="alert alert-danger py-2 px-3 small d-none" id="modalErrorAlert">
                            <i data-lucide="alert-circle" style="width:14px;height:14px;"></i>
                            <span id="modalErrorMessage"></span>
                        </div>
                        <div class="alert alert-success py-2 px-3 small d-none" id="modalSuccessAlert">
                            <i data-lucide="check-circle" style="width:14px;height:14px;"></i>
                            Academic year created successfully!
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                <i data-lucide="x" style="width:16px;height:16px;"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" id="submitAcademicYearBtn">
                                <i data-lucide="save" style="width:16px;height:16px;"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        $(document).ready(function() {
            $('#academicYearsTable').on('change', 'input[type="checkbox"]', function() {
                const yearId = $(this).data('year-id');
                const isActive = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '/year/activated',
                    type: 'PATCH',
                    data: {
                        id: yearId,
                        is_active: isActive
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#successAlert').removeClass('d-none');
                        location.reload();
                    },
                    error: function(xhr) {
                        $('#errorAlert').removeClass('d-none');
                        location.reload();
                        alert('Error toggling active status.');
                    }
                });
            });

            $('#addAcademicYearForm').on('submit', async function(e) {
                e.preventDefault();
                $('#modalErrorAlert').addClass('d-none');
                $('#modalSuccessAlert').addClass('d-none');
                const id = $('#id').val();
                const name = $('#academicYearName').val().trim();
                const isActive = $('#activeYearSwitch').is(':checked') ? 1 : 0;
                if (!name) {
                    $('#modalErrorMessage').text('Academic Year is required.');
                    $('#modalErrorAlert').removeClass('d-none');
                    return;
                }
                let url = '/year';
                let data = {
                    name: name,
                    is_active: isActive
                };
                if (id !== '') {
                    url = '/year/' + id;
                    data._method = 'PUT';
                }

                try {
                    const response = await ajaxRequest({
                        url: url,
                        method: 'POST',
                        data: data,
                        button: '#submitAcademicYearBtn',
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
