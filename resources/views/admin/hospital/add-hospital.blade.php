@extends('admin.layout.master')
@section('style')
    <style>
        .header-banner {
            background: url('admin/assets/img/header-bg.png') no-repeat center center;
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
                    <button class="btn btn-link text-dark p-0 me-2"><a href="{{ route('admin.hospital') }}">&larr;</a></button>
                    <h4 class="fw-bold mb-0">Add Hospital</h4>
                </div>
                <h6 class="section-title">Basic Details </h6>
                <form>
                    <div class="row g-3 mb-3">
                        <!-- Patient Name -->
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
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
                            <label class="form-label">Specialities</label>
                            <input type="text" class="form-control" placeholder="Enter Specialities">
                        </div>


                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Departments
                                <span id="addDepartmentBtn" style="cursor: pointer;">
                                    <i class="fa-solid fa-circle-plus ms-3 text-info"></i> Add more
                                </span>
                            </label>
                            <div id="departmentsContainer">
                                <input type="text" class="form-control mb-2" placeholder="Enter Department">
                            </div>
                        </div>
                    </div>



                    <!-- Address Details -->
                    <h6 class="section-title text-dark mt-3">Address Details</h6>
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

                    <!-- Submit -->
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-danger px-4 py-2">Add</button>
                    </div>
                </form>
            </div>


        </div>   
@endsection
@section('script')
    
@endsection