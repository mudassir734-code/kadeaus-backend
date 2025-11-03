@extends('admin.layout.master')
@section('style')
    <style>
        .header-banner {
            background: url('./assets/img/header-bg.png') no-repeat center center;
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


            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center mb-4">
                    <button class="btn btn-link text-dark p-0 me-2"><a
                            href="{{ route('admin.hospital') }}">&larr;</a></button>
                    <h4 class="fw-bold mb-0">Patient Details</h4>
                </div>

            </div>


            <div class="p-3 border-radius-lg" style="background-color: #FCF3F3;">
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-circle me-2"
                        style="width: 100px; height: 100px;">
                    <div>

                        <small class="text-muted">
                            <h6>Patricia Hawkins</h6>
                            patricia@gmail.com

                        </small>
                    </div>
                </div>
            </div>
            <hr>


            <div class="row mb-3">
                <div class="col-md-6 details-row">
                    <span class="details-label">Patient ID:</span>
                    <span class="details-value">P-001</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Email:</span>
                    <span class="details-value">denise@gmail.com</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Full Name:</span>
                    <span class="details-value">Denise Reynolds</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Hright (Inches):</span>
                    <span class="details-value">150 Inches</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Date of Birth:</span>
                    <span class="details-value">11/12/1999</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Weight (kg):</span>
                    <span class="details-value">65 kg</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Sex:</span>
                    <span class="details-value">Male</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Marital Status:</span>
                    <span class="details-value">Married</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Contact Number:</span>
                    <span class="details-value">123-456-7890</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Blood Type:</span>
                    <span class="details-value">O+</span>
                </div>
            </div>
            <h5>Address</h5>
            <div class="row mb-3 ">
                <div class="col-md-6 details-row">
                    <span class="details-label">Street:</span>
                    <span class="details-value">123 Main St</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">City:</span>
                    <span class="details-value">Anytown</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">State:</span>
                    <span class="details-value">CA</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Zip Code:</span>
                    <span class="details-value">12345</span>
                </div>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1" checked>
                <label class="custom-control-label" for="customRadio1">Pragnency</label>
            </div>
            <h5>Emergency Contact</h5>
            <div class="row">
                <div class="col-md-6 details-row">
                    <span class="details-label">Name:</span>
                    <span class="details-value">John Doe</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Relationship:</span>
                    <span class="details-value">Brother</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Contact Number:</span>
                    <span class="details-value">123-456-7890</span>
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
