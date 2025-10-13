<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqInternalProjectMmModule;

class CreateFaqInternalProjectMmModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_internal_project_mm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Internal Project MM sub-module
        $this->seedFaqMmModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_internal_project_mm_modules');
    }

    /**
     * Seed the initial FAQ data for MM sub-module.
     */
    private function seedFaqMmModuleData()
    {
        FaqInternalProjectMmModule::create([
            'question' => 'Apa itu sub-modul MM dalam Internal Project?',
            'answer' => 'Sub-modul MM dalam Internal Project mencakup pengelolaan material dan sumber daya yang diperlukan untuk proyek internal.',
            'image' => null,
        ]);

        FaqInternalProjectMmModule::create([
            'question' => 'Apa saja elemen utama dalam sub-modul MM?',
            'answer' => 'Elemen utama meliputi manajemen stok material, pengadaan barang, dan perencanaan kebutuhan material.',
            'image' => null,
        ]);

        FaqInternalProjectMmModule::create([
            'question' => 'Bagaimana sub-modul MM membantu pengelolaan proyek internal?',
            'answer' => 'Sub-modul MM menyediakan alat untuk melacak dan mengelola stok material secara real-time sehingga memastikan ketersediaan barang untuk proyek internal.',
            'image' => null,
        ]);

        FaqInternalProjectMmModule::create([
            'question' => 'Apakah sub-modul MM mendukung integrasi dengan modul lainnya?',
            'answer' => 'Ya, sub-modul MM terintegrasi dengan modul keuangan dan logistik untuk memastikan efisiensi dalam pengelolaan material.',
            'image' => null,
        ]);

        FaqInternalProjectMmModule::create([
            'question' => 'Siapa saja yang menggunakan sub-modul MM dalam Internal Project?',
            'answer' => 'Sub-modul MM digunakan oleh manajer inventaris, tim logistik, dan manajer proyek untuk mengelola sumber daya yang dibutuhkan dalam proyek internal.',
            'image' => null,
        ]);
    }
}