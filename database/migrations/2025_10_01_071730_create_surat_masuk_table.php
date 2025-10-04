<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim', 100);
            $table->string('no_surat', 50)->unique();
            $table->string('perihal', 150);
            $table->date('tanggal_surat');
            $table->date('tanggal_masuk');
            $table->string('file_upload')->nullable(); // untuk simpan nama file upload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
