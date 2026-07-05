<div class="row g-3">
    <div class="col-md-3">
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('niceadmin/img/noprofil.png') }}"
            alt="Avatar" class="w-100 rounded border shadow-sm" style="max-height: 250px; object-fit: cover;">
    </div>
    <div class="col-md-9">
        <table class="table table-bordered">
            <tr>
                <td width="150" class="fw-bold">Email</td>
                <td width="10">:</td>
                <td class="text-start">{{ $user->email }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Nama Lengkap</td>
                <td>:</td>
                <td class="text-start">{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Role Hak Akses</td>
                <td>:</td>
                <td class="text-start">
                    <span class="badge {{ $user->role == 'Superadmin' ? 'bg-primary' : 'bg-success' }}">
                        {{ $user->role }}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="fw-bold">Akun Dibuat</td>
                <td>:</td>
                <td class="text-start">{{ $user->created_at->diffForHumans() }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Terakhir Diubah</td>
                <td>:</td>
                <td class="text-start">{{ $user->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
</div>
