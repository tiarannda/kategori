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
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id_user)
{
    $user = User::find($id_user);
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id_user)
{
    $user = User::find($id_user);

    // Validasi
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id_user,
        'mobile' => 'required|string|max:20',
        'position' => 'required|string|max:255',
        'gender' => 'required|in:M,F',
        'password' => 'nullable|min:6|confirmed',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update data pengguna
    $user->name = $request->name;
    $user->email = $request->email;
    $user->username = $request->username;
    $user->mobile = $request->mobile;
    $user->position = $request->position;
    $user->gender = $request->gender;

    // Update foto jika ada
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        // Simpan foto baru
        $path = $request->file('photo')->store('photos', 'public');
        $user->photo = $path;
    }

    // Update password jika diisi
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui');
}



public function show($id_user)
{
    // Mengambil data user berdasarkan ID
    $user = User::findOrFail($id_user);

    // Mengirimkan data user ke view
    return view('users.show', compact('user'));
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
