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
                <h4 class="fw-bold mb-0">Add Nurse</h4>
            </div>

            <!-- Basic Details -->
            <h6 class="section-title">Basic Details</h6>
            <form id="nurse_create_form" action="{{ route('admin.hospital.store_nurse') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Enter Patient Name" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Enter Email" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input name="phone" type="text" class="form-control" placeholder="Enter Phone Number" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date Of Birth</label>
                    <input name="dob" type="date" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select class="form-control" name="gender" id="choices-gender-edit" required>
                        <option value="">Select Gender</option>
                        <option>Male</option><option>Female</option><option>Other</option>
                    </select>
                </div>

                <div class="col-md-6">
                        <label class="form-label">Hospital</label>
                        <select id="hospitalSelect" name="hospital_id" class="form-control @error('hospital_id') is-invalid @enderror" required>
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
                    <select id="departmentSelect" name="department_id" class="form-select" required>
                        <option value="">Please select hospital first</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Working Hours</label>
                    <input name="working_hours" type="text" class="form-control" placeholder="Enter working hours" required>
                </div>
            </div>

            <div class="divider"></div>

            <h6 class="section-title text-dark">Address Details</h6>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Address 1</label>
                    <input name="address" type="text" class="form-control" placeholder="Enter Address" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">City</label>
                    <input name="city" type="text" class="form-control" placeholder="Enter City" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">State</label>
                    <input name="state" type="text" class="form-control" placeholder="Enter State" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Zipcode</label>
                    <input name="zipcode" type="text" class="form-control" placeholder="Enter Zipcode" required >
                </div>
            </div>

            <div class="divider"></div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-semibold">Qualification</h5>
                <div>
                    <button type="button" id="add-qualification" class="btn btn-outline-primary btn-sm">+ Add</button>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Degree</label>
                    <input name="degree" type="text" class="form-control" placeholder="Enter Degree Name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Institute</label>
                    <input name="institute" type="text" class="form-control" placeholder="Enter Institute" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Start Date</label>
                    <input name="start_date" type="date" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">End Date</label>
                    <input name="end_date" type="date" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Total Marks / CGPA</label>
                    <input name="total_marks_CGPA" type="text" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Achieved Marks / CGPA</label>
                    <input name="achieved_marks_CGPA" type="text" class="form-control" placeholder="" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Attachment</label>
                    <div class="file-upload">
                        <label class="choose-file-btn">
                            <i class="fa-solid fa-cloud-arrow-up"></i> Choose File
                            <input name="attachment" type="file" hidden required>
                        </label>
                        <div class="file-preview">
                            <i class="fa-solid fa-file-pdf"></i> Attachment.pdf
                        </div>
                    </div>
                </div>
            </div>

                    <!-- Role & Permissions -->
                    <div class="mt-4">
                        <h5 class="fw-semibold">Role & Permissions</h5>
                        <div class="role-card" style="width: max-content;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="p-3">Permissions</th>
                                        <th class="p-3">Access</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Overview</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="overview" checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="overview">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Doctors</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="doctors" checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="doctors">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Nurses</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="nurses" checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="nurses">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Receptionists</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="receptionists"
                                                    checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="receptionists">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Pharmacists</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pharmacists"
                                                    checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pharmacists">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Patients</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="patients" checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="patients">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Departments</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="departments"
                                                    checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="departments">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Laboratories</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="laboratories"
                                                    checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="laboratories">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Appointments</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="appointments"
                                                    checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="appointments">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-weight-bold text-dark">Billing</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billing" checked>
                                                <label class="form-check-label">Full Access</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billing">
                                                <label class="form-check-label">Read Only</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    $(document).ready(function(){
        $('#nurse_create_form').validate({
            rules:{
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    digits: true
                },
                dob: {
                    required: true,
                    date: true
                }
            }
    });
    });
</script>
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
            fetch(`/admin/hospital/tab/departments/${hospitalId}`)
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
