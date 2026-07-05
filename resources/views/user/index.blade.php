<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow p-3 mb-3">
        <h5 class="fw-bold mb-0">{{ $title }}</h5>
    </div>

    <div class="card shadow p-4">
        <div class="mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-primary px-3">Create</a>
        </div>
        <table class="table table-bordered table-hover align-middle w-100 bisa-search">
            <div class="table-responsive">
                <table class="table table-hover datatable align-middle">
                    <thead>
                        <tr class="table-primary text-center">
                            <th width="50">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr class="text-center">
                                <td class="fw-bold">{{ $index + 1 }}</td>
                                <td class="text-start">{{ $user->name }}</td>
                                <td class="text-start">{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <button type="button" class="btn btn-info btn-sm text-white btn-detail"
                                            data-bs-toggle="modal" data-bs-target="#detailModal"
                                            data-route="{{ route('user.show', $user->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        <a class="btn btn-warning btn-sm text-white"
                                            href="{{ route('user.edit', $user->id) }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-route="{{ route('user.destroy', $user->id) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>

    @push('modals')
        {{-- Detail Modal Pop-up AJAX --}}
        <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Detail User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-detail">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {

                $('.btn-detail').click(function() {

                    let url = $(this).data('route');

                    $('#modal-detail').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary"></div>
            </div>
        `);

                    $.get(url, function(response) {

                        $('#modal-detail').html(response);

                    }).fail(function() {

                        $('#modal-detail').html(`
                <div class="alert alert-danger">
                    Gagal mengambil data user.
                </div>
            `);

                    });

                });

            });
        </script>
    @endpush
</x-app>
