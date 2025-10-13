<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqCapexProcurementCoFmModule;

class CreateFaqCapexProcurementCoFmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_capex_procurement_co_fm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Capex Procurement CO/FM sub-module
        $this->seedFaqCoFmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_capex_procurement_co_fm_modules');
    }

    /**
     * Seed the initial FAQ data for CO/FM sub-module.
     */
    private function seedFaqCoFmModuleData()
    {
        FaqCapexProcurementCoFmModule::create([
            'question' => 'Apa itu sub-modul CO/FM dalam Capex Procurement?',
            'answer' => 'Sub-modul CO/FM dalam Capex Procurement mencakup pengelolaan biaya dan keuangan terkait pengadaan barang modal.',
            'image' => null,
        ]);

        FaqCapexProcurementCoFmModule::create([
            'question' => 'Apa saja elemen penting dalam sub-modul CO/FM?',
            'answer' => 'Elemen penting meliputi pelacakan biaya pengadaan, analisis anggaran, dan pelaporan keuangan proyek.',
            'image' => null,
        ]);

        FaqCapexProcurementCoFmModule::create([
            'question' => 'Bagaimana sub-modul CO/FM membantu efisiensi biaya?',
            'answer' => 'Sub-modul CO/FM memastikan biaya pengadaan dikelola secara efisien dengan data real-time untuk pengambilan keputusan yang lebih baik.',
            'image' => null,
        ]);

        FaqCapexProcurementCoFmModule::create([
            'question' => 'Apakah sub-modul CO/FM mendukung pelaporan otomatis?',
            'answer' => 'Ya, sub-modul CO/FM menyediakan laporan otomatis untuk evaluasi kinerja pengadaan dan efisiensi biaya.',
            'image' => null,
        ]);

        FaqCapexProcurementCoFmModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul CO/FM dalam Capex Procurement?',
            'answer' => 'Sub-modul CO/FM digunakan oleh tim keuangan, analis anggaran, dan manajer pengadaan untuk memastikan pengelolaan biaya yang efektif.',
            'image' => null,
        ]);
    }
}