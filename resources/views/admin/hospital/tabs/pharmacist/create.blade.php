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
                <button class="btn btn-link text-dark p-0 me-2">&larr;</button>
                <h4 class="fw-bold mb-0">Add Pharmacists</h4>
            </div>

            <!-- Basic Details -->
            <h6 class="section-title">Basic Details</h6>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.hospital.store_pharmacist') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <!-- Patient Name -->
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- DOB -->
                    <div class="col-md-6">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control  @error('dob') is-invalid @enderror">
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select class="form-control  @error('gender') is-invalid @enderror" name="gender" id="choices-gender-edit">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hospital</label>
                        <select class="form-control @error('hospital_id') is-invalid @enderror" name="hospital_id" id="choices-hospital-edit">
                            <option value="">Select Hospital</option>
                            @foreach ($hospitals as $hospital)
                            <option value="{{ $hospital->id }}">{{ $hospital->user?->name ?? '-' }}</option>
                            @endforeach
                        </select>
                        @error('hospital_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- City -->
                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select class="form-control  @error('department_id') is-invalid @enderror" name="department_id" id="choices-department-edit">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name ?? '-' }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Appointment Date -->
                    <div class="col-md-6">
                        <label class="form-label">Working Hours</label>
                        <input type="text" name="working_hours" class="form-control @error('working_hours') is-invalid @enderror" placeholder="Enter working hours">
                        @error('working_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="Enter City">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- State -->
                    <div class="col-md-4">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" placeholder="Enter State">
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Zipcode -->
                    <div class="col-md-4">
                        <label class="form-label">Zipcode</label>
                        <input type="text" name="zipcode" class="form-control @error('zipcode') is-invalid @enderror" placeholder="Enter Zipcode">
                        @error('zipcode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                            <input type="text" name="degree" class="form-control @error('degree') is-invalid @enderror" placeholder="Enter Degree Name">
                            @error('degree')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Institute</label>
                            <input type="text" name="institute" class="form-control @error('institute') is-invalid @enderror" placeholder="Enter Institute">
                            @error('institute')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror">
                            @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror">
                            @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total Marks / CGPA</label>
                            <input type="text" name="total_marks_CGPA" class="form-control @error('total_marks_CGPA') is-invalid @enderror" placeholder="04/01/2014">
                            @error('total_marks_CGPA')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Achieved Marks / CGPA</label>
                            <input type="text" name="achieved_marks_CGPA" class="form-control @error('achieved_marks_CGPA') is-invalid @enderror" placeholder="04/01/2014">
                            @error('achieved_marks_CGPA')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-12">
                        <label class="form-label">Attachment</label>
                        <div class="file-upload">
                            <label class="choose-file-btn">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Choose File
                                <input name="attachment" class="@error('attachment') is-invalid @enderror" type="file" hidden>
                            </label>
                            <div class="file-preview">
                                <i class="fa-solid fa-file-pdf"></i> Attachment.pdf
                            </div>
                            @error('attachment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
