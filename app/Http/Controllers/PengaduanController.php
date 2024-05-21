<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tindakan;
use App\Models\User;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    // Display a listing of the resource
   // Display a listing of the resource
    public function index()
    {
        $pengaduans = Pengaduan::where('status', '!=', 'Tindakan Diajukan')
            ->orderByRaw("CASE 
                            WHEN prioritas = 'proses' THEN 1 
                            WHEN prioritas = 'sangat penting' THEN 2 
                            WHEN prioritas = 'penting' THEN 3 
                            WHEN prioritas = 'cukup penting' THEN 4 
                            WHEN prioritas = 'kurang penting' THEN 5 
                            ELSE 6 
                        END, prioritas ASC")->paginate(10);

        return view('pengaduan.index', compact('pengaduans'));
    }
    public function selesai()
    {
        $users = User::all();
        $pengaduans = Pengaduan::all();
        $tindakans = Tindakan::all();
        
        // Anda dapat melakukan sesuatu dengan data yang Anda ambil di sini,
        // misalnya, Anda dapat mengirimnya ke view.
        
        return view('pengaduan.selesai', compact('users', 'pengaduans', 'tindakans'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('pengaduan.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
{
    // Simpan pengaduan ke dalam database
    $pengaduan = Pengaduan::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'jenis_pengaduan' => $request->jenis_pengaduan,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'lokasi_kejadian' => $request->lokasi_kejadian,
        'jenis_kejadian' => $request->jenis_kejadian,
        'lokasi_masalah' => $request->lokasi_masalah,
        'jenis_infrastruktur' => $request->jenis_infrastruktur,
        'lokasi_masalah_lingkungan' => $request->lokasi_masalah_lingkungan,
        'jenis_masalah_lingkungan' => $request->jenis_masalah_lingkungan,
        'lokasi_masalah_kenyamanan' => $request->lokasi_masalah_kenyamanan,
        'jenis_masalah_kenyamanan' => $request->jenis_masalah_kenyamanan,
        'status' => 'Pending',
        'prioritas' => 'Proses',
        'komentar' => $request->komentar,
        'user_id' => auth()->id(),
    ]);

    if ($request->hasFile('foto_bukti')) {
        $image = $request->file('foto_bukti');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName); // Ganti path sesuai dengan direktori yang diinginkan
        $pengaduan->foto_bukti = $imageName; // Simpan nama gambar ke dalam database
        $pengaduan->save();
    }

    // Redirect dengan pesan sukses
    return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diajukan.');
}
    

    // Display the specified resource
    public function show(Pengaduan $pengaduans)
    {
        return view('pengaduan.show', compact('pengaduans'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $data = Pengaduan::find($id);
        $tindakan = $data->tindakan;
        $user = User::all();

        $komentar = null;
        if ($data->status === 'resolved') {
            $komentar = $data->komentar;
        }
        return view('pengaduan.edit', compact('data','tindakan','user'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
       $data = Pengaduan::find($id);
       $data->update($request->all());

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function send(Request $request, $pengaduanId, $tindakanId)
{
    try {
        // Lakukan operasi pengiriman tindakan menggunakan $pengaduanId dan $tindakanId
        
        // Update status pengaduan menjadi "Selesai"
        $pengaduanController = new PengaduanController();
        $pengaduanController->updateStatus($pengaduanId, 'Selesai');
        
        return redirect()->route('pengaduan.selesai', $pengaduanId)->with('success', 'Tindakan berhasil dikirim dan pengaduan telah ditandai sebagai selesai.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal mengirim tindakan. Silakan coba lagi.');
    }
}

public function hasil($pengaduanId)
{
    // Ambil data pengaduan berdasarkan ID
    $pengaduan = Pengaduan::findOrFail($pengaduanId);
    
    // Kemudian, kembalikan view 'pengaduan.hasil' sambil menyertakan data pengaduan
    return view('pengaduan.selesai', compact('pengaduan'));
}


    // Remove the specified resource from storage
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
    }
}
