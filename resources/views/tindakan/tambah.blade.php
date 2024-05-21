@extends('dashboard')

@section('content')
    <h1>Tambah Jumlah Personil untuk Tindakan pada Pengaduan "{{ $pengaduan->judul }}"</h1>

    <form action="{{ route('pengaduan.tindakan.store') }}" method="POST">
        @csrf
    
        <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
    
        @for($i = 1; $i <= 3; $i++)
            <div class="form-group">
                <label for="personil{{ $i }}_id">Personil {{ $i }}</label>
                <select class="form-control" id="personil{{ $i }}_id" name="personil{{ $i }}_id">
                    @foreach($users as $user)
                        @if($user->isAnggota())
                            <option value="{{ $user->id }}">{{ $user->name }} (ID: {{ $user->id }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
        @endfor
    
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    
    <a href="{{ route('pengaduan.tindakan.show', ['pengaduan' => $pengaduan->id]) }}" class="btn btn-secondary mt-2">Kembali</a>
@endsection
