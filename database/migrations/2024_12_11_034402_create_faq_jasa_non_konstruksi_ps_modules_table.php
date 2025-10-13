<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaNonKonstruksiPsModule;

class CreateFaqJasaNonKonstruksiPsModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_non_konstruksi_ps_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Jasa Non-Konstruksi PS sub-module
        $this->seedFaqPsModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_non_konstruksi_ps_modules');
    }

    /**
     * Seed the initial FAQ data for PS sub-module.
     */
    private function seedFaqPsModuleData()
    {
        FaqJasaNonKonstruksiPsModule::create([
            'question' => 'Apa itu sub-modul PS dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul PS dalam Jasa Non-Konstruksi mencakup pengelolaan perencanaan proyek untuk layanan non-konstruksi.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiPsModule::create([
            'question' => 'Apa saja langkah penting dalam pengelolaan proyek di sub-modul PS?',
            'answer' => 'Langkah penting meliputi perencanaan jadwal layanan, alokasi sumber daya, dan pemantauan pelaksanaan layanan.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiPsModule::create([
            'question' => 'Bagaimana sub-modul PS mendukung kelancaran proyek?',
            'answer' => 'Sub-modul PS membantu memastikan kelancaran proyek dengan menyediakan data real-time untuk pengambilan keputusan yang lebih baik.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiPsModule::create([
            'question' => 'Apakah sub-modul PS mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul PS terintegrasi dengan modul keuangan dan sumber daya manusia untuk efisiensi pengelolaan proyek.',
            'image' => null,
        ]);

        FaqJasaNonKonstruksiPsModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul PS dalam Jasa Non-Konstruksi?',
            'answer' => 'Sub-modul PS digunakan oleh manajer proyek, tim pelaksana layanan, dan tim operasional untuk mengelola proyek layanan.',
            'image' => null,
        ]);
    }
}