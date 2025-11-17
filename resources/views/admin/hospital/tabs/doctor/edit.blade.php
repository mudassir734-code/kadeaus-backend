@extends('admin.layout.master')
@section('style')
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="header-banner "></div>
        <div class="appointment-container">
            <!-- Header -->
            <div class="d-flex align-items-center mb-4">
                <button class="btn btn-link text-dark p-0 me-2">
                    <a href="{{ route('admin.doctor') }}">&larr;</a>
                </button>
                <h4 class="fw-bold mb-0">Edit Doctor</h4>
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

            <form id="doctor_craete_form"
                  action="{{ route('admin.hospital.update_doctor', $doctor->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input name="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter Name"
                               value="{{ old('name', $doctor->user->name ?? '') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input name="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Enter Email"
                               value="{{ old('email', $doctor->user->email ?? '') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input name="phone" type="text"
                               class="form-control @error('phone') is-invalid @enderror"
                               placeholder="Enter Phone"
                               value="{{ old('phone', $doctor->user->phone ?? '') }}"
                               required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input name="dob" type="date"
                               class="form-control @error('dob') is-invalid @enderror"
                               value="{{ old('dob', isset($doctor->user->dob) ? \Carbon\Carbon::parse($doctor->user->dob)->format('Y-m-d') : '') }}"
                               required>
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        @php $gender = old('gender', $doctor->user->gender ?? ''); @endphp
                        <select name="gender"
                                class="form-control @error('gender') is-invalid @enderror"
                                required>
                            <option value="">Select Gender</option>
                            <option value="Male"   {{ $gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other"  {{ $gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hospital</label>
                        @php $hospitalId = old('hospital_id', $doctor->hospital_id ?? ''); @endphp
                        <select id="hospitalSelect" name="hospital_id"
                                class="form-control @error('hospital_id') is-invalid @enderror"
                                required>
                            <option value="">Select Hospital</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"
                                    {{ (string)$hospitalId === (string)$hospital->id ? 'selected' : '' }}>
                                    {{ $hospital->user?->name ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('hospital_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select id="departmentSelect" name="department_id"
                                class="form-select @error('department_id') is-invalid @enderror"
                                required>
                            <option value="">Please select hospital first</option>
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Speciality Hours</label>
                        <input name="speciality_hours" type="time"
                               class="form-control @error('speciality_hours') is-invalid @enderror"
                               value="{{ old('speciality_hours', $doctor->speciality_hours ?? '') }}"
                               required>
                        @error('speciality_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Working Hours (From)</label>
                        <input name="working_hours_from" type="time"
                               class="form-control @error('working_hours_from') is-invalid @enderror"
                               value="{{ old('working_hours_from', $doctor->working_hours_from ?? '') }}"
                               required>
                        @error('working_hours_from')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Working Hours (To)</label>
                        <input name="working_hours_to" type="time"
                               class="form-control @error('working_hours_to') is-invalid @enderror"
                               value="{{ old('working_hours_to', $doctor->working_hours_to ?? '') }}"
                               required>
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
                        <input name="address" type="text"
                               class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $doctor->user?->address ?? '') }}"
                               required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <input name="city" type="text"
                               class="form-control @error('city') is-invalid @enderror"
                               value="{{ old('city', $doctor->user?->city ?? '') }}"
                               required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">State</label>
                        <input name="state" type="text"
                               class="form-control @error('state') is-invalid @enderror"
                               value="{{ old('state', $doctor->user?->state ?? '') }}"
                               required>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Zipcode</label>
                        <input name="zipcode" type="text"
                               class="form-control @error('zipcode') is-invalid @enderror"
                               value="{{ old('zipcode', $doctor->user?->zipcode ?? '') }}"
                               required>
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
                        <input name="degree" type="text"
                               class="form-control @error('degree') is-invalid @enderror"
                               value="{{ old('degree', $doctor->qualification?->degree ?? '') }}"
                               required>
                        @error('degree')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Institute</label>
                        <input name="institute" type="text"
                               class="form-control @error('institute') is-invalid @enderror"
                               value="{{ old('institute', $doctor->qualification?->institute ?? '') }}"
                               required>
                        @error('institute')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Start Date</label>
                        <input name="start_date" type="date"
                               class="form-control @error('start_date') is-invalid @enderror"
                               value="{{ old('start_date', isset($doctor->qualification?->start_date) ? \Carbon\Carbon::parse($doctor->start_date)->format('Y-m-d') : '') }}"
                               required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <input name="end_date" type="date"
                               class="form-control @error('end_date') is-invalid @enderror"
                               value="{{ old('end_date', isset($doctor->qualification?->end_date) ? \Carbon\Carbon::parse($doctor->end_date)->format('Y-m-d') : '') }}"
                               required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Marks / CGPA</label>
                        <input name="total_marks_CGPA" type="text"
                               class="form-control @error('total_marks_CGPA') is-invalid @enderror"
                               value="{{ old('total_marks_CGPA', $doctor->qualification?->total_marks_CGPA ?? '') }}"
                               required>
                        @error('total_marks_CGPA')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Achieved Marks / CGPA</label>
                        <input name="achieved_marks_CGPA" type="text"
                               class="form-control @error('achieved_marks_CGPA') is-invalid @enderror"
                               value="{{ old('achieved_marks_CGPA', $doctor->qualification?->achieved_marks_CGPA ?? '') }}"
                               required>
                        @error('achieved_marks_CGPA')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Attachment</label>
                        <div class="file-upload">
                            <label class="choose-file-btn">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Choose File
                                <input name="attachment"
                                       class="@error('attachment') is-invalid @enderror"
                                       type="file"
                                       hidden>
                            </label>
                            <div class="file-preview">
                                <i class="fa-solid fa-file-pdf"></i>
                                @if (!empty($doctor->attachment))
                                    {{ basename($doctor->attachment) }}
                                @else
                                    Attachment.pdf
                                @endif
                            </div>
                            @error('attachment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-danger px-4 py-2">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#doctor_craete_form').validate({
                rules: {
                    name: { required: true, minlength: 2 },
                    email: { required: true, email: true },
                    phone: { required: true, digits: true, minlength: 10, maxlength: 15 },
                    dob: { required: true, date: true }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hospitalSelect = document.getElementById('hospitalSelect');
            const departmentSelect = document.getElementById('departmentSelect');
            const selectedDeptId = "{{ old('department_id', $doctor->department_id ?? '') }}";

            function loadDepartments(hospitalId, preselectId = null) {
                departmentSelect.innerHTML = '<option value="">Loading...</option>';

                if (!hospitalId) {
                    departmentSelect.innerHTML = '<option value="">Please select hospital first</option>';
                    return;
                }

                fetch(`/admin/doctor/departments/${hospitalId}`)
                    .then(response => response.json())
                    .then(data => {
                        departmentSelect.innerHTML = '';

                        if (data.length === 0) {
                            departmentSelect.innerHTML =
                                '<option value="">No departments found</option>';
                            return;
                        }

                        departmentSelect.innerHTML = '<option value="">Select Department</option>';
                        data.forEach(dept => {
                            const option = document.createElement('option');
                            option.value = dept.id;
                            option.textContent = dept.name;
                            if (preselectId && String(preselectId) === String(dept.id)) {
                                option.selected = true;
                            }
                            departmentSelect.appendChild(option);
                        });
                    })
                    .catch(() => {
                        departmentSelect.innerHTML =
                            '<option value="">Error loading departments</option>';
                    });
            }

            hospitalSelect.addEventListener('change', function() {
                loadDepartments(this.value);
            });

            // load departments on page load if hospital already selected
            if (hospitalSelect.value) {
                loadDepartments(hospitalSelect.value, selectedDeptId);
            }
        });
    </script>
@endsection

