@extends('dashboard')

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
           <h3 style="color: #6c80c4;">Daftar Pengaduan</h3>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                @if ($pengaduans->isEmpty())
                    <p class="p-4">Tidak ada pengaduan yang ditemukan.</p>
                @else
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Judul</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioritas</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi Tindakan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Personil</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Laporan Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduans as $pengaduan)
                                @if (!$pengaduan->tindakans->isEmpty() && $pengaduan->tindakans->first()->status == 'selesai')
                                    <tr>
                                        <td>{{ $pengaduan->nama }}</td>
                                        <td>{{ $pengaduan->judul }}</td>
                                        <td>{{ $pengaduan->deskripsi }}</td>
                                        <td>{{ $pengaduan->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if($pengaduan->foto_bukti)
                                                <img src="{{ asset('images/' . $pengaduan->foto_bukti) }}" alt="Foto Bukti" style="max-width: 100px; max-height: 100px;">
                                            @else
                                                Tidak ada foto bukti
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($pengaduan->status) }}</td>
                                        <td>{{ ucfirst($pengaduan->prioritas) }}</td>
                                        <td>{{ $pengaduan->tindakans->first()->deskripsi_tindakan }}</td>
                                        <td>{{ $pengaduan->tindakans->first()->jumlah_personil }}</td>
                                        <td>{{ ucfirst($pengaduan->status) }}</td>
                                        <td>{{ ucfirst($pengaduan->prioritas) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
