<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Manufacturing;

class CreateManufacturingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturings', function (Blueprint $table) {
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

        // Seed data awal manufacturing
        $this->seedManufacturingData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacturings');
    }

    /**
     * Seed data awal manufacturing.
     */
    private function seedManufacturingData()
    {
        Manufacturing::create([
            'urutan' => '1',
            'judul' => 'Cost Center Planning',
            'input_process' => 'Input data cost center dan alokasi struktur biaya.',
            'output_process' => 'Rencana biaya cost center siap digunakan.',
            'pic' => 'John Doe',
            't_code' => 'KP001',
            'proses' => 'Perencanaan biaya untuk setiap cost center.',
            'link_terkait' => 'http://example.com/cost-center-planning',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'cost-center-planning',
        ]);

        Manufacturing::create([
            'urutan' => '2',
            'judul' => 'Activity Rate Planning',
            'input_process' => 'Input data aktivitas dan tarif per jam kerja.',
            'output_process' => 'Tarif aktivitas yang telah direncanakan.',
            'pic' => 'Jane Doe',
            't_code' => 'KP002',
            'proses' => 'Menentukan tarif aktivitas berdasarkan biaya teralokasi.',
            'link_terkait' => 'http://example.com/activity-rate-planning',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'activity-rate-planning',
        ]);

        Manufacturing::create([
            'urutan' => '3',
            'judul' => 'Standard Cost Estimate',
            'input_process' => 'Data material dan harga input dimasukkan.',
            'output_process' => 'Estimasi biaya standar tersedia.',
            'pic' => 'Mike Smith',
            't_code' => 'KP003',
            'proses' => 'Menghitung estimasi biaya standar untuk produk.',
            'link_terkait' => 'http://example.com/standard-cost-estimate',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'standard-cost-estimate',
        ]);

        Manufacturing::create([
            'urutan' => '4',
            'judul' => 'FM Budgeting',
            'input_process' => 'Data anggaran fasilitas dimasukkan.',
            'output_process' => 'Anggaran fasilitas ditetapkan.',
            'pic' => 'Sarah Lee',
            't_code' => 'KP004',
            'proses' => 'Menyiapkan anggaran fasilitas manajemen.',
            'link_terkait' => 'http://example.com/fm-budgeting',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'fm-budgeting',
        ]);

        Manufacturing::create([
            'urutan' => '5',
            'judul' => 'CO Production Order',
            'input_process' => 'Input data pesanan produksi.',
            'output_process' => 'Pesanan produksi siap dieksekusi.',
            'pic' => 'Tom Jones',
            't_code' => 'KP005',
            'proses' => 'Memproses pesanan produksi untuk manufaktur.',
            'link_terkait' => 'http://example.com/co-production-order',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'co-production-order',
        ]);

        Manufacturing::create([
            'urutan' => '6',
            'judul' => 'Purchase Requisition',
            'input_process' => 'Input kebutuhan pembelian barang dan jasa.',
            'output_process' => 'Rekomendasi permintaan pembelian diterbitkan.',
            'pic' => 'Anna Smith',
            't_code' => 'MM001',
            'proses' => 'Pembuatan permintaan pembelian barang/jasa.',
            'link_terkait' => 'http://example.com/purchase-requisition',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-requisition',
        ]);

        Manufacturing::create([
            'urutan' => '7',
            'judul' => 'Request for Quotation',
            'input_process' => 'Input daftar vendor untuk permintaan penawaran.',
            'output_process' => 'Dokumen permintaan penawaran diterbitkan.',
            'pic' => 'Emily White',
            't_code' => 'MM002',
            'proses' => 'Mengirimkan permintaan penawaran ke vendor.',
            'link_terkait' => 'http://example.com/request-for-quotation',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'request-for-quotation',
        ]);

        Manufacturing::create([
            'urutan' => '8',
            'judul' => 'Price Comparison',
            'input_process' => 'Input hasil penawaran harga dari vendor.',
            'output_process' => 'Laporan perbandingan harga vendor.',
            'pic' => 'Michael Brown',
            't_code' => 'MM003',
            'proses' => 'Membandingkan penawaran harga dari vendor.',
            'link_terkait' => 'http://example.com/price-comparison',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'price-comparison',
        ]);

        Manufacturing::create([
            'urutan' => '9',
            'judul' => 'Purchase Order',
            'input_process' => 'Input dokumen pemesanan barang ke vendor.',
            'output_process' => 'Dokumen pemesanan diterbitkan.',
            'pic' => 'David Clark',
            't_code' => 'MM004',
            'proses' => 'Membuat pesanan pembelian kepada vendor.',
            'link_terkait' => 'http://example.com/purchase-order',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-order',
        ]);

        Manufacturing::create([
            'urutan' => '10',
            'judul' => 'Down Payment Request',
            'input_process' => 'Input data pembayaran awal untuk vendor.',
            'output_process' => 'Permintaan pembayaran awal diterbitkan.',
            'pic' => 'Sophia Wilson',
            't_code' => 'FI001',
            'proses' => 'Mengajukan permintaan pembayaran awal.',
            'link_terkait' => 'http://example.com/down-payment-request',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'down-payment-request',
        ]);

        Manufacturing::create([
            'urutan' => '11',
            'judul' => 'Posting Down Payment Vendor',
            'input_process' => 'Input dokumen pembayaran ke vendor.',
            'output_process' => 'Pembayaran ke vendor berhasil diposting.',
            'pic' => 'Liam Martinez',
            't_code' => 'FI002',
            'proses' => 'Melakukan pembayaran awal kepada vendor.',
            'link_terkait' => 'http://example.com/posting-down-payment-vendor',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'posting-down-payment-vendor',
        ]);

        Manufacturing::create([
            'urutan' => '12',
            'judul' => 'Good Receipt from Purchase Order',
            'input_process' => 'Input dokumen penerimaan barang.',
            'output_process' => 'Barang diterima dari pesanan pembelian.',
            'pic' => 'Olivia Garcia',
            't_code' => 'MM005',
            'proses' => 'Penerimaan barang dari vendor berdasarkan PO.',
            'link_terkait' => 'http://example.com/good-receipt-from-purchase-order',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-receipt-from-purchase-order',
        ]);

        Manufacturing::create([
            'urutan' => '13',
            'judul' => 'Invoice Receipt',
            'input_process' => 'Input dokumen tagihan dari vendor.',
            'output_process' => 'Tagihan vendor berhasil diproses.',
            'pic' => 'William Hall',
            't_code' => 'FI003',
            'proses' => 'Menerima dan memproses faktur dari vendor.',
            'link_terkait' => 'http://example.com/invoice-receipt',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'invoice-receipt',
        ]);

        Manufacturing::create([
            'urutan' => '14',
            'judul' => 'Outgoing Payment',
            'input_process' => 'Input pembayaran kepada vendor.',
            'output_process' => 'Pembayaran kepada vendor berhasil.',
            'pic' => 'James Lee',
            't_code' => 'FI004',
            'proses' => 'Membayar tagihan vendor.',
            'link_terkait' => 'http://example.com/outgoing-payment',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'outgoing-payment',
        ]);

        Manufacturing::create([
            'urutan' => '15',
            'judul' => 'Clearing Invoice Vendor',
            'input_process' => 'Input dokumen penyelesaian tagihan vendor.',
            'output_process' => 'Tagihan vendor berhasil diselesaikan.',
            'pic' => 'Noah Adams',
            't_code' => 'FI005',
            'proses' => 'Menyelesaikan pembayaran terhadap faktur vendor.',
            'link_terkait' => 'http://example.com/clearing-invoice-vendor',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'clearing-invoice-vendor',
        ]);

        Manufacturing::create([
            'urutan' => '16',
            'judul' => 'Good Receipt CO Production',
            'input_process' => 'Input penerimaan barang dari produksi.',
            'output_process' => 'Barang hasil produksi diterima.',
            'pic' => 'Mason King',
            't_code' => 'MM006',
            'proses' => 'Penerimaan barang jadi dari proses produksi.',
            'link_terkait' => 'http://example.com/good-receipt-co-production',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-receipt-co-production',
        ]);

        Manufacturing::create([
            'urutan' => '17',
            'judul' => 'Good Issue from CO Production',
            'input_process' => 'Input pengeluaran barang untuk produksi.',
            'output_process' => 'Barang dikeluarkan untuk produksi.',
            'pic' => 'Ethan Wright',
            't_code' => 'MM007',
            'proses' => 'Mengelola barang yang dikeluarkan untuk produksi.',
            'link_terkait' => 'http://example.com/good-issue-from-co-production',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-issue-from-co-production',
        ]);

        Manufacturing::create([
            'urutan' => '18',
            'judul' => 'Sales Processing',
            'input_process' => 'Input data pesanan pelanggan.',
            'output_process' => 'Dokumen pemrosesan penjualan dibuat.',
            'pic' => 'Benjamin Scott',
            't_code' => 'SD001',
            'proses' => 'Proses penjualan kepada pelanggan.',
            'link_terkait' => 'http://example.com/sales-processing',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'sales-processing',
        ]);

        Manufacturing::create([
            'urutan' => '19',
            'judul' => 'Down Payment Customer',
            'input_process' => 'Input data pembayaran awal dari pelanggan.',
            'output_process' => 'Pembayaran awal pelanggan diproses.',
            'pic' => 'Lucas Rivera',
            't_code' => 'FI006',
            'proses' => 'Menerima pembayaran awal dari pelanggan.',
            'link_terkait' => 'http://example.com/down-payment-customer',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'down-payment-customer',
        ]);

        Manufacturing::create([
            'urutan' => '20',
            'judul' => 'Delivery Processing',
            'input_process' => 'Input data pengiriman barang ke pelanggan.',
            'output_process' => 'Barang berhasil dikirim.',
            'pic' => 'Henry Walker',
            't_code' => 'SD002',
            'proses' => 'Pengelolaan pengiriman barang ke pelanggan.',
            'link_terkait' => 'http://example.com/delivery-processing',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'delivery-processing',
        ]);

        Manufacturing::create([
            'urutan' => '21',
            'judul' => 'Post Good Issue',
            'input_process' => 'Input data pengeluaran barang.',
            'output_process' => 'Barang berhasil dikeluarkan.',
            'pic' => 'Sebastian Moore',
            't_code' => 'SD003',
            'proses' => 'Mencatat pengeluaran barang untuk penjualan.',
            'link_terkait' => 'http://example.com/post-good-issue',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'post-good-issue',
        ]);

        Manufacturing::create([
            'urutan' => '22',
            'judul' => 'Billing Processing',
            'input_process' => 'Input data tagihan ke pelanggan.',
            'output_process' => 'Tagihan berhasil dibuat.',
            'pic' => 'Jackson Nelson',
            't_code' => 'SD004',
            'proses' => 'Pembuatan tagihan pelanggan.',
            'link_terkait' => 'http://example.com/billing-processing',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'billing-processing',
        ]);

        Manufacturing::create([
            'urutan' => '23',
            'judul' => 'Incoming Payment & Clearing DP',
            'input_process' => 'Input data pembayaran masuk.',
            'output_process' => 'Pembayaran diterima dan diselesaikan.',
            'pic' => 'Alexander Perry',
            't_code' => 'FI007',
            'proses' => 'Mengelola pembayaran masuk dari pelanggan.',
            'link_terkait' => 'http://example.com/incoming-payment-clearing-dp',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'incoming-payment-clearing-dp',
        ]);

        Manufacturing::create([
            'urutan' => '24',
            'judul' => 'Cost Allocation Process',
            'input_process' => 'Input data alokasi biaya.',
            'output_process' => 'Alokasi biaya selesai.',
            'pic' => 'Carter Brooks',
            't_code' => 'CO001',
            'proses' => 'Melakukan alokasi biaya antar cost center.',
            'link_terkait' => 'http://example.com/cost-allocation-process',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'cost-allocation-process',
        ]);

        Manufacturing::create([
            'urutan' => '25',
            'judul' => 'Technicaly Complete',
            'input_process' => 'Input data penyelesaian teknis.',
            'output_process' => 'Pekerjaan selesai secara teknis.',
            'pic' => 'Matthew Foster',
            't_code' => 'CO002',
            'proses' => 'Menandai pekerjaan selesai secara teknis.',
            'link_terkait' => 'http://example.com/technicaly-complete',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'technicaly-complete',
        ]);

        Manufacturing::create([
            'urutan' => '26',
            'judul' => 'Variance Calculation',
            'input_process' => 'Input data untuk menghitung varians.',
            'output_process' => 'Varians biaya dihitung.',
            'pic' => 'Wyatt Gonzales',
            't_code' => 'CO003',
            'proses' => 'Menghitung selisih biaya aktual dan standar.',
            'link_terkait' => 'http://example.com/variance-calculation',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'variance-calculation',
        ]);

        Manufacturing::create([
            'urutan' => '27',
            'judul' => 'Result Analysis (WIP Calculation)',
            'input_process' => 'Input data WIP untuk analisis hasil.',
            'output_process' => 'Analisis hasil WIP selesai.',
            'pic' => 'Julian Harris',
            't_code' => 'CO004',
            'proses' => 'Menghitung pekerjaan dalam proses.',
            'link_terkait' => 'http://example.com/result-analysis-wip-calculation',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'result-analysis-wip-calculation',
        ]);

        Manufacturing::create([
            'urutan' => '28',
            'judul' => 'Settlement Process',
            'input_process' => 'Input data untuk settlement.',
            'output_process' => 'Settlement selesai.',
            'pic' => 'Hunter Murphy',
            't_code' => 'CO005',
            'proses' => 'Proses settlement biaya produksi.',
            'link_terkait' => 'http://example.com/settlement-process',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'settlement-process',
        ]);

        Manufacturing::create([
            'urutan' => '29',
            'judul' => 'CO-PA Report',
            'input_process' => 'Input data laporan profitabilitas.',
            'output_process' => 'Laporan CO-PA tersedia.',
            'pic' => 'Aaron Young',
            't_code' => 'CO006',
            'proses' => 'Menyusun laporan profitabilitas.',
            'link_terkait' => 'http://example.com/co-pa-report',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'co-pa-report',
        ]);
    }
}