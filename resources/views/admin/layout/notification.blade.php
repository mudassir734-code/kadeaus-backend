@if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <span class="text-sm"><b>Success!</b> {{ session('success') ?? 'Success' }}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10"
                data-bs-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <span class="text-sm"><b>Error!</b> {{ session('error') ?? 'Error' }}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10"
                data-bs-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
