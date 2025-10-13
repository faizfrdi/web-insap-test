<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqCapexProcurementPsModule;

class CreateFaqCapexProcurementPsModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_capex_procurement_ps_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Capex Procurement PS sub-module
        $this->seedFaqPsModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_capex_procurement_ps_modules');
    }

    /**
     * Seed the initial FAQ data for PS sub-module.
     */
    private function seedFaqPsModuleData()
    {
        FaqCapexProcurementPsModule::create([
            'question' => 'Apa itu sub-modul PS dalam Capex Procurement?',
            'answer' => 'Sub-modul PS dalam Capex Procurement mencakup pengelolaan perencanaan proyek terkait pengadaan barang modal dan investasi.',
            'image' => null,
        ]);

        FaqCapexProcurementPsModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul PS?',
            'answer' => 'Elemen utama meliputi perencanaan proyek pengadaan, alokasi sumber daya, dan pelacakan kemajuan proyek.',
            'image' => null,
        ]);

        FaqCapexProcurementPsModule::create([
            'question' => 'Bagaimana sub-modul PS membantu pengelolaan proyek pengadaan?',
            'answer' => 'Sub-modul PS memastikan perencanaan dan pelaksanaan proyek berjalan sesuai anggaran dan jadwal dengan pemantauan real-time.',
            'image' => null,
        ]);

        FaqCapexProcurementPsModule::create([
            'question' => 'Apakah sub-modul PS mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul PS terintegrasi dengan modul keuangan dan logistik untuk memastikan efisiensi dalam pengelolaan proyek.',
            'image' => null,
        ]);

        FaqCapexProcurementPsModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul PS dalam Capex Procurement?',
            'answer' => 'Sub-modul PS digunakan oleh manajer proyek, tim keuangan, dan tim pengadaan untuk mengelola proyek pengadaan barang modal.',
            'image' => null,
        ]);
    }
}