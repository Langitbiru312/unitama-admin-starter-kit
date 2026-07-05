<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Daftar User';
        $users = User::orderBy('id', 'desc')->get();
        return view('user.index', compact('title', 'users'));
    }

    public function create()
    {
        $title = 'Tambah User';
        return view('user.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users,email',
            'password'        => 'required|string|min:8',
            'passwordconfirm' => 'required|same:password',
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'role'            => 'required|in:Superadmin,Admin',
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.unique'  => 'Email sudah terdaftar.',
            'password.min'  => 'Password minimal harus 8 karakter.',
            'passwordconfirm.same' => 'Konfirmasi password harus sama.',
        ]);

        try {
            if ($request->file('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatar', 'public');
            }
            $validated['password'] = bcrypt($request->password);
            $validated['email_verified_at'] = now();

            DB::beginTransaction();
            User::create($validated);
            DB::commit();

            return to_route('user.index')->withSuccess('Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $title = 'Edit User';
        return view('user.edit', compact('title', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password'        => 'nullable|string|min:8',
            'passwordconfirm' => 'nullable|same:password',
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'role'            => 'required|in:Superadmin,Admin',
        ]);

        DB::beginTransaction();
        try {
            if ($request->file('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatar', 'public');
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
            }
            if ($request->password) {
                $validated['password'] = bcrypt($request->password);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);
            DB::commit();
            return to_route('user.index')->withSuccess('Data berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('user.edit', $user)->withError('Data gagal diubah');
        }
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->delete();
            DB::commit();
            return to_route('user.index')->withSuccess('Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('user.index')->withError('Data gagal dihapus');
        }
    }
}