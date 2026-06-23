@extends('main.index')

@section('content-style')
    <link rel="stylesheet" href="/assets/content/css/house.css">
@endsection

@section('content')
    <div class="form-card">
        <h2 class="form-title">Create a New House</h2>
        <p class="form-subtitle">Fill in the details below to add a house to the system.</p>

        <div class="alert alert-success alert-custom" id="successAlert">
            <i data-lucide="check-circle" style="width:18px;height:18px;"></i> House created successfully!
        </div>
        <div class="alert alert-danger alert-custom" id="errorAlert">
            <i data-lucide="alert-circle" style="width:18px;height:18px;"></i> <span id="errorMessage"></span>
        </div>

        <form id="addHouseForm" novalidate>
            <input type="hidden" name="id" id="id" value="{{ $house->id ?? '' }}">
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label" for="houseName">
                        <i data-lucide="building-2" style="width:14px;height:14px;"></i> House Name
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="home" style="width:18px;height:18px;"></i></span>
                        <input type="text" value="{{ $house->name ?? '' }}" name="name" class="form-control-custom"
                            id="houseName" placeholder="e.g., Phoenix" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="houseFullName">
                        <i data-lucide="file-text" style="width:14px;height:14px;"></i> Full Name
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="book-open" style="width:18px;height:18px;"></i></span>
                        <input type="text" value="{{ $house->fullname ?? '' }}" name="fullname"
                            class="form-control-custom" id="houseFullName" placeholder="e.g., Phoenix House of Excellence"
                            required>
                    </div>
                </div>
            </div>

            <!-- Motto -->
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label" for="houseMotto">
                        <i data-lucide="quote" style="width:14px;height:14px;"></i> Motto
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="feather" style="width:18px;height:18px;"></i></span>
                        <input type="text" value="{{ $house->motto ?? '' }}" name="motto" class="form-control-custom"
                            id="houseMotto" placeholder="e.g., With unity, we rise" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="houseCore">
                        <i data-lucide="shield" style="width:14px;height:14px;"></i> Core Value
                    </label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i data-lucide="heart" style="width:18px;height:18px;"></i></span>
                        <input type="text" value="{{ $house->core ?? '' }}" name="core" class="form-control-custom"
                            id="houseCore" placeholder="e.g., Fathonah, Amannah, Tabligh" required>
                    </div>
                </div>
            </div>
            <!-- Attribute -->
            <div class="mb-2">
                <label class="form-label" for="houseAttribute">
                    <i data-lucide="shield" style="width:14px;height:14px;"></i> Attribute
                </label>
                <div class="input-group-custom">
                    <span class="input-icon"><i data-lucide="heart" style="width:18px;height:18px;"></i></span>
                    <input type="text" value="{{ $house->attribute ?? '' }}" name="attribute" class="form-control-custom"
                        id="houseAttribute" placeholder="e.g., Trustworthy, Courteous, Responsible ...." required>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label" for="houseDescription">
                    <i data-lucide="align-left" style="width:14px;height:14px;"></i> Description
                </label>
                <div class="input-group-custom">
                    <span class="input-icon" style="top:16px; transform: none;"><i data-lucide="file-text"
                            style="width:18px;height:18px;"></i></span>
                    <textarea class="form-control-custom" name="description" id="houseDescription" rows="4"
                        placeholder="A brief description of the house..." required>{{ $house->description ?? '' }}</textarea>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">
                    <i data-lucide="image" style="width:14px;height:14px;"></i> House Image
                </label>
                <div class="image-upload-wrapper">
                    <div class="image-preview" id="imagePreview">
                        <i data-lucide="camera" style="width:24px;height:24px; color: #94a3b8;"></i>
                    </div>
                    <label class="image-upload-label" for="houseImage" tabindex="0">
                        <i data-lucide="upload" style="width:16px;height:16px;"></i> Choose Image
                    </label>
                    <input type="file" name="image" id="houseImage" accept="image/*">
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i data-lucide="plus-circle" style="width:18px;height:18px;"></i> Create House
                </button>
            </div>
        </form>
    </div>
@endsection

@section('content-script')
    <script>
        $(document).ready(function() {
            $('#houseImage').on('change', function() {
                const file = this.files[0];
                const $preview = $('#imagePreview');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $preview.html('<img src="' + e.target.result + '" alt="Preview">');
                    };
                    reader.readAsDataURL(file);
                } else {
                    $preview.html(
                        '<i data-lucide="camera" style="width:24px;height:24px; color: #94a3b8;"></i>');
                    lucide.createIcons();
                }
            });

            $('#addHouseForm').on('submit', function(e) {
                e.preventDefault();
                $('#successAlert, #errorAlert').removeClass('show');
                const form = this;
                const formData = new FormData(form);
                const id = $('#id').val().trim();
                const name = $('#houseName').val().trim();
                const fullName = $('#houseFullName').val().trim();
                const motto = $('#houseMotto').val().trim();
                const core = $('#houseCore').val().trim();
                const attribute = $('#houseAttribute').val();
                const description = $('#houseDescription').val().trim();

                if (!name || !fullName || !motto || !core || !attribute || !description) {
                    $('#errorMessage').text('Please fill in all required fields.');
                    $('#errorAlert').addClass('show');
                    return;
                }

                const $submitBtn = $('#submitBtn');

                $submitBtn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status"></span> Creating...'
                );

                let url = '/houses';

                if (id !== '') {
                    url = `/houses/${id}`;
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#successAlert').addClass('show');
                        $('#addHouseForm')[0].reset();
                        $('#imagePreview').hide();
                    },
                    error: function(xhr) {
                        let message = 'Something went wrong';
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            message = Object.values(errors)
                                .map(error => error[0])
                                .join('<br>');
                        } else if (xhr.responseJSON?.message) {
                            message = xhr.responseJSON.message;
                        }
                        $('#errorMessage').html(message);
                        $('#errorAlert').addClass('show');
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false).html(
                            '<i data-lucide="plus-circle" style="width:18px;height:18px;"></i> Create House'
                        );
                        lucide.createIcons();
                    }
                });
            });

            $('#cancelBtn').on('click', function() {
                if (confirm('Discard changes?')) {
                    $('#addHouseForm')[0].reset();
                    $('#imagePreview').html(
                        '<i data-lucide="camera" style="width:24px;height:24px; color: #94a3b8;"></i>');
                    lucide.createIcons();
                    $('#successAlert, #errorAlert').removeClass('show');
                }
            });

            // Hide alerts on input change
            $('#addHouseForm input, #addHouseForm select, #addHouseForm textarea').on('input change', function() {
                $('#successAlert, #errorAlert').removeClass('show');
            });
        })
    </script>
@endsection
