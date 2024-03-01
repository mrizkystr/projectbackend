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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_siswa_id')->references('id')->on('data_siswas');
            $table->integer('class');
            $table->string('departement');
            $table->enum('attendance', ['hadir', 'izin', 'sakit', 'alfa']);
            $table->text('reason');
            $table->dateTime('date_time')->nullable()->comment('Waktu absen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
