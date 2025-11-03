@extends('admin.layout.master')
@section('style')
    <style>
        .doctor-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #ddd;
            background-color: #fff;
        }


        .stats-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            height: 100%;
            /* make all cards same height */
            min-width: 0;
            /* allow flex children to shrink */
        }

        .stats-title {
            font-size: clamp(12px, 2vw, 16px);
            /* responsive font */
            font-weight: 600;
            margin-bottom: 4px;
            white-space: normal;
            /* allow wrapping */
            word-break: break-word;
            /* break long text */
        }

        .stats-value {
            font-size: clamp(14px, 2.5vw, 20px);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            /* wrap % if needed */
        }

        .stats-change {
            font-size: clamp(10px, 2vw, 14px);
            font-weight: 500;
        }

        .stats-icon {
            flex-shrink: 0;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: clamp(16px, 3vw, 22px);
        }

        /* Active selected card style */
        .doctor-card.active {
            border: 2px solid #D32F2F;
            background-color: #FFEFF1;
            box-shadow: 0px 4px 12px rgba(211, 47, 47, 0.2);
        }

        /* Hover effect for better UX */
        .doctor-card:hover {
            transform: scale(1.02);
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

        .bg-secondary {
            background-color: #CB0C9F !important;
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

        @media (min-width: 992px) {
            .col-lg-3 {
                flex: 0 0 auto;
                width: 20%;
            }
        }

        .badge-success {
            color: #50AA54;
            background-color: #e5f7ee;
        }

        .badge-danger {
            color: #D32F2F;
            background-color: #fbeaea;
        }

        .text-info {
            color: #007bff;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
            <div id="patientsView" class="main-container">
                <div class="patients-header">
                    <h2>Hospitals</h2>
                    <div class="d-flex align-items-center g-3">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Type here..." id="searchInput">
                        </div>
                        <div>
                            <button class="btn-primary schedule-btn ms-2"
                                onclick="window.location.href='{{ route('admin.hospital.addHospital') }}'">
                                Add Hospital
                            </button>
                        </div>
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
                    <div class="nav  flex-row nav-pills   mb-3 v-links p-1  " id="v-pills-tab" role="tablist"
                        aria-orientation="horizontal" style="background-color: #fff;">
                        <button class="nav-link h-navlinks py-2 v-links my-0  active " id="v-pills-overview-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-overview" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">
                            <a class="nav-link1 d-flex align-items-center px-0 mx-0 " href="#overview">
                                Overview
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-doctor-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-doctor" type="button" role="tab"
                            aria-controls="v-pills-doctor" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#doctor">
                                Doctors
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0  " id="v-pills-nurses-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-nurses" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">
                            <a class="nav-link1 d-flex align-items-center px-0 mx-0 " href="#nurses">
                                Nurses
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-receptionists-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-receptionists" type="button" role="tab"
                            aria-controls="v-pills-receptionists" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#receptionists">
                                Receptionists
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0  " id="v-pills-pharmacists-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-pharmacists" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">
                            <a class="nav-link1 d-flex align-items-center px-0 mx-0 " href="#pharmacists">
                                Pharmacists
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-patients-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-patients" type="button" role="tab"
                            aria-controls="v-pills-patients" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#patients">
                                Patients
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-departments-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-departments" type="button" role="tab"
                            aria-controls="v-pills-departments" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#departments">
                                Departments
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-laboratories-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-laboratories" type="button" role="tab"
                            aria-controls="v-pills-laboratories" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#laboratories">
                                Laboratories
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-appointment-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-appointment" type="button" role="tab"
                            aria-controls="v-pills-appointment" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#appointment">
                                Appointments
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-billing-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-billing" type="button" role="tab"
                            aria-controls="v-pills-billing" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#billing">
                                Billing
                            </a>
                        </button>
                    </div>
                </div>
                <div class=" ">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-overview" role="tabpanel"
                            aria-labelledby="v-pills-overview-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row g-2 mb-2">
                                        <!-- Doctors -->
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="stats-card">
                                                <div>
                                                    <p class="stats-title">Total Doctors</p>
                                                    <div class="stats-value text-dark">21 <span
                                                            class="stats-change text-success">+20%</span>
                                                    </div>
                                                </div>
                                                <div class="stats-icon bg-primary">
                                                    <i class="fa-solid fa-user-doctor"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="stats-card">
                                                <div>
                                                    <p class="stats-title">Total Patients</p>
                                                    <div class="stats-value text-dark">21 <span
                                                            class="stats-change text-success">+20%</span>
                                                    </div>
                                                </div>
                                                <div class="stats-icon bg-secondary">
                                                    <i class="fa-solid fa-user-doctor"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Nurses -->
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="stats-card mb-1">
                                                <div>
                                                    <p class="stats-title">Upcoming Appoinments</p>
                                                    <div class="stats-value  text-dark">24 <span
                                                            class="stats-change text-success">+20%</span>
                                                    </div>
                                                </div>
                                                <div class="stats-icon bg-info">
                                                    <i class="fa-solid fa-user-nurse"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Pharmacists -->
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="stats-card mb-1">
                                                <div>
                                                    <p class="stats-title">Completed Appoinments</p>
                                                    <div class="stats-value text-dark">13 <span
                                                            class="stats-change text-danger">-2%</span></div>
                                                </div>
                                                <div class="stats-icon bg-success">
                                                    <i class="fa-solid fa-pills"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Admins -->
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="stats-card mb-1">
                                                <div>
                                                    <p class="stats-title">Cancelled Appoinments</p>
                                                    <div class="stats-value text-dark">20 <span
                                                            class="stats-change text-danger">-2%</span></div>
                                                </div>
                                                <div class="stats-icon bg-danger">
                                                    <i class="fa-solid fa-user-gear"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <!-- Doctors -->
                                        <div class="col-lg-9 col-md-4 col-sm-6">
                                            <div class="card ">
                                                <h5 class="mb-0 font-weight-bolder">Calendar</h5>

                                                <div class="calendar " id="calendar">

                                                </div>
                                                <script src="../../assets/js/plugins/fullcalendar.min.js"></script>
                                                <script>
                                                    var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
                                                        contentHeight: 'auto',
                                                        initialView: "dayGridMonth",
                                                        headerToolbar: {
                                                            start: 'title', // will normally be on the left. if RTL, will be on the right
                                                            center: '',
                                                            end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
                                                        },
                                                        selectable: true,
                                                        editable: true,
                                                        initialDate: '2020-12-01',
                                                        events: [{
                                                            title: 'Call with Dave',
                                                            start: '2020-11-18',
                                                            end: '2020-11-18',
                                                            className: 'bg-gradient-danger'
                                                        },

                                                        {
                                                            title: 'Lunch meeting',
                                                            start: '2020-11-21',
                                                            end: '2020-11-22',
                                                            className: 'bg-gradient-warning'
                                                        },

                                                        {
                                                            title: 'All day conference',
                                                            start: '2020-11-29',
                                                            end: '2020-11-29',
                                                            className: 'bg-gradient-success'
                                                        },

                                                        {
                                                            title: 'Meeting with Mary',
                                                            start: '2020-12-01',
                                                            end: '2020-12-01',
                                                            className: 'bg-gradient-info'
                                                        },

                                                        {
                                                            title: 'Winter Hackaton',
                                                            start: '2020-12-03',
                                                            end: '2020-12-03',
                                                            className: 'bg-gradient-danger'
                                                        },

                                                        {
                                                            title: 'Digital event',
                                                            start: '2020-12-07',
                                                            end: '2020-12-09',
                                                            className: 'bg-gradient-warning'
                                                        },

                                                        {
                                                            title: 'Marketing event',
                                                            start: '2020-12-10',
                                                            end: '2020-12-10',
                                                            className: 'bg-primary'
                                                        },

                                                        {
                                                            title: 'Dinner with Family',
                                                            start: '2020-12-19',
                                                            end: '2020-12-19',
                                                            className: 'bg-gradient-danger'
                                                        },

                                                        {
                                                            title: 'Black Friday',
                                                            start: '2020-12-23',
                                                            end: '2020-12-23',
                                                            className: 'bg-gradient-info'
                                                        },

                                                        {
                                                            title: 'Cyber Week',
                                                            start: '2020-12-02',
                                                            end: '2020-12-02',
                                                            className: 'bg-gradient-warning'
                                                        },

                                                        ],
                                                        views: {
                                                            month: {
                                                                titleFormat: {
                                                                    month: "long",
                                                                    year: "numeric"
                                                                }
                                                            },
                                                            agendaWeek: {
                                                                titleFormat: {
                                                                    month: "long",
                                                                    year: "numeric",
                                                                    day: "numeric"
                                                                }
                                                            },
                                                            agendaDay: {
                                                                titleFormat: {
                                                                    month: "short",
                                                                    year: "numeric",
                                                                    day: "numeric"
                                                                }
                                                            }
                                                        },
                                                    });

                                                    calendar.render();

                                                    document.getElementById("calendar-loader").style.display = "none";

                                                </script>

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6" style="width: 25%;">
                                            <div class="card">
                                                <div class=" p-3 pb-0">
                                                    <h5 class="mb-0">Upcoming events</h5>
                                                </div>
                                                <div class="card-body border-radius-lg p-3">
                                                    <div class="d-flex my-4">
                                                        <div>
                                                            <div
                                                                class="icon icon-shape bg-info-soft shadow text-center border-radius-md shadow-none">
                                                                <i class="ni ni-money-coins text-lg text-info text-gradient opacity-10"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3">
                                                            <div class="numbers">
                                                                <h6 class="mb-1 text-dark text-sm">Dr.Vincent Pearson
                                                                </h6>
                                                                <div class="d-flex justify-content-between gap-5"><span
                                                                        class="text-sm">Patient:Justin Richards</span>
                                                                    <span class="text-sm">10:00
                                                                        PM</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex my-4">
                                                        <div>
                                                            <div
                                                                class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                                                                <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3">
                                                            <div class="numbers">
                                                                <div class="numbers">
                                                                    <h6 class="mb-1 text-dark text-sm">Dr.Vincent
                                                                        Pearson</h6>
                                                                    <div class="d-flex justify-content-between gap-5">
                                                                        <span class="text-sm">Patient:Justin
                                                                            Richards</span> <span class="text-sm">10:00
                                                                            PM</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex my-4">
                                                        <div>
                                                            <div
                                                                class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                                                                <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3">
                                                            <div class="numbers">
                                                                <div class="numbers">
                                                                    <h6 class="mb-1 text-dark text-sm">Dr.Vincent
                                                                        Pearson</h6>
                                                                    <div class="d-flex justify-content-between gap-5">
                                                                        <span class="text-sm">Patient:Justin
                                                                            Richards</span> <span class="text-sm">10:00
                                                                            PM</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex my-4">
                                                        <div>
                                                            <div
                                                                class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                                                                <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3">
                                                            <div class="numbers">
                                                                <div class="numbers">
                                                                    <h6 class="mb-1 text-dark text-sm">Dr.Vincent
                                                                        Pearson</h6>
                                                                    <div class="d-flex justify-content-between gap-5">
                                                                        <span class="text-sm">Patient:Justin
                                                                            Richards</span> <span class="text-sm">10:00
                                                                            PM</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex my-4">
                                                        <div>
                                                            <div
                                                                class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                                                                <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3">
                                                            <div class="numbers">
                                                                <div class="numbers">
                                                                    <h6 class="mb-1 text-dark text-sm">Dr.Vincent
                                                                        Pearson</h6>
                                                                    <div class="d-flex justify-content-between gap-5">
                                                                        <span class="text-sm">Patient:Justin
                                                                            Richards</span> <span class="text-sm">10:00
                                                                            PM</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="v-pills-doctor" role="tabpanel"
                            aria-labelledby="v-pills-doctor-tab">
                            <section class="appointments-section">
                                <div class="appointments-header">
                                    <h4>Doctor</h4>
                                    <div class="appointments-controls">
                                        <div class="search-box">
                                            <input type="text" placeholder="Type here..." class="search-input">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="appointments">
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                                <h6 class="mb-0 fw-bold text-muted">Dentist</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>

                                        <button class="btn details mt-3 "
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <h6 class="mb-0 fw-bold text-muted">Dentist</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                                <h6 class="mb-0 fw-bold text-muted">Dentist</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <h6 class="mb-0 fw-bold text-muted">Dentist</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                                <h6 class="mb-0 fw-bold text-muted">Dentist</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <h6 class="mb-0 fw-bold text-muted">Dentist</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                                <h6 class="mb-0 fw-bold text-muted">Dentist</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <h6 class="mb-0 fw-bold text-muted">Dentist</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                </div>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="v-pills-nurses" role="tabpanel"
                            aria-labelledby="v-pills-nurses-tab">
                            <section class="appointments-section">
                                <div class="appointments-header">
                                    <h4>Nurse</h4>
                                    <div class="appointments-controls">
                                        <div class="search-box">
                                            <input type="text" placeholder="Type here..." class="search-input">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                        <a href="Add-nurses.html"><button class="btn-primary schedule-btn">
                                                Add Nurse
                                            </button></a>
                                    </div>
                                </div>
                                <div class="appointments">
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0">212 Patients</h6>
                                            <p class="text-muted">1 Day Ago</p>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Nurse-detail.html'">View
                                            Details</button>
                                    </div>

                                </div>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="v-pills-receptionists" role="tabpanel"
                            aria-labelledby="v-pills-receptionists-tab">

                            <section class="appointments-section">
                                <div class="appointments-header">
                                    <h4>Receptionists</h4>
                                    <div class="appointments-controls">
                                        <div class="search-box">
                                            <input type="text" placeholder="Type here..." class="search-input">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                        <button class="btn-primary schedule-btn"
                                            onclick="window.location.href='Add-receptionists.html'">
                                            Add Receptionists
                                        </button>

                                    </div>
                                </div>
                                <div class="appointments">
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Receptionists-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Receptionists-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Receptionists-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Receptionists-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Receptionists-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Receptionists-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Receptionists-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Receptionists-detail.html'">View
                                            Details</button>
                                    </div>

                                </div>
                            </section>

                        </div>
                        <div class="tab-pane fade" id="v-pills-pharmacists" role="tabpanel"
                            aria-labelledby="v-pills-pharmacists-tab">
                            <section class="appointments-section">
                                <div class="appointments-header">
                                    <h4>Pharmacists</h4>
                                    <div class="appointments-controls">
                                        <div class="search-box">
                                            <input type="text" placeholder="Type here..." class="search-input">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                        <button class="btn-primary schedule-btn"
                                            onclick="window.location.href='AddPharmacists.html'">
                                            Add Pharmacists
                                        </button>
                                    </div>
                                </div>
                                <div class="appointments">
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Pharmacists-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Pharmacists-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Pharmacists-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Pharmacists-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Pharmacists-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Pharmacists-detail.html'">View
                                            Details</button>
                                    </div>
                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">George Lee</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    rachal@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Pharmacists-detail.html'">View
                                            Details</button>
                                    </div>

                                    <div class="card doctor-card p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                                class="rounded-md border-radius-lg me-2"
                                                style="width: 100px; height: 100px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-envelope text-danger"></i>
                                                    jane@gmail.com<br>
                                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                                </small>
                                            </div>
                                        </div>
                                        <button class="btn details mt-3"
                                            onclick="window.location.href='Pharmacists-detail.html'">View
                                            Details</button>
                                    </div>

                                </div>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="v-pills-patients" role="tabpanel"
                            aria-labelledby="v-pills-patients-tab">

                            <div class="appointments mb-0">
                                <div class="card doctor-card p-3">
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
                                    <div class="appointment-details mb-0">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Contact</span>
                                            <span class="detail-value"> (123) 456-7890</span>
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='Patient-Details.html'">View Details</button>
                                    </div>
                                </div>
                                <div class="card doctor-card p-3">
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
                                    <div class="appointment-details mb-0">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Contact</span>
                                            <span class="detail-value"> (123) 456-7890</span>
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='Patient-Details.html'">View Details</button>
                                    </div>
                                </div>
                                <div class="card doctor-card p-3">
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
                                    <div class="appointment-details mb-0">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Contact</span>
                                            <span class="detail-value"> (123) 456-7890</span>
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='Patient-Details.html'">View Details</button>
                                    </div>
                                </div>
                                <div class="card doctor-card p-3">
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
                                    <div class="appointment-details mb-0">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Contact</span>
                                            <span class="detail-value"> (123) 456-7890</span>
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='Patient-Details.html'">View Details</button>
                                    </div>
                                </div>
                                <div class="card doctor-card p-3">
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
                                    <div class="appointment-details mb-0">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Contact</span>
                                            <span class="detail-value"> (123) 456-7890</span>
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='Patient-Details.html'">View Details</button>
                                    </div>
                                </div>
                                <div class="card doctor-card p-3">
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
                                    <div class="appointment-details mb-0">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Contact</span>
                                            <span class="detail-value"> (123) 456-7890</span>
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='Patient-Details.html'">View Details</button>
                                    </div>
                                </div>
                                <div class="card doctor-card p-3">
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
                                    <div class="appointment-details mb-0">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Contact</span>
                                            <span class="detail-value"> (123) 456-7890</span>
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='Patient-Details.html'">View Details</button>
                                    </div>
                                </div>
                                <div class="card doctor-card p-3">
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
                                    <div class="appointment-details mb-0">
                                        <div class="detail-row">
                                            <span class="detail-label">Patient ID:</span>
                                            <span class="detail-value text-danger">P-001</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value">barbara@gmail.com</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Contact</span>
                                            <span class="detail-value"> (123) 456-7890</span>
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100"
                                            onclick="window.location.href='Patient-Details.html'">View Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-departments" role="tabpanel"
                            aria-labelledby="v-pills-departments-tab">
                            <section class="appointments-section mb-0 pb-0">
                                <div class="appointments-header mb-2">
                                    <h4 class="mb-0">Department</h4>
                                    <div class="appointments-controls">
                                        <div class="search-box">
                                            <input type="text" placeholder="Type here..." class="search-input">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                        <button class="btn-primary schedule-btn" data-bs-toggle="modal"
                                            data-bs-target="#adddepartmentModal">
                                            Add Department
                                        </button>
                                    </div>
                                </div>
                                <div class="detail-section">
                                    <div class="appointments mb-0">
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Urology Department</h5>
                                                <p><strong>Doctors:</strong> 15</p>
                                                <p><strong>Nurses:</strong> 25</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>

                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Urology Department</h5>
                                                <p><strong>Doctors:</strong> 15</p>
                                                <p><strong>Nurses:</strong> 25</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Urology Department</h5>
                                                <p><strong>Doctors:</strong> 15</p>
                                                <p><strong>Nurses:</strong> 25</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Urology Department</h5>
                                                <p><strong>Doctors:</strong> 15</p>
                                                <p><strong>Nurses:</strong> 25</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Urology Department</h5>
                                                <p><strong>Doctors:</strong> 15</p>
                                                <p><strong>Nurses:</strong> 25</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Urology Department</h5>
                                                <p><strong>Doctors:</strong> 15</p>
                                                <p><strong>Nurses:</strong> 25</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Urology Department</h5>
                                                <p><strong>Doctors:</strong> 15</p>
                                                <p><strong>Nurses:</strong> 25</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Urology Department</h5>
                                                <p><strong>Doctors:</strong> 15</p>
                                                <p><strong>Nurses:</strong> 25</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                        <div class="tab-pane fade" id="v-pills-laboratories" role="tabpanel"
                            aria-labelledby="v-pills-laboratories-tab">
                            <section class="appointments-section mb-0 pb-0">
                                <div class="appointments-header mb-2">
                                    <h4 class="mb-0">Laboratories</h4>
                                    <div class="appointments-controls">
                                        <div class="search-box">
                                            <input type="text" placeholder="Type here..." class="search-input">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                        <button class="btn-primary schedule-btn"
                                            onclick="window.location.href='Add-laboratory.html'">
                                            Add Laboratory
                                        </button>
                                    </div>
                                </div>
                                <div class="detail-section">
                                    <div class="appointments mb-0">
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/Laboratories.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Alice Hughes</h5>
                                                <p><strong>Patient ID:</strong> 15</p>
                                                <p><strong>Gender:</strong> Female</p>
                                                <p><strong>Report Name:</strong> Blood Test</p>
                                                <p><strong>Date:</strong> 2023-10-01</p>
                                                <p><strong>Time:</strong> 10:00 AM</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/Laboratories.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Alice Hughes</h5>
                                                <p><strong>Patient ID:</strong> 15</p>
                                                <p><strong>Gender:</strong> Female</p>
                                                <p><strong>Report Name:</strong> Blood Test</p>
                                                <p><strong>Date:</strong> 2023-10-01</p>
                                                <p><strong>Time:</strong> 10:00 AM</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/Laboratories.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Alice Hughes</h5>
                                                <p><strong>Patient ID:</strong> 15</p>
                                                <p><strong>Gender:</strong> Female</p>
                                                <p><strong>Report Name:</strong> Blood Test</p>
                                                <p><strong>Date:</strong> 2023-10-01</p>
                                                <p><strong>Time:</strong> 10:00 AM</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/Laboratories.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Alice Hughes</h5>
                                                <p><strong>Patient ID:</strong> 15</p>
                                                <p><strong>Gender:</strong> Female</p>
                                                <p><strong>Report Name:</strong> Blood Test</p>
                                                <p><strong>Date:</strong> 2023-10-01</p>
                                                <p><strong>Time:</strong> 10:00 AM</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/Laboratories.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Alice Hughes</h5>
                                                <p><strong>Patient ID:</strong> 15</p>
                                                <p><strong>Gender:</strong> Female</p>
                                                <p><strong>Report Name:</strong> Blood Test</p>
                                                <p><strong>Date:</strong> 2023-10-01</p>
                                                <p><strong>Time:</strong> 10:00 AM</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/Laboratories.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Alice Hughes</h5>
                                                <p><strong>Patient ID:</strong> 15</p>
                                                <p><strong>Gender:</strong> Female</p>
                                                <p><strong>Report Name:</strong> Blood Test</p>
                                                <p><strong>Date:</strong> 2023-10-01</p>
                                                <p><strong>Time:</strong> 10:00 AM</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/Laboratories.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Alice Hughes</h5>
                                                <p><strong>Patient ID:</strong> 15</p>
                                                <p><strong>Gender:</strong> Female</p>
                                                <p><strong>Report Name:</strong> Blood Test</p>
                                                <p><strong>Date:</strong> 2023-10-01</p>
                                                <p><strong>Time:</strong> 10:00 AM</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="dept-card d-flex gap-3 align-items-start">
                                            <img src="{{ asset('admin/assets/img/Laboratories.svg') }}" />
                                            <div class="dept-info">
                                                <h5 class="font-weight-bolder">Alice Hughes</h5>
                                                <p><strong>Patient ID:</strong> 15</p>
                                                <p><strong>Gender:</strong> Female</p>
                                                <p><strong>Report Name:</strong> Blood Test</p>
                                                <p><strong>Date:</strong> 2023-10-01</p>
                                                <p><strong>Time:</strong> 10:00 AM</p>
                                            </div>
                                            <button class="menu-btn" id="menu-btn">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>

                                            <!-- Popover Menu -->
                                            <div class="popover-menu" id="popoverMenu">
                                                <button class="edit-btn">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="v-pills-appointment" role="tabpanel"
                            aria-labelledby="v-pills-appointment-tab">
                            <section class="appointments-section mb-0 pb-0">
                                <div class="appointments-header mb-2">
                                    <h4 class="mb-0">Appointments</h4>
                                    <div class="appointments-controls">
                                        <div class="search-box">
                                            <input type="text" placeholder="Type here..." class="search-input">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                        <button class="btn-primary schedule-btn" data-bs-toggle="modal"
                                            data-bs-target="#confirmedModal">
                                            Schedule Appointment
                                        </button>
                                    </div>
                                </div>

                                <div class="recent-requests-section mb-1">
                                    <h3 class="section-title text-dark mb-0">Recent Requests</h3>
                                    <div class="carousel-container">
                                        <button class="carousel-btn prev-btn" id="prevCarousel">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <div class="carousel-wrapper">
                                            <div class="carousel-track" id="carouselTrack">
                                                <!-- Appointment cards will be dynamically inserted here -->
                                            </div>
                                        </div>
                                        <button class="carousel-btn next-btn" id="nextCarousel">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Appointment Statistics -->

                            </section>
                            <h4 class="my-1">All Appointments</h4>
                            <div class="appointments mb-0">
                                <div class="card">
                                    <div class="text-info font-weight-bold incoming cursor-pointer">Incoming</div>
                                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                                    <div class="user-profile-section">
                                        <div class="profile-image-container">
                                            <img src="{{ asset('admin/assets/img/Circle-1.png') }}" alt="Justin Carrol"
                                                class="profile-image">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div class="user-name">Justin Carrol</div>
                                    </div>
                                    <div class="appointment-details mb-0">
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
                                    <div class="btns mt-0">
                                        <button class="btn details"
                                            onclick="window.location.href='appointment-detail.html'">View
                                            Details</button>
                                        <button class="btn reschedule " data-bs-toggle="modal"
                                            data-bs-target="#rescheduleDoctorModal">Reschedule</button>
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
                                    <div class="appointment-details mb-0">
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
                                    <div class="btns mt-0">
                                        <button class="btn details"
                                            onclick="window.location.href='appointment-detail.html'">View
                                            Details</button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="text-info font-weight-bold incoming cursor-pointer">Incoming</div>
                                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                                    <div class="user-profile-section">
                                        <div class="profile-image-container">
                                            <img src="{{ asset('admin/assets/img/Circle-2.png') }}" alt="Justin Carrol"
                                                class="profile-image">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div class="user-name">Justin Carrol</div>
                                    </div>
                                    <div class="appointment-details mb-0">
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
                                    <div class="btns mt-0">
                                        <button class="btn details"
                                            onclick="window.location.href='appointment-detail.html'">View
                                            Details</button>
                                        <button class="btn reschedule " data-bs-toggle="modal"
                                            data-bs-target="#rescheduleDoctorModal">Reschedule</button>
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
                                    <div class="appointment-details mb-0">
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
                                    <div class="btns mt-0">
                                        <button class="btn details w-100">View Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-billing" role="tabpanel"
                            aria-labelledby="v-pills-billing-tab">
                            <div class="">
                                <div class="patients-header">
                                    <h2>Billing</h2>
                                    <div class="d-flex align-items-center g-3">
                                        <div class="search-box">
                                            <i class="fas fa-search"></i>
                                            <input type="text" placeholder="Type here..." id="searchInput">
                                        </div>
                                        <div>
                                            <button class="btn details  ms-2" onclick="window.location.href='#'">
                                                Export CSV
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn-primary schedule-btn ms-2" data-bs-toggle="modal"
                                                data-bs-target="#addBillingModal">
                                                Generate Invoice
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" style="height: 400%;">
                                    <table class="table table-flush " id="datatable-basic" style="height: 400%;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Invoice #</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Invoice Date</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Total Amount</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Status</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-sm font-weight-normal">#INV01</td>
                                                <td class="text-sm font-weight-normal">01/06/2025</td>
                                                <td class="text-sm font-weight-normal">northbridgehospital@gmail.com
                                                </td>
                                                <td class="text-sm font-weight-normal">$100</td>
                                                <td class="text-sm font-weight-normal"> <span
                                                        class="badge badge-success w-50">Paid</span>

                                                </td>
                                                <td class="text-sm font-weight-normal">
                                                    <i class="fa-solid fa-eye text-info"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">#INV02</td>
                                                <td class="text-sm font-weight-normal">01/06/2025</td>
                                                <td class="text-sm font-weight-normal">northbridgehospital@gmail.com
                                                </td>
                                                <td class="text-sm font-weight-normal">$100</td>
                                                <td class="text-sm font-weight-normal">
                                                    <span class="badge badge-danger w-50">Danger</span>
                                                </td>
                                                <td class="text-sm font-weight-normal">
                                                    <i class="fa-solid fa-eye text-info"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">#INV03</td>
                                                <td class="text-sm font-weight-normal">01/06/2025</td>
                                                <td class="text-sm font-weight-normal">northbridgehospital@gmail.com
                                                </td>
                                                <td class="text-sm font-weight-normal">$100</td>
                                                <td class="text-sm font-weight-normal"> <span
                                                        class="badge badge-success w-50">Paid</span>

                                                </td>
                                                <td class="text-sm font-weight-normal">
                                                    <i class="fa-solid fa-eye text-info"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">#INV04</td>
                                                <td class="text-sm font-weight-normal">01/06/2025</td>
                                                <td class="text-sm font-weight-normal">northbridgehospital@gmail.com
                                                </td>
                                                <td class="text-sm font-weight-normal">$100</td>
                                                <td class="text-sm font-weight-normal">
                                                    <span class="badge badge-danger w-50">Danger</span>
                                                </td>
                                                <td class="text-sm font-weight-normal">
                                                    <i class="fa-solid fa-eye text-info"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">#INV05</td>
                                                <td class="text-sm font-weight-normal">01/06/2025</td>
                                                <td class="text-sm font-weight-normal">northbridgehospital@gmail.com
                                                </td>
                                                <td class="text-sm font-weight-normal">$100</td>
                                                <td class="text-sm font-weight-normal"> <span
                                                        class="badge badge-success w-50">Paid</span>

                                                </td>
                                                <td class="text-sm font-weight-normal">
                                                    <i class="fa-solid fa-eye text-info"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">#INV06</td>
                                                <td class="text-sm font-weight-normal">01/06/2025</td>
                                                <td class="text-sm font-weight-normal">northbridgehospital@gmail.com
                                                </td>
                                                <td class="text-sm font-weight-normal">$100</td>
                                                <td class="text-sm font-weight-normal">
                                                    <span class="badge badge-danger w-50">Danger</span>
                                                </td>
                                                <td class="text-sm font-weight-normal">
                                                    <i class="fa-solid fa-eye text-info"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
            <div class="modal fade" id="adddepartmentModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Add Department</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <label class="form-check-label font-weight-bold">Department Name </label>
                            <input type="text" class="form-control mt-2" placeholder="Department Name"
                                aria-label="Department Name">
                            <small id="errorMsg" class="text-danger d-none">Please select a doctor.</small>
                        </div>

                        <div class="d-flex justify-content-end p-3">
                            <button type="button" id="doneBtn" class="btn bg-danger text-white">Add</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal " id="labreportModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Add Laboratory</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label"> Patient Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Patient Name">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label"> User ID</label>
                                    <input type="text" class="form-control" placeholder="Enter User ID">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Report Name</label>
                                    <select class="form-control" name="choices-report" id="choices-report-edit">
                                        <option value="">Select Report</option>
                                        <option value="Blood Test">Blood Test</option>
                                        <option value="X-Ray">X-Ray</option>
                                        <option value="MRI Scan">MRI Scan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control" placeholder="Enter Date">
                                </div>

                                <!-- DOB -->
                                <div class="col-md-6">
                                    <label class="form-label">Time</label>
                                    <input type="text" class="form-control" placeholder="Enter Time">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end p-3">
                            <button type="button" class="btn bg-danger text-white">Add</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal fade" id="addBillingModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark">Generate Invoice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="suggestionForm">
                                <div class="mb-3">
                                    <label class="form-check-label opacity-6 font-weight-bold">Appointment Id</label>
                                    <select class="form-control" name="choices-billing" id="choices-billing-edit">
                                        <option value="">Select Appointment</option>
                                        <option value="baby-growth">Appointment 001</option>
                                        <option value="nutrition">Appointment 002</option>
                                        <option value="lifestyle">Appointment 003</option>
                                        <option value="health-tips">Appointment 004</option>
                                        <option value="warning-signs">Appointment 005</option>

                                    </select>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn bg-danger  text-white">Generate</button>
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
        if (document.getElementById('choices-billing-edit')) {
            var element = document.getElementById('choices-billing-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };

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
                photo: 'https://images.unsplash.com/photo-1494790108755-2616b612b27c?w=100&h=100&fit=crop&crop=face'
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
                        <div class="d-flex align-items-center g-3">
                        <button class="view-btn text-danger" >
                           <i class="fa-solid fa-trash-can"></i>
                        </button>
                         <button class="view-btn text-success" >
                          <i class="fa-solid fa-pencil"></i>
                        </button>
                         <button class="view-btn"  onclick="window.location.href='{{ route('admin.hospital.hospitalDetail') }}'" >
                            
                            <i class="fas fa-eye"></i>
                        </button>
                        </div>
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
    <script>
        // Handle popovers for ALL cards
        const menuButtons = document.querySelectorAll(".menu-btn");
        const allPopovers = document.querySelectorAll(".popover-menu");

        menuButtons.forEach((btn, index) => {
            btn.addEventListener("click", (e) => {
                e.stopPropagation();

                // Close all popovers first
                allPopovers.forEach(p => p.classList.remove("active"));

                // Open only the clicked one
                allPopovers[index].classList.toggle("active");
            });
        });

        // Close popovers when clicking outside
        document.addEventListener("click", () => {
            allPopovers.forEach(p => p.classList.remove("active"));
        });
    </script>
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
            searchable: false,
            fixedHeight: true
        });

        document.getElementById("doneBtn").addEventListener("click", function () {
            let doctor = document.getElementById("doctorSelect").value;
            let errorMsg = document.getElementById("errorMsg");

            if (doctor === "") {
                errorMsg.classList.remove("d-none"); // show error
            } else {
                errorMsg.classList.add("d-none"); // hide error
                // Close current modal
                let assignModal = bootstrap.Modal.getInstance(document.getElementById("assignDoctorModal"));
                assignModal.hide();

                // Open success modal
                let successModal = new bootstrap.Modal(document.getElementById("successModal"));
                successModal.show();
            }
        });
        if (document.querySelector('.datetimepicker')) {
            flatpickr('.datetimepicker', {
                allowInput: true
            }); // flatpickr
        }
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
        // Notification system for standalone appointments page
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                z-index: 9999;
                animation: slideInRight 0.3s ease-out;
            `;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease-in';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Create mock dashboard object for compatibility
        const mockDashboard = {
            showNotification: showNotification
        };

        // Initialize appointments when page loads
        document.addEventListener('DOMContentLoaded', () => {
            const appointmentsManager = new AppointmentsManager(mockDashboard);
            appointmentsManager.render();

            // Update statistics
            const updateStats = () => {
                document.getElementById('pendingRequests').textContent = appointmentsManager.appointments.length;
                document.getElementById('totalAppointments').textContent = appointmentsManager.appointments.length + 6; // Including completed ones
            };

            updateStats();

            // Update stats when appointments change
            const originalAccept = appointmentsManager.acceptAppointment.bind(appointmentsManager);
            const originalReject = appointmentsManager.rejectAppointment.bind(appointmentsManager);

            appointmentsManager.acceptAppointment = function (id) {
                originalAccept(id);
                updateStats();
            };

            appointmentsManager.rejectAppointment = function (id) {
                originalReject(id);
                updateStats();
            };
        });
    </script>
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
@endsection