<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaNonKonstruksiSdModule;

class CreateFaqJasaNonKonstruksiSdModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_non_konstruksi_sd_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Jasa Non-Konstruksi SD sub-module
        $this->seedFaqSdModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_non_konstruksi_sd_modules');
    }

    /**
     * Seed the initial FAQ data for SD sub-module.
     */
    private function seedFaqSdModuleData()
    {
        FaqJasaNonKonstruksiSdModule::create([
            'question' => 'Apa itu sub-modul SD dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul SD dalam Jasa Non-Konstruksi mencakup pengelolaan distribusi layanan dan pengelolaan hubungan dengan pelanggan.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiSdModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul SD?',
            'answer' => 'Elemen utama meliputi manajemen pesanan layanan, penjadwalan penyediaan layanan, dan pengelolaan keluhan pelanggan.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiSdModule::create([
            'question' => 'Bagaimana sub-modul SD membantu meningkatkan layanan pelanggan?',
            'answer' => 'Sub-modul SD membantu memastikan kepuasan pelanggan dengan menyediakan alat untuk pelacakan pesanan dan penyelesaian keluhan.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiSdModule::create([
            'question' => 'Apakah sub-modul SD mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul SD terintegrasi dengan modul keuangan dan inventaris untuk memastikan layanan diberikan tepat waktu.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiSdModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul SD dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul SD digunakan oleh tim layanan pelanggan, manajer distribusi, dan manajer operasional untuk mengelola hubungan pelanggan.',
            'image' => null,
        ]);
    }
}