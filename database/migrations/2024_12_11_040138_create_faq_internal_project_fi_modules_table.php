<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqInternalProjectFiModule;

class CreateFaqInternalProjectFiModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_internal_project_fi_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Internal Project FI sub-module
        $this->seedFaqFiModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_internal_project_fi_modules');
    }

    /**
     * Seed the initial FAQ data for FI sub-module.
     */
    private function seedFaqFiModuleData()
    {
        FaqInternalProjectFiModule::create([
            'question' => 'Apa itu sub-modul FI dalam Internal Project?',
            'answer' => 'Sub-modul FI dalam Internal Project mencakup pengelolaan keuangan untuk proyek internal organisasi.',
            'image' => null,
        ]);

        FaqInternalProjectFiModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul FI?',
            'answer' => 'Elemen utama meliputi manajemen anggaran proyek, pencatatan pengeluaran, dan pelaporan keuangan.',
            'image' => null,
        ]);

        FaqInternalProjectFiModule::create([
            'question' => 'Bagaimana sub-modul FI membantu pengelolaan keuangan proyek?',
            'answer' => 'Sub-modul FI memastikan pengelolaan anggaran yang efisien dengan melacak pengeluaran secara real-time dan menyediakan laporan yang akurat.',
            'image' => null,
        ]);

        FaqInternalProjectFiModule::create([
            'question' => 'Apakah sub-modul FI mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul FI terintegrasi dengan modul proyek dan logistik untuk mendukung kelancaran pengelolaan keuangan.',
            'image' => null,
        ]);

        FaqInternalProjectFiModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul FI dalam Internal Project?',
            'answer' => 'Sub-modul FI digunakan oleh tim keuangan, manajer proyek, dan analis anggaran untuk memastikan pengelolaan keuangan yang efektif.',
            'image' => null,
        ]);
    }
}