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
Schema::create('pesertas', function (Blueprint $table) {
    $table->id();

    $table->foreignId('periode_id')
        ->constrained('periodes')
        ->cascadeOnDelete();

    $table->string('nama');
    $table->string('institusi');
    $table->string('jurusan');
    $table->string('pembimbing');
    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai');
    $table->enum('status', ['aktif', 'selesai'])->default('aktif');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
