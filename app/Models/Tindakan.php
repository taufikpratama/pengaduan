<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $guarded = [];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    public function personil1()
    {
        return $this->belongsTo(User::class, 'personil1_id');
    }

    public function personil2()
    {
        return $this->belongsTo(User::class, 'personil2_id');
    }

    public function personil3()
    {
        return $this->belongsTo(User::class, 'personil3_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function laporan()
    {
        return $this->hasOne(Tindakan::class);
    }

    public function uploadLaporan($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('laporan', $fileName);

        // Menggunakan relasi hasOne untuk menyimpan laporan
        $laporan = $this->laporan()->create([
            'file_path' => $filePath,
        ]);

        return $laporan;
    }
}
