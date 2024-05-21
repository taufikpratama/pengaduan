@extends('dashboard')

@section('content')
    <h3 class="font-weight-border text-white">Ajukan Pengaduan</h3>
    <form id="pengaduanForm"  action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama" style="color: white;">Nama Pelapor</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::user()->name }}" readonly>
        </div>
              
        <div class="form-group">
            <label for="email"style="color: white;">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telepon">Nomor Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>
        <div class="form-group">
            <label for="jenis_pengaduan">Jenis Pengaduan</label>
            <select class="form-control" id="jenis_pengaduan" name="jenis_pengaduan" required onchange="toggleForm()">
                <option value="" selected disabled>Pilih Jenis Pengaduan</option>
                <option value="keamanan">Keamanan</option>
                <option value="infrastruktur">Infrastruktur</option>
                <option value="lingkungan">Lingkungan</option>
                <option value="kenyamanan">Kenyamanan Masyarakat</option>
                <!-- Tambahkan jenis pengaduan lainnya jika diperlukan -->
            </select>
        </div>
        <div class="form-group">
            <label for="judul">Judul Pengaduan</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi Pengaduan</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
        </div>
        @auth
        @if(auth()->user()->isPetugas())
        <div class="form-group">
            <label for="prioritas">Prioritas</label>
            <select class="form-control" id="prioritas" name="prioritas" required>
                
                <option value="rendah">Rendah</option>
                <option value="sedang">Sedang</option>
                <option value="tinggi">Tinggi</option>
            </select>
        </div>
        @endif
        @endauth
        {{-- Form tambahan untuk jenis pengaduan --}}
        <div id="form_keamanan" class="form-group d-none">
            <label for="lokasi_kejadian">Lokasi Kejadian</label>
            <input type="text" class="form-control" id="lokasi_kejadian" name="lokasi_kejadian" required>
        
            <label for="jenis_kejadian">Jenis Kejadian</label>
            <input type="text" class="form-control" id="jenis_kejadian" name="jenis_kejadian" required>
        </div>
        
        <div id="form_infrastruktur" class="form-group d-none">
            <label for="lokasi_masalah">Lokasi Masalah Infrastruktur</label>
            <input type="text" class="form-control" id="lokasi_masalah" name="lokasi_masalah" required>
        
            <label for="jenis_infrastruktur">Jenis Infrastruktur</label>
            <select class="form-control" id="jenis_infrastruktur" name="jenis_infrastruktur" required>
                <option value="">Pilih Jenis Infrastruktur</option>
                <option value="jalan">Jalan</option>
                <option value="jembatan">Jembatan</option>
                <option value="saluran_air">Saluran Air</option>
                <!-- Tambahkan jenis infrastruktur lainnya jika diperlukan -->
            </select>
        </div>
        
        <div id="form_lingkungan" class="form-group d-none">
            <label for="lokasi_masalah_lingkungan">Lokasi Masalah Lingkungan</label>
            <input type="text" class="form-control" id="lokasi_masalah_lingkungan" name="lokasi_masalah_lingkungan" required>
        
            <label for="jenis_masalah_lingkungan">Jenis Masalah Lingkungan</label>
            <textarea class="form-control" id="jenis_masalah_lingkungan" name="jenis_masalah_lingkungan" rows="3" required></textarea>
        </div>
        
        <div id="form_kenyamanan" class="form-group d-none">
            <label for="lokasi_masalah_kenyamanan">Lokasi Masalah Kenyamanan Masyarakat</label>
            <input type="text" class="form-control" id="lokasi_masalah_kenyamanan" name="lokasi_masalah_kenyamanan" required>
        
            <label for="jenis_masalah_kenyamanan">Jenis Masalah Kenyamanan Masyarakat</label>
            <textarea class="form-control" id="jenis_masalah_kenyamanan" name="jenis_masalah_kenyamanan" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="foto_bukti">Unggah Foto Bukti</label>
            <input type="file" class="form-control-file" id="foto_bukti" name="foto_bukti" accept="image/*" required>
        </div>
        <div id="imagePreview" class="mt-3" style="display: none;">
            <h2>Pratinjau Gambar</h2>
            <img id="preview" src="#" alt="Pratinjau Gambar" style="max-width: 200px; max-height: 200px;">
        </div>
        
        <button type="button" class="btn btn-primary" onclick="submitForm()">Ajukan Pengaduan</button>
    </form>

        @if(isset($pengaduan) && $pengaduan->foto_bukti)
        <div>
            <h2>Gambar Bukti</h2>
            <img src="{{ asset('images/' . $pengaduan->foto_bukti) }}" alt="Foto Bukti">
        </div>
    @endif
    <script>
        function previewImage(input) {
            var preview = document.getElementById('preview');
            var imagePreview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
                imagePreview.style.display = 'block';
            } else {
                preview.src = '#';
                imagePreview.style.display = 'none';
            }
        }
    </script>

    <script>
        
        function submitForm() {
            console.log('Form submitted');
            var form = document.getElementById('pengaduanForm');
            form.submit();
        }
    </script>

    <script>

    function submitForm() {
        console.log('Form submitted'); // Tambahkan ini
        // Dapatkan referensi ke formulir
        var form = document.getElementById('pengaduanForm');
        // Kirim formulir
        form.submit();

    }
        // Tampilkan form tambahan berdasarkan jenis pengaduan yang dipilih
        document.getElementById('jenis_pengaduan').addEventListener('change', function() {
            var jenisPengaduan = this.value;
            var forms = document.querySelectorAll('.form-group[id^="form_"]');
            forms.forEach(function(form) {
                form.classList.add('d-none');
            });
            document.getElementById('form_' + jenisPengaduan).classList.remove('d-none');
        });
    </script>
@endsection
