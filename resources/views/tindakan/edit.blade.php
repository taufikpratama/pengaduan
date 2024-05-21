@extends('dashboard')

@section('content')
    <h2 style="color: #fffffffa;">Edit Tindakan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.tindakan.update', ['pengaduan' => $pengaduan->id, 'tindakan' => $tindakan->id]) }}" method="POST" enctype="multipart/form-data">        
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama" style="color: white;">Nama Pelapor:</label>
            <input type="text" id="nama" name="nama" value="{{ $pengaduan->nama }}" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="email" style="color: white;">Email:</label>
            <input type="email" id="email" name="email" value="{{ $pengaduan->email }}" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="telepon">Nomor Telepon:</label>
            <input type="text" id="telepon" name="telepon" value="{{ $pengaduan->telepon }}" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="jenis_pengaduan">Jenis Pengaduan:</label>
            <input type="text" id="jenis_pengaduan" name="jenis_pengaduan" value="{{ $pengaduan->jenis_pengaduan }}" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="judul">Judul Pengaduan:</label>
            <input type="text" id="judul" name="judul" value="{{ $pengaduan->judul }}" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Pengaduan:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" readonly>{{ $pengaduan->deskripsi }}</textarea>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi Tindakan:</label>
            <textarea id="deskripsi_tindakan" name="deskripsi_tindakan" class="form-control" rows="5" readonly>{{ $tindakan->deskripsi_tindakan }}</textarea>
        </div>

        @if ($tindakan->jumlah_personil === null)
        <div class="form-group">
            <label for="jumlah_personil">Jumlah Personil:</label>
            <input type="number" id="jumlah_personil" name="jumlah_personil" class="form-control">
        </div>
        @endif
    
        <div class="form-group">
            <label for="laporan_progress">Laporan Progress:</label>
            <input type="file" id="laporan_progress" name="laporan_progress" class="form-control-file">
        </div>
        
        <div id="personil_fields"></div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pengaduan.tindakan.show') }}" class="btn btn-secondary">Batal</a>
    </form>

    <script>
        document.getElementById('jumlah_personil').addEventListener('input', function() {
            var jumlahPersonil = parseInt(this.value);
            var personilFields = document.getElementById('personil_fields');
    
            // Clear existing personnel fields
            personilFields.innerHTML = '';
    
            // Generate personnel selection fields based on the chosen number of personnel
            for (var i = 1; i <= jumlahPersonil; i++) {
                var div = document.createElement('div');
                div.classList.add('form-group');
    
                var label = document.createElement('label');
                label.setAttribute('for', 'personil' + i + '_id');
                label.textContent = 'Personil ' + i;
    
                var select = document.createElement('select');
                select.classList.add('form-control');
                select.setAttribute('id', 'personil' + i + '_id');
                select.setAttribute('name', 'personil_ids[]');
    
                // Add an empty option for default selection
                var emptyOption = document.createElement('option');
                emptyOption.setAttribute('value', '');
                emptyOption.textContent = 'Pilih Personil';
                select.appendChild(emptyOption);
    
                // Add options for personnel selection
                @foreach($users as $user)
                    @if($user->isAnggota())
                        var option = document.createElement('option');
                        option.setAttribute('value', '{{ $user->id }}');
                        option.textContent = '{{ $user->name }}';
                        select.appendChild(option);
                    @endif
                @endforeach
    
                div.appendChild(label);
                div.appendChild(select);
                personilFields.appendChild(div);
            }
        });
    </script>
    
@endsection
