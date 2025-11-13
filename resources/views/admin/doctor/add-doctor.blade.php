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
                <button class="btn btn-link text-dark p-0 me-2"><a href="{{ route('admin.doctor') }}">
                        &larr;
                    </a></button>
                <h4 class="fw-bold mb-0">Add Doctor</h4>
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
            <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input name="dob" type="date" class="form-control @error('dob') is-invalid @enderror">
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="">Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hospital</label>
                        <select id="hospitalSelect" name="hospital_id" class="form-control @error('hospital_id') is-invalid @enderror">
                            <option value="">Select Hospital</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}">{{ $hospital->user?->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                        @error('hospital_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select id="departmentSelect" name="department_id" class="form-select">
                            <option value="">Please select hospital first</option>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">Speciality Hours</label>
                        <input name="speciality_hours" type="time" class="form-control @error('speciality_hours') is-invalid @enderror">
                        @error('speciality_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Working Hours (From)</label>
                        <input name="working_hours_from" type="time" class="form-control @error('working_hours_from') is-invalid @enderror">
                        @error('working_hours_from')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Working Hours (To)</label>
                        <input name="working_hours_to" type="time" class="form-control @error('working_hours_to') is-invalid @enderror">
                        @error('working_hours_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Address section --}}
                <h6 class="section-title text-dark">Address Details</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <input name="city" type="text" class="form-control @error('city') is-invalid @enderror">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">State</label>
                        <input name="state" type="text" class="form-control @error('state') is-invalid @enderror">
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Zipcode</label>
                        <input name="zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror">
                        @error('zipcode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Qualification --}}
                <h5 class="fw-semibold mt-4">Qualification</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Degree</label>
                        <input name="degree" type="text" class="form-control @error('degree') is-invalid @enderror">
                        @error('degree')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Institute</label>
                        <input name="institute" type="text" class="form-control @error('institute') is-invalid @enderror">
                        @error('institute')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Start Date</label>
                        <input name="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <input name="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Marks / CGPA</label>
                        <input name="total_marks_CGPA" type="text" class="form-control @error('total_marks_CGPA') is-invalid @enderror">
                        @error('total_marks_CGPA')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Achieved Marks / CGPA</label>
                        <input name="achieved_marks_CGPA" type="text" class="form-control @error('achieved_marks_CGPA') is-invalid @enderror">
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

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-danger px-4 py-2">Add</button>
                </div>
            </form>
        </div>


    </div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hospitalSelect = document.getElementById('hospitalSelect');
        const departmentSelect = document.getElementById('departmentSelect');

        hospitalSelect.addEventListener('change', function () {
            const hospitalId = this.value;

            // Reset department dropdown
            departmentSelect.innerHTML = '<option value="">Loading...</option>';

            if (!hospitalId) {
                departmentSelect.innerHTML = '<option value="">Please select hospital first</option>';
                return;
            }

            // Fetch departments for selected hospital
            fetch(`/admin/doctor/departments/${hospitalId}`)
                .then(response => response.json())
                .then(data => {
                    departmentSelect.innerHTML = '';

                    if (data.length === 0) {
                        departmentSelect.innerHTML = '<option value="">No departments found</option>';
                        return;
                    }

                    // Populate department dropdown
                    departmentSelect.innerHTML = '<option value="">Select Department</option>';
                    data.forEach(dept => {
                        const option = document.createElement('option');
                        option.value = dept.id;
                        option.textContent = dept.name;
                        departmentSelect.appendChild(option);
                    });
                })
                .catch(() => {
                    departmentSelect.innerHTML = '<option value="">Error loading departments</option>';
                });
        });
    });
</script>
@endsection
