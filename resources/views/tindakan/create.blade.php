@extends('dashboard')

@section('content')
    <h1 style="color: aliceblue">Tindakan untuk Pengaduan "{{ $pengaduan->judul }}"</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tambahkan kondisi untuk menyembunyikan pengaduan --}}
    @if($pengaduan->prioritas == 'sangat penting' || $pengaduan->prioritas == 'penting')
        <form action="{{ route('pengaduan.tindakan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
            <div class="form-group">
                <label for="deskripsi_tindakan" style="color: aliceblue">Deskripsi Tindakan</label>
                <textarea class="form-control" id="deskripsi_tindakan" name="deskripsi_tindakan" rows="5" required></textarea>
            </div>
            <div class="form-group">
                {{-- <label for="jumlah_personil">Jumlah Personil</label>
                <input type="number" class="form-control" id="jumlah_personil" name="jumlah_personil" required>
            </div> --}}
            <!-- Tambahkan input lainnya sesuai kebutuhan -->

            <button type="submit" class="btn btn-primary">Kirim Tindakan</button>
        </form>
    @else
        <div class="alert alert-warning" role="alert">
            Pengaduan tidak dapat ditindaklanjuti karena prioritasnya tidak termasuk dalam kategori "sangat penting" atau "penting".
        </div>
    @endif
@endsection
