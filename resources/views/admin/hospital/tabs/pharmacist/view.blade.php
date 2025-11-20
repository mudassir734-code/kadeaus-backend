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
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center mb-4">
                        <button class="btn btn-link text-dark p-0 me-2">&larr;</button>
                        <h4 class="fw-bold mb-0">Pharmacist Details</h4>
                    </div>
                    <div>
                        <div class="profile-actions">
                            <i class="fa-solid fa-trash"></i> Delete
                            <i class="fa-solid fa-pen ms-3"></i> Edit
                        </div>
                    </div>

                </div>
                <div class="p-3 border-radius-lg" style="background-color: #FCF3F3;">
                    <div class="d-flex align-items-center mb-2">
                        <img src="{{ asset('admin/assets/img/Circle-2.png') }}" alt="Doctor" class="rounded-circle me-2"
                            style="width: 100px; height: 100px;">
                        <div>

                            <small class="text-muted">
                                <i class="fa-regular fa-envelope text-danger"></i>
                                {{ $pharmacist->user->email ?? '-' }}<br>
                                <i class="fa-solid fa-phone text-danger"></i> {{ $pharmacist->user->phone ?? '-'}}
                            </small>

                        </div>


                    </div>
                </div>
                <hr>
                <div class="">
                    <h5>Basic Details</h5>
                    <div class="row">
                        <div class="col-md-6 details-row">
                            <span class="details-label">Full Name</span>
                            <span class="details-value">{{ $pharmacist->user?->name ?? '-' }}</span>

                        </div>
                        <div class="col-md-6 details-row">
                            <span class="details-label">Email:</span>
                            <span class="details-value">{{ $pharmacist->user?->email ?? '-' }}</span>
                        </div>
                        <div class="col-md-6 details-row">
                            <span class="details-label">Contact Number:</span>
                            <span class="details-value">{{ $pharmacist->user?->phone ?? '-' }}</span>
                        </div>

                        <div class="col-md-6 details-row">
                            <span class="details-label">Gender:</span>
                            <span class="details-value">{{ $pharmacist->user?->gender ?? '-' }}</span>
                        </div>
                        <div class="col-md-6 details-row">
                            <span class="details-label">Date of Birth:</span>
                            <span class="details-value">{{ $pharmacist->user?->dob ?? '-' }}</span>
                        </div>
                        <div class="col-md-6 details-row">
                            <span class="details-label">Hospital:</span>
                            <span class="details-value">{{ $pharmacist->hospital?->user?->name ?? '-' }}</span>
                        </div>
                        <div class="col-md-6 details-row">
                            <span class="details-label">Appointments</span>
                            <span class="details-value">-</span>
                        </div>
                        <div class="col-md-6 details-row">
                            <span class="details-label">Modules Access:</span>
                            <span class="details-value">-</span>
                        </div>
                        <div class="col-md-6 details-row">
                            <span class="details-label">Qualification</span>
                            <span class="details-value">{{ $pharmacist->qualification->degree ?? '-' }}</span>
                        </div>
                        <div class="col-md-6 details-row">
                            <span class="details-label">Address:</span>
                            <span class="details-value">{{ $pharmacist->user?->address ?? '-' }}</span>
                        </div>
                    </div>
                    <div id="patientsView" class="main-container">
                        <div class="card">
                            <div class="patients-header">
                                <h2>Prescriptions</h2>
                                <div class="d-flex align-items-center g-3">
                                    <div class="search-box">
                                        <i class="fas fa-search"></i>
                                        <input type="text" placeholder="Type here..." id="searchInput">
                                    </div>
                                    <div>
                                        <button class="btn-primary schedule-btn ms-2" data-bs-toggle="modal"
                                            data-bs-target="#rescheduleDoctorModal">
                                            Add Prescription
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="entries-control">
                                <select id="entriesPerPage">
                                    <option value="12" selected>5</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                Entries Per Page
                            </div>

                            <table class="table patient-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Diagnosis</th>
                                        <th>Medications</th>
                                        <th>Instruction</th>
                                        <th>Duration</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="patientTableBody">
                                    <!-- Patient rows will be populated here -->
                                </tbody>
                            </table>

                            <div class="pagination-container">
                                <div class="pagination-info">
                                    Showing <span id="showingStart">1</span> to <span id="showingEnd">12</span> of <span
                                        id="totalEntries">57</span> entries
                                </div>
                                <nav>
                                    <ul class="pagination" id="paginationNav">
                                        <!-- Pagination will be populated here -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="rescheduleDoctorModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Add Report</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Patient's ID </label>
                                            <select class="form-control" name="choices-patient"
                                                id="choices-patient-edit">
                                                <option value="">Select Patient</option>
                                                <option value="Patient 1">Patient 1</option>
                                                <option value="Patient 2">Patient 2</option>
                                                <option value="Patient 3">Patient 3</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label"> Appointment ID</label>
                                            <select class="form-control" name="choices-appointment"
                                                id="choices-appointment-edit">
                                                <option value="">Select Appointment</option>
                                                <option value="Blood Test">Blood Test</option>
                                                <option value="X-Ray">X-Ray</option>
                                                <option value="MRI Scan">MRI Scan</option>
                                            </select>
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
                                </div>
                                <div class="d-flex justify-content-end p-3">
                                    <button type="button" class="btn bg-danger text-white">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
