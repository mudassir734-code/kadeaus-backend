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
                <button class="btn btn-link text-dark p-0 me-2"><a href="Admins.html">&larr;</a></button>
                <h4 class="fw-bold mb-0">Admin Details</h4>
            </div>
            <div class="p-3 border-radius-lg" style="background-color: #FCF3F3;">
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ asset('admin/assets/img/bomb.svg') }}" alt="Doctor" class="rounded-circle me-2"
                        style="width: 100px; height: 100px;">
                    <div>

                        <small class="text-muted">
                            <h6>Chris Bradley</h6>
                            <p>Patient ID:HID-001</p>

                    </div>


                </div>
            </div>
            <!-- Appointment Details -->
            <h6 class="section-title">Patient Info. </h6>
            <form>
                <div class="row">
                    <div class="col-md-6 details-row">
                        <span class="details-label">Full Name:</span>
                        <span class="details-value">Megan Weber</span>

                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Email:</span>
                        <span class="details-value">megan@gmail.com</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Contact Number :</span>
                        <span class="details-value">(248)951-3820</span>
                    </div>

                    <div class="col-md-6 details-row">
                        <span class="details-label">Gender:</span>
                        <span class="details-value">Male</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Date of Birth:</span>
                        <span class="details-value">02/04/1998</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Hospital:</span>
                        <span class="details-value">City Hospital</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Modules Access:</span>
                        <span class="details-value">Dashboard,Chat</span>
                    </div>
                    <div class="col-md-6 details-row">
                        <span class="details-label">Appointments:</span>
                        <span class="details-value">50</span>
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
                                <tr>
                                    <td class="text-sm font-weight-bold text-dark">Dashboard</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="overview" checked>
                                            <label class="form-check-label">Full Access</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="overview">
                                            <label class="form-check-label">Read Only</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm font-weight-bold text-dark">Appointment</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="doctors" checked>
                                            <label class="form-check-label">Full Access</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="doctors">
                                            <label class="form-check-label">Read Only</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm font-weight-bold text-dark">Chat</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nurses" checked>
                                            <label class="form-check-label">Full Access</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nurses">
                                            <label class="form-check-label">Read Only</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm font-weight-bold text-dark">Hospital</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="receptionists" checked>
                                            <label class="form-check-label">Full Access</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="receptionists">
                                            <label class="form-check-label">Read Only</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm font-weight-bold text-dark">Doctors</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pharmacists" checked>
                                            <label class="form-check-label">Full Access</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pharmacists">
                                            <label class="form-check-label">Read Only</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm font-weight-bold text-dark">Patients</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="patients" checked>
                                            <label class="form-check-label">Full Access</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="patients">
                                            <label class="form-check-label">Read Only</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm font-weight-bold text-dark">Admins</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="departments" checked>
                                            <label class="form-check-label">Full Access</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="departments">
                                            <label class="form-check-label">Read Only</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm font-weight-bold text-dark">Setting</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="laboratories" checked>
                                            <label class="form-check-label">Full Access</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="laboratories">
                                            <label class="form-check-label">Read Only</label>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Submit -->
                <div class="mt-4 text-end">
                    <button type="submit" class="btn bg-danger text-white">Add</button>
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
