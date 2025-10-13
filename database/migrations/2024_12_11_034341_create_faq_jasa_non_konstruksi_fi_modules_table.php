<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaNonKonstruksiFiModule;

class CreateFaqJasaNonKonstruksiFiModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_non_konstruksi_fi_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Jasa Non-Konstruksi FI sub-module
        $this->seedFaqFiModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_non_konstruksi_fi_modules');
    }

    /**
     * Seed the initial FAQ data for FI sub-module.
     */
    private function seedFaqFiModuleData()
    {
        FaqJasaNonKonstruksiFiModule::create([
            'question' => 'Apa itu sub-modul FI dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul FI dalam Jasa Non-Konstruksi mencakup aspek pengelolaan keuangan untuk layanan yang tidak terkait konstruksi.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiFiModule::create([
            'question' => 'Bagaimana FI diterapkan dalam Jasa Non-Konstruksi?',
            'answer' => 'FI diterapkan melalui sistem pencatatan transaksi, manajemen anggaran, dan pelaporan keuangan yang mendukung efisiensi operasional.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiFiModule::create([
            'question' => 'Apa saja komponen utama dalam sub-modul FI?',
            'answer' => 'Komponen utama meliputi pencatatan akuntansi, perencanaan keuangan, dan kontrol pengeluaran.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiFiModule::create([
            'question' => 'Apakah sub-modul FI mendukung integrasi dengan sistem lain?',
            'answer' => 'Ya, sub-modul FI dapat diintegrasikan dengan modul layanan lainnya untuk pelaporan dan pengelolaan keuangan yang lebih baik.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiFiModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul FI dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul FI biasanya digunakan oleh tim keuangan, manajer layanan, dan manajer operasional untuk mengelola keuangan layanan.',
            'image' => null,
        ]);
    }
}