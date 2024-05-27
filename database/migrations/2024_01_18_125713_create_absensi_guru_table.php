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
        Schema::create('absensi_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_guru_id')->references('id')->on('data_guru');
            $table->enum('attendance', ['hadir', 'izin', 'sakit', 'alfa']);
            $table->text('reason')->nullable();
            $table->dateTime('time')->nullable()->comment('Waktu absen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_guru');
    }
};
