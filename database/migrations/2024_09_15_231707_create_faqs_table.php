<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Faq;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable(); // Kolom image yang opsional
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the default FAQ data
        $this->seedFaqData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }

    /**
     * Seed the initial FAQ data.
     */
    private function seedFaqData()
    {
        // Tambahkan semua data default FAQ dengan format create()
        Faq::create([
            'question' => 'Bagaimana Flow End to End All Process untuk Scenario Jasa Konstruksi?',
            'answer' => 'Proses end-to-end untuk scenario Jasa Konstruksi dimulai dengan perencanaan proyek, pemilihan kontraktor melalui tender, pelaksanaan pembangunan, pengawasan proyek, dan diakhiri dengan serah terima serta evaluasi hasil proyek.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        Faq::create([
            'question' => 'Bagaimana Flow End to End All Process untuk Scenario Manufacturing?',
            'answer' => 'Proses end-to-end untuk scenario Manufacturing dimulai dengan perencanaan produksi, pengadaan bahan baku, proses produksi, pengepakan, distribusi, dan evaluasi hasil produksi untuk memastikan kualitas dan efisiensi.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        Faq::create([
            'question' => 'Bagaimana Flow End to End All Process untuk Scenario Jasa Non Konstruksi?',
            'answer' => 'Proses end-to-end untuk scenario Jasa Non Konstruksi dimulai dengan identifikasi kebutuhan layanan, penyusunan proposal, negosiasi dengan klien, pelaksanaan layanan, dan diakhiri dengan evaluasi hasil dan umpan balik dari klien.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        Faq::create([
            'question' => 'Bagaimana Flow End to End All Process untuk Scenario Capex Procurement?',
            'answer' => 'Proses end-to-end untuk scenario Capex Procurement dimulai dengan identifikasi kebutuhan investasi, penyusunan anggaran, seleksi vendor, pengadaan barang/jasa, dan evaluasi hasil pengadaan untuk memastikan efisiensi penggunaan anggaran.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        Faq::create([
            'question' => 'Bagaimana Flow End to End All Process untuk Scenario Internal Project?',
            'answer' => 'Proses end-to-end untuk scenario Internal Project dimulai dengan perencanaan dan penyusunan tim proyek, implementasi proyek, pengawasan, dan diakhiri dengan evaluasi serta dokumentasi hasil proyek.',
            'image' => null, // Gambar default (jika ada)
        ]);        
    }
}