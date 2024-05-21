@extends('dashboard')

@section('content')
    <div class="container">
        <h3 class="font-weight-border text-white mb-4">Tindakan untuk Pengaduan</h3>

        <div class="card">
            <div class="card-header pb-0">
                <h3 class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Pengaduan Table</h3>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Pengaduan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi Pengaduan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi Tindakan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat Pada</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Personil</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tindakans as $index => $tindakan)
                            @if ($tindakan->status === null)
                                    <tr>
                                        <td class="align-middle text-center">{{ $index + 1 }}</td>
                                        <td class="align-middle">{{ $tindakan->pengaduan->nama }}</td>
                                        <td class="align-middle">{{ $tindakan->pengaduan->jenis_pengaduan }}</td>
                                        <td class="align-middle">{{ $tindakan->pengaduan->judul }}</td>
                                        <td class="align-middle">{{ $tindakan->pengaduan->deskripsi }}</td>
                                        <td class="align-middle">{{ $tindakan->deskripsi_tindakan }}</td>
                                        <td class="align-middle">{{ $tindakan->created_at->format('d M Y H:i') }}</td>
                                        <td class="align-middle">{{ $tindakan->jumlah_personil }}</td>
                                        <td class="align-middle">
                                            @if(auth()->user()->isDepartemen() || auth()->user()->isPetugas())
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('pengaduan.tindakan.edit', ['pengaduan' => $tindakan->pengaduan->id, 'tindakan' => $tindakan->id]) }}" class="btn btn-primary mr-2">Edit</a>
                                                    <form action="{{ route('pengaduan.tindakan.selesai', ['pengaduan' => $tindakan->pengaduan->id, 'tindakan' => $tindakan->id]) }}" method="POST">
                                                        @csrf
                                                        @method('POST') <!-- Sesuaikan metode dengan yang diharapkan -->
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan tindakan ini?')">Selesai</button>
                                                    </form>                                   
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali ke Daftar Pengaduan</a>
            </div>
        </div>
    </div>
@endsection
