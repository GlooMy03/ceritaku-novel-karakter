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
        Schema::create('reading_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cerita_id')->constrained('ceritas')->cascadeOnDelete();
            $table->foreignId('bab_id')->nullable()->constrained('babs')->nullOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'cerita_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_lists');
    }
};
