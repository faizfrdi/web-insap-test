<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama admin
            $table->string('email')->unique(); // Email harus unik
            $table->string('password'); // Password terenkripsi
            $table->timestamp('email_verified_at')->nullable(); // Untuk verifikasi email jika diperlukan
            $table->rememberToken(); // Token untuk fitur remember me
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
