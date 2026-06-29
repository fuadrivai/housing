@extends('main.index')

@section('content-style')
    <style>
        /* ========== FORM CARD ========== */

        .input-group-custom {
            position: relative;
            margin-bottom: 18px;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .form-control-custom,
        .form-select-custom {
            width: 100%;
            padding: 12px 14px 12px 44px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: var(--text-primary);
            background: #fafbfc;
            transition: all 0.2s;
            outline: none;
            box-shadow: none;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            border-color: var(--accent-blue);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-select-custom {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px 12px;
            appearance: none;
        }

        textarea.form-control-custom {
            padding-left: 44px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            padding: 12px 24px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            cursor: pointer;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
        }

        .btn-cancel {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 12px 24px;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-secondary);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #f8fafc;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .alert-custom {
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 0.85rem;
            margin-top: 16px;
            display: none;
        }

        .alert-custom.show {
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="form-card">
        <h2 class="form-title">Points Entry Form</h2>
        <p class="form-subtitle">Reward or deduct points for a house member.</p>

        <div class="alert alert-success alert-custom" id="successAlert">
            <i data-lucide="check-circle" style="width:18px;height:18px;"></i> Points added successfully!
        </div>
        <div class="alert alert-danger alert-custom" id="errorAlert">
            <i data-lucide="alert-circle" style="width:18px;height:18px;"></i> <span id="errorMessage"></span>
        </div>

        <form id="pointsForm" novalidate>
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="calendar" style="width:14px;height:14px;"></i> Academic
                        Year</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="calendar-days" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="academicYearSelect" {{ $yearId ? 'disabled' : '' }}>
                            @foreach ($academicYears as $year)
                                <option value="{{ $year->id }}"
                                    {{ $year->is_active || $year->id == $yearId ? 'selected' : '' }}>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="building-2" style="width:14px;height:14px;"></i>
                        House</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="building-2" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="houseSelect" {{ $houseId ? 'disabled' : '' }}>
                            @foreach ($houses as $house)
                                <option value="{{ $house->id }}" {{ $house->id == $houseId ? 'selected' : '' }}>
                                    {{ $house->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="users" style="width:14px;height:14px;"></i> Member
                        List</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="user" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="memberSelect">
                            <option value="" selected>Select a member</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">
                                    {{ $member->person->fullname }} ({{ $member->person->role }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="calendar" style="width:14px;height:14px;"></i> Date</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="calendar-days" style="width:18px;height:18px;"></i></span>
                        <input type="date" class="form-control-custom" id="dateInput" required>
                    </div>
                </div>
            </div>
            <!-- Reward / Punishment (required) -->
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="tag" style="width:14px;height:14px;"></i> Type <span
                            class="text-danger">*</span></label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="bookmark" style="width:18px;height:18px;"></i></span>
                        <select class="form-select-custom" id="typeSelect" required>
                            <option value="" disabled selected>Select reward or punishment</option>
                            <option value="reward">Reward</option>
                            <option value="punishment">Punishment</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i data-lucide="hash" style="width:14px;height:14px;"></i> Points <span
                            class="text-danger">*</span></label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="star" style="width:18px;height:18px;"></i></span>
                        <input type="number" class="form-control-custom" id="pointsInput" min="1"
                            placeholder="e.g., 50" required>
                    </div>
                </div>
            </div>

            <!-- Reason / Note (optional) -->
            <div class="row mb-2">
                <div class="col-md-12">
                    <label class="form-label"><i data-lucide="file-text" style="width:14px;height:14px;"></i> Reason or
                        Note</label>
                    <div class="input-group-custom">
                        <span class="input-icon" style="top:16px;"><i data-lucide="pen"
                                style="width:18px;height:18px;"></i></span>
                        <textarea class="form-control-custom" id="reasonTextarea" rows="3" placeholder="Optional reason..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Created by (optional) -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label"><i data-lucide="user-plus" style="width:14px;height:14px;"></i> Created
                        by</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="user-circle" style="width:18px;height:18px;"></i></span>
                        <input type="text" class="form-control-custom" id="createdByInput"
                            placeholder="Admin (optional)">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i data-lucide="save" style="width:18px;height:18px;"></i> Submit Points
                </button>
                <button type="button" class="btn-cancel" id="cancelBtn">
                    <i data-lucide="x" style="width:18px;height:18px;"></i> Cancel
                </button>
            </div>
        </form>
    </div>
@endsection

@section('content-script')
    <script src="/assets/plugins/moment.js"></script>
    <script>
        $('#pointsForm').on('submit', async function(e) {
            e.preventDefault();
            $('#successAlert, #errorAlert').removeClass('show');

            // Gather values;
            const date = $('#dateInput').val();
            const type = $('#typeSelect').val();
            const points = $('#pointsInput').val().trim();

            // Validation
            if (!date) {
                showError('Please select a date.');
                return;
            }
            if (!type) {
                showError('Please select whether it is a reward or punishment.');
                return;
            }
            if (!points || isNaN(points) || parseInt(points) < 1) {
                showError('Please enter a valid point value (positive number).');
                return;
            }

            const formattedDate = moment(date).format('YYYY-MM-DD');

            let point = {
                member_id: $('#memberSelect').val(),
                house_id: $('#houseSelect').val(),
                academic_year_id: $('#academicYearSelect').val(),
                date: formattedDate,
                type: type,
                value: parseInt(points),
                reason: $('#reasonTextarea').val().trim(),
                created_by: $('#createdByInput').val().trim()
            };

            blockUI(); // Block UI during submission
            try {
                const response = await ajaxRequest({
                    url: '/point',
                    method: 'POST',
                    data: JSON.stringify(point),
                    contentType: 'application/json'
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message || 'Points saved successfully.',
                    timer: 1000,
                    showConfirmButton: false
                });

                setTimeout(function() {
                    $('#pointsForm')[0].reset();
                    $('#successAlert').addClass('show');
                    $('#errorAlert').removeClass('show');
                }, 1000);
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: error.message || 'An error occurred while saving points.'
                });
            }

        });

        function showError(msg) {
            $('#errorMessage').text(msg);
            $('#errorAlert').addClass('show');
            $('#successAlert').removeClass('show');
        }

        // Cancel button
        $('#cancelBtn').on('click', function() {
            if (confirm('Discard changes?')) {
                $('#pointsForm')[0].reset();
                $('#dateInput').val(today);
                $('#successAlert, #errorAlert').removeClass('show');
            }
        });

        // Hide alerts on user input
        $('#pointsForm input, #pointsForm select, #pointsForm textarea').on('input change', function() {
            $('#successAlert, #errorAlert').removeClass('show');
        });
    </script>
@endsection
