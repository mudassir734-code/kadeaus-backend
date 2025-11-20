@extends('admin.layout.master')
@section('style')
    <style>
        .header-banner {
            background: url('{{ asset('admin/assets/img/header-bg.png') }}') no-repeat center center;
            background-size: cover;
            height: 190px;
            border-radius: 10px;
        }

        .appointment-container {
            max-width: 1335px;
            margin: -60px auto 40px auto;
            /* Pull white card upward */
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        .section-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            font-size: 14px;
        }

        input,
        select {
            border-radius: 8px !important;
            padding: 10px;
            font-size: 14px;
        }

        .divider {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="header-banner"></div>
        <div class="appointment-container">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center mb-4">
                    <button class="btn btn-link text-dark p-0 me-2"><a href="#">&larr;</a></button>
                    <h4 class="fw-bold mb-0">Receptionist Details</h4>
                </div>
                <div>
                    <div class="profile-actions">
                     <a href="javascript:;" onclick="deleteReceptionist({{ $receptionist->id }})"> <i class="fa-solid fa-trash"></i>
                        Delete</a>
                     <a href="{{route('admin.receptionist.edit',encrypt($receptionist->id))  }}"><i class="fa-solid fa-pen ms-3"></i> Edit</a>
                    </div>
                </div>
            </div>
            <div class="p-3 border-radius-lg" style="background-color: #FCF3F3;">
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-circle me-2"
                        style="width: 100px; height: 100px;">
                    <div>
                        <small class="text-muted">
                            <h6>{{ $receptionist->user?->name ?? '-' }}</h6>
                            <i class="fa-regular fa-envelope text-danger me-3"></i> {{ $receptionist->user?->email ?? '-' }}
                            <br />
                            <i class="fa-solid fa-phone text-danger me-3"></i> Video Call
                        </small>
                    </div>
                </div>
            </div>
            <hr>
            <div class="">
                <h5>Patient Info.</h5>
                <div class="row">
                    <div class="col-md-6 details-row">
                        <span class="details-label">Name:</span>
                        <span class="details-value">{{ $receptionist->user?->name ?? '-' }}</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Email:</span>
                        <span class="details-value">{{ $receptionist->user?->email ?? '-' }}</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Contact Number:</span>
                        <span class="details-value">{{ $receptionist->user?->phone ?? '-'}}</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Gender:</span>
                        <span class="details-value">{{ $receptionist->user?->gender ?? '-' }}</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Date of Birth:</span>
                        <span class="details-value">{{ $receptionist->user?->dob ?? '-' }}</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Hospital:</span>
                        <span class="details-value">{{ $receptionist->hospital->user->name ?? '-' }}</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Modules Access:</span>
                        <span class="details-value">-</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Appointments:</span>
                        <span class="details-value">-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
 <script>
        function deleteReceptionist(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.receptionist.delete') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _method: 'DELETE' // Laravel's method spoofing
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.status === 'success') {
                                Swal.fire('Deleted!', response.message ||
                                        'Receptionist has been deleted.', 'success')
                                    .then(() => {
                                        // redirect to returned URL
                                        if (response.redirect_url) {
                                            window.location.href = response.redirect_url;
                                        }
                                    });
                            } else {
                                Swal.fire('Error!', response.message || 'Something went wrong.',
                                    'error');
                            }
                        },
                        error: (xhr) => {
                            const message = xhr.responseJSON?.message || 'Server error occurred.';
                            Swal.fire('Error!', message, 'error');
                        }
                    });
                }
            });
        }
    </script>
@endsection
