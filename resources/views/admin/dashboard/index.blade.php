@extends('admin.layout.master')
@section('style')
    
@endsection
@section('content')
    <div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="row g-2 mb-2">
                <!-- Doctors -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card">
                        <div>
                            <p class="stats-title mb-0">Doctors</p>
                            <div class="stats-value text-dark">21 <span class="stats-change text-success">+20%</span>
                            </div>
                        </div>
                        <div class="stats-icon">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                    </div>
                </div>

                <!-- Nurses -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title mb-0">Nurses</p>
                            <div class="stats-value  text-dark">24 <span class="stats-change text-success">+20%</span>
                            </div>
                        </div>
                        <div class="stats-icon">
                            <i class="fa-solid fa-user-nurse"></i>
                        </div>
                    </div>
                </div>

                <!-- Pharmacists -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title mb-0">Pharmacists</p>
                            <div class="stats-value text-dark">13 <span class="stats-change text-danger">-2%</span>
                            </div>
                        </div>
                        <div class="stats-icon">
                            <i class="fa-solid fa-pills"></i>
                        </div>
                    </div>
                </div>

                <!-- Admins -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title mb-0">Admins</p>
                            <div class="stats-value text-dark">20 <span class="stats-change text-danger">-2%</span>
                            </div>
                        </div>
                        <div class="stats-icon">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                    </div>
                </div>

                <!-- Receptionists -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title mb-0">Receptionists</p>
                            <div class="stats-value text-dark">07 <span class="stats-change text-success">+20%</span>
                            </div>
                        </div>
                        <div class="stats-icon">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                    </div>
                </div>

                <!-- Hospital -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title mb-0">Hospital</p>
                            <div class="stats-value text-dark">10 <span class="stats-change text-success">+20%</span>
                            </div>
                        </div>
                        <div class="stats-icon">
                            <i class="fa-solid fa-hospital"></i>
                        </div>
                    </div>
                </div>

                <!-- Patients -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title mb-0">Patients</p>
                            <div class="stats-value text-dark">251 <span class="stats-change text-danger">-2%</span>
                            </div>
                        </div>
                        <div class="stats-icon">
                            <i class="fa-solid fa-bed-pulse"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <!-- Doctors -->
                <div class="col-lg-9 col-md-4 col-sm-6">
                    <div class="card card-calendar">

                        <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pb-0">
                            <h6 class="mb-0">Upcoming events</h6>

                        </div>
                        <div class="card-body border-radius-lg p-3">
                            <div class="d-flex">
                                <div>
                                    <div
                                        class="icon icon-shape bg-info-soft shadow text-center border-radius-md shadow-none">
                                        <i class="ni ni-money-coins text-lg text-info text-gradient opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="numbers">
                                        <h6 class="mb-1 text-dark text-sm">Dr.Vincent Pearson</h6>
                                        <div class="d-flex justify-content-between gap-5"><span
                                                class="text-sm">Patient:Justin Richards</span> <span
                                                class="text-sm">10:00
                                                PM</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
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
                                            <h6 class="mb-1 text-dark text-sm">Dr.Vincent Pearson</h6>
                                            <div class="d-flex justify-content-between gap-5"><span
                                                    class="text-sm">Patient:Justin Richards</span> <span
                                                    class="text-sm">10:00
                                                    PM</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
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
                                            <h6 class="mb-1 text-dark text-sm">Dr.Vincent Pearson</h6>
                                            <div class="d-flex justify-content-between gap-5"><span
                                                    class="text-sm">Patient:Justin Richards</span> <span
                                                    class="text-sm">10:00
                                                    PM</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
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
                                            <h6 class="mb-1 text-dark text-sm">Dr.Vincent Pearson</h6>
                                            <div class="d-flex justify-content-between gap-5"><span
                                                    class="text-sm">Patient:Justin Richards</span> <span
                                                    class="text-sm">10:00
                                                    PM</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
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
                                            <h6 class="mb-1 text-dark text-sm">Dr.Vincent Pearson</h6>
                                            <div class="d-flex justify-content-between gap-5"><span
                                                    class="text-sm">Patient:Justin Richards</span> <span
                                                    class="text-sm">10:00
                                                    PM</span></div>
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
@endsection
@section('script')
    
@endsection