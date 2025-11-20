@extends('admin.layout.master')
@section('style')

@endsection
@section('content')
    <div class="container-fluid py-4">
        <div id="patientsView" class="main-container">
            <div class="patients-header">
                <h2>Hospitals</h2>
                <div class="d-flex align-items-center g-3">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Type here..." id="searchInput">
                    </div>
                    <div>
                        <button class="btn-primary schedule-btn ms-2"
                            onclick="window.location.href='{{ route('admin.hospital.addHospital') }}'">
                            Add Hospital
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
            <table class="table patient-table align-items-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Total Appointments</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody >
                    @forelse($hospitals as $hospital)
                        <tr>
                            <td class="text-nowrap">{{ $loop->iteration  }}</td>
                            <td>{{ $hospital->user?->name ?? '—' }}</td>
                            <td>{{ $hospital->user?->email ?? '—' }}</td>
                            <td>{{ $hospital->user?->phone ?? '—' }}</td>
                            <td>{{ $hospital->appointments_count ?? 'N/A' }}</td>
                            <td>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.hospital.hospitalDetail', encrypt($hospital->id)) }}" class="btn btn-sm btn-white mb-0"   title="View">
                                <i class="fas fa-eye text-info"></i>
                            </a>
                            <a href="{{route('admin.hospital.edit', encrypt($hospital->id))  }}" class="btn btn-sm btn-white mb-0" title="Edit">
                                <i class="fa-solid fa-pencil text-success"></i>
                            </a>
                            <a href="javascript:;" onclick="deleteHospital({{ $hospital->id }})" class="btn btn-sm btn-white mb-0" title="Delete">
                                <i class="fa-solid fa-trash-can text-danger"></i>
                            </a>
                        </div>
                    </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
 <script>
        function deleteHospital(id) {
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
                        url: "{{ route('admin.hospital.destroy') }}",
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
                                        'Hospital has been deleted.', 'success')
                                    .then(() => {
                                        // redirect to returned URL
                                         window.location.reload();
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
