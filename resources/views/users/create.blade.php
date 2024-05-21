@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-8 col-md-10">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Create User</h5>
                </div>
                <div class="card-body px-4">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <select id="role" name="role" class="form-seslect" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="departemen">Departemen</option>
                                <option value="masyarakat">Masyarakat</option>
                                <option value="masyarakat">Anggota</option>
                            </select>
                        </div>

                        <button type="submit" class="btn bg-gradient-dark w-100 my-4">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
