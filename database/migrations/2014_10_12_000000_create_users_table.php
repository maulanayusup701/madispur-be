<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username', 255)->unique();
            $table->string('nama_lengkap', 255);
            $table->bigInteger('no_handphone');
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->string('alamat_lengkap', 255);
            $table->bigInteger('NIK')->nullable();
            $table->string('nama_kampus/sekolah', 255)->nullable();
            $table->string('NIM', 255)->nullable();
            $table->string('NISN', 255)->nullable();
            $table->string('jurusan/prodi', 13)->nullable();
            $table->bigInteger('kelas/semester')->nullable();
            $table->string('Keperluan')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->foreignId('role_id');
            $table->timestamp('login_terakhir')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
