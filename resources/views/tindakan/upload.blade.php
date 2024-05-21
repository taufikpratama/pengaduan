@extends('dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Laporan</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tindakan.uploadLaporan', ['pengaduanId' => $pengaduan->id, 'tindakanId' => $tindakan->id]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="laporan_file">Pilih File Laporan (PDF, DOC, DOCX)</label>
                                <input id="laporan_file" type="file" class="form-control @error('laporan_file') is-invalid @enderror" name="laporan_file" required>

                                @error('laporan_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
