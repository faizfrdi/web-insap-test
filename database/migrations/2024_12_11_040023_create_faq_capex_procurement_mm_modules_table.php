<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqCapexProcurementMmModule;

class CreateFaqCapexProcurementMmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_capex_procurement_mm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Capex Procurement MM sub-module
        $this->seedFaqMmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_capex_procurement_mm_modules');
    }

    /**
     * Seed the initial FAQ data for MM sub-module.
     */
    private function seedFaqMmModuleData()
    {
        FaqCapexProcurementMmModule::create([
            'question' => 'Apa itu sub-modul MM dalam Capex Procurement?',
            'answer' => 'Sub-modul MM dalam Capex Procurement mencakup pengelolaan material dan barang modal yang terkait dengan pengadaan.',
            'image' => null,
        ]);

        FaqCapexProcurementMmModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul MM?',
            'answer' => 'Elemen utama meliputi manajemen stok barang modal, pengadaan material, dan perencanaan kebutuhan barang.',
            'image' => null,
        ]);

        FaqCapexProcurementMmModule::create([
            'question' => 'Bagaimana sub-modul MM membantu pengelolaan material?',
            'answer' => 'Sub-modul MM menyediakan alat untuk melacak stok barang modal secara real-time, merencanakan kebutuhan, dan mengelola pengadaan secara efisien.',
            'image' => null,
        ]);

        FaqCapexProcurementMmModule::create([
            'question' => 'Apakah sub-modul MM mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul MM terintegrasi dengan modul keuangan dan proyek untuk memastikan efisiensi dalam pengelolaan barang modal.',
            'image' => null,
        ]);

        FaqCapexProcurementMmModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul MM dalam Capex Procurement?',
            'answer' => 'Sub-modul MM digunakan oleh tim logistik, manajer pengadaan, dan tim proyek untuk mengelola alur barang modal.',
            'image' => null,
        ]);
    }
}