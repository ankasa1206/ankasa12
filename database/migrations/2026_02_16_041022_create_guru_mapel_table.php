<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_mapel', function (Blueprint $table) {

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('mapel_id')
                ->constrained('mapels')
                ->cascadeOnDelete();

            // Supaya tidak duplicate
            $table->unique(['user_id', 'mapel_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_mapel');
    }
};
