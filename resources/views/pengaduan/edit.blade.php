@extends('dashboard')

@section('content')
<h2 style="color: #f8f8f8ee;">Edit Pengaduan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nama">Nama Pelapor</label>
            <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
        </div>

        <div class="form-group">
            <label for="telepon">Nomor Telepon</label>
            <input type="text" name="telepon" class="form-control" value="{{ $data->telepon }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_pengaduan">Jenis Pengaduan</label>
            <input type="text" name="jenis_pengaduan" class="form-control" value="{{ $data->jenis_pengaduan }}" required>
        </div>

        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $data->judul }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="5" required>{{ $data->deskripsi }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="foto_bukti">Foto Bukti</label>
            <img src="{{ asset('images/' . $data->foto_bukti) }}" alt="Foto Bukti" class="img-fluid" style="max-width: 500px; max-height: 500px;">
        </div>        
        @auth
        @if(auth()->user()->isPetugas() || auth()->user()->isAdmin())
        <div class="form-group">
            <label for="prioritas">Prioritas</label>
            <select name="prioritas" id="prioritas" class="form-control" required>
                <option value="proses" {{ $data->prioritas == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="sangat penting" {{ $data->prioritas == 'sangat penting' ? 'selected' : '' }}>Sangat Penting</option>
                <option value="penting" {{ $data->prioritas == 'penting' ? 'selected' : '' }}>Penting</option>
                <option value="cukup penting" {{ $data->prioritas == 'cukup penting' ? 'selected' : '' }}>Cukup Penting</option>
                <option value="kurang penting" {{ $data->prioritas == 'kurang penting' ? 'selected' : '' }}>Kurang Penting</option>
            </select>
        </div>
        @endif
        @endauth

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $data->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="resolved" {{ $data->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>
        <div class="form-group" id="komentar-group" style="{{ $data->Komentar == 'resolved' ? 'display: block;' : 'display: none;' }}">
            <label for="komentar">Komentar</label>
            <textarea name="Komentar" id="Komentar" class="form-control" rows="5">{{ $data->Komentar }}</textarea>
        </div>
          
        <div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
    <script>
        document.getElementById('status').addEventListener('change', function () {
            var komentarGroup = document.getElementById('komentar-group');
            if (this.value === 'resolved') {
                komentarGroup.style.display = 'block';
            } else {
                komentarGroup.style.display = 'none';
            }
        });
    
        // Trigger change event on page load to ensure proper state
        document.getElementById('status').dispatchEvent(new Event('change'));
    </script>
@endsection
