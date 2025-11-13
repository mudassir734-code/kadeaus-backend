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
                        <i class="fa-solid fa-trash"></i> Delete
                        <i class="fa-solid fa-pen ms-3"></i> Edit
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
        if (document.getElementById('choices-role-edit')) {
            var element = document.getElementById('choices-role-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-hospital-edit')) {
            var element = document.getElementById('choices-hospital-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-gender-edit')) {
            var element = document.getElementById('choices-gender-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
    </script>

    <script>
        if (document.getElementById('choices-category-edit')) {
            var element = document.getElementById('choices-category-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
    </script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
@endsection
