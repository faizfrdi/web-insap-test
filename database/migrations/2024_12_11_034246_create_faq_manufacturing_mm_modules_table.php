<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqManufacturingMmModule;

class CreateFaqManufacturingMmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_manufacturing_mm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Manufacturing MM sub-module
        $this->seedFaqMmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_manufacturing_mm_modules');
    }

    /**
     * Seed the initial FAQ data for MM sub-module.
     */
    private function seedFaqMmModuleData()
    {
        FaqManufacturingMmModule::create([
            'question' => 'Apa itu sub-modul MM dalam Manufacturing?',
            'answer' => 'Sub-modul MM dalam manufacturing mencakup pengelolaan material, pembelian, dan inventarisasi barang.',
            'image' => null,
        ]);

        FaqManufacturingMmModule::create([
            'question' => 'Apa saja elemen utama dalam modul MM?',
            'answer' => 'Elemen utama meliputi manajemen stok, perencanaan kebutuhan material (MRP), dan pengadaan barang.',
            'image' => null,
        ]);

        FaqManufacturingMmModule::create([
            'question' => 'Bagaimana modul MM membantu manajemen stok?',
            'answer' => 'Modul MM menyediakan alat untuk melacak stok secara real-time, memprediksi kebutuhan, dan mengelola pengadaan material secara efisien.',
            'image' => null,
        ]);

        FaqManufacturingMmModule::create([
            'question' => 'Apakah modul MM mendukung integrasi dengan modul lain?',
            'answer' => 'Ya, modul MM terintegrasi dengan modul produksi dan keuangan untuk memastikan proses pengadaan berjalan lancar.',
            'image' => null,
        ]);

        FaqManufacturingMmModule::create([
            'question' => 'Siapa saja yang menggunakan modul MM dalam Manufacturing?',
            'answer' => 'Modul MM digunakan oleh tim pengadaan, manajer inventaris, dan tim logistik untuk mengelola alur material.',
            'image' => null,
        ]);
    }
}