<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow p-3 mb-3">
        <h5 class="fw-bold mb-0">{{ $title }}</h5>
    </div>

    <div class="card shadow p-4">
        <div class="mb-3">
            <a href="{{ route('user.index') }}" class="btn btn-secondary px-3">Kembali</a>
        </div>

        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Alamat Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label fw-bold">Role</label>
                <select class="form-select select2 @error('role') is-invalid @enderror" id="role" name="role"
                    required>
                    <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Superadmin" {{ old('role', $user->role) == 'Superadmin' ? 'selected' : '' }}>
                        Superadmin</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label fw-bold">Foto Avatar <small class="text-muted">(Kosongkan jika
                        tidak ingin mengubah)</small></label>
                @if ($user->avatar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-thumbnail"
                            width="100">
                    </div>
                @endif
                <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar"
                    name="avatar">
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password Baru <small class="text-muted">(Kosongkan jika
                        tidak ingin mengganti password)</small></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="passwordconfirm" class="form-label fw-bold">Konfirmasi Password Baru</label>
                <input type="password" class="form-control @error('passwordconfirm') is-invalid @enderror"
                    id="passwordconfirm" name="passwordconfirm">
                @error('passwordconfirm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning text-white px-4">Update Data</button>
        </form>
    </div>
</x-app>
