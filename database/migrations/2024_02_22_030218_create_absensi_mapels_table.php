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
        Schema::create('absensi_mapels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('class');
            $table->string('departement');
            $table->enum('attendance', ['hadir', 'izin', 'sakit', 'alfa']);
            $table->text('mapel');
            $table->text('reason')->nullable();
            $table->dateTime('date_time')->nullable()->comment('Waktu absen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_mapels');
    }
};
