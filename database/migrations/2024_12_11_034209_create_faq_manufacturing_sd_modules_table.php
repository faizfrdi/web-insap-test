<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqManufacturingSdModule;

class CreateFaqManufacturingSdModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_manufacturing_sd_modules', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable();
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the data for Manufacturing SD sub-module
        $this->seedFaqSdModuleData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_manufacturing_sd_modules');
    }

    /**
     * Seed the initial FAQ data for SD sub-module.
     */
    private function seedFaqSdModuleData()
    {
        FaqManufacturingSdModule::create([
            'question' => 'Apa itu sub-modul SD dalam Manufacturing?',
            'answer' => 'Sub-modul SD dalam manufacturing mencakup aspek pengelolaan distribusi dan penjualan produk hasil produksi.',
            'image' => null,
        ]);

        FaqManufacturingSdModule::create([
            'question' => 'Apa saja elemen utama dalam modul SD?',
            'answer' => 'Elemen utama meliputi manajemen pesanan penjualan, perencanaan pengiriman, dan pengelolaan stok.',
            'image' => null,
        ]);

        FaqManufacturingSdModule::create([
            'question' => 'Bagaimana cara memastikan pengiriman produk tepat waktu?',
            'answer' => 'Pengiriman produk tepat waktu dapat dilakukan dengan sistem logistik yang efisien dan koordinasi antara tim produksi dan distribusi.',
            'image' => null,
        ]);

        FaqManufacturingSdModule::create([
            'question' => 'Apakah modul SD terintegrasi dengan sistem ERP lainnya?',
            'answer' => 'Ya, modul SD biasanya terintegrasi dengan modul lain seperti produksi, keuangan, dan inventarisasi untuk kelancaran operasional.',
            'image' => null,
        ]);

        FaqManufacturingSdModule::create([
            'question' => 'Siapa saja yang terlibat dalam sub-modul SD?',
            'answer' => 'Sub-modul SD melibatkan tim penjualan, logistik, dan pengelolaan inventaris.',
            'image' => null,
        ]);
    }
}