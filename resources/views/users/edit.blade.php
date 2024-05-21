@extends('dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Gunakan method PUT untuk update -->

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <small class="text-muted">Isi hanya jika ingin mengganti password</small>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="masyarakat" {{ $user->role === 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                        <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="departemen" {{ $user->role === 'departemen' ? 'selected' : '' }}>Departemen</option>
                        <option value="anggota" {{ $user->role === 'anggota' ? 'selected' : '' }}>Anggota</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
