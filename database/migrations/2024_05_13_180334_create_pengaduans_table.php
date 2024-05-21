<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->string('jenis_pengaduan');
            $table->text('deskripsi');
            $table->unsignedBigInteger('user_id'); // ID pengguna yang membuat pengaduan
            $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
            $table->string('lokasi_kejadian')->nullable(); // Kolom yang dibuat menjadi opsional
            $table->string('jenis_kejadian')->nullable(); // Kolom yang dibuat menjadi opsional
            $table->string('lokasi_masalah')->nullable(); // Kolom yang dibuat menjadi opsional
            $table->enum('jenis_infrastruktur', ['jalan', 'jembatan', 'saluran_air'])->nullable();
            $table->string('lokasi_masalah_lingkungan')->nullable(); // Kolom yang dibuat menjadi opsional
            $table->text('jenis_masalah_lingkungan')->nullable(); // Kolom yang dibuat menjadi opsional
            $table->string('lokasi_masalah_kenyamanan')->nullable(); // Kolom yang dibuat menjadi opsional
            $table->text('jenis_masalah_kenyamanan')->nullable(); // Kolom yang dibuat menjadi opsional
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('hasil_tindakan')->nullable();
        });
    }

    public function down()
{
    Schema::dropIfExists('pengaduans');
}

}
