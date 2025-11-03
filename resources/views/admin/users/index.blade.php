@extends('admin.layout.master')
@section('style')
    <style>
        /* Default card style */
        .doctor-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        /* Active selected card style */
        .doctor-card.active {
            border: 2px solid #D32F2F;
            background-color: #FFEFF1;
            box-shadow: 0px 4px 12px rgba(211, 47, 47, 0.2);
        }

        /* Hover effect for better UX */
        .doctor-card:hover {
            transform: scale(1.02);
        }
    </style>
@endsection
@section('content')
   <div class="container-fluid py-4">
            <section class="appointments-section">
                <div class="appointments-header">
                    <h4>Admins</h4>
                    <div class="appointments-controls">
                        <div class="search-box">
                            <input type="text" placeholder="Type here..." class="search-input">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                        <button class="btn-primary schedule-btn" onclick="window.location.href='{{ route('admin.users.addUser') }}'">
                           Add Admin
                        </button>
                    </div>
                </div>
                <div class="appointments">
                    <div class="card doctor-card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i> rachal@gmail.com<br>
                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                </small>
                            </div>
                        </div>
                        <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.users.viewUser') }}'">View Details</button>
                    </div>

                    <div class="card doctor-card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i> jane@gmail.com<br>
                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                </small>
                            </div>
                        </div>
                        <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.users.viewUser') }}'">View Details</button>
                    </div>
                      <div class="card doctor-card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i> rachal@gmail.com<br>
                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                </small>
                            </div>
                        </div>
                        <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.users.viewUser') }}'">View Details</button>
                    </div>

                    <div class="card doctor-card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i> jane@gmail.com<br>
                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                </small>
                            </div>
                        </div>
                        <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.users.viewUser') }}'">View Details</button>
                    </div>
                      <div class="card doctor-card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i> rachal@gmail.com<br>
                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                </small>
                            </div>
                        </div>
                        <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.users.viewUser') }}'">View Details</button>
                    </div>

                    <div class="card doctor-card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i> jane@gmail.com<br>
                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                </small>
                            </div>
                        </div>
                        <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.users.viewUser') }}'">View Details</button>
                    </div>
                      <div class="card doctor-card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i> rachal@gmail.com<br>
                                    <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                                </small>
                            </div>
                        </div>
                        <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.users.viewUser') }}'">View Details</button>
                    </div>

                    <div class="card doctor-card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. Jane Smith</h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i> jane@gmail.com<br>
                                    <i class="fa-solid fa-phone text-danger"></i> (123)456-7890
                                </small>
                            </div>
                        </div>
                        <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.users.viewUser') }}'">View Details</button>
                    </div>

                </div>
            </section>
        </div> 
@endsection
@section('script')
    <script>
        const cards = document.querySelectorAll(".doctor-card");

        cards.forEach(card => {
            card.addEventListener("click", () => {
                // Remove active class from all cards
                cards.forEach(c => c.classList.remove("active"));
                // Add active class to the clicked card
                card.classList.add("active");
            });
        });
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