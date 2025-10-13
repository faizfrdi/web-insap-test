<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqCapexProcurementFiModule;

class CreateFaqCapexProcurementFiModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_capex_procurement_fi_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Capex Procurement FI sub-module
        $this->seedFaqFiModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_capex_procurement_fi_modules');
    }

    /**
     * Seed the initial FAQ data for FI sub-module.
     */
    private function seedFaqFiModuleData()
    {
        FaqCapexProcurementFiModule::create([
            'question' => 'Apa itu sub-modul FI dalam Capex Procurement?',
            'answer' => 'Sub-modul FI dalam Capex Procurement mencakup pengelolaan keuangan terkait pengadaan barang modal dan investasi.',
            'image' => null,
        ]);

        FaqCapexProcurementFiModule::create([
            'question' => 'Apa saja elemen penting dalam sub-modul FI?',
            'answer' => 'Elemen penting meliputi manajemen anggaran investasi, pencatatan pengeluaran modal, dan pelaporan keuangan.',
            'image' => null,
        ]);

        FaqCapexProcurementFiModule::create([
            'question' => 'Bagaimana sub-modul FI membantu pengelolaan Capex Procurement?',
            'answer' => 'Sub-modul FI memastikan alokasi anggaran yang efisien, pelacakan pengeluaran modal secara real-time, dan pelaporan yang akurat.',
            'image' => null,
        ]);

        FaqCapexProcurementFiModule::create([
            'question' => 'Apakah sub-modul FI mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul FI terintegrasi dengan modul procurement dan operasional untuk mendukung efisiensi pengadaan.',
            'image' => null,
        ]);

        FaqCapexProcurementFiModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul FI dalam Capex Procurement?',
            'answer' => 'Sub-modul FI digunakan oleh tim keuangan, analis anggaran, dan manajer pengadaan untuk mengelola anggaran investasi.',
            'image' => null,
        ]);
    }
}