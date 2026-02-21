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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            // ID Pengirim (Admin atau Wali)
        $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
        
        // ID Penerima (Admin atau Wali)
        $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
        
        // Isi Pesan
        $table->text('message');
        
        // Status apakah sudah dibaca (opsional tapi berguna)
        $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
