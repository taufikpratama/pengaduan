@extends('dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Jenis Pengaduan</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('jenis-pengaduan.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Jenis Pengaduan</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required autofocus>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Daftar Jenis Pengaduan</div>

                    <div class="card-body">
                        @if ($jenisPengaduans->isEmpty())
                            <p>Tidak ada jenis pengaduan yang tersedia.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @foreach ($jenisPengaduans as $jenisPengaduan)
                                        <tr>
                                            <td>{{ $jenisPengaduan->id }}</td>
                                            <td>{{ $jenisPengaduan->nama }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('jenis-pengaduan.destroy', $jenisPengaduan->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jenis pengaduan ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
