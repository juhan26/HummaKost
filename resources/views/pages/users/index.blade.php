@extends('app')

@section('content')
    <div class="col-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item me-4" role="presentation">
                <button class="nav-link active btn btn-primary rounded text-black" id="tenant-tab" data-bs-toggle="tab" data-bs-target="#tenant-tab-pane"
                    type="button" role="tab" aria-controls="tenant-tab-pane" aria-selected="true">Penyewa</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn btn-primary rounded text-black" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-tab-pane" type="button"
                    role="tab" aria-controls="admin-tab-pane" aria-selected="false">Ketua Kontrakan</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            @include('pages.users.tenantTable')
            @include('pages.users.adminTable')
        </div>
    </div>

    <script>
        // SweetAlert configuration for rejecting a user
        document.querySelectorAll('.reject-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission
                const form = this.closest('form'); // Get the form related to this button

                Swal.fire({
                    title: "Yakin ingin menolak?",
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#646464",
                    confirmButtonText: "Ya, tolak!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    }
                });
            });
        });
        document.querySelectorAll('.accept-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission
                const form = this.closest('form'); // Get the form related to this button

                Swal.fire({
                    title: "Yakin ingin menerima?",
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#20b486",
                    cancelButtonColor: "#646464",
                    confirmButtonText: "Ya, terima!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    }
                });
            });
        });
    </script>
@endsection
