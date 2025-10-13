<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqManufacturingCoFmModule;

class CreateFaqManufacturingCoFmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_manufacturing_co_fm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Manufacturing CO/FM sub-module
        $this->seedFaqCoFmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_manufacturing_co_fm_modules');
    }

    /**
     * Seed the initial FAQ data for CO/FM sub-module.
     */
    private function seedFaqCoFmModuleData()
    {
        FaqManufacturingCoFmModule::create([
            'question' => 'Apa itu sub-modul CO/FM dalam Manufacturing?',
            'answer' => 'Sub-modul CO/FM dalam manufacturing mencakup pengelolaan biaya dan kontrol keuangan terkait proses produksi.',
            'image' => null,
        ]);

        FaqManufacturingCoFmModule::create([
            'question' => 'Apa saja komponen utama dalam modul CO/FM?',
            'answer' => 'Komponen utama meliputi pelacakan biaya produksi, analisis keuntungan, dan alokasi sumber daya.',
            'image' => null,
        ]);

        FaqManufacturingCoFmModule::create([
            'question' => 'Bagaimana modul CO/FM membantu pengendalian biaya?',
            'answer' => 'Modul ini menyediakan data biaya real-time untuk membantu mengidentifikasi area penghematan dan pengelolaan anggaran yang efektif.',
            'image' => null,
        ]);

        FaqManufacturingCoFmModule::create([
            'question' => 'Apakah modul CO/FM mendukung pelaporan keuangan otomatis?',
            'answer' => 'Ya, modul CO/FM mendukung pelaporan keuangan otomatis untuk analisis kinerja dan pelacakan efisiensi produksi.',
            'image' => null,
        ]);

        FaqManufacturingCoFmModule::create([
            'question' => 'Siapa saja yang menggunakan modul CO/FM dalam Manufacturing?',
            'answer' => 'Modul CO/FM digunakan oleh manajer keuangan, analis biaya, dan tim pengendalian produksi untuk memastikan akurasi dan efisiensi biaya.',
            'image' => null,
        ]);
    }
}