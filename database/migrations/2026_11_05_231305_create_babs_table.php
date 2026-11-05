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
        Schema::create('babs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cerita_id')->constrained('ceritas')->cascadeOnDelete();
            $table->unsignedInteger('nomor');
            $table->string('judul');
            $table->longText('isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('babs');
    }
};
