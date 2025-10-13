<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqManufacturingPsModule;

class CreateFaqManufacturingPsModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_manufacturing_ps_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Manufacturing PS sub-module
        $this->seedFaqPsModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_manufacturing_ps_modules');
    }

    /**
     * Seed the initial FAQ data for PS sub-module.
     */
    private function seedFaqPsModuleData()
    {
        FaqManufacturingPsModule::create([
            'question' => 'Apa itu sub-modul PS dalam Manufacturing?',
            'answer' => 'Sub-modul PS dalam manufacturing mencakup pengelolaan perencanaan proyek dan aktivitas terkait produksi.',
            'image' => null,
        ]);

        FaqManufacturingPsModule::create([
            'question' => 'Apa peran utama modul PS?',
            'answer' => 'Modul PS berperan dalam merencanakan jadwal proyek, alokasi sumber daya, dan pengendalian biaya.',
            'image' => null,
        ]);

        FaqManufacturingPsModule::create([
            'question' => 'Bagaimana modul PS membantu pengelolaan proyek?',
            'answer' => 'Modul PS membantu dengan menyediakan data real-time untuk pemantauan proyek dan penyesuaian strategi sesuai kebutuhan.',
            'image' => null,
        ]);

        FaqManufacturingPsModule::create([
            'question' => 'Apakah modul PS mendukung integrasi dengan sistem lain?',
            'answer' => 'Ya, modul PS dapat diintegrasikan dengan modul lain seperti keuangan dan produksi untuk efisiensi proyek.',
            'image' => null,
        ]);

        FaqManufacturingPsModule::create([
            'question' => 'Siapa saja yang menggunakan modul PS dalam Manufacturing?',
            'answer' => 'Modul PS biasanya digunakan oleh manajer proyek, insinyur produksi, dan tim keuangan untuk memastikan kelancaran operasional proyek.',
            'image' => null,
        ]);
    }
}