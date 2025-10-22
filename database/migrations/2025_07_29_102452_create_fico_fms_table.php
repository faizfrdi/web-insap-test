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
        Schema::create('fico_fms', function (Blueprint $table) {
            $table->id();
            $table->string('report');
            $table->string('status'); // contoh: done, on going
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable(); // path gambar
            $table->string('file')->nullable();  // path file
            $table->timestamps();
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