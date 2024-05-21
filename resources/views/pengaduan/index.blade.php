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
                                @auth
                                    @if(auth()->user()->isMasyarakat())
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Komentar</th>
                                    @endif
                                @endauth
                                @auth
                                    @if(auth()->user()->isPetugas())
                                        <th class="text-secondary opacity-7">Aksi</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduans as $pengaduan)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $pengaduan->nama }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $pengaduan->judul }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0">{{ $pengaduan->deskripsi }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $pengaduan->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($pengaduan->foto_bukti)
                                            <img src="{{ asset('images/' . $pengaduan->foto_bukti) }}" alt="Foto Bukti" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            <p class="text-xs text-secondary mb-0">Tidak ada foto bukti</p>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm {{ $pengaduan->status == 'online' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">{{ ucfirst($pengaduan->status) }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm {{ $pengaduan->prioritas == 'online' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">{{ ucfirst($pengaduan->prioritas) }}</span>
                                    </td>
                                    @auth
                                        @if(auth()->user()->isMasyarakat())
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $pengaduan->komentar }}</p>
                                            </td>
                                        @endif
                                    @endauth
                                    @auth
                                        @if(auth()->user()->isAdmin() || auth()->user()->isPetugas())
                                            <td class="align-middle">
                                                @if ($pengaduan->tindakans->isEmpty())
                                                    <a href="{{ route('pengaduan.edit', $pengaduan->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit pengaduan">Lihat & Edit</a>
                                                    @if($pengaduan->prioritas == 'sangat penting' || $pengaduan->prioritas == 'penting')
                                                        <a href="{{ route('pengaduan.tindakan.create', $pengaduan->id) }}" class="text-secondary font-weight-bold text-xs ms-3" data-toggle="tooltip" data-original-title="Tindakan">Tindakan</a>
                                                    @endif
                                                    <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0 ms-3" data-toggle="tooltip" data-original-title="Hapus pengaduan">Hapus</button>
                                                    </form>
                                                @else
                                                    @if ($pengaduan->tindakans->first()->status == 'selesai')
                                                        <a href="{{ route('pengaduan.edit', $pengaduan->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit pengaduan">Selesaikan</a>
                                                    @else
                                                        <p>Sedang ada tindakan!</p>
                                                    @endif
                                                @endif
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    @foreach ($pengaduans as $pengaduan)
        <script>
            $(document).ready(function() {
                $('#prioritasDropdown{{ $pengaduan->id }}').change(function() {
                    var prioritas = $(this).val();
                    var pengaduan_id = {{ $pengaduan->id }};
                    
                    // Kirim data ke server
                    $.ajax({
                        type: 'PUT',
                        url: '/pengaduan/' + pengaduan_id,
                        data: {
                            _token: '{{ csrf_token() }}',
                            prioritas: prioritas
                        },
                        success: function(response) {
                            // Refresh halaman setelah berhasil
                            location.reload();
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endforeach
@endsection
