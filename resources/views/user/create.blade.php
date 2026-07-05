<x-app>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <div class="card shadow p-4">
        <form method="POST" action="{{ route('user.store') }}" class="form" enctype="multipart/form-data"
            data-parsley-validate>
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label required">Nama Mahasiswa <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" required
                        data-parsley-required-message="Nama Harus Diisi">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label required">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required data-parsley-type="email"
                        data-parsley-required-message="Email Harus Diisi" data-parsley-type-message="Email tidak valid">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label required">Password <span
                            class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required minlength="8" data-parsley-minlength="8"
                        data-parsley-required-message="Password Harus Diisi"
                        data-parsley-minlength-message="Password minimal 8 karakter">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="passwordconfirm" class="form-label required">Konfirmasi Password <span
                            class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('passwordconfirm') is-invalid @enderror"
                        id="passwordconfirm" name="passwordconfirm" required minlength="8" data-parsley-minlength="8"
                        data-parsley-equalto="#password" data-parsley-required-message="Konfirmasi Password Harus Diisi"
                        data-parsley-equalto-message="Konfirmasi Password harus sama dengan Password">
                    @error('passwordconfirm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="role" class="form-label required">Role <span class="text-danger">*</span></label>
                    <select name="role" id="role" class="form-select select2" required
                        data-parsley-required-message="Role Harus Dipilih">
                        <option value="">-- Pilih Role --</option>
                        <option value="Superadmin" {{ old('role') == 'Superadmin' ? 'selected' : '' }}>Superadmin
                        </option>
                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="upload"
                        name="avatar">
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-2">
                        <img src="{{ asset('niceadmin/img/noprofil.png') }}" alt="Avatar" class="rounded border"
                            style="width: 120px; height: 120px; object-fit: cover;" id="preview">
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a class="btn btn-warning" href="{{ route('user.index') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @push('modals')
    @endpush
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    theme: 'bootstrap-5'
                });

                // Handler real-time image preview
                $("#upload").change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $("#preview").attr("src", e.target.result);
                    };
                    reader.readAsDataURL(this.files[0]);
                });
            });
        </script>
    @endpush
</x-app>
