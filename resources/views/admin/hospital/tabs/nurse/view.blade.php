@extends('admin.layout.master')
@section('style')
    <style>
        .header-banner {
            background: url('{{ asset('admin/assets/img/header-bg.png') }}') no-repeat center center;
            background-size: cover;
            height: 190px;
            border-radius: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="container my-4">
        <div class="details-card mx-0">
            <div class="profile-header ">
                <!-- Left Section -->
                <div class="profile-info">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile Picture">
                    <div>
                        <div class="profile-name">{{ $nurse->user?->name ?? '-' }}</div>
                        <div class="profile-email">{{ $nurse->user?->email ?? '-' }}</div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="profile-actions">
                    <i class="fa-solid fa-trash"></i> Delete
                    <i class="fa-solid fa-pen ms-3"></i> Edit
                </div>
            </div>
        </div>
        <!-- Basic Details -->
        <div class="details-card mx-0">
            <h5>Basic Details</h5>
            <hr>
            <div class="row">
                <div class="col-md-6 details-row">
                    <span class="details-label">Name:</span>
                    <span class="details-value">{{ $nurse->user?->name ?? 'N/A' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Email:</span>
                    <span class="details-value">{{ $nurse->user?->email ?? '-' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Phone Number:</span>
                    <span class="details-value">{{ $nurse->user?->phone ?? '-' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Date of Birth:</span>
                    <span class="details-value">{{ $nurse->user?->dob ? \Carbon\Carbon::parse($nurse->user->dob)->format('d/m/Y') : '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Gender:</span>
                    <span class="details-value">{{ $nurse->user?->gender ?? '-' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Department:</span>
                    <span class="details-value">{{ $nurse->department?->name ?? '-' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Hospital:</span>
                    <span class="details-value">{{ $nurse->hospital?->user?->name ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Access:</span>
                    <span class="details-value">—</span>
                </div>
            </div>
        </div>
        <div class="details-card mx-0 my-3">
            <h5>Qualification Details</h5>
            <hr>
            <div class="row">
                <div class="col-md-6 details-row">
                    <span class="details-label">Degree:</span>
                    <span class="details-value">{{ $nurse->qualifications?->degree ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Institute:</span>
                    <span class="details-value">{{ $nurse->qualifications?->institute ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Start Date:</span>
                    <span class="details-value">{{ $nurse->qualifications?->start_date ? \Carbon\Carbon::parse($nurse->qualifications->start_date)->format('d/m/Y') : '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">End Date:</span>
                    <span class="details-value">{{ $nurse->qualifications?->end_date ? \Carbon\Carbon::parse($nurse->qualifications->end_date)->format('d/m/Y') : '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Total Marks/CGPA:</span>
                    <span class="details-value">{{ $nurse->qualifications?->total_marks_CGPA ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Achieved Marks/CGPA:</span>
                    <span class="details-value">{{ $nurse->qualifications?->achieved_marks_CGPA ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Attachment:</span>
                    @if ($nurse->qualifications?->attachment)
                        <a href="{{ asset('storage/' . $nurse->qualifications->attachment) }}" target="_blank"
                            class="details-value text-info">
                            View Attachment
                        </a>
                    @else
                        <span class="details-value">—</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="details-card mx-0">
            <h5>Address</h5>
            <hr>
            <div class="row">
                <div class="col-md-6 details-row">
                    <span class="details-label">Address:</span>
                    <span class="details-value">{{ $nurse->user?->address ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">City:</span>
                    <span class="details-value">{{ $nurse->user?->city ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">State:</span>
                    <span class="details-value">{{ $nurse->user?->state ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Country:</span>
                    <span class="details-value">{{ $nurse->user->country ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Zip Code:</span>
                    <span class="details-value">{{ $nurse->user?->zipcode ?? '—' }}</span>
                </div>
            </div>
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
