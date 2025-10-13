<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaKonstruksi;

class CreateFaqJasaKonstruksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_konstruksis', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable(); // Kolom image yang opsional
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the default FAQ data for Jasa Konstruksi
        $this->seedFaqData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_konstruksis');
    }

    /**
     * Seed the initial FAQ data.
     */
    private function seedFaqData()
    {
        // Tambahkan data default FAQ untuk Jasa Konstruksi dengan format create()
        FaqJasaKonstruksi::create([
            'question' => 'Bagaimana cara pemesanan layanan Jasa Konstruksi?',
            'answer' => 'Pemesanan layanan Jasa Konstruksi dapat dilakukan dengan menghubungi tim kami melalui website atau kontak yang tersedia. Setelah itu, akan ada konsultasi awal mengenai kebutuhan proyek Anda, dan kami akan memberikan penawaran sesuai dengan scope pekerjaan.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqJasaKonstruksi::create([
            'question' => 'Apakah Jasa Konstruksi mencakup instalasi di lapangan?',
            'answer' => 'Ya, layanan Jasa Konstruksi kami mencakup instalasi di lapangan sesuai dengan kebutuhan proyek. Tim kami akan memastikan semua pekerjaan konstruksi dilakukan dengan standar kualitas yang tinggi.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqJasaKonstruksi::create([
            'question' => 'Bagaimana estimasi biaya untuk proyek Konstruksi?',
            'answer' => 'Estimasi biaya proyek Konstruksi tergantung pada skala dan kompleksitas proyek. Setelah kami melakukan survei lokasi dan memahami kebutuhan proyek, kami akan memberikan estimasi biaya yang lebih akurat.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqJasaKonstruksi::create([
            'question' => 'Apakah bisa melakukan modifikasi pada layanan Jasa Konstruksi?',
            'answer' => 'Tentu, kami memungkinkan adanya modifikasi sesuai dengan kebutuhan dan permintaan Anda. Setiap perubahan akan dibahas dan disesuaikan dengan anggaran serta timeline yang ada.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqJasaKonstruksi::create([
            'question' => 'Seberapa lama durasi pengerjaan proyek Jasa Konstruksi?',
            'answer' => 'Durasi pengerjaan proyek Jasa Konstruksi sangat bergantung pada jenis dan ukuran proyek. Secara umum, kami akan memberikan estimasi waktu pengerjaan setelah konsultasi dan perencanaan proyek.',
            'image' => null, // Gambar default (jika ada)
        ]);        
    }
}