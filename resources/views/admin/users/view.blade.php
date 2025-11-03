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
    <div class="header-banner "></div>
    <div class="appointment-container">
        <!-- Header -->
        <div class="d-flex align-items-center mb-4">
            <button class="btn btn-link text-dark p-0 me-2">
                <a href="{{ route('admin.users') }}">&larr;</a>
            </button>
            <h4 class="fw-bold mb-0">Admin Details</h4>
        </div>

        <div class="p-3 border-radius-lg" style="background-color: #FCF3F3;">
            <div class="d-flex align-items-center mb-2">
                <img src="{{ asset('admin/assets/img/bomb.svg') }}" alt="Doctor" class="rounded-circle me-2"
                    style="width: 100px; height: 100px;">
                <div>
                    <small class="text-muted">
                        <h6 class="mb-0">{{ $user->name }}</h6>
                        <p class="mt-2">User ID: U-{{ $user->id }}</p>
                    </small>
                </div>
            </div>
        </div>

        <!-- Appointment Details -->
        <h6 class="section-title">Patient Info. </h6>
        <form>
            <div class="row">
                <div class="col-md-6 details-row">
                    <span class="details-label">Full Name:</span>
                    <span class="details-value">{{ $user->name }}</span>
                </div>

                <div class="col-md-6 details-row">
                    <span class="details-label">Email:</span>
                    <span class="details-value">{{ $user->email }}</span>
                </div>

                <div class="col-md-6 details-row">
                    <span class="details-label">Contact Number :</span>
                    <span class="details-value">{{ $user->phone ?? '-' }}</span>
                </div>

                <div class="col-md-6 details-row">
                    <span class="details-label">Gender:</span>
                    <span class="details-value">{{ $user->gender ?? '-' }}</span>
                </div>

                <div class="col-md-6 details-row">
                    <span class="details-label">Date of Birth:</span>
                    <span class="details-value">
                        @if(!empty($user->dob))
                            {{ \Carbon\Carbon::parse($user->dob)->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>

                <div class="col-md-6 details-row">
                    <span class="details-label">Hospital:</span>
                    <span class="details-value">-</span> {{-- no hospital relation provided --}}
                </div>

                <div class="col-md-6 details-row">
                    <span class="details-label">Modules Access:</span>
                    <span class="details-value">
                        {{ empty($modulesWithAccess) ? '-' : implode(',', $modulesWithAccess) }}
                    </span>
                </div>

                <div class="col-md-6 details-row">
                    <span class="details-label">Appointments:</span>
                    <span class="details-value">-</span> {{-- no appointments relation provided --}}
                </div>
            </div>

            <!-- Divider -->
            <div class="divider"></div>

            <div class="mt-4">
                <h5 class="fw-semibold">Role & Permissions</h5>
                <div class="role-card" style="width: max-content;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="p-3">Permissions</th>
                                <th class="p-3">Access</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Map your existing radio row names to modules, keeping your exact HTML --}}
                            @php
                                // $levels is ['Module' => 'FullAccess'|'ViewOnly'|null]
                                $isFull = fn($m) => ($levels[$m] ?? null) === 'FullAccess';
                                $isView = fn($m) => ($levels[$m] ?? null) === 'ViewOnly';
                            @endphp

                            <tr>
                                <td class="text-sm font-weight-bold text-dark">Dashboard</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="overview"
                                            {{ $isFull('Dashboard') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="overview"
                                            {{ $isView('Dashboard') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Read Only</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm font-weight-bold text-dark">Appointment</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="doctors"
                                            {{ $isFull('Appointment') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="doctors"
                                            {{ $isView('Appointment') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Read Only</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm font-weight-bold text-dark">Chat</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="nurses"
                                            {{ $isFull('Chat') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="nurses"
                                            {{ $isView('Chat') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Read Only</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm font-weight-bold text-dark">Hospital</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="receptionists"
                                            {{ $isFull('Hospital') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="receptionists"
                                            {{ $isView('Hospital') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Read Only</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm font-weight-bold text-dark">Doctors</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pharmacists"
                                            {{ $isFull('Doctors') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pharmacists"
                                            {{ $isView('Doctors') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Read Only</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm font-weight-bold text-dark">Patients</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="patients"
                                            {{ $isFull('Patients') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="patients"
                                            {{ $isView('Patients') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Read Only</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm font-weight-bold text-dark">Admins</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="departments"
                                            {{ $isFull('Admins') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="departments"
                                            {{ $isView('Admins') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Read Only</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm font-weight-bold text-dark">Setting</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="laboratories"
                                            {{ $isFull('Setting') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Full Access</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="laboratories"
                                            {{ $isView('Setting') ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Read Only</label>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit (left as-is; no action wired for view-only page) -->
            <div class="mt-4 text-end">
                <button type="button" class="btn bg-danger text-white" onclick="window.history.back()">Back</button>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
    <script>
        const cards = document.querySelectorAll(".doctor-card");

        cards.forEach(card => {
            card.addEventListener("click", () => {
                // Remove active class from all cards
                cards.forEach(c => c.classList.remove("active"));
                // Add active class to the clicked card
                card.classList.add("active");
            });
        });
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
