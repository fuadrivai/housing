@extends('main.index')


@section('content')
    <!-- Recent Activities + Points Distribution -->
    <div class="row g-3">
        <div class="alert alert-success alert-custom" id="successAlert">
            <i data-lucide="check-circle" style="width:18px;height:18px;"></i> Branch created successfully!
        </div>
        <div class="alert alert-danger alert-custom" id="errorAlert">
            <i data-lucide="alert-circle" style="width:18px;height:18px;"></i> <span id="errorMessage"></span>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-12">
            <div class="dashboard-card h-100">
                <div class="card-header">
                    <span>📋 Branched</span>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                        <i data-lucide="plus-circle" style="width:18px;height:18px;"></i> Add Branch
                    </button>
                </div>
                <div class="card-body no-padding" style="overflow-x:auto;">
                    <table class="table-activities" aria-label="Recent activities table" id="branchTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Branch</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $branch)
                                <tr>
                                    <td>{{ $branch->id }}</td>
                                    <td><strong>{{ $branch->name }}</strong></td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="#" data-bs-toggle="modal"
                                            data-bs-target="#addBranchModal"
                                            onclick="$('#id').val('{{ $branch->id }}'); $('#branchName').val('{{ $branch->name }}'); ">
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

    <!-- Add Branch Modal -->
    <div class="modal fade" id="addBranchModal" tabindex="-1" aria-labelledby="addBranchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom-0 px-4 pt-4 pb-2">
                    <h5 class="modal-title fw-bold" id="addBranchModalLabel">
                        <i data-lucide="calendar-plus" style="width:20px;height:20px; margin-right: 6px;"></i> New Branch
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pt-2 pb-3">
                    <form id="branchForm" novalidate>
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <!-- Branch Name -->
                        <div class="mb-3">
                            <label for="branchName" class="form-label fw-semibold small">
                                <i data-lucide="building" style="width:14px;height:14px;"></i> Branch Name
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i data-lucide="book-open" style="width:18px;height:18px;"></i>
                                </span>
                                <input type="text" name="name" class="form-control" id="branchName"
                                    placeholder="e.g., Main Branch" required>
                            </div>
                        </div>

                        <!-- Alert -->
                        <div class="alert alert-danger py-2 px-3 small d-none" id="modalErrorAlert">
                            <i data-lucide="alert-circle" style="width:14px;height:14px;"></i>
                            <span id="modalErrorMessage"></span>
                        </div>
                        <div class="alert alert-success py-2 px-3 small d-none" id="modalSuccessAlert">
                            <i data-lucide="check-circle" style="width:14px;height:14px;"></i>
                            Branch created successfully!
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                <i data-lucide="x" style="width:16px;height:16px;"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" id="submitBranchBtn">
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
            $('#branchForm').on('submit', async function(e) {
                e.preventDefault();
                $('#modalErrorAlert').addClass('d-none');
                $('#modalSuccessAlert').addClass('d-none');
                const id = $('#id').val();
                const name = $('#branchName').val().trim();
                if (!name) {
                    $('#modalErrorMessage').text('Branch Name is required.');
                    $('#modalErrorAlert').removeClass('d-none');
                    return;
                }
                let url = '/branch';
                let data = {
                    name: name,
                };
                if (id !== '') {
                    url = '/branch/' + id;
                    data._method = 'PUT';
                }

                try {
                    const response = await ajaxRequest({
                        url: url,
                        method: 'POST',
                        data: data,
                        button: '#submitBranchBtn',
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
