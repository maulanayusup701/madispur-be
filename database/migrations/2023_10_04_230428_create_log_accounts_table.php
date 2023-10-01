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
        Schema::create('log_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('ip_address');
            $table->string('status');
            $table->string('browser');
            $table->string('os');
            $table->string('device');
            $table->timestamp('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_accounts');
    }
};
