<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('activity');
            $table->unsignedBigInteger('admin_id');  // Admin yang melakukan aktivitas
            $table->boolean('is_new')->default(true); // Kolom is_new, default true (baru)
            $table->timestamps();

            // Tambahkan foreign key ke tabel admin
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
}