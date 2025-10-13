<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqInternalProjectPsModule;

class CreateFaqInternalProjectPsModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_internal_project_ps_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Internal Project PS sub-module
        $this->seedFaqPsModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_internal_project_ps_modules');
    }

    /**
     * Seed the initial FAQ data for PS sub-module.
     */
    private function seedFaqPsModuleData()
    {
        FaqInternalProjectPsModule::create([
            'question' => 'Apa itu sub-modul PS dalam Internal Project?',
            'answer' => 'Sub-modul PS dalam Internal Project mencakup pengelolaan perencanaan proyek untuk aktivitas internal organisasi.',
            'image' => null,
        ]);

        FaqInternalProjectPsModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul PS?',
            'answer' => 'Elemen utama meliputi perencanaan jadwal proyek, pengelolaan sumber daya, dan pelacakan kemajuan proyek.',
            'image' => null,
        ]);

        FaqInternalProjectPsModule::create([
            'question' => 'Bagaimana sub-modul PS membantu pengelolaan proyek internal?',
            'answer' => 'Sub-modul PS memastikan kelancaran proyek dengan perencanaan yang matang dan pemantauan kemajuan secara real-time.',
            'image' => null,
        ]);

        FaqInternalProjectPsModule::create([
            'question' => 'Apakah sub-modul PS mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul PS terintegrasi dengan modul keuangan dan SDM untuk mendukung efisiensi pengelolaan proyek.',
            'image' => null,
        ]);

        FaqInternalProjectPsModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul PS dalam Internal Project?',
            'answer' => 'Sub-modul PS digunakan oleh manajer proyek, tim pelaksana, dan tim pengelola sumber daya untuk memastikan kelancaran pelaksanaan proyek internal.',
            'image' => null,
        ]);
    }
}