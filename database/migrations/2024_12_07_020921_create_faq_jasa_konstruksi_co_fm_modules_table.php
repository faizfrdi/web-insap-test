<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaKonstruksiCoFmModule;

class CreateFaqJasaKonstruksiCoFmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_konstruksi_co_fm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for CO/FM sub-module
        $this->seedFaqCoFmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_konstruksi_co_fm_modules');
    }

    /**
     * Seed the initial FAQ data for CO/FM sub-module.
     */
    private function seedFaqCoFmModuleData()
    {
        FaqJasaKonstruksiCoFmModule::create([
            'question' => 'Apa itu sub-modul CO/FM dalam Jasa Konstruksi?',
            'answer' => 'Sub-modul CO/FM berfokus pada kontrol biaya dan manajemen fasilitas selama dan setelah proyek konstruksi.',
            'image' => null,
        ]);

        FaqJasaKonstruksiCoFmModule::create([
            'question' => 'Apa peran manajemen fasilitas dalam sub-modul CO/FM?',
            'answer' => 'Manajemen fasilitas mencakup pemeliharaan dan pengelolaan aset fisik yang dibangun dalam proyek konstruksi.',
            'image' => null,
        ]);

        FaqJasaKonstruksiCoFmModule::create([
            'question' => 'Bagaimana cara melakukan kontrol biaya dalam sub-modul CO/FM?',
            'answer' => 'Kontrol biaya dilakukan dengan memantau pengeluaran proyek dan memastikan bahwa anggaran tidak terlampaui.',
            'image' => null,
        ]);

        FaqJasaKonstruksiCoFmModule::create([
            'question' => 'Apakah sub-modul CO/FM melibatkan teknologi untuk pengelolaan biaya?',
            'answer' => 'Ya, teknologi seperti perangkat lunak manajemen proyek digunakan untuk memantau dan mengendalikan biaya secara real-time.',
            'image' => null,
        ]);

        FaqJasaKonstruksiCoFmModule::create([
            'question' => 'Bagaimana cara memastikan bahwa fasilitas dikelola dengan baik setelah proyek selesai?',
            'answer' => 'Fasilitas dikelola dengan baik melalui perawatan rutin dan pemantauan kondisi fisik bangunan atau infrastruktur yang telah selesai dibangun.',
            'image' => null,
        ]);
    }
}