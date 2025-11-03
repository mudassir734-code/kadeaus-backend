@extends('admin.layout.master')
@section('style')
    <style>
        .custom-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 15px 0;
            background: #fff;
            position: relative;
        }

        .card-header-title {
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 10px;
        }

        .card-header-title i {
            font-size: 18px;
        }

        .status-tag {
            font-size: 12px;
            font-weight: 600;
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .status-new {
            color: #a020f0;
        }

        .status-progress {
            color: #007bff;
        }

        .status-skipped {
            color: #ff5722;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
        }


        .btn-custom {
            width: 100%;
            margin-top: 15px;
            border-radius: 6px;
            font-weight: 600;
            padding: 10px;
        }

        .btn-done {
            background: #e53935;
            color: #fff;
        }

        .btn-skipped {
            background: #e53935;
            color: #fff;
        }

        .main-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 0;
        }

        .patients-header {
            padding: 20px 25px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .patients-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            color: #343a40;
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 8px 15px 8px 40px;
            width: 100%;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #6c757d;
        }

        .entries-control {
            padding: 0 25px 15px;
            font-size: 14px;
            color: #6c757d;
        }

        .entries-control select {
            border: none;
            background: none;
            outline: none;
            font-weight: 500;
            color: #495057;
        }

        .patient-table {
            margin: 0;
        }

        .patient-table th {
            background-color: #f8f9fa;
            border: none;
            padding: 15px 25px;
            font-weight: 600;
            color: #000;
            font-size: 15px;
        }

        .patient-table td {
            padding: 12px 23px;
            /* border-top: 1px solid #f1f3f4; */
            vertical-align: middle;
            font-size: 14px;
        }

        .patient-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .view-btn {
            background: #fff;
            color: #007bff;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .view-btn:hover {
            background: #0056b3;
        }

        .pagination-container {
            padding: 20px 25px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            font-size: 14px;
            color: #6c757d;
        }

        .pagination .page-link {
            border: none;
            color: #6c757d;
            padding: 8px 12px;
            margin: 0 2px;
            border-radius: 4px;
        }

        .pagination .page-item.active .page-link {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
            color: #495057;
        }

        /* Patient Detail View */
        .patient-detail {
            display: none;
        }

        .patient-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px 25px;
            color: white;
        }

        .patient-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .patient-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .patient-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .patient-info h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .patient-info p {
            margin: 2px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .nav-tabs {
            border-bottom: 1px solid #e9ecef;
            padding: 0 25px;
            margin-bottom: 0;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 15px 20px;
            margin-right: 10px;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff !important;
            background-color: #dc3545;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        .nav-tabs .nav-link.active {
            color: #fff !important;

            background: #dc3545;
        }

        .tab-content {
            padding: 5px;
        }

        .detail-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .detail-section h5 {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 12px;
        }

        .detail-label {
            font-weight: 500;
            color: #495057;
            width: 140px;
            font-size: 14px;
        }

        .detail-value {
            color: #6c757d;
            font-size: 14px;
        }

        .nav.nav-pills .nav-link.active a {
            color: #fff !important;
            font-weight: bold;
        }

        .accordion-button:not(.collapsed) {
            color: var(--bs-accordion-active-color);
            /* background-color: var(--bs-accordion-active-bg); */
            box-shadow: inset 0 calc(-1 * var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color);
        }

        .doctor-card.active {
            border: 2px solid #D32F2F;
            background-color: #FFEFF1;
            box-shadow: 0px 4px 12px rgba(211, 47, 47, 0.2);
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
            <div id="patientsView" class="main-container">
                <div class="patients-header">
                    <h2>Patients</h2>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Type here..." id="searchInput">
                    </div>
                </div>

                <div class="entries-control">
                    <select id="entriesPerPage">
                        <option value="12" selected>5</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    Entries Per Page
                </div>

                <table class="table patient-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Total Appointments</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="patientTableBody">
                        <!-- Patient rows will be populated here -->
                    </tbody>
                </table>

                <div class="pagination-container">
                    <div class="pagination-info">
                        Showing <span id="showingStart">1</span> to <span id="showingEnd">12</span> of <span
                            id="totalEntries">57</span> entries
                    </div>
                    <nav>
                        <ul class="pagination" id="paginationNav">
                            <!-- Pagination will be populated here -->
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Patient Detail View -->
            <div id="patientDetail" class="patient-detail ">
                <div class="col-md-12" style="width: fit-content;">
                    <div class="nav  flex-row nav-pills d-flex  justify-content-between  mb-3 v-links p-1  "
                        id="v-pills-tab" role="tablist" aria-orientation="horizontal" style="background-color: #fff;">
                        <button class="nav-link h-navlinks py-2 v-links my-0  active " id="v-pills-overview-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-overview" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">
                            <a class="nav-link1 d-flex align-items-center px-0 mx-0 " href="#overview">
                                Overview
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-health-history-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-health-history" type="button" role="tab"
                            aria-controls="v-pills-health-history" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#health-history">
                                Health History
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0  " id="v-pills-appointments-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-appointments" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">
                            <a class="nav-link1 d-flex align-items-center px-0 mx-0 " href="#appointments">
                                Appointments
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-pregnancy-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-pregnancy" type="button" role="tab"
                            aria-controls="v-pills-pregnancy" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#pregnancy">
                                Pregnancy Suggestions
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0  " id="v-pills-telemedicine-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-telemedicine" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">
                            <a class="nav-link1 d-flex align-items-center px-0 mx-0 " href="#telemedicine">
                                Telemedicine
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-prescription-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-prescription" type="button" role="tab"
                            aria-controls="v-pills-prescription" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#prescription">
                                Prescription
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-recommendations-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-recommendations" type="button" role="tab"
                            aria-controls="v-pills-recommendations" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#recommendations">
                                Health Recommendations
                            </a>
                        </button>
                    </div>
                </div>
                <div class=" ">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-overview" role="tabpanel"
                            aria-labelledby="v-pills-overview-tab">
                            <div class="detail-section">
                                <i class="fa-solid fa-arrow-left" onclick="showPatientsView()"></i>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="patient-profile">
                                        <div class="patient-avatar" onclick="showPatientsView()">
                                            <img src="{{ asset('admin/assets/img/Circle-2.png') }}" alt="Patient Photo" id="patientPhoto"
                                                class="w-100 h-100">
                                        </div>
                                        <div class="patient-info">
                                            <h3 id="patientName">Patricia Hawkins</h3>
                                            <p id="patientEmail" class="opacity-6">patricia@gmail.com</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="detail-section">
                                <h5>Basic Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">First Name:</div>
                                            <div class="detail-value" id="firstName">Patricia</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">Date of Birth:</div>
                                            <div class="detail-value" id="dateOfBirth">11/12/1999</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">Gender:</div>
                                            <div class="detail-value" id="gender">Female</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">Email:</div>
                                            <div class="detail-value" id="email">patricia@gmail.com</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">Last Name:</div>
                                            <div class="detail-value" id="lastName">Hawkins</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">Sex:</div>
                                            <div class="detail-value" id="sex">Female</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">Contact Number:</div>
                                            <div class="detail-value" id="contactNumber">(460)670-4413</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">Marital Status:</div>
                                            <div class="detail-value" id="maritalStatus">Married</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="detail-section">
                                <h5>Address</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">Address:</div>
                                            <div class="detail-value" id="address">2857 Oxford Blvd, Allison Park,
                                                Pennsylvania, 15101, United States</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">City:</div>
                                            <div class="detail-value" id="city">Allison Park</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">Country:</div>
                                            <div class="detail-value" id="country">United States</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">State:</div>
                                            <div class="detail-value" id="state">Pennsylvania</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label">Zip Code:</div>
                                            <div class="detail-value" id="zipCode">15101</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="detail-section">
                                <h5>Medical Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">Height(cm):</div>
                                            <div class="detail-value" id="height">175 cm</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">Weight (Pounds):</div>
                                            <div class="detail-value" id="weight">145 Pounds</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">Marital Status:</div>
                                            <div class="detail-value" id="maritalStatus">Single</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <div class="detail-label">Blood Type:</div>
                                            <div class="detail-value" id="bloodType">O+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="detail-section">
                                <h5>Emergency Contact</h5>
                                <div class="row">
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Name:</p>
                                    </div>
                                    <div class="col-md-3 mb-3 gap-4">
                                        <p class="text-sm font-weight-normal" id="name">Richard Payne</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Relationship:</p>
                                    </div>
                                    <div class="col-md-3 mb-3 gap-4">
                                        <p class="text-sm font-weight-normal" id="relationship">Brother</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Contact Number:</p>
                                    </div>
                                    <div class="col-md-3 mb-3 gap-4">
                                        <p class="text-sm font-weight-normal" id="contactNumber">(307)197-6191</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="v-pills-health-history" role="tabpanel"
                            aria-labelledby="v-pills-health-history-tab">
                            <div>
                                <div class="accordion" id="healthAccordion">

                                    <!-- Blood Sugar -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSugar">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSugar"
                                                aria-expanded="false" aria-controls="collapseSugar">
                                                <h5><i class="fa-solid fa-droplet text-danger text-lg me-3"></i> Blood
                                                    Sugar</h5>
                                                <!-- <h5 class="d-flex justify-content-end"><span
                                                        class="ms-auto fw-normal">95 mg/dL</span></h5> -->
                                            </button>
                                        </h2>
                                        <div id="collapseSugar" class="accordion-collapse collapse"
                                            aria-labelledby="headingSugar" data-bs-parent="#healthAccordion">
                                            <div class="accordion-body">
                                                <!-- Top Info Row -->
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-6 col-md-3">
                                                        <span class="label-title font-weight-bold">Latest
                                                            Reading:</span>
                                                        <span class="label-value font-weight-normal opacity-8">95
                                                            mg/dL</span>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <span class="label-title font-weight-bold">Date:</span>
                                                        <span class="label-value font-weight-normal opacity-8">26 Jun
                                                            2025, 8:00 AM</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                                        <span class="label-title font-weight-bold">Reading Type:</span>
                                                        <span
                                                            class="label-value font-weight-normal opacity-8">Fasting</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                                        <span class="status-badge">Normal</span>
                                                    </div>
                                                </div>

                                                <!-- History Table -->
                                                <div class="history-container p-3">
                                                    <h6 class="mb-3 fw-bold">History</h6>
                                                    <div class="table-responsive " style="background-color: #FFCDD2;">
                                                        <table class="table table-borderless mb-0 history-table"
                                                            style="background-color: #FFCDD2 !important;">
                                                            <thead style="background-color: #FFCDD2 !important;">
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                    <th>Value (mg/dL)</th>
                                                                    <th>Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="background-color: #FFCDD2 !important;">
                                                                <tr>
                                                                    <td>25 Jun 2025</td>
                                                                    <td>8:00 AM</td>
                                                                    <td>96</td>
                                                                    <td>Fasting</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>22 Jun 2025</td>
                                                                    <td>10:00 AM</td>
                                                                    <td>142</td>
                                                                    <td>Post-Meal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Blood Pressure -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingBP">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseBP"
                                                aria-expanded="false" aria-controls="collapseBP">
                                                <h5><i class="fa-solid fa-heart-pulse text-info text-lg me-3"></i>Blood
                                                    Pressure</h5>

                                            </button>
                                        </h2>
                                        <div id="collapseBP" class="accordion-collapse collapse"
                                            aria-labelledby="headingBP" data-bs-parent="#healthAccordion">
                                            <div class="accordion-body">
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-6 col-md-3">
                                                        <span class="label-title font-weight-bold">Latest
                                                            Reading:</span>
                                                        <span class="label-value font-weight-normal opacity-8">95
                                                            mg/dL</span>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <span class="label-title font-weight-bold">Date:</span>
                                                        <span class="label-value font-weight-normal opacity-8">26 Jun
                                                            2025, 8:00 AM</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                                        <span class="label-title font-weight-bold">Reading Type:</span>
                                                        <span
                                                            class="label-value font-weight-normal opacity-8">Fasting</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                                        <span class="status-badge">Normal</span>
                                                    </div>
                                                </div>

                                                <!-- History Table -->
                                                <div class="history-container p-3">
                                                    <h6 class="mb-3 fw-bold">History</h6>
                                                    <div class="table-responsive " style="background-color: #FFCDD2;">
                                                        <table class="table table-borderless mb-0 history-table"
                                                            style="background-color: #FFCDD2 !important;">
                                                            <thead style="background-color: #FFCDD2 !important;">
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                    <th>Value (mg/dL)</th>
                                                                    <th>Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="background-color: #FFCDD2 !important;">
                                                                <tr>
                                                                    <td>25 Jun 2025</td>
                                                                    <td>8:00 AM</td>
                                                                    <td>96</td>
                                                                    <td>Fasting</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>22 Jun 2025</td>
                                                                    <td>10:00 AM</td>
                                                                    <td>142</td>
                                                                    <td>Post-Meal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Heart Rate -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingHeart">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseHeart"
                                                aria-expanded="false" aria-controls="collapseHeart">

                                                <h5><i class="fa-solid fa-heart text-danger text-lg me-3"></i>Heart Rate
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="collapseHeart" class="accordion-collapse collapse"
                                            aria-labelledby="headingHeart" data-bs-parent="#healthAccordion">
                                            <div class="accordion-body">
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-6 col-md-3">
                                                        <span class="label-title font-weight-bold">Latest
                                                            Reading:</span>
                                                        <span class="label-value font-weight-normal opacity-8">95
                                                            mg/dL</span>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <span class="label-title font-weight-bold">Date:</span>
                                                        <span class="label-value font-weight-normal opacity-8">26 Jun
                                                            2025, 8:00 AM</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                                        <span class="label-title font-weight-bold">Reading Type:</span>
                                                        <span
                                                            class="label-value font-weight-normal opacity-8">Fasting</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                                        <span class="status-badge">Normal</span>
                                                    </div>
                                                </div>

                                                <!-- History Table -->
                                                <div class="history-container p-3">
                                                    <h6 class="mb-3 fw-bold">History</h6>
                                                    <div class="table-responsive " style="background-color: #FFCDD2;">
                                                        <table class="table table-borderless mb-0 history-table"
                                                            style="background-color: #FFCDD2 !important;">
                                                            <thead style="background-color: #FFCDD2 !important;">
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                    <th>Value (mg/dL)</th>
                                                                    <th>Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="background-color: #FFCDD2 !important;">
                                                                <tr>
                                                                    <td>25 Jun 2025</td>
                                                                    <td>8:00 AM</td>
                                                                    <td>96</td>
                                                                    <td>Fasting</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>22 Jun 2025</td>
                                                                    <td>10:00 AM</td>
                                                                    <td>142</td>
                                                                    <td>Post-Meal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Weight -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingWeight">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseWeight"
                                                aria-expanded="false" aria-controls="collapseWeight">
                                                <h5><i
                                                        class="fa-solid fa-weight-scale text-warning text-lg me-3"></i>weight
                                                </h5>
                                            </button>
                                        </h2>
                                        <div id="collapseWeight" class="accordion-collapse collapse"
                                            aria-labelledby="headingWeight" data-bs-parent="#healthAccordion">
                                            <div class="accordion-body">
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-6 col-md-3">
                                                        <span class="label-title font-weight-bold">Latest
                                                            Reading:</span>
                                                        <span class="label-value font-weight-normal opacity-8">95
                                                            mg/dL</span>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <span class="label-title font-weight-bold">Date:</span>
                                                        <span class="label-value font-weight-normal opacity-8">26 Jun
                                                            2025, 8:00 AM</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                                        <span class="label-title font-weight-bold">Reading Type:</span>
                                                        <span
                                                            class="label-value font-weight-normal opacity-8">Fasting</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                                        <span class="status-badge">Normal</span>
                                                    </div>
                                                </div>

                                                <!-- History Table -->
                                                <div class="history-container p-3">
                                                    <h6 class="mb-3 fw-bold">History</h6>
                                                    <div class="table-responsive " style="background-color: #FFCDD2;">
                                                        <table class="table table-borderless mb-0 history-table"
                                                            style="background-color: #FFCDD2 !important;">
                                                            <thead style="background-color: #FFCDD2 !important;">
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                    <th>Value (mg/dL)</th>
                                                                    <th>Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="background-color: #FFCDD2 !important;">
                                                                <tr>
                                                                    <td>25 Jun 2025</td>
                                                                    <td>8:00 AM</td>
                                                                    <td>96</td>
                                                                    <td>Fasting</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>22 Jun 2025</td>
                                                                    <td>10:00 AM</td>
                                                                    <td>142</td>
                                                                    <td>Post-Meal</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-appointments" role="tabpanel"
                            aria-labelledby="v-pills-appointments-tab">


                            <div class="appointments">
                                <div class="card">
                                    <div class="text-success font-weight-bold incoming cursor-pointer">Completed</div>
                                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                                    <div class="user-profile-section">
                                        <div class="profile-image-container">
                                            <img src="{{ asset('admin/assets/img/Circle-1.png') }}" alt="Justin Carrol"
                                                class="profile-image">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div class="user-name">Justin Carrol</div>
                                    </div>
                                    <div class="appointment-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Gender:</span>
                                            <span class="detail-value">Female</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">DOB:</span>
                                            <span class="detail-value">06/03/2005</span>
                                        </div>
                                    </div>
                                    <div class="btns">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='{{ route('admin.patient.viewPatient') }}'">View
                                            Details</button>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="text-success font-weight-bold completed cursor-pointer">Completed</div>
                                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                                    <div class="user-profile-section">
                                        <div class="profile-image-container">
                                            <img src="{{ asset('admin/assets/img/Circle-5.png') }}" alt="Justin Carrol"
                                                class="profile-image">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div class="user-name">Justin Carrol</div>
                                    </div>
                                    <div class="appointment-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Gender:</span>
                                            <span class="detail-value">Female</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">DOB:</span>
                                            <span class="detail-value">06/03/2005</span>
                                        </div>
                                    </div>
                                    <div class="btns">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='detail.html'">View
                                            Details</button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="text-success font-weight-bold incoming cursor-pointer">Completed</div>
                                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                                    <div class="user-profile-section">
                                        <div class="profile-image-container">
                                            <img src="{{ asset('admin/assets/img/Circle-2.png') }}" alt="Justin Carrol"
                                                class="profile-image">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div class="user-name">Justin Carrol</div>
                                    </div>
                                    <div class="appointment-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Gender:</span>
                                            <span class="detail-value">Female</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">DOB:</span>
                                            <span class="detail-value">06/03/2005</span>
                                        </div>
                                    </div>
                                    <div class="btns">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='detail.html'">View
                                            Details</button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="text-success font-weight-bold completed">Completed</div>
                                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                                    <div class="user-profile-section">
                                        <div class="profile-image-container">
                                            <img src="{{ asset('admin/assets/img/Circle-3.png') }}" alt="Justin Carrol"
                                                class="profile-image">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div class="user-name">Justin Carrol</div>
                                    </div>
                                    <div class="appointment-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Gender:</span>
                                            <span class="detail-value">Female</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">DOB:</span>
                                            <span class="detail-value">06/03/2005</span>
                                        </div>
                                    </div>
                                    <div class="btns">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='detail.html'">View
                                            Details</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="v-pills-pregnancy" role="tabpanel"
                            aria-labelledby="v-pills-pregnancy-tab">
                            <div class="">
                                <div class="header-box mb-4 bg-danger border-radius-lg">
                                    <div class="header-content p-3 d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-white">Pregnancy Tracking & Guidance</h6>
                                            <small class="text-white">Personalize insights on baby growth, health tips,
                                                lifestyle guidance,
                                                appointment reminders, and alerts for potential risks</small>
                                        </div>
                                        <button class="btn btn-add btn-light" data-bs-toggle="modal"
                                            data-bs-target="#addSuggestionModal">Add New</button>

                                    </div>
                                </div>

                                <!-- Suggestion Cards -->
                                <div
                                    class="card card-custom p-3 mb-3 border-radius-lg d-flex flex-row align-items-center">
                                    <img src="{{ asset('admin/assets/img/chart.svg') }}" alt="Baby Growth Insights" class="card-icon w-3">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">Baby Growth Insights</h5>
                                        <small>Track your baby's growth week by week & gain personalized
                                            insights.</small>
                                    </div>
                                    <div>
                                        <a href="#" class="me-3 text-muted"><i class="fa fa-trash"></i> Delete</a>
                                        <a href="#" class="text-muted"><i class="fa fa-pen"></i> Edit</a>
                                    </div>
                                </div>

                                <div
                                    class="card card-custom p-3  mb-3 d-flex border-radius-lg flex-row align-items-center">
                                    <img src="{{ asset('admin/assets/img/calendar.svg') }}" alt="Health Tips & Lifestyle Guidance"
                                        class="card-icon w-3">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">Health Tips & Lifestyle Guidance</h5>
                                        <small>Get personalized health tips lifestyle guidance tailored for
                                            pregnancy.</small>
                                    </div>
                                    <div>
                                        <a href="#" class="me-3 text-muted"><i class="fa fa-trash"></i> Delete</a>
                                        <a href="#" class="text-muted"><i class="fa fa-pen"></i> Edit</a>
                                    </div>
                                </div>

                                <div
                                    class="card card-custom p-3 mb-3 border-radius-lg d-flex flex-row align-items-center">
                                    <img src="{{ asset('admin/assets/img/blub.svg') }}" alt="Baby Growth Insights" class="card-icon w-2">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">Appointment Reminders</h5>
                                        <small>Get timely reminders for your appointments & stay on track.</small>
                                    </div>
                                    <div>
                                        <a href="#" class="me-3 text-muted"><i class="fa fa-trash"></i> Delete</a>
                                        <a href="#" class="text-muted"><i class="fa fa-pen"></i> Edit</a>
                                    </div>
                                </div>

                            </div>

                            <!-- Modal -->

                        </div>
                        <div class="tab-pane fade" id="v-pills-telemedicine" role="tabpanel"
                            aria-labelledby="v-pills-telemedicine-tab">
                            <div class="appointments mb-0">
                                <div class="card doctor-card p-3">
                                    <div class="doctor-name text-dark text-sm">Dr.Victoria Ellis</div>
                                    <div class="options text-info font-weight-bold text-sm"> Upcoming</div>

                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                            class="rounded-md border-radius-lg me-2"
                                            style="width: 100px; height: 100px;">
                                        <div>

                                            <small class="text-muted">
                                                <i class="fa-solid fa-users text-danger me-3"></i>Dentist<br>
                                                <i class="fa-solid fa-hospital text-danger me-3"></i> Northwood General
                                                Hospital
                                                <br />
                                                <i class="fa-solid fa-phone text-danger me-3"></i> Video Call
                                            </small>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 fw-bold">Instructions:</h6>
                                    <p>
                                        Please log in 10 minutes early and have your latest skin care products or
                                        medications handy.
                                    </p>
                                    <div class="text-center border-radius-lg p-3 " style="background-color: #CDEDFF;">
                                        <p class="mb-0"><i class="fa-solid fa-circle-info text-info text-lg"></i></p>
                                        <p class="mb-0">Please log in 10 minutes early and have your latest skin care
                                            products or
                                            medications handy.</p>
                                    </div>

                                </div>
                                <div class="card doctor-card p-3">
                                    <div class="doctor-name text-dark text-sm">Dr.Victoria Ellis</div>
                                    <div class="options text-info font-weight-bold text-sm"> Upcoming</div>

                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                            class="rounded-md border-radius-lg me-2"
                                            style="width: 100px; height: 100px;">
                                        <div>

                                            <small class="text-muted">
                                                <i class="fa-solid fa-users text-danger me-3"></i>Dentist<br>
                                                <i class="fa-solid fa-hospital text-danger me-3"></i> Northwood General
                                                Hospital
                                                <br />
                                                <i class="fa-solid fa-phone text-danger me-3"></i> Video Call
                                            </small>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 fw-bold">Instructions:</h6>
                                    <p>
                                        Please log in 10 minutes early and have your latest skin care products or
                                        medications handy.
                                    </p>
                                    <div class="text-center border-radius-lg p-3 " style="background-color: #CDEDFF;">
                                        <p class="mb-0"><i class="fa-solid fa-circle-info text-info text-lg"></i></p>
                                        <p class="mb-0">Please log in 10 minutes early and have your latest skin care
                                            products or
                                            medications handy.</p>
                                    </div>

                                </div>
                                <div class="card doctor-card p-3">
                                    <div class="doctor-name text-dark text-sm">Dr.Victoria Ellis</div>
                                    <div class="options text-info font-weight-bold text-sm"> Upcoming</div>

                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                            class="rounded-md border-radius-lg me-2"
                                            style="width: 100px; height: 100px;">
                                        <div>

                                            <small class="text-muted">
                                                <i class="fa-solid fa-users text-danger me-3"></i>Dentist<br>
                                                <i class="fa-solid fa-hospital text-danger me-3"></i> Northwood General
                                                Hospital
                                                <br />
                                                <i class="fa-solid fa-phone text-danger me-3"></i> Video Call
                                            </small>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 fw-bold">Instructions:</h6>
                                    <p>
                                        Please log in 10 minutes early and have your latest skin care products or
                                        medications handy.
                                    </p>
                                    <div class="text-center border-radius-lg p-3 " style="background-color: #CDEDFF;">
                                        <p class="mb-0"><i class="fa-solid fa-circle-info text-info text-lg"></i></p>
                                        <p class="mb-0">Please log in 10 minutes early and have your latest skin care
                                            products or
                                            medications handy.</p>
                                    </div>

                                </div>
                                <div class="card doctor-card p-3">
                                    <div class="doctor-name text-dark text-sm">Dr.Victoria Ellis</div>
                                    <div class="options text-info font-weight-bold text-sm"> Upcoming</div>

                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                            class="rounded-md border-radius-lg me-2"
                                            style="width: 100px; height: 100px;">
                                        <div>

                                            <small class="text-muted">
                                                <i class="fa-solid fa-users text-danger me-3"></i>Dentist<br>
                                                <i class="fa-solid fa-hospital text-danger me-3"></i> Northwood General
                                                Hospital
                                                <br />
                                                <i class="fa-solid fa-phone text-danger me-3"></i> Video Call
                                            </small>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 fw-bold">Instructions:</h6>
                                    <p>
                                        Please log in 10 minutes early and have your latest skin care products or
                                        medications handy.
                                    </p>
                                    <div class="text-center border-radius-lg p-3 " style="background-color: #CDEDFF;">
                                        <p class="mb-0"><i class="fa-solid fa-circle-info text-info text-lg"></i></p>
                                        <p class="mb-0">Please log in 10 minutes early and have your latest skin care
                                            products or
                                            medications handy.</p>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-prescription" role="tabpanel"
                            aria-labelledby="v-pills-prescription-tab">
                            <div class="appointments mb-0">
                                <div class="card shadow-lg  doctor-card">
                                    <div class="doctor-header">
                                        <i class="fa-solid fa-chart-line text-danger me-3 font-weight-bolder"></i>
                                        <div class="doctor-info">
                                            <div class="doctor-name">Dr. John - General Physician</div>
                                        </div>
                                    </div>

                                    <div class="diagnosis ">Diagnosis: Flu</div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Paracetamol 500mg
                                        </div>
                                        <div class="med-dosage">2x / Day</div>
                                        <div class="med-duration">5 Days</div>
                                    </div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Omeprazole 20mg
                                        </div>
                                        <div class="med-dosage">1x / Day</div>
                                        <div class="med-duration">7 Days</div>
                                    </div>

                                    <div class="notes mb-3">
                                        <strong>Notes:</strong> Allergic to ibuprofen
                                    </div>
                                    <div class="date"><strong>Date:</strong> 23 June 2025</div>
                                    <div class="prescription-footer">
                                        <button class="btn details w-100">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>

                                <!-- Additional prescription cards (same structure) -->
                                <div class="card shadow-lg  doctor-card">
                                    <div class="doctor-header">
                                        <i class="fa-solid fa-chart-line text-danger me-3 font-weight-bolder"></i>
                                        <div class="doctor-info">
                                            <div class="doctor-name">Dr. John - General Physician</div>
                                        </div>
                                    </div>

                                    <div class="diagnosis ">Diagnosis: Flu</div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Paracetamol 500mg
                                        </div>
                                        <div class="med-dosage">2x / Day</div>
                                        <div class="med-duration">5 Days</div>
                                    </div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Omeprazole 20mg
                                        </div>
                                        <div class="med-dosage">1x / Day</div>
                                        <div class="med-duration">7 Days</div>
                                    </div>

                                    <div class="notes mb-3">
                                        <strong>Notes:</strong> Allergic to ibuprofen
                                    </div>
                                    <div class="date"><strong>Date:</strong> 23 June 2025</div>

                                    <div class="prescription-footer">

                                        <button class="btn details w-100">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>

                                <div class="card shadow-lg  doctor-card">
                                    <div class="doctor-header">
                                        <i class="fa-solid fa-chart-line text-danger me-3 font-weight-bolder"></i>
                                        <div class="doctor-info">
                                            <div class="doctor-name">Dr. John - General Physician</div>
                                        </div>
                                    </div>

                                    <div class="diagnosis ">Diagnosis: Flu</div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Paracetamol 500mg
                                        </div>
                                        <div class="med-dosage">2x / Day</div>
                                        <div class="med-duration">5 Days</div>
                                    </div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Omeprazole 20mg
                                        </div>
                                        <div class="med-dosage">1x / Day</div>
                                        <div class="med-duration">7 Days</div>
                                    </div>

                                    <div class="notes mb-3">
                                        <strong>Notes:</strong> Allergic to ibuprofen
                                    </div>
                                    <div class="date"><strong>Date:</strong> 23 June 2025</div>

                                    <div class="prescription-footer">

                                        <button class="btn details  w-100">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>
                                <div class="card shadow-lg  doctor-card">
                                    <div class="doctor-header">
                                        <i class="fa-solid fa-chart-line text-danger me-3 font-weight-bolder"></i>
                                        <div class="doctor-info">
                                            <div class="doctor-name">Dr. John - General Physician</div>
                                        </div>
                                    </div>

                                    <div class="diagnosis ">Diagnosis: Flu</div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Paracetamol 500mg
                                        </div>
                                        <div class="med-dosage">2x / Day</div>
                                        <div class="med-duration">5 Days</div>
                                    </div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Omeprazole 20mg
                                        </div>
                                        <div class="med-dosage">1x / Day</div>
                                        <div class="med-duration">7 Days</div>
                                    </div>

                                    <div class="notes mb-3">
                                        <strong>Notes:</strong> Allergic to ibuprofen
                                    </div>
                                    <div class="date"><strong>Date:</strong> 23 June 2025</div>
                                    <div class="prescription-footer">
                                        <button class="btn details w-100">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>

                                <!-- Additional prescription cards (same structure) -->
                                <div class="card shadow-lg  doctor-card">
                                    <div class="doctor-header">
                                        <i class="fa-solid fa-chart-line text-danger me-3 font-weight-bolder"></i>
                                        <div class="doctor-info">
                                            <div class="doctor-name">Dr. John - General Physician</div>
                                        </div>
                                    </div>

                                    <div class="diagnosis ">Diagnosis: Flu</div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Paracetamol 500mg
                                        </div>
                                        <div class="med-dosage">2x / Day</div>
                                        <div class="med-duration">5 Days</div>
                                    </div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Omeprazole 20mg
                                        </div>
                                        <div class="med-dosage">1x / Day</div>
                                        <div class="med-duration">7 Days</div>
                                    </div>

                                    <div class="notes mb-3">
                                        <strong>Notes:</strong> Allergic to ibuprofen
                                    </div>
                                    <div class="date"><strong>Date:</strong> 23 June 2025</div>

                                    <div class="prescription-footer">

                                        <button class="btn details w-100">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>

                                <div class="card shadow-lg  doctor-card">
                                    <div class="doctor-header">
                                        <i class="fa-solid fa-chart-line text-danger me-3 font-weight-bolder"></i>
                                        <div class="doctor-info">
                                            <div class="doctor-name">Dr. John - General Physician</div>
                                        </div>
                                    </div>

                                    <div class="diagnosis ">Diagnosis: Flu</div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Paracetamol 500mg
                                        </div>
                                        <div class="med-dosage">2x / Day</div>
                                        <div class="med-duration">5 Days</div>
                                    </div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Omeprazole 20mg
                                        </div>
                                        <div class="med-dosage">1x / Day</div>
                                        <div class="med-duration">7 Days</div>
                                    </div>

                                    <div class="notes mb-3">
                                        <strong>Notes:</strong> Allergic to ibuprofen
                                    </div>
                                    <div class="date"><strong>Date:</strong> 23 June 2025</div>

                                    <div class="prescription-footer">

                                        <button class="btn details  w-100">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>
                                <div class="card shadow-lg  doctor-card">
                                    <div class="doctor-header">
                                        <i class="fa-solid fa-chart-line text-danger me-3 font-weight-bolder"></i>
                                        <div class="doctor-info">
                                            <div class="doctor-name">Dr. John - General Physician</div>
                                        </div>
                                    </div>

                                    <div class="diagnosis ">Diagnosis: Flu</div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Paracetamol 500mg
                                        </div>
                                        <div class="med-dosage">2x / Day</div>
                                        <div class="med-duration">5 Days</div>
                                    </div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Omeprazole 20mg
                                        </div>
                                        <div class="med-dosage">1x / Day</div>
                                        <div class="med-duration">7 Days</div>
                                    </div>

                                    <div class="notes mb-3">
                                        <strong>Notes:</strong> Allergic to ibuprofen
                                    </div>
                                    <div class="date"><strong>Date:</strong> 23 June 2025</div>

                                    <div class="prescription-footer">

                                        <button class="btn details  w-100">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>
                                <div class="card shadow-lg  doctor-card">
                                    <div class="doctor-header">
                                        <i class="fa-solid fa-chart-line text-danger me-3 font-weight-bolder"></i>
                                        <div class="doctor-info">
                                            <div class="doctor-name">Dr. John - General Physician</div>
                                        </div>
                                    </div>

                                    <div class="diagnosis ">Diagnosis: Flu</div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Paracetamol 500mg
                                        </div>
                                        <div class="med-dosage">2x / Day</div>
                                        <div class="med-duration">5 Days</div>
                                    </div>

                                    <div class="medication">
                                        <div class="med-name text-muted">
                                            <i class="fas fa-pills"></i> Omeprazole 20mg
                                        </div>
                                        <div class="med-dosage">1x / Day</div>
                                        <div class="med-duration">7 Days</div>
                                    </div>

                                    <div class="notes mb-3">
                                        <strong>Notes:</strong> Allergic to ibuprofen
                                    </div>
                                    <div class="date"><strong>Date:</strong> 23 June 2025</div>

                                    <div class="prescription-footer">

                                        <button class="btn details  w-100">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-recommendations" role="tabpanel"
                            aria-labelledby="v-pills-recommendations-tab">
                            <div class="row g-3">
                                <!-- Nutrition -->
                                <div class="col-md-3 d-flex">
                                    <div class="custom-card flex-fill d-flex flex-column">
                                        <div class="card-header-title text-danger">
                                            <!-- <h6 class="badge-danger p-4 rounded-circle">
          <i class="bi bi-heart-pulse text-danger"></i>
        </h6> -->
                                            <h6>Nutrition</h6>
                                        </div>
                                        <h3 class="card-title">Increase Fiber Intake</h3>
                                        <p class="card-text">Your LDL cholesterol is elevated.</p>
                                        <p class="suggested">Suggested Action: Add 2 servings of leafy greens daily.</p>
                                        <div class="mt-auto">
                                            <button class="btn btn-custom btn-done w-100">Mark as Done</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sleep -->
                                <div class="col-md-3 d-flex">
                                    <div class="custom-card flex-fill d-flex flex-column">
                                        <!-- <div class="card-header-title text-danger">
        <i class="bi bi-moon-stars"></i>
         Sleep
      </div> -->
                                        <h6 class=" text-danger">Sleep</h6>
                                        <span class="status-tag status-progress">In Progress</span>
                                        <h3 class="card-title">Improve Sleep Habits</h3>
                                        <p class="card-text">You have been experiencing difficulty sleeping.</p>
                                        <p class="suggested">Suggested Action: Limit screen time before bed</p>
                                        <div class="mt-auto"></div>
                                    </div>
                                </div>

                                <!-- Medication -->
                                <div class="col-md-3 d-flex">
                                    <div class="custom-card flex-fill d-flex flex-column">
                                        <!-- <div class="card-header-title text-danger">
        <i class="bi bi-capsule"></i> Medication
      </div> -->
                                        <h6 class=" text-danger">Medication</h6>
                                        <span class="status-tag status-skipped">Skipped</span>
                                        <h3 class="card-title">Improve Sleep Habits</h3>
                                        <p class="card-text">Take Iron Supplement. Your iron levels are low.</p>
                                        <p class="suggested">Suggested Action: Take 1 tablet of ferrous sulfate daily.
                                        </p>
                                        <div class="mt-auto">
                                            <button class="btn btn-custom btn-skipped w-100">Skipped</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lab Based -->
                                <div class="col-md-3 d-flex">
                                    <div class="custom-card flex-fill d-flex flex-column">
                                        <!-- <div class="card-header-title text-danger">
        <i class="bi bi-flask"></i> Lab Based
      </div> -->
                                        <h6 class=" text-danger">Lab Based</h6>
                                        <span class="status-tag status-new">New</span>
                                        <h3 class="card-title">Boost Vitamin D</h3>
                                        <p class="card-text">Your vitamin D level is below the target range.</p>
                                        <p class="suggested">Suggested Action: Get 15 minutes of sunlight each day.</p>
                                        <div class="mt-auto"></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addSuggestionModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark">Add Pregnancy Suggestion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="suggestionForm">
                                <div class="mb-3">
                                    <label class="form-check-label opacity-6 font-weight-bold">Suggestion
                                        Category</label>
                                    <select class="form-control" name="choices-department" id="choices-department-edit">
                                        <option value="">Select Category</option>
                                        <option value="baby-growth">Baby Growth</option>
                                        <option value="nutrition">Nutrition</option>
                                        <option value="lifestyle">Lifestyle</option>
                                        <option value="health-tips">Health Tips</option>
                                        <option value="warning-signs">Warning Signs/Alerts</option>
                                        <option value="general-advice">General Advice</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check-label opacity-6 font-weight-bold">Suggestion</label>
                                    <input type="text" class="form-control" placeholder="Enter Suggestion">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn bg-danger  text-white">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
        document.querySelectorAll('.btn details').forEach(btn => {
            btn.addEventListener('click', function () {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';

                setTimeout(() => {
                    this.innerHTML = originalText;
                    alert('Prescription downloaded successfully!');
                }, 1500);
            });
        });
        if (document.getElementById('choices-department-edit')) {
            var element = document.getElementById('choices-department-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample patient data
        const patients = [
            {
                id: 'PID-01',
                firstName: 'Jessica',
                lastName: 'Hudson',
                name: 'Jessica Hudson',
                email: 'jessicahudson@gmail.com',
                contact: '(809)666-4172',
                appointments: 123,
                dateOfBirth: '15/08/1985',
                gender: 'Female',
                sex: 'Female',
                maritalStatus: 'Single',
                address: '123 Main St, New York, NY, 10001, United States',
                city: 'New York',
                state: 'New York',
                country: 'United States',
                zipCode: '10001',
                height: '168 cm',
                bloodType: 'O+',
                maritalStatus: 'Single',
                weight: '132 Pounds',
                photo: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-02',
                firstName: 'Dan',
                lastName: 'Cooper',
                name: 'Dan Cooper',
                email: 'dancooper@gmail.com',
                contact: '(912)922-7783',
                appointments: 432,
                dateOfBirth: '22/03/1978',
                gender: 'Male',
                sex: 'Male',
                maritalStatus: 'Married',
                address: '456 Oak Ave, Los Angeles, CA, 90210, United States',
                city: 'Los Angeles',
                state: 'California',
                country: 'United States',
                zipCode: '90210',
                height: '182 cm',
                weight: '175 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-03',
                firstName: 'Doris',
                lastName: 'Brewer',
                name: 'Doris Brewer',
                email: 'dorisbrewer@gmail.com',
                contact: '(236)913-2980',
                appointments: 654,
                dateOfBirth: '10/11/1992',
                gender: 'Female',
                sex: 'Female',
                maritalStatus: 'Single',
                address: '789 Pine St, Chicago, IL, 60601, United States',
                city: 'Chicago',
                state: 'Illinois',
                country: 'United States',
                zipCode: '60601',
                height: '165 cm',
                bloodType: 'O+',
                maritalStatus: 'Single',
                weight: '125 Pounds',
                photo: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-04',
                firstName: 'Harry',
                lastName: 'Ellis',
                name: 'Harry Ellis',
                email: 'harryellis@gmail.com',
                contact: '(629)554-8232',
                appointments: 244,
                dateOfBirth: '05/07/1980',
                gender: 'Male',
                sex: 'Male',
                maritalStatus: 'Divorced',
                address: '321 Elm St, Houston, TX, 77001, United States',
                city: 'Houston',
                state: 'Texas',
                country: 'United States',
                zipCode: '77001',
                height: '178 cm',
                weight: '165 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-05',
                firstName: 'Lori',
                lastName: 'Ross',
                name: 'Lori Ross',
                email: 'loriross@gmail.com',
                contact: '(285)417-0724',
                appointments: 123,
                dateOfBirth: '18/12/1988',
                gender: 'Female',
                sex: 'Female',
                maritalStatus: 'Married',
                address: '654 Maple Dr, Phoenix, AZ, 85001, United States',
                city: 'Phoenix',
                state: 'Arizona',
                country: 'United States',
                zipCode: '85001',
                height: '172 cm',
                weight: '140 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1489424731084-a5d8b219a5bb?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-06',
                firstName: 'Keanu',
                lastName: 'Lawson',
                name: 'Keanu Lawson',
                email: 'keanulawson@gmail.com',
                contact: '(869)497-3005',
                appointments: 236,
                dateOfBirth: '25/04/1995',
                gender: 'Male',
                sex: 'Male',
                maritalStatus: 'Single',
                address: '987 Cedar Ln, Philadelphia, PA, 19101, United States',
                city: 'Philadelphia',
                state: 'Pennsylvania',
                country: 'United States',
                zipCode: '19101',
                height: '185 cm',
                weight: '180 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-07',
                firstName: 'Randy',
                lastName: 'Valdez',
                name: 'Randy Valdez',
                email: 'randyvaldez@gmail.com',
                contact: '(470)507-2628',
                appointments: 275,
                dateOfBirth: '14/09/1975',
                gender: 'Male',
                sex: 'Male',
                maritalStatus: 'Married',
                address: '147 Birch St, San Antonio, TX, 78201, United States',
                city: 'San Antonio',
                state: 'Texas',
                country: 'United States',
                zipCode: '78201',
                height: '176 cm',
                weight: '170 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-08',
                firstName: 'Elizabeth',
                lastName: 'Boyd',
                name: 'Elizabeth Boyd',
                email: 'elizabethboyd@gmail.com',
                contact: '(203)573-3614',
                appointments: 117,
                dateOfBirth: '30/01/1990',
                gender: 'Female',
                sex: 'Female',
                maritalStatus: 'Single',
                address: '258 Willow Way, San Diego, CA, 92101, United States',
                city: 'San Diego',
                state: 'California',
                country: 'United States',
                zipCode: '92101',
                height: '163 cm',
                weight: '128 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-09',
                firstName: 'Brandon',
                lastName: 'Murphy',
                name: 'Brandon Murphy',
                email: 'brandonmurphy@gmail.com',
                contact: '(041)259-5261',
                appointments: 253,
                dateOfBirth: '12/06/1983',
                gender: 'Male',
                sex: 'Male',
                maritalStatus: 'Divorced',
                address: '369 Spruce Ave, Dallas, TX, 75201, United States',
                city: 'Dallas',
                state: 'Texas',
                country: 'United States',
                zipCode: '75201',
                height: '180 cm',
                weight: '172 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-10',
                firstName: 'Janice',
                lastName: 'Coleman',
                name: 'Janice Coleman',
                email: 'janicecoleman@gmail.com',
                contact: '(347)759-0966',
                appointments: 321,
                dateOfBirth: '08/02/1987',
                gender: 'Female',
                sex: 'Female',
                maritalStatus: 'Married',
                address: '741 Poplar St, Jacksonville, FL, 32099, United States',
                city: 'Jacksonville',
                state: 'Florida',
                country: 'United States',
                zipCode: '32099',
                height: '170 cm',
                weight: '135 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-11',
                firstName: 'Rose',
                lastName: 'Cunningham',
                name: 'Rose Cunningham',
                email: 'rosecunningham@gmail.com',
                contact: '(083)675-7501',
                appointments: 564,
                dateOfBirth: '27/10/1979',
                gender: 'Female',
                sex: 'Female',
                maritalStatus: 'Widowed',
                address: '852 Hickory Rd, Columbus, OH, 43085, United States',
                city: 'Columbus',
                state: 'Ohio',
                country: 'United States',
                zipCode: '43085',
                height: '167 cm',
                weight: '142 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1498529605908-f357a9af7bf5?w=100&h=100&fit=crop&crop=face'
            },
            {
                id: 'PID-12',
                firstName: 'Alice',
                lastName: 'Stanley',
                name: 'Alice Stanley',
                email: 'alicestanley@gmail.com',
                contact: '(571)965-2757',
                appointments: 422,
                dateOfBirth: '16/05/1991',
                gender: 'Female',
                sex: 'Female',
                maritalStatus: 'Single',
                address: '963 Ash St, Fort Worth, TX, 76102, United States',
                city: 'Fort Worth',
                state: 'Texas',
                country: 'United States',
                zipCode: '76102',
                height: '174 cm',
                weight: '148 Pounds',
                bloodType: 'O+',
                maritalStatus: 'Single',
                photo: 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=100&h=100&fit=crop&crop=face'
            }
        ];

        let currentPage = 1;
        let entriesPerPage = 12;
        let filteredPatients = [...patients];

        function renderPatients() {
            const tbody = document.getElementById('patientTableBody');
            const start = (currentPage - 1) * entriesPerPage;
            const end = start + entriesPerPage;
            const patientsToShow = filteredPatients.slice(start, end);

            tbody.innerHTML = '';

            patientsToShow.forEach(patient => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${patient.id}</td>
                    <td>${patient.name}</td>
                    <td>${patient.email}</td>
                    <td>${patient.contact}</td>
                    <td>${patient.appointments}</td>
                    <td>
                        <button class="view-btn" onclick="showPatientDetail('${patient.id}')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            updatePaginationInfo();
            renderPagination();
        }

        function updatePaginationInfo() {
            const start = (currentPage - 1) * entriesPerPage + 1;
            const end = Math.min(currentPage * entriesPerPage, filteredPatients.length);
            const total = filteredPatients.length;

            document.getElementById('showingStart').textContent = start;
            document.getElementById('showingEnd').textContent = end;
            document.getElementById('totalEntries').textContent = total;
        }

        function renderPagination() {
            const totalPages = Math.ceil(filteredPatients.length / entriesPerPage);
            const paginationNav = document.getElementById('paginationNav');

            paginationNav.innerHTML = '';

            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1})">‹</a>`;
            paginationNav.appendChild(prevLi);

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                paginationNav.appendChild(li);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1})">›</a>`;
            paginationNav.appendChild(nextLi);
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredPatients.length / entriesPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderPatients();
            }
        }

        function showPatientDetail(patientId) {
            const patient = patients.find(p => p.id === patientId);
            if (!patient) return;

            // Update patient detail view with data
            document.getElementById('patientPhoto').src = patient.photo;
            document.getElementById('patientName').textContent = patient.name;
            document.getElementById('patientEmail').textContent = patient.email;

            // Basic Details
            document.getElementById('firstName').textContent = patient.firstName;
            document.getElementById('lastName').textContent = patient.lastName;
            document.getElementById('dateOfBirth').textContent = patient.dateOfBirth;
            document.getElementById('sex').textContent = patient.sex;
            document.getElementById('gender').textContent = patient.gender;
            document.getElementById('contactNumber').textContent = patient.contact;
            document.getElementById('email').textContent = patient.email;
            document.getElementById('maritalStatus').textContent = patient.maritalStatus;

            // Address
            document.getElementById('address').textContent = patient.address;
            document.getElementById('city').textContent = patient.city;
            document.getElementById('state').textContent = patient.state;
            document.getElementById('country').textContent = patient.country;
            document.getElementById('zipCode').textContent = patient.zipCode;

            // Medical Details
            document.getElementById('height').textContent = patient.height;
            document.getElementById('weight').textContent = patient.weight;
            document.getElementById('maritalStatus').textContent = patient.maritalStatus;
            document.getElementById('bloodType').textContent = patient.bloodType;

            // Hide patients view and show detail view
            document.getElementById('patientsView').style.display = 'none';
            document.getElementById('patientDetail').style.display = 'block';
        }

        function showPatientsView() {
            document.getElementById('patientDetail').style.display = 'none';
            document.getElementById('patientsView').style.display = 'block';
        }

        function filterPatients() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            filteredPatients = patients.filter(patient =>
                patient.name.toLowerCase().includes(searchTerm) ||
                patient.email.toLowerCase().includes(searchTerm) ||
                patient.id.toLowerCase().includes(searchTerm) ||
                patient.contact.includes(searchTerm)
            );
            currentPage = 1;
            renderPatients();
        }

        function changeEntriesPerPage() {
            entriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
            currentPage = 1;
            renderPatients();
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', filterPatients);
        document.getElementById('entriesPerPage').addEventListener('change', changeEntriesPerPage);

        // Initialize the page
        renderPatients();

        // Prevent default behavior for pagination links
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('page-link')) {
                e.preventDefault();
            }
        });
    </script>
@endsection