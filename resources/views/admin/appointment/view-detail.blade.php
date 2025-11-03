@extends('admin.layout.master')
@section('style')
    <style>
        .header-banner {
            background: url('admin/assets/img/header-bg.png') no-repeat center center;
            background-size: cover;
            height: 190px;
            border-radius: 10px;


        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
            <div class="header-banner "></div>
            <div class="appointment-container">
                <div class="">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-link text-dark p-0 me-2">&larr;</button>
                            <h4 class="fw-bold mb-0">Appointment Details</h4>
                        </div>
                        <button class="btn btn-pdf">
                            <i class="bi bi-file-earmark-pdf"></i> Download PDF
                        </button>
                    </div>

                    <!-- Patient and Doctor Details -->
                    <div class="row g-3 mb-4">
                        <!-- Patient -->
                        <div class="col-md-6">
                            <div class="sub-card h-100">
                                <h6 class="fw-bold mb-3">Patient Details</h6>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('admin/assets/img/team-1.jpg') }}" class="border-radius-lg me-3" width="100"
                                        height="100" alt="Patient">
                                    <div>
                                        <p class="mb-1"><strong>Name:</strong> Louisa Sanders</p>
                                        <p class="mb-1"><strong>Email:</strong> louisa@gmail.com</p>
                                        <p class="mb-0"><strong>Visit Type:</strong> In Person</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Doctor -->
                        <div class="col-md-6">
                            <div class="sub-card doctor-card h-100">
                                <h6 class="fw-bold mb-3">Doctor Details</h6>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('admin/assets/img/team-2.jpg') }}" class="border-radius-lg me-3" width="100"
                                        height="100" alt="Doctor">
                                    <div>
                                        <p class="mb-1"><strong>Name:</strong> Dr. George Lee</p>
                                        <p class="mb-1"><strong>Email:</strong> george@mail.co</p>
                                        <p class="mb-0"><strong>Contact:</strong> In Person</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Details -->
                    <h6 class="section-title">Appointment Details</h6>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p><strong>Date:</strong> June 26, 2025 - 11:00 AM</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>Time:</strong> 11:00 AM - 11:30 (30 Minutes)</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>Visit Type:</strong> In Person</p>
                        </div>
                    </div>

                    <!-- Doctors Notes -->
                    <h6 class="section-title">Doctors Notes</h6>
                    <p>
                        Patient reports occasional chest pain during exercise. BP slightly elevated.
                        Recommended ECG and follow-up in 2 weeks. Advised light physical activity until results are in.
                    </p>

                    <!-- Prescription -->
                    <div class="prescription-card">
                        <h6 class="section-title text-dark mt-0">Prescription</h6>
                        <div class=" d-flex flex-wrap align-items-center">
                            <div class="me-4">
                                <p class="mb-1 "><i class="fa-solid fa-capsules text-danger bg-white p-2 rounded-circle"></i> <strong>Panadol 500
                                        mg</strong></p>
                                <small>1 Tablet, 3x daily for 7 days</small>
                            </div>
                            <div>
                                <p class="mb-1"><i class="fa-solid fa-capsules text-danger bg-white p-2 rounded-circle"></i> <strong>Ibuprofen 500
                                        mg</strong></p>
                                <small>1 Tablet, 3x daily for 7 days</small>
                            </div>
                        </div>
                    </div>
                    <!-- Lab Tests -->
                    <h6 class="section-title mt-4">Lab Tests</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="lab-test-card d-flex justify-content-between">
                                <p class="mb-1"><i class="fa-solid fa-chart-line text-danger"></i> Blood Sugar</p>
                                <a href="lab-report.pdf" class="text-info small">lab-report.pdf</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="lab-test-card d-flex justify-content-between">
                                <p class="mb-1"><i class="fa-solid fa-chart-line text-danger"></i> Blood Sugar</p>
                                <a href="lab-report.pdf" class="text-info small">lab-report.pdf</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    
@endsection