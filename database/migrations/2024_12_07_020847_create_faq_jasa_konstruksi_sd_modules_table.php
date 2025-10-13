<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaKonstruksiSdModule;

class CreateFaqJasaKonstruksiSdModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_konstruksi_sd_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for SD sub-module
        $this->seedFaqSdModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_konstruksi_sd_modules');
    }

    /**
     * Seed the initial FAQ data for SD sub-module.
     */
    private function seedFaqSdModuleData()
    {
        FaqJasaKonstruksiSdModule::create([
            'question' => 'Apa yang dimaksud dengan sub-modul SD dalam Jasa Konstruksi?',
            'answer' => 'Sub-modul SD mencakup aspek sosial dari proyek konstruksi, seperti interaksi dengan masyarakat dan pihak terkait.',
            'image' => null,
        ]);

        FaqJasaKonstruksiSdModule::create([
            'question' => 'Bagaimana pengaruh sub-modul SD terhadap masyarakat sekitar?',
            'answer' => 'Sub-modul SD bertujuan untuk meminimalisir dampak negatif terhadap masyarakat, serta melibatkan mereka dalam setiap tahap proyek.',
            'image' => null,
        ]);

        FaqJasaKonstruksiSdModule::create([
            'question' => 'Apakah sub-modul SD melibatkan pihak ketiga?',
            'answer' => 'Ya, sub-modul SD sering melibatkan pihak ketiga untuk memastikan bahwa aspek sosial proyek dapat berjalan dengan baik.',
            'image' => null,
        ]);

        FaqJasaKonstruksiSdModule::create([
            'question' => 'Bagaimana cara menilai keberhasilan sub-modul SD?',
            'answer' => 'Keberhasilan sub-modul SD diukur dengan seberapa baik hubungan yang terjalin dengan masyarakat dan pengurangan dampak negatif.',
            'image' => null,
        ]);

        FaqJasaKonstruksiSdModule::create([
            'question' => 'Apa yang dimaksud dengan dampak sosial positif dalam sub-modul SD?',
            'answer' => 'Dampak sosial positif adalah peningkatan kualitas hidup masyarakat sekitar proyek, baik dalam aspek ekonomi maupun sosial.',
            'image' => null,
        ]);
    }
}