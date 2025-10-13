<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqInternalProjectSdModule;

class CreateFaqInternalProjectSdModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_internal_project_sd_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Internal Project SD sub-module
        $this->seedFaqSdModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_internal_project_sd_modules');
    }

    /**
     * Seed the initial FAQ data for SD sub-module.
     */
    private function seedFaqSdModuleData()
    {
        FaqInternalProjectSdModule::create([
            'question' => 'Apa itu sub-modul SD dalam Internal Project?',
            'answer' => 'Sub-modul SD dalam Internal Project mencakup pengelolaan distribusi dan koordinasi sumber daya untuk proyek internal.',
            'image' => null,
        ]);

        FaqInternalProjectSdModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul SD?',
            'answer' => 'Elemen utama meliputi perencanaan distribusi, pengelolaan alokasi sumber daya, dan pemantauan penyelesaian tugas.',
            'image' => null,
        ]);

        FaqInternalProjectSdModule::create([
            'question' => 'Bagaimana sub-modul SD membantu pelaksanaan proyek internal?',
            'answer' => 'Sub-modul SD memastikan distribusi sumber daya yang efisien dan pemantauan kemajuan proyek secara real-time.',
            'image' => null,
        ]);

        FaqInternalProjectSdModule::create([
            'question' => 'Apakah sub-modul SD mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul SD terintegrasi dengan modul keuangan dan logistik untuk mendukung koordinasi proyek internal.',
            'image' => null,
        ]);

        FaqInternalProjectSdModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul SD dalam Internal Project?',
            'answer' => 'Sub-modul SD digunakan oleh tim manajemen proyek, manajer sumber daya, dan tim pelaksana untuk memastikan kelancaran pelaksanaan proyek.',
            'image' => null,
        ]);
    }
}