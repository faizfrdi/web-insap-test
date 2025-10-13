<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaKonstruksiPsModule;

class CreateFaqJasaKonstruksiPsModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_konstruksi_ps_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for PS sub-module
        $this->seedFaqPsModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_konstruksi_ps_modules');
    }

    /**
     * Seed the initial FAQ data for PS sub-module.
     */
    private function seedFaqPsModuleData()
    {
        FaqJasaKonstruksiPsModule::create([
            'question' => 'Apa yang dimaksud dengan sub-modul PS dalam Jasa Konstruksi?',
            'answer' => 'Sub-modul PS mencakup perencanaan anggaran dan estimasi biaya proyek konstruksi.',
            'image' => null,
        ]);

        FaqJasaKonstruksiPsModule::create([
            'question' => 'Bagaimana cara membuat estimasi biaya dalam sub-modul PS?',
            'answer' => 'Estimasi biaya dilakukan dengan memperhitungkan material, tenaga kerja, dan durasi proyek.',
            'image' => null,
        ]);

        FaqJasaKonstruksiPsModule::create([
            'question' => 'Apakah sub-modul PS melibatkan vendor eksternal?',
            'answer' => 'Terkadang, sub-modul PS melibatkan vendor eksternal untuk menyediakan material atau jasa khusus.',
            'image' => null,
        ]);

        FaqJasaKonstruksiPsModule::create([
            'question' => 'Bagaimana cara mengevaluasi biaya proyek dalam sub-modul PS?',
            'answer' => 'Evaluasi biaya dilakukan dengan membandingkan estimasi dengan biaya aktual yang dikeluarkan selama pelaksanaan proyek.',
            'image' => null,
        ]);

        FaqJasaKonstruksiPsModule::create([
            'question' => 'Apakah ada cara untuk mengurangi biaya dalam sub-modul PS?',
            'answer' => 'Ya, pengurangan biaya dapat dilakukan dengan memilih material yang lebih efisien atau menggunakan tenaga kerja yang lebih terampil.',
            'image' => null,
        ]);
    }
}