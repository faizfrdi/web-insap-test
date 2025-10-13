<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaKonstruksiFiModule;

class CreateFaqJasaKonstruksiFiModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_konstruksi_fi_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Fiqih sub-module
        $this->seedFaqFiModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_konstruksi_fi_modules');
    }

    /**
     * Seed the initial FAQ data for FI sub-module.
     */
    private function seedFaqFiModuleData()
    {
        FaqJasaKonstruksiFiModule::create([
            'question' => 'Apa itu sub-modul FI dalam Jasa Konstruksi?',
            'answer' => 'Sub-modul FI mencakup aspek terkait struktur dan perencanaan teknis proyek konstruksi.',
            'image' => null,
        ]);

        FaqJasaKonstruksiFiModule::create([
            'question' => 'Apa saja yang termasuk dalam perencanaan teknis FI?',
            'answer' => 'Perencanaan teknis FI meliputi perhitungan struktural, pemilihan material, dan desain teknis lainnya.',
            'image' => null,
        ]);

        FaqJasaKonstruksiFiModule::create([
            'question' => 'Bagaimana cara menghitung estimasi biaya untuk sub-modul FI?',
            'answer' => 'Estimasi biaya dilakukan dengan menghitung volume pekerjaan dan kebutuhan material serta tenaga kerja yang sesuai.',
            'image' => null,
        ]);

        FaqJasaKonstruksiFiModule::create([
            'question' => 'Apakah sub-modul FI melibatkan teknologi baru dalam konstruksi?',
            'answer' => 'Ya, sub-modul FI mengintegrasikan teknologi terbaru untuk efisiensi dan keamanan proyek konstruksi.',
            'image' => null,
        ]);

        FaqJasaKonstruksiFiModule::create([
            'question' => 'Siapa saja yang terlibat dalam perencanaan sub-modul FI?',
            'answer' => 'Perencanaan sub-modul FI melibatkan insinyur sipil, arsitek, dan ahli struktur lainnya.',
            'image' => null,
        ]);
    }
}