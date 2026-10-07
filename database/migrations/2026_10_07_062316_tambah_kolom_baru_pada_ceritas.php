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
        Schema::table('ceritas', function (Blueprint $table) {
            $table->string('penulis')->default('Anonim');
            $table->string('cover')->nullable();
            $table->unsignedInteger('jumlah_baca')->default(0);
            $table->string('status')->default('berlanjut');
        });
        Schema::table('kategoris', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ceritas', function (Blueprint $table) {
            $table->dropColumn(['penulis', 'cover', 'jumlah_baca', 'status']);
        });
        Schema::table('kategoris', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('tags', fn (Blueprint $table) => $table->dropColumn('slug'));
    }
};
