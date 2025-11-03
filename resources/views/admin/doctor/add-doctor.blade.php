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
                <div class="d-flex align-items-center mb-4">
                    <button class="btn btn-link text-dark p-0 me-2"><a href="Doctors.html">
                            &larr;
                        </a></button>
                    <h4 class="fw-bold mb-0">Add Doctor</h4>
                </div>

                <!-- Basic Details -->
                <h6 class="section-title">Basic Details</h6>
                <form>
                    <div class="row g-3">
                        <!-- Patient Name -->
                        <div class="col-md-6">
                            <label class="form-label"> Name</label>
                            <input type="text" class="form-control" placeholder="Enter Patient Name">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number">
                        </div>

                        <!-- DOB -->
                        <div class="col-md-6">
                            <label class="form-label">Date Of Birth</label>
                            <input type="date" class="form-control">
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select class="form-control" name="choices-gender" id="choices-gender-edit">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hospital</label>
                            <select class="form-control" name="choices-hospital" id="choices-hospital-edit">
                                <option value="">Select Hospital</option>
                                <option value="Northbridge Medical Center">Northbridge Medical Center</option>
                                <option value="Starlight Health Hospital">Starlight Health Hospital</option>
                                <option value="Riverview General Hospital">Riverview General Hospital</option>
                                <option value="Evergreen Medical Institute">Evergreen Medical Institute</option>
                                <option value="Lakeside Community Hospital">Lakeside Community Hospital</option>
                                <option value="UnityCare Health">UnityCare Health</option>
                                <option value="SummitView Hospital">SummitView Hospital</option>

                            </select>
                        </div>

                        <!-- City -->
                        <div class="col-md-6">
                            <label class="form-label">Department</label>
                            <select class="form-control" name="choices-department" id="choices-department-edit">
                                <option value="">Select Department</option>
                                <option value="Cardiology">Cardiology</option>
                                <option value="Neurology">Neurology</option>
                                <option value="Oncology">Oncology</option>
                                <option value="Orthopedics">Orthopedics</option>
                                <option value="Gastroenterology">Gastroenterology</option>
                                <option value="Pulmonology">Pulmonology</option>
                                <option value="Urology">Urology</option>
                                <option value="Endocrinology">Endocrinology</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Speciality Hours</label>
                            <input type="text" class="form-control" placeholder="Enter speciality ">
                        </div>
                        <!-- Appointment Date -->
                        <div class="col-md-6">
                            <label class="form-label">Working Hours (From)</label>
                            <input type="text" class="form-control" placeholder="Enter working hours">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Working Hours (To)</label>
                            <input type="text" class="form-control" placeholder="Enter working hours">
                        </div>

                    </div>

                    <!-- Divider -->
                    <div class="divider"></div>

                    <!-- Address Details -->
                    <h6 class="section-title text-dark">Address Details</h6>
                    <div class="row g-3">
                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label">Address 1</label>
                            <input type="text" class="form-control" placeholder="Enter Address">
                        </div>

                        <!-- City -->
                        <div class="col-md-4">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" placeholder="Enter City">
                        </div>

                        <!-- State -->
                        <div class="col-md-4">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" placeholder="Enter State">
                        </div>

                        <!-- Zipcode -->
                        <div class="col-md-4">
                            <label class="form-label">Zipcode</label>
                            <input type="text" class="form-control" placeholder="Enter Zipcode">
                        </div>
                    </div>
                    <div>

                        <!-- Qualification Section -->
                        <div class="divider"></div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-semibold">Qualification</h5>
                            <span class="add-btn"><i class="fa-solid fa-plus"></i> Add</span>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Degree</label>
                                <input type="text" class="form-control" placeholder="Enter Degree Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Institute</label>
                                <input type="text" class="form-control" placeholder="Enter Institute">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Total Marks / CGPA</label>
                                <input type="text" class="form-control" placeholder="04/01/2014">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Achieved Marks / CGPA</label>
                                <input type="text" class="form-control" placeholder="04/01/2014">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Attachment</label>
                                <div class="file-upload">
                                    <label class="choose-file-btn">
                                        <i class="fa-solid fa-cloud-arrow-up"></i> Choose File
                                        <input type="file" hidden>
                                    </label>
                                    <div class="file-preview">
                                        <i class="fa-solid fa-file-pdf"></i> Attachment.pdf
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Role & Permissions -->


                    </div>

                    <!-- Submit -->
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-danger px-4 py-2">Add</button>
                    </div>
                </form>
            </div>


        </div>
@endsection
@section('script')
        <script>
        if (document.getElementById('choices-doctor-edit')) {
            var element = document.getElementById('choices-doctor-edit');
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
        if (document.getElementById('choices-department-edit')) {
            var element = document.getElementById('choices-department-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
    </script>

    <script>
        if (document.getElementById('choices-gender-edit')) {
            var element = document.getElementById('choices-gender-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
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