<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\InternalProject;

class CreateInternalProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_projects', function (Blueprint $table) {
            $table->id();
            $table->string('urutan'); // Kolom untuk urutan
            $table->string('judul'); // Kolom untuk judul
            $table->text('input_process'); // Kolom untuk Input Process
            $table->text('output_process'); // Kolom untuk Output Process
            $table->string('pic'); // Kolom untuk PIC
            $table->string('t_code'); // Kolom untuk T-Code
            $table->text('proses'); // Kolom untuk Proses
            $table->string('link_terkait'); // Kolom untuk Link Terkait
            $table->string('module'); // Kolom module
            $table->string('image')->nullable(); // Kolom image opsional
            $table->string('slug')->unique()->nullable(); // Kolom slug untuk URL
            $table->timestamps();
        });

        // Seed data awal internal project
        $this->seedInternalProjectData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_projects');
    }

    /**
     * Seed data awal internal project.
     */
    private function seedInternalProjectData()
    {
        InternalProject::create([
            'urutan' => '1',
            'judul' => 'Profit Center',
            'input_process' => 'Input data profit center.',
            'output_process' => 'Profit center berhasil dibuat.',
            'pic' => 'John Doe',
            't_code' => 'FM001',
            'proses' => 'Membuat profit center untuk keperluan laporan keuangan.',
            'link_terkait' => 'http://example.com/profit-center',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'profit-center',
        ]);

        InternalProject::create([
            'urutan' => '2',
            'judul' => 'Project Definition & WBS',
            'input_process' => 'Input definisi proyek dan WBS.',
            'output_process' => 'Definisi proyek dan WBS selesai dibuat.',
            'pic' => 'Jane Smith',
            't_code' => 'PS001',
            'proses' => 'Mendefinisikan proyek dan membuat WBS.',
            'link_terkait' => 'http://example.com/project-definition-wbs',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-definition-wbs',
        ]);

        InternalProject::create([
            'urutan' => '3',
            'judul' => 'Project Cost Planning',
            'input_process' => 'Input perencanaan biaya proyek.',
            'output_process' => 'Perencanaan biaya proyek selesai.',
            'pic' => 'Emily Brown',
            't_code' => 'PS002',
            'proses' => 'Merencanakan biaya proyek berdasarkan WBS.',
            'link_terkait' => 'http://example.com/project-cost-planning',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-cost-planning',
        ]);

        InternalProject::create([
            'urutan' => '4',
            'judul' => 'Project Budget',
            'input_process' => 'Input data anggaran proyek.',
            'output_process' => 'Anggaran proyek berhasil dibuat.',
            'pic' => 'Michael Taylor',
            't_code' => 'PS003',
            'proses' => 'Menyusun anggaran proyek berdasarkan rencana biaya.',
            'link_terkait' => 'http://example.com/project-budget',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-budget',
        ]);

        InternalProject::create([
            'urutan' => '5',
            'judul' => 'Project Release',
            'input_process' => 'Input pelepasan proyek untuk eksekusi.',
            'output_process' => 'Proyek berhasil dilepas.',
            'pic' => 'Sarah Davis',
            't_code' => 'PS004',
            'proses' => 'Melepaskan proyek untuk pelaksanaan.',
            'link_terkait' => 'http://example.com/project-release',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-release',
        ]);

        InternalProject::create([
            'urutan' => '6',
            'judul' => 'Asset Under Construction',
            'input_process' => 'Input data aset dalam konstruksi.',
            'output_process' => 'Aset dalam konstruksi tercatat.',
            'pic' => 'William Moore',
            't_code' => 'FI001',
            'proses' => 'Mencatat aset dalam konstruksi untuk proyek.',
            'link_terkait' => 'http://example.com/asset-under-construction',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'asset-under-construction',
        ]);

        InternalProject::create([
            'urutan' => '7',
            'judul' => 'Automatic Purchase Requisition',
            'input_process' => 'Input kebutuhan pembelian otomatis.',
            'output_process' => 'Permintaan pembelian otomatis dibuat.',
            'pic' => 'Lucas White',
            't_code' => 'MM001',
            'proses' => 'Membuat permintaan pembelian secara otomatis.',
            'link_terkait' => 'http://example.com/automatic-purchase-requisition',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'automatic-purchase-requisition',
        ]);

        InternalProject::create([
            'urutan' => '8',
            'judul' => 'Request for Quotation',
            'input_process' => 'Input data permintaan penawaran harga.',
            'output_process' => 'Permintaan penawaran harga berhasil dibuat.',
            'pic' => 'Olivia Harris',
            't_code' => 'MM002',
            'proses' => 'Mengelola permintaan penawaran harga dari vendor.',
            'link_terkait' => 'http://example.com/request-for-quotation',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'request-for-quotation',
        ]);

        InternalProject::create([
            'urutan' => '9',
            'judul' => 'Price Comparison',
            'input_process' => 'Input data perbandingan harga vendor.',
            'output_process' => 'Perbandingan harga vendor berhasil dibuat.',
            'pic' => 'Sophia Martinez',
            't_code' => 'MM003',
            'proses' => 'Membandingkan harga vendor untuk proyek.',
            'link_terkait' => 'http://example.com/price-comparison',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'price-comparison',
        ]);

        InternalProject::create([
            'urutan' => '10',
            'judul' => 'Purchase Order',
            'input_process' => 'Input data pesanan pembelian.',
            'output_process' => 'Pesanan pembelian berhasil dibuat.',
            'pic' => 'Emma Taylor',
            't_code' => 'MM004',
            'proses' => 'Mengelola pesanan pembelian kepada vendor.',
            'link_terkait' => 'http://example.com/purchase-order',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-order',
        ]);

        InternalProject::create([
            'urutan' => '11',
            'judul' => 'Down Payment Request Vendor',
            'input_process' => 'Input data permintaan pembayaran awal vendor.',
            'output_process' => 'Permintaan pembayaran awal berhasil dibuat.',
            'pic' => 'Henry Walker',
            't_code' => 'FI002',
            'proses' => 'Mengajukan permintaan pembayaran awal kepada vendor.',
            'link_terkait' => 'http://example.com/down-payment-request-vendor',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'down-payment-request-vendor',
        ]);

        InternalProject::create([
            'urutan' => '12',
            'judul' => 'Posting Down Payment Vendor',
            'input_process' => 'Input data posting pembayaran awal.',
            'output_process' => 'Pembayaran awal vendor berhasil diposting.',
            'pic' => 'Lucas Edwards',
            't_code' => 'FI003',
            'proses' => 'Memposting pembayaran awal kepada vendor.',
            'link_terkait' => 'http://example.com/posting-down-payment-vendor',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'posting-down-payment-vendor',
        ]);

        InternalProject::create([
            'urutan' => '13',
            'judul' => 'Good Receipt / Service Entry Sheet',
            'input_process' => 'Input data penerimaan barang atau layanan.',
            'output_process' => 'Barang atau layanan berhasil diterima.',
            'pic' => 'Mia Clark',
            't_code' => 'MM005',
            'proses' => 'Mencatat penerimaan barang atau layanan untuk proyek.',
            'link_terkait' => 'http://example.com/good-receipt-service-entry-sheet',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-receipt-service-entry-sheet',
        ]);

        InternalProject::create([
            'urutan' => '14',
            'judul' => 'Invoice Receipt',
            'input_process' => 'Input data faktur vendor.',
            'output_process' => 'Faktur vendor berhasil diterima.',
            'pic' => 'Benjamin White',
            't_code' => 'FI004',
            'proses' => 'Memproses faktur vendor.',
            'link_terkait' => 'http://example.com/invoice-receipt',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'invoice-receipt',
        ]);

        InternalProject::create([
            'urutan' => '15',
            'judul' => 'Outgoing Payment',
            'input_process' => 'Input data pembayaran kepada vendor.',
            'output_process' => 'Pembayaran kepada vendor berhasil dilakukan.',
            'pic' => 'Emma Walker',
            't_code' => 'FI005',
            'proses' => 'Melakukan pembayaran kepada vendor.',
            'link_terkait' => 'http://example.com/outgoing-payment',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'outgoing-payment',
        ]);

        InternalProject::create([
            'urutan' => '16',
            'judul' => 'Clearing Invoice Vendor',
            'input_process' => 'Input data penyelesaian faktur vendor.',
            'output_process' => 'Penyelesaian faktur vendor selesai.',
            'pic' => 'Charlotte Davis',
            't_code' => 'FI006',
            'proses' => 'Menyelesaikan pembayaran faktur vendor.',
            'link_terkait' => 'http://example.com/clearing-invoice-vendor',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'clearing-invoice-vendor',
        ]);

        InternalProject::create([
            'urutan' => '17',
            'judul' => 'Good Issue to Project',
            'input_process' => 'Input data pengeluaran barang untuk proyek.',
            'output_process' => 'Barang berhasil dikeluarkan untuk proyek.',
            'pic' => 'Ethan Martinez',
            't_code' => 'MM006',
            'proses' => 'Mencatat pengeluaran barang untuk kebutuhan proyek.',
            'link_terkait' => 'http://example.com/good-issue-to-project',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-issue-to-project',
        ]);

        InternalProject::create([
            'urutan' => '18',
            'judul' => 'Project Confirmation',
            'input_process' => 'Input data konfirmasi proyek.',
            'output_process' => 'Proyek berhasil dikonfirmasi.',
            'pic' => 'Michael Wilson',
            't_code' => 'PS005',
            'proses' => 'Mengelola konfirmasi proyek.',
            'link_terkait' => 'http://example.com/project-confirmation',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-confirmation',
        ]);

        InternalProject::create([
            'urutan' => '19',
            'judul' => 'Project Progress Analysis',
            'input_process' => 'Input data analisis kemajuan proyek.',
            'output_process' => 'Laporan kemajuan proyek berhasil dibuat.',
            'pic' => 'Henry Bennett',
            't_code' => 'PS006',
            'proses' => 'Menganalisis kemajuan proyek berdasarkan WBS.',
            'link_terkait' => 'http://example.com/project-progress-analysis',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-progress-analysis',
        ]);

        InternalProject::create([
            'urutan' => '20',
            'judul' => 'Settlement WBS Project to AUC',
            'input_process' => 'Input data penyelesaian WBS ke aset dalam konstruksi.',
            'output_process' => 'Penyelesaian WBS berhasil dilakukan.',
            'pic' => 'Sophia Taylor',
            't_code' => 'FI007',
            'proses' => 'Menyelesaikan WBS proyek ke aset dalam konstruksi.',
            'link_terkait' => 'http://example.com/settlement-wbs-project-to-auc',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'settlement-wbs-project-to-auc',
        ]);

        InternalProject::create([
            'urutan' => '21',
            'judul' => 'Fixed Asset',
            'input_process' => 'Input data aset tetap.',
            'output_process' => 'Aset tetap berhasil dicatat.',
            'pic' => 'Lucas Wright',
            't_code' => 'FI008',
            'proses' => 'Mencatat aset tetap untuk operasional.',
            'link_terkait' => 'http://example.com/fixed-asset',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'fixed-asset',
        ]);

        InternalProject::create([
            'urutan' => '22',
            'judul' => 'Settlement AUC to FXA',
            'input_process' => 'Input data penyelesaian aset dalam konstruksi ke aset tetap.',
            'output_process' => 'Aset dalam konstruksi berhasil diselesaikan menjadi aset tetap.',
            'pic' => 'Ethan Campbell',
            't_code' => 'FI009',
            'proses' => 'Menyelesaikan aset dalam konstruksi ke aset tetap.',
            'link_terkait' => 'http://example.com/settlement-auc-to-fxa',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'settlement-auc-to-fxa',
        ]);

        InternalProject::create([
            'urutan' => '23',
            'judul' => 'Technically Completed',
            'input_process' => 'Input data penyelesaian teknis proyek.',
            'output_process' => 'Proyek selesai secara teknis.',
            'pic' => 'Mia Lopez',
            't_code' => 'PS007',
            'proses' => 'Menandai proyek selesai secara teknis.',
            'link_terkait' => 'http://example.com/technically-completed',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'technically-completed',
        ]);

        InternalProject::create([
            'urutan' => '24',
            'judul' => 'Business Closed Project',
            'input_process' => 'Input data penutupan proyek bisnis.',
            'output_process' => 'Proyek bisnis berhasil ditutup.',
            'pic' => 'Noah Allen',
            't_code' => 'PS008',
            'proses' => 'Menutup proyek bisnis secara formal.',
            'link_terkait' => 'http://example.com/business-closed-project',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'business-closed-project',
        ]);
    }
}