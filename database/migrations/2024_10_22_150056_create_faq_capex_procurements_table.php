<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqCapexProcurement;

class CreateFaqCapexProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_capex_procurements', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable(); // Kolom image yang opsional
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the default FAQ data for Capex Procurement
        $this->seedFaqData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_capex_procurements');
    }

    /**
     * Seed the initial FAQ data.
     */
    private function seedFaqData()
    {
        // Tambahkan data default FAQ untuk Capex Procurement dengan format create()
        FaqCapexProcurement::create([
            'question' => 'Apa itu Capex Procurement?',
            'answer' => 'Capex Procurement adalah proses pengadaan barang atau jasa untuk investasi jangka panjang, seperti pembelian aset tetap, infrastruktur, atau proyek yang mendukung pertumbuhan perusahaan. Proses ini melibatkan perencanaan, pengadaan, dan pengelolaan anggaran untuk pembelian aset tersebut.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqCapexProcurement::create([
            'question' => 'Bagaimana cara pengadaan barang di Capex Procurement?',
            'answer' => 'Proses pengadaan barang di Capex Procurement dimulai dengan perencanaan kebutuhan barang atau jasa, dilanjutkan dengan pengajuan permintaan pengadaan, evaluasi vendor, dan kemudian pembelian barang. Proses ini sering melibatkan berbagai persetujuan dari departemen terkait.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqCapexProcurement::create([
            'question' => 'Apa saja syarat untuk mengikuti Capex Procurement?',
            'answer' => 'Syarat untuk mengikuti Capex Procurement meliputi persyaratan administratif, seperti kelengkapan dokumen perusahaan, serta memenuhi spesifikasi teknis yang diperlukan untuk proyek atau barang yang dibutuhkan. Selain itu, vendor juga harus memenuhi kriteria evaluasi yang ditetapkan oleh perusahaan.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqCapexProcurement::create([
            'question' => 'Berapa lama proses pengadaan Capex Procurement?',
            'answer' => 'Durasi proses pengadaan Capex Procurement bervariasi tergantung pada kompleksitas dan skala proyek. Secara umum, proses ini dapat memakan waktu mulai dari beberapa minggu hingga beberapa bulan untuk memastikan bahwa pengadaan dilakukan dengan hati-hati dan sesuai anggaran.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqCapexProcurement::create([
            'question' => 'Apakah ada dukungan logistik untuk Capex Procurement?',
            'answer' => 'Ya, dalam Capex Procurement, dukungan logistik disediakan untuk memastikan barang atau aset yang dibeli dapat dikirim dan dipasang dengan efisien. Hal ini meliputi pengaturan pengiriman, penyimpanan, serta instalasi jika diperlukan.',
            'image' => null, // Gambar default (jika ada)
        ]);        
    }
}