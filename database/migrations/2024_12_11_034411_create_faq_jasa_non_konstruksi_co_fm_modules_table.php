<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaNonKonstruksiCoFmModule;

class CreateFaqJasaNonKonstruksiCoFmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_non_konstruksi_co_fm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Jasa Non-Konstruksi CO/FM sub-module
        $this->seedFaqCoFmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_non_konstruksi_co_fm_modules');
    }

    /**
     * Seed the initial FAQ data for CO/FM sub-module.
     */
    private function seedFaqCoFmModuleData()
    {
        FaqJasaNonKonstruksiCoFmModule::create([
            'question' => 'Apa itu sub-modul CO/FM dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul CO/FM dalam Jasa Non-Konstruksi mencakup pengelolaan biaya dan keuangan untuk layanan non-konstruksi.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiCoFmModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul CO/FM?',
            'answer' => 'Elemen utama meliputi pengendalian biaya, perencanaan anggaran, dan pelaporan keuangan.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiCoFmModule::create([
            'question' => 'Bagaimana sub-modul CO/FM membantu efisiensi biaya?',
            'answer' => 'Sub-modul CO/FM membantu melacak dan menganalisis biaya secara real-time, sehingga memungkinkan pengelolaan anggaran yang lebih efisien.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiCoFmModule::create([
            'question' => 'Apakah sub-modul CO/FM mendukung pelaporan otomatis?',
            'answer' => 'Ya, sub-modul CO/FM menyediakan pelaporan keuangan otomatis untuk analisis kinerja dan pengambilan keputusan.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiCoFmModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul CO/FM dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul CO/FM biasanya digunakan oleh tim keuangan, analis biaya, dan manajer layanan untuk memastikan efisiensi biaya operasional.',
            'image' => null,
        ]);
    }
}