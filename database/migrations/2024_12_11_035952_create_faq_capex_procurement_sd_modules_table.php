<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqCapexProcurementSdModule;

class CreateFaqCapexProcurementSdModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_capex_procurement_sd_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Capex Procurement SD sub-module
        $this->seedFaqSdModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_capex_procurement_sd_modules');
    }

    /**
     * Seed the initial FAQ data for SD sub-module.
     */
    private function seedFaqSdModuleData()
    {
        FaqCapexProcurementSdModule::create([
            'question' => 'Apa itu sub-modul SD dalam Capex Procurement?',
            'answer' => 'Sub-modul SD dalam Capex Procurement mencakup pengelolaan distribusi dan pengaturan barang modal yang telah diadakan.',
            'image' => null,
        ]);

        FaqCapexProcurementSdModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul SD?',
            'answer' => 'Elemen utama meliputi manajemen pengiriman barang, perencanaan distribusi, dan pelacakan alokasi barang modal.',
            'image' => null,
        ]);

        FaqCapexProcurementSdModule::create([
            'question' => 'Bagaimana sub-modul SD membantu pengelolaan distribusi barang modal?',
            'answer' => 'Sub-modul SD memastikan pengiriman barang modal dilakukan tepat waktu dan sesuai kebutuhan proyek dengan koordinasi yang efisien.',
            'image' => null,
        ]);

        FaqCapexProcurementSdModule::create([
            'question' => 'Apakah sub-modul SD mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul SD terintegrasi dengan modul keuangan dan logistik untuk memaksimalkan efisiensi distribusi barang modal.',
            'image' => null,
        ]);

        FaqCapexProcurementSdModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul SD dalam Capex Procurement?',
            'answer' => 'Sub-modul SD digunakan oleh tim logistik, manajer distribusi, dan manajer proyek untuk mengelola distribusi barang modal.',
            'image' => null,
        ]);
    }
}