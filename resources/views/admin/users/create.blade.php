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
                <button class="btn btn-link text-dark p-0 me-2"><a href="{{ route('admin.users') }}">&larr;</a></button>
                <h4 class="fw-bold mb-0">Add Admin</h4>
            </div>

            <!-- Basic Details -->
            <h6 class="section-title">Basic Details</h6>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <!-- Patient Name -->
                    <div class="col-md-6">
                        <label class="form-label"> Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Patient Name">
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
                    </div>

                    <!-- DOB -->
                    <div class="col-md-6">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control">
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select class="form-control" name="gender" id="choices-gender-edit">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select class="form-control" name="role" id="roleSelect" required>
                            <option value="">Select Role</option>
                            @foreach(($roles ?? []) as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Role & Permissions -->
                    <div class="mt-4">
                        <h5 class="fw-semibold">Role & Permissions</h5>
                        <div class="role-card" style="width: max-content;">
                            <table class="table mb-0" id="permTable">
                                <thead>
                                    <tr>
                                        <th class="p-3">Permissions</th>
                                        <th class="p-3">Access</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $modules = ['Dashboard','Appointment','Chat','Hospital','Doctors','Patients','Admins','Setting'];
                                    @endphp

                                    @foreach($modules as $m)
                                        <tr>
                                            <td class="text-sm fw-bold text-dark">{{ $m }}</td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="perm[{{ $m }}]" value="FullAccess" checked>
                                                    <label class="form-check-label">Full Access</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="perm[{{ $m }}]" value="ViewOnly">
                                                    <label class="form-check-label">View Only</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                        </table>
                        <small class="text-muted d-block mt-2" id="adminHint" style="display:none;">
                            Admin role always has FullAccess to all modules. The table is disabled.
                        </small>
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
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('roleSelect');
        const permTable  = document.getElementById('permTable');
        const adminHint  = document.getElementById('adminHint');

        function togglePerms() {
            const isAdmin = roleSelect.value === 'Admin';
            permTable.querySelectorAll('input[type="radio"]').forEach(i => {
                i.disabled = isAdmin;
            });
            adminHint.style.display = isAdmin ? 'block' : 'none';
        }
        roleSelect.addEventListener('change', togglePerms);
        togglePerms();
    });
    </script>
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
    <!-- Githu
@endsection
