<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqJasaNonKonstruksi;

class CreateFaqJasaNonKonstruksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_jasa_non_konstruksis', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable(); // Kolom image yang opsional
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the default FAQ data for Jasa Non Konstruksi
        $this->seedFaqData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_jasa_non_konstruksis');
    }

    /**
     * Seed the initial FAQ data.
     */
    private function seedFaqData()
    {
        // Tambahkan data default FAQ untuk Jasa Non Konstruksi dengan format create()
        FaqJasaNonKonstruksi::create([
            'question' => 'Bagaimana cara menggunakan layanan Jasa Non Konstruksi?',
            'answer' => 'Untuk menggunakan layanan Jasa Non Konstruksi, Anda dapat menghubungi tim kami melalui platform yang tersedia atau langsung mengisi form permintaan layanan. Kami akan mengonfirmasi permintaan Anda dan memberikan rincian lebih lanjut mengenai layanan yang dibutuhkan.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqJasaNonKonstruksi::create([
            'question' => 'Apakah Jasa Non Konstruksi menyediakan layanan kustom?',
            'answer' => 'Ya, kami menyediakan layanan kustom sesuai dengan kebutuhan dan permintaan khusus dari pelanggan. Anda bisa mendiskusikan detail layanan yang diinginkan dan kami akan menyesuaikan dengan anggaran dan timeline proyek.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqJasaNonKonstruksi::create([
            'question' => 'Bagaimana cara menghitung biaya layanan Jasa Non Konstruksi?',
            'answer' => 'Biaya layanan dihitung berdasarkan kompleksitas dan ruang lingkup pekerjaan. Kami akan memberikan estimasi biaya setelah mendapatkan informasi lebih lanjut mengenai kebutuhan spesifik dari proyek yang diajukan.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqJasaNonKonstruksi::create([
            'question' => 'Berapa lama durasi pengerjaan untuk Jasa Non Konstruksi?',
            'answer' => 'Durasi pengerjaan untuk Jasa Non Konstruksi bervariasi tergantung pada jenis layanan yang diminta. Setelah mengetahui rincian proyek, kami akan memberikan estimasi waktu penyelesaian yang lebih akurat.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqJasaNonKonstruksi::create([
            'question' => 'Apakah layanan Jasa Non Konstruksi mencakup wilayah nasional?',
            'answer' => 'Ya, layanan Jasa Non Konstruksi kami mencakup seluruh wilayah Indonesia. Kami siap untuk bekerja di berbagai daerah sesuai dengan permintaan pelanggan.',
            'image' => null, // Gambar default (jika ada)
        ]);        
    }
}