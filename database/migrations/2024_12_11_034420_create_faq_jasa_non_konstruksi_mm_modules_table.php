<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaNonKonstruksiMmModule;

class CreateFaqJasaNonKonstruksiMmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_non_konstruksi_mm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Jasa Non-Konstruksi MM sub-module
        $this->seedFaqMmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_non_konstruksi_mm_modules');
    }

    /**
     * Seed the initial FAQ data for MM sub-module.
     */
    private function seedFaqMmModuleData()
    {
        FaqJasaNonKonstruksiMmModule::create([
            'question' => 'Apa itu sub-modul MM dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul MM dalam Jasa Non-Konstruksi mencakup pengelolaan material dan inventarisasi barang untuk mendukung layanan non-konstruksi.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiMmModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul MM?',
            'answer' => 'Elemen utama meliputi pengadaan barang, manajemen stok, dan perencanaan kebutuhan material.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiMmModule::create([
            'question' => 'Bagaimana sub-modul MM membantu pengelolaan material?',
            'answer' => 'Sub-modul MM menyediakan alat untuk memantau stok secara real-time, merencanakan kebutuhan material, dan mengelola pengadaan secara efisien.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiMmModule::create([
            'question' => 'Apakah sub-modul MM mendukung integrasi dengan modul lain?',
            'answer' => 'Ya, sub-modul MM terintegrasi dengan modul keuangan dan operasional untuk memastikan kelancaran alur material.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiMmModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul MM dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul MM digunakan oleh tim logistik, manajer inventaris, dan tim pengadaan untuk mengelola alur barang dan material.',
            'image' => null,
        ]);
    }
}