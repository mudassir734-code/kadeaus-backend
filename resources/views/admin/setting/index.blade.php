@extends('admin.layout.master')
@section('style')
    <style>
        .fc-event {
            border-radius: 30px !important;
            /* Rounded corners */
            padding: 5px 10px;
            /* Add some padding */
            font-size: 14px;
            /* Adjust font size */
            color: white;
            /* Text color */
            border: none;
            /* Remove borders */
        }

        .nav.nav-pills {
            background: #f4f4f5;
            border-radius: 0.75rem;
            position: relative;
            width: fit-content;
        }

        .active-circle {
            position: absolute;
            margin-left: 45px;
        }

        .nav.nav-pills .nav-link.active {
            animation: 0.2s ease;
            border: 2px solid #D32F2F;
            color: #fff;
            background: transparent linear-gradient(180deg, #D32F2F 0%, #D32F2F 100%) 0% 0% no-repeat padding-box;
        }

        .nav.nav-pills .nav-link.active .nav-link1 {
            font-weight: 500;
            color: #fff;
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 1,
                'wght' 700,
                'GRAD' 0,
                'opsz' 24
        }


        /* Remove default card styles */
        .banner-container {
            position: relative;
            border-radius: 21px;
            overflow: hidden;
            height: 200px;
            /* Default height */
        }

        /* Background image */
        .banner-background {
            object-fit: cover;
            height: 100%;
        }

        /* Text and content styling */
        .banner-content {
            background: transparent;

            height: 100%;
            padding: 30px;
            z-index: 1;
        }

        .banner-content h4 {
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .banner-container {
                height: 150px;
                /* Adjust height for smaller screens */
            }

            .banner-content h4 {
                font-size: 18px;
                /* Adjust font size for smaller screens */
            }
        }

        .avatar-edit {
            position: relative;
            right: 0;
            bottom: 0;
            /* background-color: #fff; */
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            z-index: 1;
            align-items: center;
            justify-content: center;
            /* border: 2px solid #ddd; */
            cursor: pointer;
        }

        /* .avatar-profile {
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            border-radius: 50rem;
            height: 90px;
            width: 90px;
            transition: all .2s ease-in-out;
        }

        .avatar-edit input {
            display: none;
        }

        .avatar-edit label {
            display: inline-block;
            width: 150%;
            height: 150%;
            margin-left: 120px;
            margin-top: -9px;
            position: absolute;
            z-index: 1;
            cursor: pointer;
            background: url(../assets/img/camera\ copy.png) center center no-repeat;
            background-size: 150%;
        } */
        .avatar-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #ddd;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-edit input {
            display: none;
        }

        .avatar-edit label {
            cursor: pointer;
            display: inline-block;
            padding: 1px 1px;
            margin-left: 50px;
            margin-bottom: 50px;
            /* background-color: white; */
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }

        .position-relative {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-3">

            <div class="row mx-2" style="border-radius: 10%;box-shadow:none; ">
                <div class="col-md-7 ">
                    <div class="nav  flex-row nav-pills   mb-3 v-links p-1  " id="v-pills-tab" role="tablist"
                        aria-orientation="horizontal" style="background-color: #fff;">
                        <button class="nav-link h-navlinks py-2 v-links my-0 active " id="v-pills-home-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">
                            <a class="nav-link1 d-flex align-items-center px-0 mx-0 ">
                                Update Profile
                            </a>
                        </button>
                        <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-Vaccine-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-Vaccine" type="button" role="tab"
                            aria-controls="v-pills-Vaccine" aria-selected="false">
                            <a class="nav-link1  d-flex align-items-center px-0 mx-0">
                                Update Password
                            </a>
                        </button>


                    </div>
                </div>
                <div class="col-md-12 m-auto ">
                    <!-- Image container -->

                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="p-3 card col-md-10 border-radius-lg"
                                style="border: 1px solid rgb(208, 208, 208);">
                                <div class="d-flex gap-3">
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img src="{{ asset('admin/assets/img/team-2.jpg') }}" id="avatarImage" class="avatar-profile"
                                                alt="Avatar Preview" />
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload">

                                                <i class="fa-solid fa-camera  "
                                                    style="color: #cecece; font-size: 30px;"></i></label>
                                        </div>
                                    </div>

                                    <div class="text-align-center  my-5">
                                        <h6 class="mb-0">John Doe</h6>
                                        <p class="text-sm font-weight-bold">ber admin</p>
                                    </div>

                                </div>
                            </div>
                            <div class="p-3 mt-4 card col-md-10 border-radius-lg" id="Divone"
                                style="border: 1px solid rgb(208, 208, 208);">
                                <div class="d-flex justify-content-between">
                                    <h6>Basic Detail</h6>
                                    <div>
                                        <i class="fa-solid fa-pen" onclick="switchDocument()"></i>

                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Name:</p>
                                    </div>
                                    <div class="col-md-3 mb-3 gap-4">
                                        <p class="text-sm font-weight-normal">Richard Payne</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Email</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-normal">richardpayne@gmail.com</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Phone Number:</p>
                                    </div>
                                    <div class="col-md-3 mb-3 gap-4">
                                        <p class="text-sm font-weight-normal">(307)197-6191</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Date of Birth:</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-normal">11/12/1999</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Gender:</p>
                                    </div>
                                    <div class="col-md-3 mb-3 gap-4">
                                        <p class="text-sm font-weight-normal">Male</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Address</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-normal">1680 Labadie Light Suite 672</p>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>Address </h6>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Address:</p>
                                    </div>
                                    <div class="col-md-9 mb-3 gap-4">
                                        <p class="text-sm font-weight-normal">2857 Oxford Blvd, Allison Park,
                                            Pennsylvania, 15101, United States</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">City:</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-normal">Allison Park</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">State:</p>
                                    </div>
                                    <div class="col-md-3 mb-3 gap-4">
                                        <p class="text-sm font-weight-normal">Pennsylvania</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Country:</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-normal">United States</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-bold text-dark">Zip Code:</p>
                                    </div>
                                    <div class="col-md-3 mb-3  gap-4">
                                        <p class="text-sm font-weight-normal">15101</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="p-3 mt-4 card col-md-10 border-radius-lg" id="Divtwo"
                                    style="display: none;border: 1px solid rgb(208, 208, 208);">

                                    <h6>Basic Detail</h6>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label  mb-0 text-xs font-weight-bold">First
                                                Name</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" placeholder="John Doe">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label  mb-0 text-xs font-weight-bold">Email</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" placeholder="johndoe@gmail.com">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label  mb-0 text-xs font-weight-bold">Phone
                                                Number</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" placeholder="(307)197-6191">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label  mb-0 text-xs font-weight-bold">Gender
                                            </label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" placeholder="Male">
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <h6>Address Details</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label   mb-0 text-xs font-weight-bold">
                                                Address Details</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" placeholder="112 hawkin street">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label   mb-0 text-xs font-weight-bold">
                                                City</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" placeholder="California">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label   mb-0 text-xs font-weight-bold">
                                                State</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" placeholder="united state">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label   mb-0 text-xs font-weight-bold">
                                                Zip Code</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" placeholder="0000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end p-3  col-md-10">
                                    <button type="button" class="btn btn-sm  btn-info btn-lg mt-4 ">Save
                                        Changes</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade   " id="v-pills-Vaccine" role="tabpanel"
                            aria-labelledby="v-pills-Vaccine-tab">

                            <div class=" p-3 card col-md-10 border-radius-lg"
                                style="border: 1px solid rgb(208, 208, 208);">

                                <h6>Change Password</h6>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="mb-3 position-relative">
                                        <input type="password" class="form-control form-control-lg password-field"
                                            id="current-password" placeholder="Current Password"
                                            aria-label="Password" />
                                        <span class="toggle-password"
                                            onclick="togglePassword('current-password', this)">
                                            <i class="fas fa-eye"></i> <!-- Font Awesome Icon -->
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 my-3">
                                    <div class="mb-3 position-relative">
                                        <input type="password" class="form-control form-control-lg password-field"
                                            id="new-password" placeholder="New Password" aria-label="Password" />
                                        <span class="toggle-password" onclick="togglePassword('new-password', this)">
                                            <i class="fas fa-eye"></i> <!-- Font Awesome Icon -->
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12">
                                    <div class="mb-3 position-relative">
                                        <input type="password" class="form-control form-control-lg password-field"
                                            id="confirm-password" placeholder="Confirm New Password"
                                            aria-label="Password" />
                                        <span class="toggle-password"
                                            onclick="togglePassword('confirm-password', this)">
                                            <i class="fas fa-eye"></i> <!-- Font Awesome Icon -->
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <h6>Password requirements</h6>
                                    <p class="text-sm font-weight-normal">Please follow this guide for a strong
                                        password:</p>
                                    <p class="text-sm font-weight-normal">One special characters<br /> Min 6
                                        characters<br /> One number (2 are recommended)<br />
                                        Change it often</p>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-sm  btn-info btn-lg mt-4 mb-0 ">Save
                                        Changes</button>
                                </div>
                            </div>


                        </div>
                        <!-- 3 tab -->
                        <div class="tab-pane fade  " id="v-pills-Diagnosis" role="tabpanel"
                            aria-labelledby="v-pills-Diagnosis-tab">
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header pb-0">
                                    <div class="d-lg-flex">
                                        <div>
                                            <h5 class="mb-0">Nurses</h5>

                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto">
                                                <a href="#" class="btn btn-info " data-bs-toggle="modal"
                                                    data-bs-target="#addimport"> ADD NEW USER</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-0">
                                    <div class="table-responsive">
                                        <table class="table table-flush" id="products-list">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-dark opacity-9">NAME</th>
                                                    <th class="text-dark opacity-9">SERVICES</th>
                                                    <th class="text-dark opacity-9">AREA OF EXPERTISE</th>
                                                    <th class="text-dark opacity-9">QUALIFICATION</th>
                                                    <th class="text-dark opacity-9">EXPERIENCE</th>
                                                    <th class="text-dark opacity-9">EMAIL</th>
                                                    <th class="text-dark opacity-9">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">heart specialists</td>
                                                    <td class="text-sm">lorem ipsum</td>
                                                    <td class="text-sm">
                                                        <h6>MBBS</h6>
                                                    </td>
                                                    <td class="text-sm">03</td>
                                                    <td class="text-sm">
                                                        Beverlymatthews@gmail.com
                                                    </td>
                                                    <td class="">

                                                        <a href="">
                                                            <i class="fas fa-trash  text-lg text-secondary"></i>
                                                        </a>
                                                        <a href="viewnurse.html">
                                                            <i class="fas fa-eye text-secondary text-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">heart specialists</td>
                                                    <td class="text-sm">lorem ipsum</td>
                                                    <td class="text-sm">
                                                        <h6>MBBS</h6>
                                                    </td>
                                                    <td class="text-sm">03</td>
                                                    <td class="text-sm">
                                                        Beverlymatthews@gmail.com
                                                    </td>
                                                    <td class="">

                                                        <a href="">
                                                            <i class="fas fa-trash  text-lg text-secondary"></i>
                                                        </a>
                                                        <a href="viewnurse.html">
                                                            <i class="fas fa-eye text-secondary text-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">heart specialists</td>
                                                    <td class="text-sm">lorem ipsum</td>
                                                    <td class="text-sm">
                                                        <h6>MBBS</h6>
                                                    </td>
                                                    <td class="text-sm">03</td>
                                                    <td class="text-sm">
                                                        Beverlymatthews@gmail.com
                                                    </td>
                                                    <td class="">

                                                        <a href="">
                                                            <i class="fas fa-trash  text-lg text-secondary"></i>
                                                        </a>
                                                        <a href="viewnurse.html">
                                                            <i class="fas fa-eye text-secondary text-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">heart specialists</td>
                                                    <td class="text-sm">lorem ipsum</td>
                                                    <td class="text-sm">
                                                        <h6>MBBS</h6>
                                                    </td>
                                                    <td class="text-sm">03</td>
                                                    <td class="text-sm">
                                                        Beverlymatthews@gmail.com
                                                    </td>
                                                    <td class="">

                                                        <a href="">
                                                            <i class="fas fa-trash  text-lg text-secondary"></i>
                                                        </a>
                                                        <a href="viewnurse.html">
                                                            <i class="fas fa-eye text-secondary text-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">heart specialists</td>
                                                    <td class="text-sm">lorem ipsum</td>
                                                    <td class="text-sm">
                                                        <h6>MBBS</h6>
                                                    </td>
                                                    <td class="text-sm">03</td>
                                                    <td class="text-sm">
                                                        Beverlymatthews@gmail.com
                                                    </td>
                                                    <td class="">

                                                        <a href="">
                                                            <i class="fas fa-trash  text-lg text-secondary"></i>
                                                        </a>
                                                        <a href="viewnurse.html">
                                                            <i class="fas fa-eye text-secondary text-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">heart specialists</td>
                                                    <td class="text-sm">lorem ipsum</td>
                                                    <td class="text-sm">
                                                        <h6>MBBS</h6>
                                                    </td>
                                                    <td class="text-sm">03</td>
                                                    <td class="text-sm">
                                                        Beverlymatthews@gmail.com
                                                    </td>
                                                    <td class="">

                                                        <a href="">
                                                            <i class="fas fa-trash  text-lg text-secondary"></i>
                                                        </a>
                                                        <a href="viewnurse.html">
                                                            <i class="fas fa-eye text-secondary text-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 5 tab -->
                        <div class="tab-pane fade  " id="v-pills-PastSurgeries" role="tabpanel"
                            aria-labelledby="v-pills-PastSurgeries-tab">
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header pb-0">
                                    <div class="d-lg-flex">
                                        <div>
                                            <h5 class="mb-0">Vaccines</h5>

                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto">
                                                <a href="#" class="btn btn-info " data-bs-toggle="modal"
                                                    data-bs-target="#addvaccine"> ADD NEW</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-0">
                                    <div class="table-responsive">
                                        <table class="table table-flush" id="Vaccines-list">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-dark opacity-9">NAME</th>
                                                    <th class="text-dark opacity-9">VACCINE CODE</th>
                                                    <th class="text-dark opacity-9">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Lorem ipsum</h6>
                                                    </td>

                                                    <td class="text-sm">V-001</td>

                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" />
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Lorem ipsum</h6>
                                                    </td>

                                                    <td class="text-sm">V-001</td>

                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Lorem ipsum</h6>
                                                    </td>

                                                    <td class="text-sm">V-001</td>

                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Lorem ipsum</h6>
                                                    </td>

                                                    <td class="text-sm">V-001</td>

                                                    <td class="">
                                                        <img src="{{ asset('admin.assets/img/edit.png') }}" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Lorem ipsum</h6>
                                                    </td>

                                                    <td class="text-sm">V-001</td>

                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" />
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 6 tab -->

                        <div class="tab-pane fade  " id="v-pills-DoctorNotes" role="tabpanel"
                            aria-labelledby="v-pills-DoctorNotes-tab">
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header pb-0">
                                    <div class="d-lg-flex">
                                        <div>
                                            <h5 class="mb-0">Roles and Permissions</h5>

                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto">
                                                <a href="#" class="btn btn-info " data-bs-toggle="modal"
                                                    data-bs-target="#addpermission"> ADD NEW</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-0">
                                    <div class="table-responsive">
                                        <table class="table table-flush" id="permission-list">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-dark opacity-9">NAME</th>
                                                    <th class="text-dark opacity-9">EMAIL</th>
                                                    <th class="text-dark opacity-9"> ACCESS</th>
                                                    <th class="text-dark opacity-9">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">beverlymatthews@gmail.com</td>
                                                    <td class="text-sm">
                                                        <h6>Dashboard, Appointments</h6>
                                                    </td>
                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" data-bs-toggle="modal"
                                                            data-bs-target="#editpermission" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">beverlymatthews@gmail.com</td>
                                                    <td class="text-sm">
                                                        <h6>Dashboard, Appointments</h6>
                                                    </td>
                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" data-bs-toggle="modal"
                                                            data-bs-target="#editpermission" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">beverlymatthews@gmail.com</td>
                                                    <td class="text-sm">
                                                        <h6>Dashboard, Appointments</h6>
                                                    </td>
                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" data-bs-toggle="modal"
                                                            data-bs-target="#editpermission" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">beverlymatthews@gmail.com</td>
                                                    <td class="text-sm">
                                                        <h6>Dashboard, Appointments</h6>
                                                    </td>
                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" data-bs-toggle="modal"
                                                            data-bs-target="#editpermission" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">
                                                        <h6>Beverly Matthews</h6>
                                                    </td>
                                                    <td class="text-sm">beverlymatthews@gmail.com</td>
                                                    <td class="text-sm">
                                                        <h6>Dashboard, Appointments</h6>
                                                    </td>
                                                    <td class="">
                                                        <img src="{{ asset('admin/assets/img/edit.png') }}" data-bs-toggle="modal"
                                                            data-bs-target="#editpermission" />
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
            </div>

            <div class="modal fade" id="addimport" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Add New Nurse</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Full Name<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Services<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Services">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Department<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Department">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Experience<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Experience">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Qualification<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Qualification">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Specialty & Area of
                                        Services<b class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="Enter Specialty & Area of Services">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Email<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Contact #<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Contact #">
                                    </div>
                                </div>
                            </div>
                            <h6>Address Detail</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Street Address<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Street Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">City<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">State<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter State">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Zip Code<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Zip Code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h6>Module Request</h6>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Dashboard</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Pharmacies</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled"
                                            checked>
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Appointments</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Labs</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled"
                                            checked>
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Patients</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Reports</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Communication</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Settings</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-info  ml-auto" data-bs-dismiss="modal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addvaccine" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Add New Vaccine</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label class="form-label  mb-0 text-xs font-weight-bold">Vaccine Name<b
                                        class="text-danger text-sm">*</b></label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Vaccine Name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label  mb-0 text-xs font-weight-bold">Vaccine Code<b
                                        class="text-danger text-sm">*</b></label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Agreement Name">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-info  ml-auto" data-bs-dismiss="modal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addpermission" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Add Permissions</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Name<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Email<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <h6>Access</h6>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Dashboard</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Pharmacies</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled"
                                            checked>
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Appointments</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Labs</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled"
                                            checked>
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Patients</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Reports</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Communication</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Settings</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-info  ml-auto" data-bs-dismiss="modal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editpermission" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Edit Permissions</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Name<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Email<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <h6>Access</h6>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Dashboard</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Pharmacies</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled"
                                            checked>
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Appointments</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Labs</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled"
                                            checked>
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Patients</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Reports</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Communication</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Settings</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-info text-white ml-auto"
                                data-bs-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addimport" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Add New Nurse</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Full Name<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Services<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Services">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Department<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Department">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Experience<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Experience">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Qualification<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Qualification">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Specialty & Area of
                                        Services<b class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="Enter Specialty & Area of Services">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Email<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Contact #<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Contact #">
                                    </div>
                                </div>
                            </div>
                            <h6>Address Detail</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Street Address<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Street Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">City<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">State<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter State">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label  mb-0 text-xs font-weight-bold">Zip Code<b
                                            class="text-danger text-sm">*</b></label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Zip Code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h6>Module Request</h6>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Dashboard</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Pharmacies</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled"
                                            checked>
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Appointments</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Labs</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled"
                                            checked>
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Patients</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Reports</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Communication</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckDisabled">
                                        <label class="custom-control-label font-weight-normal"
                                            for="customCheckDisabled">Settings</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-info  ml-auto" data-bs-dismiss="modal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addvaccine" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Add New Vaccine</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label class="form-label  mb-0 text-xs font-weight-bold">Vaccine Name<b
                                        class="text-danger text-sm">*</b></label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Vaccine Name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label  mb-0 text-xs font-weight-bold">Vaccine Code<b
                                        class="text-danger text-sm">*</b></label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Agreement Name">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-info  ml-auto" data-bs-dismiss="modal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    
@endsection