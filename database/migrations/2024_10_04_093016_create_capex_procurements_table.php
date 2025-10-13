<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CapexProcurement;

class CreateCapexProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capex_procurements', function (Blueprint $table) {
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

        // Seed data awal capex procurement
        $this->seedCapexProcurementData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capex_procurements');
    }

    /**
     * Seed data awal capex procurement.
     */
    private function seedCapexProcurementData()
    {
        CapexProcurement::create([
            'urutan' => '1',
            'judul' => 'FM Budget Planning',
            'input_process' => 'Input data anggaran fasilitas manajemen.',
            'output_process' => 'Anggaran fasilitas manajemen direncanakan.',
            'pic' => 'John Doe',
            't_code' => 'FM001',
            'proses' => 'Menyusun rencana anggaran fasilitas.',
            'link_terkait' => 'http://example.com/fm-budget-planning',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'fm-budget-planning',
        ]);

        CapexProcurement::create([
            'urutan' => '2',
            'judul' => 'FM Budget Release',
            'input_process' => 'Input data pelepasan anggaran.',
            'output_process' => 'Anggaran berhasil dilepas.',
            'pic' => 'Jane Smith',
            't_code' => 'FM002',
            'proses' => 'Melepaskan anggaran untuk penggunaan.',
            'link_terkait' => 'http://example.com/fm-budget-release',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'fm-budget-release',
        ]);

        CapexProcurement::create([
            'urutan' => '3',
            'judul' => 'Asset Under Construction',
            'input_process' => 'Input data aset dalam konstruksi.',
            'output_process' => 'Aset dalam konstruksi tercatat.',
            'pic' => 'Emily Davis',
            't_code' => 'FI001',
            'proses' => 'Mencatat aset yang sedang dalam proses konstruksi.',
            'link_terkait' => 'http://example.com/asset-under-construction',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'asset-under-construction',
        ]);

        CapexProcurement::create([
            'urutan' => '4',
            'judul' => 'Purchase Requisition',
            'input_process' => 'Input data kebutuhan pembelian.',
            'output_process' => 'Permintaan pembelian diterbitkan.',
            'pic' => 'Michael Brown',
            't_code' => 'MM001',
            'proses' => 'Mengelola permintaan pembelian barang/jasa.',
            'link_terkait' => 'http://example.com/purchase-requisition',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-requisition',
        ]);

        CapexProcurement::create([
            'urutan' => '5',
            'judul' => 'Request for Quotation',
            'input_process' => 'Input data permintaan penawaran.',
            'output_process' => 'Permintaan penawaran ke vendor selesai.',
            'pic' => 'Sarah Taylor',
            't_code' => 'MM002',
            'proses' => 'Menerbitkan permintaan penawaran kepada vendor.',
            'link_terkait' => 'http://example.com/request-for-quotation',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'request-for-quotation',
        ]);

        CapexProcurement::create([
            'urutan' => '6',
            'judul' => 'Price Comparison',
            'input_process' => 'Input data perbandingan harga.',
            'output_process' => 'Laporan perbandingan harga selesai.',
            'pic' => 'William Johnson',
            't_code' => 'MM003',
            'proses' => 'Membandingkan penawaran harga dari vendor.',
            'link_terkait' => 'http://example.com/price-comparison',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'price-comparison',
        ]);

        CapexProcurement::create([
            'urutan' => '7',
            'judul' => 'Purchase Order',
            'input_process' => 'Input data pesanan pembelian.',
            'output_process' => 'Pesanan pembelian berhasil dibuat.',
            'pic' => 'Emma Wilson',
            't_code' => 'MM004',
            'proses' => 'Membuat pesanan pembelian kepada vendor.',
            'link_terkait' => 'http://example.com/purchase-order',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-order',
        ]);

        CapexProcurement::create([
            'urutan' => '8',
            'judul' => 'Down Payment Request Vendor',
            'input_process' => 'Input data pembayaran awal untuk vendor.',
            'output_process' => 'Permintaan pembayaran awal berhasil diproses.',
            'pic' => 'Olivia Martinez',
            't_code' => 'FI002',
            'proses' => 'Mengajukan permintaan pembayaran awal kepada vendor.',
            'link_terkait' => 'http://example.com/down-payment-request-vendor',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'down-payment-request-vendor',
        ]);

        CapexProcurement::create([
            'urutan' => '9',
            'judul' => 'Posting Down Payment Vendor',
            'input_process' => 'Input data posting pembayaran awal vendor.',
            'output_process' => 'Pembayaran awal vendor berhasil diposting.',
            'pic' => 'Ava Moore',
            't_code' => 'FI003',
            'proses' => 'Memposting pembayaran awal kepada vendor.',
            'link_terkait' => 'http://example.com/posting-down-payment-vendor',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'posting-down-payment-vendor',
        ]);

        CapexProcurement::create([
            'urutan' => '10',
            'judul' => 'Good Receipt',
            'input_process' => 'Input data penerimaan barang.',
            'output_process' => 'Barang diterima sesuai pesanan.',
            'pic' => 'Lucas Harris',
            't_code' => 'MM005',
            'proses' => 'Mencatat penerimaan barang dari vendor.',
            'link_terkait' => 'http://example.com/good-receipt',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-receipt',
        ]);

        CapexProcurement::create([
            'urutan' => '11',
            'judul' => 'Invoice Receipt',
            'input_process' => 'Input data faktur dari vendor.',
            'output_process' => 'Faktur berhasil diterima dan dicatat.',
            'pic' => 'Henry Clark',
            't_code' => 'FI004',
            'proses' => 'Memproses faktur dari vendor.',
            'link_terkait' => 'http://example.com/invoice-receipt',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'invoice-receipt',
        ]);

        CapexProcurement::create([
            'urutan' => '12',
            'judul' => 'Outgoing Payment',
            'input_process' => 'Input data pembayaran kepada vendor.',
            'output_process' => 'Pembayaran kepada vendor berhasil dilakukan.',
            'pic' => 'Ethan Walker',
            't_code' => 'FI005',
            'proses' => 'Melakukan pembayaran kepada vendor.',
            'link_terkait' => 'http://example.com/outgoing-payment',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'outgoing-payment',
        ]);

        CapexProcurement::create([
            'urutan' => '13',
            'judul' => 'Clearing Invoice Vendor',
            'input_process' => 'Input data penyelesaian faktur vendor.',
            'output_process' => 'Faktur vendor berhasil diselesaikan.',
            'pic' => 'Mia Martinez',
            't_code' => 'FI006',
            'proses' => 'Menyelesaikan pembayaran faktur kepada vendor.',
            'link_terkait' => 'http://example.com/clearing-invoice-vendor',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'clearing-invoice-vendor',
        ]);

        CapexProcurement::create([
            'urutan' => '14',
            'judul' => 'Acquisition AUC',
            'input_process' => 'Input data akuisisi aset dalam konstruksi.',
            'output_process' => 'Akuisisi aset dalam konstruksi selesai.',
            'pic' => 'Oliver Young',
            't_code' => 'FI007',
            'proses' => 'Mengelola akuisisi aset dalam konstruksi.',
            'link_terkait' => 'http://example.com/acquisition-auc',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'acquisition-auc',
        ]);

        CapexProcurement::create([
            'urutan' => '15',
            'judul' => 'Fixed Asset',
            'input_process' => 'Input data pencatatan aset tetap.',
            'output_process' => 'Aset tetap berhasil dicatat.',
            'pic' => 'Charlotte Taylor',
            't_code' => 'FI008',
            'proses' => 'Mencatat aset tetap untuk keperluan operasional.',
            'link_terkait' => 'http://example.com/fixed-asset',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'fixed-asset',
        ]);

        CapexProcurement::create([
            'urutan' => '16',
            'judul' => 'Settlement AUC to FXA',
            'input_process' => 'Input data penyelesaian aset dalam konstruksi ke aset tetap.',
            'output_process' => 'Aset dalam konstruksi berhasil diselesaikan menjadi aset tetap.',
            'pic' => 'Sophia White',
            't_code' => 'FI009',
            'proses' => 'Menyelesaikan konversi aset dalam konstruksi menjadi aset tetap.',
            'link_terkait' => 'http://example.com/settlement-auc-to-fxa',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'settlement-auc-to-fxa',
        ]);
    }
}