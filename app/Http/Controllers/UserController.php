<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'username' => 'required|string|max:50|unique:users,username',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:admin,karyawan', // Validasi role
    ]);

    // Debugging: Cek data yang akan disimpan
    \Log::info($validated);
    \Log::info('Data yang diterima:', $request->all());


    // Menyimpan data user
    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'username' => $validated['username'],
        'password' => bcrypt($validated['password']),
        'role' => $validated['role'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
}

    public function edit($id_user)
{
    $user = User::find($id_user);
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id_user)
    {
        // Mencari user berdasarkan id_user
        $user = User::find($id_user);

        // Jika user tidak ditemukan
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan');
        }

        // Validasi input yang sesuai dengan validasi pada metode store
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user', // Tambahkan id_user di akhir
            'username' => 'required|unique:users,username,' . $user->id_user . ',id_user',
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,karyawan',
        ]);


        // Memperbarui data pengguna sesuai input yang telah divalidasi
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->username = $validated['username'];
        $user->role = $validated['role'];  // Menambahkan role

        // Mengupdate password jika diisi
        if ($request->password) {
            $user->password = bcrypt($validated['password']);
        }

        // Menyimpan perubahan data
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui');
    }


public function show($id_user)
{
    $user = User::findOrFail($id_user);

    // Cek apakah yang login adalah karyawan dan hanya boleh melihat data mereka sendiri
    if (auth()->user()->role == 'karyawan' && auth()->user()->id_user != $id_user) {
        return redirect()->route('users.show', auth()->user()->id_user);
    }

    return view('users.show', compact('user'));
}



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
