<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', [
            'title' => 'User',
            'users' => User::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create', [
            'title' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Form (Gabungan aturan & pesan kustom)
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users,email',
            'password'        => 'required|string|min:8',
            'passwordconfirm' => 'required|same:password',
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role'            => 'required|in:Superadmin,Admin',
        ], [
            'name.required'            => 'Nama tidak boleh kosong.',
            'name.max'                 => 'Nama tidak boleh lebih dari :max karakter.',
            'email.required'           => 'Email tidak boleh kosong.',
            'email.email'              => 'Format email tidak valid.',
            'email.unique'             => 'Email sudah terdaftar.',
            'password.required'        => 'Password tidak boleh kosong.',
            'password.min'             => 'Password minimal harus :min karakter.',
            'passwordconfirm.required' => 'Konfirmasi password tidak boleh kosong.',
            'passwordconfirm.same'     => 'Konfirmasi password harus sama dengan password.',
            'role.required'            => 'Role harus dipilih.',
            'role.in'                  => 'Role yang dipilih tidak valid.',
        ]);

        // 2. Proses Penyimpanan Data (Menggunakan Try-Catch & Database Transaction)
        try {
            // Mengecek apakah ada file avatar yang diunggah
            if ($request->file('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatar', 'public');
            }

            // Memulai transaksi database
            DB::beginTransaction();

            // Menyimpan data user baru ke database
            User::create($validated);

            // Menyimpan perubahan jika tidak ada error
            DB::commit();

            // Mengalihkan halaman kembali ke indeks dengan pesan sukses
            return to_route('user.index')->withSuccess('Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Membatalkan transaksi jika terjadi error/kesalahan
            DB::rollBack();

            // Mengembalikan ke halaman sebelumnya dengan pesan error bawaan
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}