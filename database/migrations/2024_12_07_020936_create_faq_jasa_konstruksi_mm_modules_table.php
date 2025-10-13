<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaKonstruksiMmModule;

class CreateFaqJasaKonstruksiMmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_konstruksi_mm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for MM sub-module
        $this->seedFaqMmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_konstruksi_mm_modules');
    }

    /**
     * Seed the initial FAQ data for MM sub-module.
     */
    private function seedFaqMmModuleData()
    {
        FaqJasaKonstruksiMmModule::create([
            'question' => 'Apa yang dimaksud dengan sub-modul MM dalam Jasa Konstruksi?',
            'answer' => 'Sub-modul MM berfokus pada manajemen material dan logistik selama proyek konstruksi.',
            'image' => null,
        ]);

        FaqJasaKonstruksiMmModule::create([
            'question' => 'Bagaimana cara mengelola material dalam sub-modul MM?',
            'answer' => 'Pengelolaan material dilakukan dengan memantau kebutuhan material, penyimpanan, dan distribusi ke lokasi proyek.',
            'image' => null,
        ]);

        FaqJasaKonstruksiMmModule::create([
            'question' => 'Apa yang harus dilakukan untuk menghindari kekurangan material dalam proyek konstruksi?',
            'answer' => 'Untuk menghindari kekurangan material, perlu dilakukan perencanaan yang matang dan pemantauan kebutuhan material secara berkala.',
            'image' => null,
        ]);

        FaqJasaKonstruksiMmModule::create([
            'question' => 'Apa pentingnya logistik dalam sub-modul MM?',
            'answer' => 'Logistik penting untuk memastikan material sampai tepat waktu ke lokasi proyek dan dalam kondisi yang baik.',
            'image' => null,
        ]);

        FaqJasaKonstruksiMmModule::create([
            'question' => 'Bagaimana cara memastikan penggunaan material yang efisien dalam sub-modul MM?',
            'answer' => 'Penggunaan material yang efisien dapat dilakukan dengan meminimalkan pemborosan dan memastikan penggunaan material sesuai dengan perencanaan.',
            'image' => null,
        ]);
    }
}