<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tindakan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TindakanController extends Controller
{
    public function show(Pengaduan $pengaduan)
{
    $tindakan = Tindakan::all();
    $tindakans = Tindakan::latest()->get(); // Mengambil semua tindakan yang terkait dengan pengaduan
    return view('tindakan.show', compact('pengaduan', 'tindakans'));
}

    public function create($pengaduanId)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduanId);
        $users = User::where('role', 'anggota')->get();
        return view('tindakan.create', compact('pengaduan', 'users'));
    }
        public function tambah($pengaduanId)
    {
        // Ambil data pengaduan berdasarkan ID yang diberikan
        $pengaduan = Pengaduan::findOrFail($pengaduanId);

        // Ambil semua pengguna yang merupakan anggota (isAnggota)
        $users = User::where('role', 'anggota')->get();

        // Kembalikan view 'tindakan.tambah' sambil menyertakan data pengaduan dan pengguna yang merupakan anggota
        return view('tindakan.tambah', compact('pengaduan', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'exists:pengaduans,id',
            'deskripsi_tindakan' => 'required',
            'status' => '',
            'jumlah_personil' => 'integer|min:1',
            'personil_ids' => 'array|min:' . $request->jumlah_personil,
            'personil_ids.*' => 'exists:users,id',
            'laporan_progress' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'personil_ids.required' => 'Pilih minimal satu personil yang terlibat.'
        ]);
    
        try {
            // Begin transaction
            DB::beginTransaction();
    
            // Simpan data tindakan baru
            $tindakan = new Tindakan;
            $tindakan->pengaduan_id = $request->pengaduan_id;
            $tindakan->deskripsi_tindakan = $request->deskripsi_tindakan; 
            $tindakan->jumlah_personil = $request->jumlah_personil;
    
            // Ambil nama pengguna dari opsi dropdown dan simpan dalam kolom 'personil1_name', 'personil2_name', dan 'personil3_name'
            for ($i = 0; $i < $request->jumlah_personil; $i++) {
                $user = User::findOrFail($request->personil_ids[$i]);
                $tindakan->{'personil'.($i+1).'_name'} = $user->name;
            }
    
            $tindakan->save();  
            // Commit transaction
            DB::commit();
    
            return redirect()->route('pengaduan.index')->with('success', 'Tindakan berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollback();
    
            // Redirect kembali ke halaman sebelumnya dengan input sebelumnya dan pesan error
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan tindakan. Silakan coba lagi.');
        }
    }
    

    public function edit($pengaduanId, $tindakanId)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduanId);
    
        $tindakan = Tindakan::findOrFail($tindakanId);
    
        $users = User::where('role', 'anggota')->get();
    
        return view('tindakan.edit', compact('pengaduan', 'tindakan', 'users'));
    }
    

        public function update(Request $request, $pengaduanId, $tindakanId)
    {
        try {
            $tindakan = Tindakan::findOrFail($tindakanId);
            $tindakan->jumlah_personil = $request->jumlah_personil;

            // Simpan ID personil ke dalam kolom yang sesuai dalam tabel tindakan
            for ($i = 1; $i <= $request->jumlah_personil; $i++) {
                $tindakan->{'personil'.$i.'_id'} = $request->personil_ids[$i-1];
            }
            if ($request->hasFile('laporan_progress')) {
                $file = $request->file('laporan_progress');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('laporan', $fileName);
                $tindakan->laporan_progress = $filePath;
            }

            $tindakan->save();

            return redirect()->route('pengaduan.tindakan.show', $pengaduanId)
                            ->with('success', 'Deskripsi tindakan pada pengaduan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui tindakan. Silakan coba lagi.');
        }
    }

    public function uploadLaporan(Request $request, $pengaduanId, $tindakanId)
    {
        $request->validate([
            'laporan_file' => 'required|file|mimes:pdf,doc,docx|max:10240', // Atur validasi sesuai kebutuhan Anda
        ]);

        try {
            // Temukan tindakan berdasarkan ID
            $tindakan = Tindakan::findOrFail($tindakanId);

            // Proses upload laporan
            $file = $request->file('laporan_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('laporan', $fileName);

            // Simpan informasi laporan ke dalam model Tindakan
            $tindakan->laporan()->create([
                'file_path' => $filePath,
            ]);

            return redirect()->back()->with('success', 'Laporan berhasil diupload.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload laporan. Silakan coba lagi.');
        }
    }

    public function selesaiTindakan(Request $request, $pengaduanId, $tindakanId) {
        // Temukan pengaduan dan tindakan yang sesuai
        $pengaduan = Pengaduan::findOrFail($pengaduanId); // Menggunakan findOrFail untuk menangani jika tidak ditemukan
        $tindakan = Tindakan::findOrFail($tindakanId); // Menggunakan findOrFail untuk menangani jika tidak ditemukan
        
        // Lakukan pembaruan status tindakan
        $tindakan->status = 'selesai'; // Misalnya, asumsikan ada kolom 'status' dalam tabel tindakan yang menunjukkan status tindakan
        
        // Simpan perubahan tindakan
        $tindakan->save();

        return redirect()->route('pengaduan.show', $pengaduan);
        
    }
    

    public function destroy($pengaduanId, $tindakanId)
    {
        $tindakan = Tindakan::findOrFail($tindakanId);
        $tindakan->delete();

        return redirect()->route('pengaduan.tindakan.show', $pengaduanId)
                        ->with('success', 'Tindakan berhasil dihapus');
    }
}
