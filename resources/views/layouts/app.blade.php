<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title ?? 'Daftar User' }} - NiceAdmin</title>

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">

    <link href="{{ asset('niceadmin/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center justify-content-between px-3">
        <div class="d-flex align-items-center">
            <a href="#" class="logo d-flex align-items-center text-decoration-none">
                <span class="d-none d-lg-block fw-bold text-primary fs-4">NiceAdmin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn ms-3" style="cursor: pointer; font-size: 24px;"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center list-style-none mb-0" style="list-style: none;">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=K.+Anderson&background=0D6EFD&color=fff"
                            alt="Profile" class="rounded-circle" width="36" height="36">
                        <span class="d-none d-md-block dropdown-toggle ps-2 fw-semibold">K. Anderson</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header text-center p-3">
                            <h6 class="fw-bold mb-0">K. Anderson</h6>
                            <small class="text-muted">Web Designer</small>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <<aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('setting.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Setting</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('user.index') }}">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li>

        </ul>

        </aside>

        <main id="main" class="main" style="margin-top: 60px; padding: 20px;">
            {{ $slot }}
        </main>

        {{-- Modal Delete Global --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST" id="form-delete">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <h5 class="mb-0">Anda yakin ingin menghapus data ini?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @stack('modals')

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

        <script>
            $(document).ready(function() {
                // Deteksi otomatis tabel ber-class 'datatable' dan paksa render fitur Search & Pagination
                const dataTableEl = document.querySelector('.datatable');
                if (dataTableEl) {
                    new simpleDatatables.DataTable(dataTableEl, {
                        perPage: 5,
                        perPageSelect: [5, 10, 25, 50],
                        searchable: true,
                        labels: {
                            placeholder: "Search...",
                            perPage: "entries per page",
                            noRows: "No entries found",
                            info: "Showing {start} to {end} of {rows} entries",
                        }
                    });
                }

                // Handler Modal Delete
                $(document).on('click', '.btn-delete', function() {
                    $('#form-delete').attr('action', $(this).data('route'));
                });
            });
        </script>
        @stack('scripts')
</body>

</html>
