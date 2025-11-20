@extends('admin.layout.master')
@section('style')
    <style>
        .header-banner {
            background: url('{{ asset('admin/assets/img/header-bg.png') }}') no-repeat center center;
            background-size: cover;
            height: 190px;
            border-radius: 10px;
        }
         .divider {
            border-top: 1px solid #ddd;
            margin: 20px 0;
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
                    <a href="javascript:;" onclick="deleteNurse({{ $nurse->id }})"> <i class="fa-solid fa-trash"></i>
                        Delete</a>
                <a href="{{route('admin.nurse.edit',encrypt($nurse->id))  }}"><i class="fa-solid fa-pen ms-3"></i> Edit</a>
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
                    <span
                        class="details-value">{{ $nurse->user?->dob ? \Carbon\Carbon::parse($nurse->user->dob)->format('d/m/Y') : '—' }}</span>
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
            @foreach ($nurse->qualifications as $qualification)
            <div class="row">
                <div class="col-md-6 details-row">
                    <span class="details-label">Degree:</span>
                    <span class="details-value">{{ $qualification?->degree ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Institute:</span>
                    <span class="details-value">{{ $qualification?->institute ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Start Date:</span>
                    <span
                        class="details-value">{{ $qualification?->start_date ? \Carbon\Carbon::parse($qualification->start_date)->format('d/m/Y') : '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">End Date:</span>
                    <span
                        class="details-value">{{ $qualification?->end_date ? \Carbon\Carbon::parse($qualification->end_date)->format('d/m/Y') : '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Total Marks/CGPA:</span>
                    <span class="details-value">{{ $qualification?->total_marks_CGPA ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Achieved Marks/CGPA:</span>
                    <span class="details-value">{{ $qualification?->achieved_marks_CGPA ?? '—' }}</span>
                </div>
                <div class="col-md-6 details-row">
                    <span class="details-label">Attachment:</span>
                    @if ($qualification?->attachment)
                        <a href="{{ asset('storage/' . $qualification->attachment) }}" target="_blank"
                            class="details-value text-info">
                            View Attachment
                        </a>
                    @else
                        <span class="details-value">—</span>
                    @endif
                </div>
            </div>
               <div class="divider"></div>
            @endforeach
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
        function deleteNurse(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.nurse.delete') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _method: 'DELETE' // Laravel's method spoofing
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.status === 'success') {
                                Swal.fire('Deleted!', response.message ||
                                        'Nurse has been deleted.', 'success')
                                    .then(() => {
                                        // redirect to returned URL
                                        if (response.redirect_url) {
                                            window.location.href = response.redirect_url;
                                        }
                                    });
                            } else {
                                Swal.fire('Error!', response.message || 'Something went wrong.',
                                    'error');
                            }
                        },
                        error: (xhr) => {
                            const message = xhr.responseJSON?.message || 'Server error occurred.';
                            Swal.fire('Error!', message, 'error');
                        }
                    });
                }
            });
        }
    </script>
@endsection
