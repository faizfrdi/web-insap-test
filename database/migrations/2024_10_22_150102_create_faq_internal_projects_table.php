<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FaqInternalProject;

class CreateFaqInternalProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_internal_projects', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('image')->nullable(); // Kolom image yang opsional
            $table->text('answer');
            $table->timestamps();
        });

        // Seed the default FAQ data for Internal Project
        $this->seedFaqData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_internal_projects');
    }

    /**
     * Seed the initial FAQ data.
     */
    private function seedFaqData()
    {
        // Tambahkan data default FAQ untuk Internal Project dengan format create()
        FaqInternalProject::create([
            'question' => 'Apa itu Internal Project?',
            'answer' => 'Internal Project adalah proyek yang dilakukan di dalam organisasi atau perusahaan untuk tujuan internal, seperti pengembangan sistem, peningkatan proses, atau implementasi teknologi baru. Proyek ini bertujuan untuk mendukung tujuan organisasi dan meningkatkan efisiensi operasional.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqInternalProject::create([
            'question' => 'Bagaimana cara mengelola Internal Project?',
            'answer' => 'Mengelola Internal Project melibatkan beberapa langkah penting, seperti perencanaan proyek, penetapan anggaran, pembagian tugas tim, serta pemantauan kemajuan proyek secara rutin. Penggunaan alat manajemen proyek dan komunikasi yang efektif antar anggota tim sangat penting dalam keberhasilan proyek.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqInternalProject::create([
            'question' => 'Apa saja manfaat dari Internal Project?',
            'answer' => 'Manfaat dari Internal Project meliputi peningkatan efisiensi operasional, pengembangan kapasitas tim, serta pemecahan masalah internal yang dapat meningkatkan kinerja organisasi secara keseluruhan. Selain itu, proyek ini juga membantu organisasi untuk beradaptasi dengan perubahan dan kebutuhan pasar.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqInternalProject::create([
            'question' => 'Apakah ada sistem monitoring untuk Internal Project?',
            'answer' => 'Ya, sistem monitoring untuk Internal Project dapat digunakan untuk melacak kemajuan proyek, memastikan bahwa proyek berjalan sesuai dengan jadwal dan anggaran. Sistem ini dapat berupa perangkat lunak manajemen proyek, dashboard visualisasi, atau laporan rutin yang memungkinkan manajer proyek untuk mengambil keputusan yang tepat.',
            'image' => null, // Gambar default (jika ada)
        ]);
        
        FaqInternalProject::create([
            'question' => 'Bagaimana cara pelaporan dalam Internal Project?',
            'answer' => 'Pelaporan dalam Internal Project dilakukan dengan menyusun laporan berkala yang mencakup perkembangan proyek, penggunaan anggaran, serta tantangan yang dihadapi. Laporan ini biasanya disampaikan kepada pemangku kepentingan atau manajemen untuk memberikan gambaran jelas mengenai status dan hasil proyek.',
            'image' => null, // Gambar default (jika ada)
        ]);        
    }
}