<div class="tab-pane fade" id="v-pills-nurses" role="tabpanel" aria-labelledby="v-pills-nurses-tab">
    <section class="appointments-section">
        <div class="appointments-header">
            <h4>Nurse</h4>
            <div class="appointments-controls">
                <div class="search-box">
                    <input type="text" placeholder="Type here..." class="search-input">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <a href="Add-nurses.html"><button class="btn-primary schedule-btn">
                        Add Nurse
                    </button></a>
            </div>
        </div>
        <div class="appointments">
            <div class="card doctor-card p-3">
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                        class="rounded-md border-radius-lg me-2" style="width: 100px; height: 100px;">
                    <div>
                        <h6 class="mb-0 fw-bold">Dr. George Lee</h6>
                        <small class="text-muted">
                            <i class="fa-regular fa-envelope text-danger"></i>
                            rachal@gmail.com<br>
                            <i class="fa-solid fa-phone text-danger"></i> (182)379-2691
                        </small>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="fw-bold mb-0">212 Patients</h6>
                    <p class="text-muted">1 Day Ago</p>
                </div>
                <button class="btn details mt-3" onclick="window.location.href='Nurse-detail.html'">View
                    Details</button>
            </div>
        </div>
    </section>
</div>
