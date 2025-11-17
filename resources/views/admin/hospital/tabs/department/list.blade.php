<section class="appointments-section mb-0 pb-0">
    <div class="appointments-header mb-2">
        <h4 class="mb-0">Department</h4>
        <div class="appointments-controls">
            <div class="search-box">
                <input type="text" placeholder="Type here..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <button class="btn-primary schedule-btn" data-bs-toggle="modal" data-bs-target="#adddepartmentModal">
                Add Department
            </button>
        </div>
    </div>
    <div class="detail-section">
        <div class="appointments mb-0">
            @foreach($departments as $dept)
                <div class="dept-card d-flex gap-3 align-items-start">
                    <img src="{{ asset('admin/assets/img/hexagon.svg') }}" />

                    <div class="dept-info">
                        <h5 class="font-weight-bolder">{{ $dept->name }}</h5>
                        <p><strong>Doctors:</strong> {{ $dept->doctors_count }}</p>
                        <p><strong>Nurses:</strong> {{ $dept->nurses_count }}</p>
                    </div>

                    <button class="menu-btn" type="button">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>

                    <div class="popover-menu">

                        <!-- EDIT -->
                        <button class="edit-btn"
                                data-id="{{ $dept->id }}"
                                data-name="{{ $dept->name }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editDeptModal">
                            Edit
                        </button>

                        <!-- DELETE -->
                        <form action="{{ route('admin.hospital.delete_department', $dept->id) }}" method="POST">
                            @csrf
                            <button class="delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="editDeptModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editDeptForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Department Name</label>
                        <input type="text" name="name" id="editDeptName" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="adddepartmentModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('admin.hospital.store_department') }}" method="POST">
                @csrf
                <input type="hidden" name="hospital_id" value="{{ $hospital->id }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Department Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  
</section>

