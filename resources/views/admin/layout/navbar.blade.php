

<nav class="navbar navbar-main navbar-expand-lg position-sticky top-1 shadow-none border-radius-xl z-index-sticky"
            id="navbarBlur" data-scroll="true" style="background-color:#f8f9fa;">
            <div class="container-fluid py-2 px-3 d-flex align-items-center justify-content-between">

                <!-- Left Section: Breadcrumb + Sidebar Toggle -->
                <div class="d-flex align-items-center">
                    <!-- Dashboard Icon -->
                    <a href="javascript:;" class="me-2">
                        <img src="{{ asset('admin/assets/img/dashboard gray.svg') }}" alt="Dashboard" width="15" height="15">
                    </a>
                    <ol class="breadcrumb bg-transparent mb-1 pb-1 px-0">
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                    <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ms-3">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <ul class="navbar-nav d-flex align-items-center mb-0">

                    <!-- Language Selector -->
                    <li class="nav-item dropdown pe-3">
                        <a href="#" class="nav-link text-body p-0" id="languageDropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-globe fs-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="#"><img src="{{ asset('admin/assets/img/flag-1 (3).png') }}"
                                        class="mx-1" />Arabic</a></li>
                            <li><a class="dropdown-item" href="#"><img src="{{ asset('admin/assets/img/flag-1 (4).png') }}"
                                        class="mx-1" />English </a></li>
                            <li><a class="dropdown-item" href="#"><img src="{{ asset('admin/assets/img/flag-1 (1).png') }}" class="mx-1" />
                                    Spanish</a></li>
                            <li><a class="dropdown-item" href="#"><img src="{{ asset('admin/assets/img/flag-1 (2).png') }}" class="mx-1" />
                                    French</a></li>


                        </ul>
                    </li>

                    <!-- Notifications -->
                    <li class="nav-item dropdown pe-3">
                        <a href="#" class="nav-link text-body position-relative" id="notificationsDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-bell fs-5"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                4
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-3" style="width: 300px;">
                            <h6 class="fw-bold">Notifications</h6>
                            <p class="text-muted small">You have 4 unread notifications</p>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">You have an appointment with Dr. Amanda <small
                                        class="text-muted d-block">07 June 2025</small></a></li>
                            <li><a class="dropdown-item" href="#">Appointment Confirmed <small
                                        class="text-muted d-block">06 June 2025</small></a></li>
                            <li><a class="dropdown-item" href="#">Your appointment with Dr. Rahul Sharma <small
                                        class="text-muted d-block">05 June 2025</small></a></li>
                            <li><a class="dropdown-item" href="#">Appointment Cancelled <small
                                        class="text-muted d-block">01 June 2025</small></a></li>
                            <li><a class="dropdown-item text-primary text-center fw-bold" href="#">View All</a></li>
                        </ul>
                    </li>

                    <!-- Profile Image -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link p-0" id="profileDropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('admin/assets/img/team-2.jpg') }}" class="rounded-circle" alt="Profile" width="40"
                                height="40">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown">

                            <li><a class="dropdown-item text-danger" href="index.html">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>