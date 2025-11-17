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
                <h4 class="fw-bold mb-0">Add Receptionist</h4>
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
            <form id="receptionist_create_form" action="{{ route('admin.hospital.store_receptionist') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <!-- Patient Name -->
                    <div class="col-md-6">
                        <label class="form-label"> Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Patient Name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- DOB -->
                    <div class="col-md-6">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required>
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender -->
                     <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="choices-gender-edit" required>
                            <option value="">Select Gender</option>
                            <option value="Male"   @selected(old('gender')==='Male')>Male</option>
                            <option value="Female" @selected(old('gender')==='Female')>Female</option>
                            <option value="Other"  @selected(old('gender')==='Other')>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select class="form-control @error('role_id') is-invalid @enderror" name="role_id" id="choices-role-edit" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @selected(old('role_id')==$role->id)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="col-md-6">
                        <label class="form-label">Hospital</label>
                        <select class="form-control @error('hospital_id') is-invalid @enderror" name="hospital_id" id="choices-hospital-edit" required>
                            <option value="">Select Hospital</option>
                            @foreach($hospitals as $hospital)
                                <option value="{{ $hospital->id }}" @selected(old('hospital_id')==$hospital->id)>
                                    {{ $hospital->user?->name ?? ('Hospital #'.$hospital->id) }}
                                </option>
                            @endforeach
                        </select>
                        @error('hospital_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
        $(document).ready(function() {
            $("#receptionist_create_form").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    phone: {
                        required: true,
                        maxlength: 20
                    },
                    dob: {
                        required: true,
                        date: true
                    },
                    gender: {
                        required: true
                    },
                    role_id: {
                        required: true
                    },
                    hospital_id: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter the name",
                        maxlength: "Name cannot exceed 255 characters"
                    },
                    email: {
                        required: "Please enter the email",
                        email: "Please enter a valid email address",
                        maxlength: "Email cannot exceed 255 characters"
                    },
                    phone: {
                        required: "Please enter the phone number",
                        maxlength: "Phone number cannot exceed 20 characters"
                    },
                    dob: {
                        required: "Please enter the date of birth",
                        date: "Please enter a valid date"
                    },
                    gender: {
                        required: "Please select the gender"
                    },
                    role_id: {
                        required: "Please select the role"
                    },
                    hospital_id: {
                        required: "Please select the hospital"
                    },
                    
                }
            });
        });
    </script>

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
