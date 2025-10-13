<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqInternalProjectCoFmModule;

class CreateFaqInternalProjectCoFmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_internal_project_co_fm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Internal Project CO/FM sub-module
        $this->seedFaqCoFmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_internal_project_co_fm_modules');
    }

    /**
     * Seed the initial FAQ data for CO/FM sub-module.
     */
    private function seedFaqCoFmModuleData()
    {
        FaqInternalProjectCoFmModule::create([
            'question' => 'Apa itu sub-modul CO/FM dalam Internal Project?',
            'answer' => 'Sub-modul CO/FM dalam Internal Project mencakup pengelolaan biaya dan keuangan untuk proyek internal.',
            'image' => null,
        ]);

        FaqInternalProjectCoFmModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul CO/FM?',
            'answer' => 'Elemen utama meliputi pencatatan biaya proyek, analisis anggaran, dan pelaporan keuangan.',
            'image' => null,
        ]);

        FaqInternalProjectCoFmModule::create([
            'question' => 'Bagaimana sub-modul CO/FM membantu efisiensi proyek internal?',
            'answer' => 'Sub-modul CO/FM membantu dengan menyediakan data biaya real-time untuk pengambilan keputusan yang lebih baik dan pengelolaan anggaran yang efisien.',
            'image' => null,
        ]);

        FaqInternalProjectCoFmModule::create([
            'question' => 'Apakah sub-modul CO/FM mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul CO/FM terintegrasi dengan modul manajemen proyek dan SDM untuk mendukung kelancaran operasional.',
            'image' => null,
        ]);

        FaqInternalProjectCoFmModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul CO/FM dalam Internal Project?',
            'answer' => 'Sub-modul CO/FM digunakan oleh manajer keuangan, analis biaya, dan manajer proyek untuk memastikan efisiensi biaya dan pengelolaan keuangan yang efektif.',
            'image' => null,
        ]);
    }
}