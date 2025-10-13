<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date'); // Menyimpan tanggal kunjungan
            $table->integer('visit_count')->default(1); // Menyimpan jumlah pengunjung pada hari tersebut
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}