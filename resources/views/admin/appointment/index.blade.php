@extends('admin.layout.master')
@section('style')
    
@endsection
@section('content')
<div class="container-fluid py-4">
            <section class="appointments-section mb-0 pb-0">
                <div class="appointments-header mb-2">
                    <h4 class="mb-0">Appointments</h4>
                    <div class="appointments-controls">
                        <div class="search-box">
                            <input type="text" placeholder="Type here..." class="search-input">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                        <button class="btn-primary schedule-btn" data-bs-toggle="modal"
                            data-bs-target="#rescheduleDoctorModal">
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
                            <img src="{{ asset('admin/assets/img/Circle-1.png') }}" alt="Justin Carrol" class="profile-image">
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
                        <button class="btn details" onclick="window.location.href='{{ route('admin.appointment.viewDetail') }}'">View Details</button>
                        <button class="btn reschedule "
                            data-bs-toggle="modal"
                            data-bs-target="#rescheduleDoctorModal">Reschedule</button>
                    </div>
                </div>
                <div class="card">
                    <div class="text-success font-weight-bold completed cursor-pointer">Completed</div>
                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                    <div class="user-profile-section">
                        <div class="profile-image-container">
                            <img src="{{ asset('admin/assets/img/Circle-5.png') }}" alt="Justin Carrol" class="profile-image">
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
                        <button class="btn details w-100" onclick="window.location.href={{ route('admin.appointment.viewDetail') }}">View Details</button>
                    </div>
                </div>
                <div class="card">
                    <div class="text-info font-weight-bold incoming cursor-pointer">Incoming</div>
                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                    <div class="user-profile-section">
                        <div class="profile-image-container">
                            <img src="{{ asset('admin/assets/img/Circle-2.png') }}" alt="Justin Carrol" class="profile-image">
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
                        <button class="btn details" onclick="window.location.href='{{ route('admin.appointment.viewDetail') }}'">View Details</button>
                        <button class="btn reschedule "
                            data-bs-toggle="modal"
                            data-bs-target="#rescheduleDoctorModal">Reschedule</button>
                    </div>
                </div>
                <div class="card">
                    <div class="text-success font-weight-bold completed">Completed</div>
                    <div class="options"> <i class="fas fa-ellipsis-h"></i></div>
                    <div class="user-profile-section">
                        <div class="profile-image-container">
                            <img src="{{ asset('admin/assets/img/Circle-3.png') }}" alt="Justin Carrol" class="profile-image">
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
            
            <div class="modal fade" id="assignDoctorModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Assign Doctor</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <label class="form-check-label font-weight-bold">Doctor <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" id="doctorSelect">
                                <option value="">Select Doctor</option>
                                <option value="Anthony Ellis">Anthony Ellis</option>
                                <option value="Danielle Gibson">Danielle Gibson</option>
                                <option value="Tom Fuller">Tom Fuller</option>
                                <option value="Dorothy Andrews">Dorothy Andrews</option>
                                <option value="Kelly Gray">Kelly Gray</option>
                            </select>
                            <small id="errorMsg" class="text-danger d-none">Please select a doctor.</small>
                        </div>

                        <div class="d-flex justify-content-end p-3">
                            <button type="button" id="doneBtn" class="btn bg-danger text-white">Done</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="rescheduleDoctorModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Reschedule Appointment</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <p>Please select the new date for your appointment.</p>
                            <label class="form-check-label font-weight-bold">Date </label>
                                         <input class="form-control datetimepicker" type="text" placeholder="Enter date" data-input>
                            <small id="errorMsg" class="text-danger d-none">Please select a doctor.</small>
                        </div>

                        <div class="d-flex justify-content-end p-3">
                            <button type="button" id="doneBtn" class="btn bg-danger text-white" data-bs-dismiss="modal"
                                aria-label="Close" data-bs-toggle="modal"
                                data-bs-target="#confirmedModal">Next</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="visitDoctorModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content"> 

                        <div class="modal-header">
                            <h5 class="modal-title">The visit type for this appointment is video call</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <label class="form-check-label font-weight-bold">Insert Link <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control mt-2" placeholder="Link" aria-label="Link">
                            <small id="errorMsg" class="text-danger d-none">Please select a doctor.</small>
                        </div>

                        <div class="d-flex justify-content-end p-3">
                            <button type="button" id="doneBtn" class="btn bg-danger text-white">Next</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="videocallModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">The visit type for this appointment is video call</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <label class="form-check-label font-weight-bold">Insert Link <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control mt-2" placeholder="Link" aria-label="Link">
                            <small id="errorMsg" class="text-danger d-none">Please select a doctor.</small>
                        </div>

                        <div class="d-flex justify-content-end p-3">
                            <button type="button" id="doneBtn" class="btn bg-danger text-white">Done</button>
                        </div>

                    </div>
                </div>
            </div>
        
            <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center p-3">
                        <div class="modal-body p-3">
                            <div class="mb-3">
                                <img src="{{ asset('admin/assets/img/Successmark.svg') }}" alt="Success"
                                    style="width: 100px; height: 100px;">
                            </div>
                            <h5 class="mb-2">Appointment Booked</h5>
                            <p>Your appointment was successfully scheduled.</p>
                            <button type="button" class="btn bg-danger text-white"
                                data-bs-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center p-3">
                        <div class="modal-body p-3">
                            <div class="mb-3">
                                <img src="./assets/img/Successmark.svg" alt="Success"
                                    style="width: 100px; height: 100px;">
                            </div>
                            <h5 class="mb-2">Appointment Confirmed!</h5>
                            <p>Your appointment has been successfully booked. You’ll receive a confirmation email
                                shortly.</p>
                            <button type="button" class="btn bg-danger text-white"
                                data-bs-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="modal fade" id="confirmedModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center p-4">

                        <!-- Success Checkmark -->
                        <div class="mb-3">
                            <img src="{{ asset('admin/assets/img/Successmark.svg') }}" alt="Success" style="width: 80px; height: 80px;">
                        </div>

                        <!-- Title & Subtitle -->
                        <h4 class="fw-bold mb-2">Appointment Rescheduled!</h4>
                        <p class="text-muted">Your appointment has been successfully rescheduled.</p>

                        <!-- Doctor Info Card -->
                        <div class="border rounded p-3 text-start mb-3" style="background: #FCF3F3;">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('admin/assets/img/Circle-1.png') }}" alt="Doctor" class="rounded-circle me-2"
                                    style="width: 100px; height: 100px;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                    <small class="text-muted">
                                        <i class="fa-solid fa-user-doctor text-danger"></i> Cardiologist <br>
                                        <i class="fa-solid fa-hospital text-danger"></i> City Hospital
                                    </small>
                                </div>
                            </div>

                            <hr>
                            <div class="appointment-details mb-0">
                                <div class="detail-row">
                                    <span class="detail-label">Date:</span>
                                    <span class="detail-value text-dark">June 26, 2025 – 11:00 AM</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Time:</span>
                                    <span class="detail-value text-dark">11:00 AM – 11:30 (30 Minutes)</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Visit Type:</span>
                                    <span class="detail-value text-dark">In Person</span>
                                </div>

                            </div>

                        </div>

                        <!-- Continue Button -->
                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>

        </div>
@endsection
@section('script')
    
@endsection