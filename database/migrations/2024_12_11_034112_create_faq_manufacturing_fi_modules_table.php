<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqManufacturingFiModule;

class CreateFaqManufacturingFiModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_manufacturing_fi_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Manufacturing FI sub-module
        $this->seedFaqFiModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_manufacturing_fi_modules');
    }

    /**
     * Seed the initial FAQ data for FI sub-module.
     */
    private function seedFaqFiModuleData()
    {
        FaqManufacturingFiModule::create([
            'question' => 'Apa itu sub-modul FI dalam Manufacturing?',
            'answer' => 'Sub-modul FI dalam manufacturing mencakup aspek terkait pengelolaan proses produksi dan perencanaan sumber daya.',
            'image' => null,
        ]);

        FaqManufacturingFiModule::create([
            'question' => 'Apa saja langkah penting dalam proses produksi FI?',
            'answer' => 'Langkah penting meliputi perencanaan produksi, penjadwalan material, dan pengawasan kualitas.',
            'image' => null,
        ]);

        FaqManufacturingFiModule::create([
            'question' => 'Bagaimana cara mengoptimalkan efisiensi di sub-modul FI?',
            'answer' => 'Efisiensi dioptimalkan dengan menggunakan teknik lean manufacturing, automasi, dan analisis data produksi.',
            'image' => null,
        ]);

        FaqManufacturingFiModule::create([
            'question' => 'Apakah teknologi terkini digunakan dalam sub-modul FI?',
            'answer' => 'Ya, sub-modul FI memanfaatkan teknologi seperti IoT dan machine learning untuk meningkatkan produktivitas dan pengambilan keputusan.',
            'image' => null,
        ]);

        FaqManufacturingFiModule::create([
            'question' => 'Siapa saja yang berperan dalam pengelolaan sub-modul FI?',
            'answer' => 'Pengelolaan melibatkan manajer produksi, insinyur manufaktur, dan tim pengendalian kualitas.',
            'image' => null,
        ]);
    }
}