@endsection
@section('script')
    <script>
        // Sample patient data
        const patients = [

        ];

        let currentPage = 1;
        let entriesPerPage = 12;
        let filteredPatients = [...patients];

        function renderPatients() {
            const tbody = document.getElementById('patientTableBody');
            const start = (currentPage - 1) * entriesPerPage;
            const end = start + entriesPerPage;
            const patientsToShow = filteredPatients.slice(start, end);

            tbody.innerHTML = '';

            patientsToShow.forEach(patient => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${patient.id}</td>
                    <td>${patient.Diagnosis}</td>
                    <td>${patient.Medications}</td>
                    <td>${patient.Instruction}</td>
                    <td>${patient.Duration}</td>
                    <td>${patient.date}</td>


                `;
                tbody.appendChild(row);
            });

            updatePaginationInfo();
            renderPagination();
        }

        function updatePaginationInfo() {
            const start = (currentPage - 1) * entriesPerPage + 1;
            const end = Math.min(currentPage * entriesPerPage, filteredPatients.length);
            const total = filteredPatients.length;

            document.getElementById('showingStart').textContent = start;
            document.getElementById('showingEnd').textContent = end;
            document.getElementById('totalEntries').textContent = total;
        }

        function renderPagination() {
            const totalPages = Math.ceil(filteredPatients.length / entriesPerPage);
            const paginationNav = document.getElementById('paginationNav');

            paginationNav.innerHTML = '';

            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1})">‹</a>`;
            paginationNav.appendChild(prevLi);

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                paginationNav.appendChild(li);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1})">›</a>`;
            paginationNav.appendChild(nextLi);
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredPatients.length / entriesPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderPatients();
            }
        }

        function showPatientDetail(patientId) {
            const patient = patients.find(p => p.id === patientId);
            if (!patient) return;



            // Hide patients view and show detail view
            document.getEl
            reporttype: ' Blood Test', ementById('patientsView').style.display = 'none';
            document.getElementById('patientDetail').style.display = 'block';
        }

        function showPatientsView() {
            document.getElementById('patientDetail').style.display = 'none';
            document.getElementById('patientsView').style.display = 'block';
        }

        function filterPatients() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            filteredPatients = patients.filter(patient =>
                patient.name.toLowerCase().includes(searchTerm) ||
                patient.email.toLowerCase().includes(searchTerm) ||
                patient.id.toLowerCase().includes(searchTerm) ||
                patient.contact.includes(searchTerm)
            );
            currentPage = 1;
            renderPatients();
        }

        function changeEntriesPerPage() {
            entriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
            currentPage = 1;
            renderPatients();
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', filterPatients);
        document.getElementById('entriesPerPage').addEventListener('change', changeEntriesPerPage);

        // Initialize the page
        renderPatients();

        // Prevent default behavior for pagination links
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('page-link')) {
                e.preventDefault();
            }
        });
    </script>
    <script>
        if (document.getElementById('choices-role-edit')) {
            var element = document.getElementById('choices-role-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-user-edit')) {
            var element = document.getElementById('choices-user-edit');
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
