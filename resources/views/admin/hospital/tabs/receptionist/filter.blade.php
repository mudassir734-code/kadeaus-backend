
  @forelse ($receptionists as $receptionist)
    <div class="card doctor-card p-3">
      <div class="d-flex align-items-center mb-2">
        <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Receptionist"
             class="rounded-md border-radius-lg me-2" style="width: 100px; height: 100px;">
        <div>
          <h6 class="mb-0 fw-bold">{{ $receptionist->user?->name ?? 'N/A' }}</h6>
          <small class="text-muted">
            <i class="fa-regular fa-envelope text-danger"></i>
            {{ $receptionist->user?->email ?? '-' }}<br>
            <i class="fa-solid fa-phone text-danger"></i>
            {{ $receptionist->user?->phone ?? '-' }}
          </small>
          <div class="d-flex justify-content-start">
            <p class="fw-semibold text-muted mb-0">
                {{ $receptionist->created_at?->diffForHumans() ?? '—' }}
            </p>
        </div>
        </div>
      </div>
      <button class="btn details mt-3"
              onclick="window.location.href='{{ route('admin.hospital.view_receptionist', $receptionist->id) }}'">
        View Details
      </button>
    </div>
  @empty
    <div class="text_muted text-center">Not found Receptionists</div>
  @endforelse
