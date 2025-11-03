<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#">
                <img src="{{ asset('admin/assets/img/Logo-black.svg') }}" class="navbar-brand-img h-100" alt="main_logo">
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('admin/dashboard') || Request::is('admin/dashboard/*') ? ' active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/dashboard') || Request::is('admin/dashboard/*') ? ' active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <div
                            class="icon icon-sm -sm border-radius-md bg-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{ asset('admin/assets/img/Dashboard.svg') }}" alt="Changelog Icon" />
                            </div>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/appointment') || Request::is('admin/appointment/*') ? ' active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/appointment') || Request::is('admin/appointment/*') ? ' active' : '' }}" href="{{ route('admin.appointment') }}">
                        <div
                            class="icon icon-sm -sm border-radius-md bg-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{ asset('admin/assets/img/add-event_9311187.svg') }}" alt="Changelog Icon" />
                            </div>
                        </div>
                        <span class="nav-link-text ms-1">Appointments</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/chat') || Request::is('admin/chat/*') ? ' active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/chat') || Request::is('admin/chat/*') ? ' active' : '' }}" href="{{ route('admin.chat') }}">
                        <div
                            class="icon icon-sm -sm border-radius-md bg-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{ asset('admin/assets/img/Chat.svg') }}" alt="Changelog Icon" />
                            </div>
                        </div>
                        <span class="nav-link-text ms-1">Chat</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/hospital') || Request::is('admin/hospital/*') ? ' active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/hospital') || Request::is('admin/hospital/*') ? ' active' : '' }}" href="{{ route('admin.hospital') }}">
                        <div
                            class="icon icon-sm -sm border-radius-md bg-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{ asset('admin/assets/img/hospital_building.svg') }}" alt="Changelog Icon" />
                            </div>
                        </div>
                        <span class="nav-link-text ms-1">Hospitals</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/doctor') || Request::is('admin/doctor/*') ? ' active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/doctor') || Request::is('admin/doctor/*') ? ' active' : '' }}" href="{{ route('admin.doctor') }}">
                        <div
                            class="icon icon-sm -sm border-radius-md bg-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{ asset('admin/assets/img/Doctors.svg') }}" alt="Changelog Icon" />
                            </div>
                        </div>
                        <span class="nav-link-text ms-1">Doctors</span>
                    </a>
                </li>
                <li class="nav-item  {{ Request::is('admin/patient') || Request::is('admin/patient/*') ? ' active' : '' }}">
                    <a class="nav-link  {{ Request::is('admin/patient') || Request::is('admin/patient/*') ? ' active' : '' }}" href="{{ route('admin.patient') }}">
                        <div
                            class="icon icon-sm -sm border-radius-md bg-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{ asset('admin/assets/img/patient_3359183-1.svg') }}" alt="Changelog Icon" />
                            </div>
                        </div>
                        <span class="nav-link-text ms-1">Patients</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/users') || Request::is('admin/users/*') ? ' active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*') ? ' active' : '' }}" href="{{ route('admin.users') }}">
                        <div
                            class="icon icon-sm -sm border-radius-md bg-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{ asset('admin/assets/img/Admins.svg') }}" alt="Changelog Icon" />
                            </div>
                        </div>
                        <span class="nav-link-text ms-1">Admins</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/setting') || Request::is('admin/setting/*') ? ' active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/setting') || Request::is('admin/setting/*') ? ' active' : '' }}" href="{{ route('admin.setting') }}">
                        <div
                            class="icon icon-sm -sm border-radius-md bg-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{ asset('admin/assets/img/Settings.svg') }}" alt="Changelog Icon" />
                            </div>
                        </div>
                        <span class="nav-link-text ms-1">Settings</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>