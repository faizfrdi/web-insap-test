<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicoFmsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fico_fms', function (Blueprint $table) {
            $table->id(); // Ini akan jadi "no" (nomor urut/primary key)
            $table->string('report');
            $table->enum('status', ['done', 'on going']);
            $table->timestamps(); // Ini akan otomatis buat kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fico_fms');
    }
};

