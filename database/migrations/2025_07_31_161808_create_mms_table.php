<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mms', function (Blueprint $table) {
            $table->id();
            $table->string('report');
            $table->string('status'); // contoh: done, on going
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable(); // bisa simpan path atau filename
            $table->string('file')->nullable();  // bisa simpan path atau filename
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mms');
    }
};