@extends('dashboard')

@section('content')
@auth
@if(auth()->user()->isPetugas())
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 style="color: #fffffffb;">Daftar Pengguna </h3>
    </div>
@endif
@endauth
    @if ($users->isEmpty())
        <p>Tidak ada pengguna yang ditemukan.</p>
    @else
        <div class="card mb-4">
            <div class="card-header pb-0">
              <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ">Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ">Role</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>
                              @auth
                                  @if(auth()->user()->isPetugas())
                                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                      <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                      </form>
                                  @endif
                              @endauth
                          </td>
                          
                        </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
            </div>
          </div>
    @endif
@endsection
