<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of the users.
    public function index()
{
    $users = User::orderByRaw("CASE 
                            WHEN role = 'admin' THEN 1 
                            WHEN role = 'petugas' THEN 2 
                            WHEN role = 'departemen' THEN 3 
                            WHEN role = 'anggota' THEN 4 
                            WHEN role = 'masyarakat' THEN 5 
                            ELSE 6 
                        END, role ASC")->get();

    return view('users.index', compact('users'));
}

    // Show the form for creating a new user.
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8', // Perbaiki validasi password
            'role' => 'required|in:user,admin,petugas,departemen,masyarakat,anggota' // Validasi role
        ]);
    
        // Buat pengguna baru dengan role
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Enkripsi password menggunakan Hash
            'role' => $request->input('role') // Tambahkan role
        ]);
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    

    // Show the form for editing the specified user.
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified user in the database.
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8', // password bersifat opsional
            'role' => 'required|string|in:user,admin,petugas,departemen,masyarakat,anggota', // validasi role
        ]);
    
        // Update data pengguna
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role']; // update peran (role) pengguna
    
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }
    
        $user->save();
    
        // Redirect ke halaman lain atau tindakan lain setelah berhasil update
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }
    

    // Remove the specified user from the database.
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
