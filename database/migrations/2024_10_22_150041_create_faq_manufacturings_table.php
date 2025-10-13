<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqManufacturing;

class CreateFaqManufacturingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_manufacturings', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable(); // Kolom image yang opsional
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the default FAQ data for Manufacturing
        $this->seedFaqData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_manufacturings');
    }

    /**
     * Seed the initial FAQ data.
     */
    private function seedFaqData()
    {
        // Tambahkan data default FAQ untuk Manufacturing dengan format create()
        FaqManufacturing::create([
            'question' => 'Bagaimana proses produksi di Manufacturing?',
            'answer' => 'Proses produksi di Manufacturing dimulai dengan perencanaan dan pengadaan bahan baku. Setelah itu, proses produksi dilakukan melalui serangkaian tahap, mulai dari pemrosesan bahan, perakitan, hingga kontrol kualitas sebelum produk siap untuk distribusi.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqManufacturing::create([
            'question' => 'Apakah layanan Manufacturing mencakup kustomisasi produk?',
            'answer' => 'Ya, layanan kami memungkinkan kustomisasi produk sesuai dengan kebutuhan dan permintaan pelanggan, baik itu dari segi desain, ukuran, maupun spesifikasi teknis lainnya.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqManufacturing::create([
            'question' => 'Bagaimana cara menghitung biaya produksi di Manufacturing?',
            'answer' => 'Biaya produksi dihitung berdasarkan beberapa faktor, termasuk bahan baku, tenaga kerja, biaya operasional mesin, dan overhead. Kami akan memberikan estimasi biaya yang lebih akurat setelah memahami detail kebutuhan produksi Anda.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqManufacturing::create([
            'question' => 'Berapa lama waktu pengerjaan pesanan di Manufacturing?',
            'answer' => 'Waktu pengerjaan pesanan bergantung pada kompleksitas dan volume produksi. Setelah menerima pesanan, kami akan memberikan estimasi waktu penyelesaian yang jelas sesuai dengan jadwal dan kapasitas produksi yang ada.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqManufacturing::create([
            'question' => 'Apakah tersedia layanan pengiriman untuk produk Manufacturing?',
            'answer' => 'Ya, kami menyediakan layanan pengiriman untuk produk-produk yang telah selesai diproduksi. Pengiriman dapat dilakukan ke berbagai lokasi sesuai dengan permintaan pelanggan, baik menggunakan layanan logistik kami maupun pihak ketiga.',
            'image' => null, // Gambar default (jika ada)
        ]);        
    }
}