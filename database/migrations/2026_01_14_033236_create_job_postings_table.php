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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')->constrained('perusahaans')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('deskripsi');
            $table->text('syarat');
            $table->string('tipe_pekerjaan'); // Full Time/Part Time
            $table->bigInteger('gaji_min')->nullable();
            $table->bigInteger('gaji_max')->nullable();
            $table->string('lokasi');
            $table->enum('status', ['buka', 'tutup'])->default('buka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
