<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JasaNonKonstruksi;

class CreateJasaNonKonstruksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_non_konstruksis', function (Blueprint $table) {
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

        // Seed data awal jasa non konstruksi
        $this->seedJasaNonKonstruksiData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jasa_non_konstruksis');
    }

    /**
     * Seed data awal jasa non konstruksi.
     */
    private function seedJasaNonKonstruksiData()
    {
        JasaNonKonstruksi::create([
            'urutan' => '1',
            'judul' => 'Create Standard Network',
            'input_process' => 'Input data jaringan standar proyek.',
            'output_process' => 'Jaringan standar proyek berhasil dibuat.',
            'pic' => 'John Doe',
            't_code' => 'PS001',
            'proses' => 'Membuat jaringan standar untuk proyek.',
            'link_terkait' => 'http://example.com/create-standard-network',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'create-standard-network',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '2',
            'judul' => 'Sales Order',
            'input_process' => 'Input data pesanan penjualan.',
            'output_process' => 'Dokumen pesanan penjualan berhasil dibuat.',
            'pic' => 'Jane Smith',
            't_code' => 'SD001',
            'proses' => 'Memproses pesanan penjualan.',
            'link_terkait' => 'http://example.com/sales-order',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'sales-order',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '3',
            'judul' => 'Down Payment Request Customer',
            'input_process' => 'Input data pembayaran awal dari pelanggan.',
            'output_process' => 'Permintaan pembayaran awal berhasil diproses.',
            'pic' => 'Emily Brown',
            't_code' => 'SD051',
            'proses' => 'Mengelola permintaan pembayaran awal pelanggan.',
            'link_terkait' => 'http://example.com/down-payment-request-customer',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'down-payment-request-customer',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '4',
            'judul' => 'Posting Down Payment Customer',
            'input_process' => 'Input data posting pembayaran awal pelanggan.',
            'output_process' => 'Pembayaran awal pelanggan berhasil diposting.',
            'pic' => 'Mike Lee',
            't_code' => 'FI002',
            'proses' => 'Memposting pembayaran awal pelanggan.',
            'link_terkait' => 'http://example.com/posting-down-payment-customer',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'posting-down-payment-customer',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '5',
            'judul' => 'Automatic Network from SO',
            'input_process' => 'Input data jaringan otomatis dari pesanan penjualan.',
            'output_process' => 'Jaringan otomatis berhasil dibuat.',
            'pic' => 'Anna Davis',
            't_code' => 'PS002',
            'proses' => 'Membuat jaringan otomatis berdasarkan pesanan penjualan.',
            'link_terkait' => 'http://example.com/automatic-network-from-so',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'automatic-network-from-so',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '6',
            'judul' => 'Activity Planning',
            'input_process' => 'Input data rencana aktivitas.',
            'output_process' => 'Rencana aktivitas berhasil dibuat.',
            'pic' => 'Lucas Martin',
            't_code' => 'PS003',
            'proses' => 'Menyusun rencana aktivitas untuk proyek.',
            'link_terkait' => 'http://example.com/activity-planning',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'activity-planning',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '7',
            'judul' => 'Network Release',
            'input_process' => 'Input data pelepasan jaringan proyek.',
            'output_process' => 'Jaringan proyek berhasil dilepas.',
            'pic' => 'Ethan Taylor',
            't_code' => 'PS004',
            'proses' => 'Melepaskan jaringan proyek untuk eksekusi.',
            'link_terkait' => 'http://example.com/network-release',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'network-release',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '8',
            'judul' => 'Automatic Purchase Requisition',
            'input_process' => 'Input data kebutuhan pembelian otomatis.',
            'output_process' => 'Permintaan pembelian otomatis dibuat.',
            'pic' => 'Sophia Johnson',
            't_code' => 'PS005',
            'proses' => 'Membuat permintaan pembelian secara otomatis.',
            'link_terkait' => 'http://example.com/automatic-purchase-requisition',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'automatic-purchase-requisition',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '9',
            'judul' => 'Purchase Requisition Release',
            'input_process' => 'Input data pelepasan permintaan pembelian.',
            'output_process' => 'Permintaan pembelian berhasil dilepas.',
            'pic' => 'Oliver Martinez',
            't_code' => 'MM001',
            'proses' => 'Melepas permintaan pembelian untuk diproses.',
            'link_terkait' => 'http://example.com/purchase-requisition-release',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-requisition-release',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '10',
            'judul' => 'Request for Quotation',
            'input_process' => 'Input data permintaan penawaran ke vendor.',
            'output_process' => 'Permintaan penawaran berhasil dibuat.',
            'pic' => 'Mason Clark',
            't_code' => 'MM002',
            'proses' => 'Mengajukan permintaan penawaran harga ke vendor.',
            'link_terkait' => 'http://example.com/request-for-quotation',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'request-for-quotation',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '11',
            'judul' => 'Purchase Order',
            'input_process' => 'Input data pesanan pembelian.',
            'output_process' => 'Pesanan pembelian berhasil dibuat.',
            'pic' => 'Liam Harris',
            't_code' => 'MM003',
            'proses' => 'Membuat pesanan pembelian kepada vendor.',
            'link_terkait' => 'http://example.com/purchase-order',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-order',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '12',
            'judul' => 'Good Receipt / Service Entry Sheet',
            'input_process' => 'Input data penerimaan barang atau layanan.',
            'output_process' => 'Barang atau layanan berhasil diterima.',
            'pic' => 'Emma Rodriguez',
            't_code' => 'MM004',
            'proses' => 'Mencatat penerimaan barang atau layanan.',
            'link_terkait' => 'http://example.com/good-receipt-service-entry-sheet',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-receipt-service-entry-sheet',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '13',
            'judul' => 'Invoice Receipt',
            'input_process' => 'Input data faktur dari vendor.',
            'output_process' => 'Faktur vendor berhasil diterima.',
            'pic' => 'Ella Wright',
            't_code' => 'FI003',
            'proses' => 'Memproses faktur dari vendor.',
            'link_terkait' => 'http://example.com/invoice-receipt',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'invoice-receipt',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '14',
            'judul' => 'Outgoing Payment',
            'input_process' => 'Input data pembayaran ke vendor.',
            'output_process' => 'Pembayaran ke vendor berhasil diproses.',
            'pic' => 'Ava Lee',
            't_code' => 'FI004',
            'proses' => 'Melakukan pembayaran kepada vendor.',
            'link_terkait' => 'http://example.com/outgoing-payment',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'outgoing-payment',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '15',
            'judul' => 'Reservation Review',
            'input_process' => 'Input data review reservasi barang.',
            'output_process' => 'Review reservasi barang selesai.',
            'pic' => 'Amelia Perez',
            't_code' => 'MM005',
            'proses' => 'Mereview reservasi barang untuk kebutuhan produksi.',
            'link_terkait' => 'http://example.com/reservation-review',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'reservation-review',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '16',
            'judul' => 'Good Issue to Reservation',
            'input_process' => 'Input data pengeluaran barang.',
            'output_process' => 'Barang berhasil dikeluarkan untuk reservasi.',
            'pic' => 'Mia Turner',
            't_code' => 'MM006',
            'proses' => 'Melakukan pengeluaran barang untuk memenuhi reservasi.',
            'link_terkait' => 'http://example.com/good-issue-to-reservation',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-issue-to-reservation',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '17',
            'judul' => 'Confirmation',
            'input_process' => 'Input data konfirmasi pekerjaan proyek.',
            'output_process' => 'Konfirmasi pekerjaan proyek selesai.',
            'pic' => 'Lucas Edwards',
            't_code' => 'PS006',
            'proses' => 'Mengkonfirmasi aktivitas proyek yang telah selesai.',
            'link_terkait' => 'http://example.com/confirmation',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'confirmation',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '18',
            'judul' => 'Billing Plan (Termin) Processing',
            'input_process' => 'Input data termin pembayaran pelanggan.',
            'output_process' => 'Termin pembayaran berhasil diproses.',
            'pic' => 'Ethan Anderson',
            't_code' => 'SD002',
            'proses' => 'Mengelola termin pembayaran untuk pelanggan.',
            'link_terkait' => 'http://example.com/billing-plan-termin-processing',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'billing-plan-termin-processing',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '19',
            'judul' => 'Billing Processing',
            'input_process' => 'Input data tagihan pelanggan.',
            'output_process' => 'Tagihan pelanggan berhasil dibuat.',
            'pic' => 'Harper Wilson',
            't_code' => 'SD003',
            'proses' => 'Mengelola proses pembuatan tagihan pelanggan.',
            'link_terkait' => 'http://example.com/billing-processing',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'billing-processing',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '20',
            'judul' => 'Incoming Payment & Clearing DP',
            'input_process' => 'Input data pembayaran masuk dari pelanggan.',
            'output_process' => 'Pembayaran masuk berhasil diproses.',
            'pic' => 'Jack Campbell',
            't_code' => 'FI005',
            'proses' => 'Mencatat pembayaran masuk dan menyelesaikan DP.',
            'link_terkait' => 'http://example.com/incoming-payment-clearing-dp',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'incoming-payment-clearing-dp',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '21',
            'judul' => 'Monthly Closing - Result Analysis',
            'input_process' => 'Input data analisis hasil bulanan.',
            'output_process' => 'Laporan hasil bulanan selesai.',
            'pic' => 'Avery Mitchell',
            't_code' => 'CO001',
            'proses' => 'Menyelesaikan analisis hasil bulanan.',
            'link_terkait' => 'http://example.com/monthly-closing-result-analysis',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'monthly-closing-result-analysis',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '22',
            'judul' => 'Settlement',
            'input_process' => 'Input data penyelesaian proyek.',
            'output_process' => 'Penyelesaian proyek berhasil dilakukan.',
            'pic' => 'Grace Carter',
            't_code' => 'PS007',
            'proses' => 'Melakukan penyelesaian proyek secara finansial.',
            'link_terkait' => 'http://example.com/settlement',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'settlement',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '23',
            'judul' => 'Technically Completed',
            'input_process' => 'Input data penyelesaian teknis proyek.',
            'output_process' => 'Proyek berhasil selesai secara teknis.',
            'pic' => 'Ella Gray',
            't_code' => 'PS008',
            'proses' => 'Menandai proyek selesai secara teknis.',
            'link_terkait' => 'http://example.com/technically-completed',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'technically-completed',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '24',
            'judul' => 'Settlement SO',
            'input_process' => 'Input data penyelesaian pesanan penjualan.',
            'output_process' => 'Pesanan penjualan berhasil diselesaikan.',
            'pic' => 'James Lewis',
            't_code' => 'SD004',
            'proses' => 'Menyelesaikan pesanan penjualan.',
            'link_terkait' => 'http://example.com/settlement-so',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'settlement-so',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '25',
            'judul' => 'CO-PA Report',
            'input_process' => 'Input data laporan profitabilitas.',
            'output_process' => 'Laporan profitabilitas selesai.',
            'pic' => 'Charlotte Walker',
            't_code' => 'CO002',
            'proses' => 'Menyusun laporan profitabilitas pelanggan.',
            'link_terkait' => 'http://example.com/co-pa-report',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'co-pa-report',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '26',
            'judul' => 'Retensi',
            'input_process' => 'Input data retensi proyek.',
            'output_process' => 'Data retensi berhasil dikelola.',
            'pic' => 'Henry Allen',
            't_code' => 'SD005',
            'proses' => 'Mengelola retensi proyek hingga selesai.',
            'link_terkait' => 'http://example.com/retensi',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'retensi',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '27',
            'judul' => 'Billing Retensi',
            'input_process' => 'Input data tagihan retensi.',
            'output_process' => 'Tagihan retensi berhasil dibuat.',
            'pic' => 'Oliver Brooks',
            't_code' => 'SD006',
            'proses' => 'Membuat tagihan retensi untuk pelanggan.',
            'link_terkait' => 'http://example.com/billing-retensi',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'billing-retensi',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '28',
            'judul' => 'Incoming Payment Retention and Clearing',
            'input_process' => 'Input data pembayaran retensi pelanggan.',
            'output_process' => 'Pembayaran retensi berhasil diproses.',
            'pic' => 'Mason Bennett',
            't_code' => 'FI006',
            'proses' => 'Memproses pembayaran retensi dari pelanggan.',
            'link_terkait' => 'http://example.com/incoming-payment-retention-clearing',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'incoming-payment-retention-clearing',
        ]);

        JasaNonKonstruksi::create([
            'urutan' => '29',
            'judul' => 'Business Closed Project',
            'input_process' => 'Input data penutupan proyek bisnis.',
            'output_process' => 'Proyek bisnis berhasil ditutup.',
            'pic' => 'Sophia Torres',
            't_code' => 'PS009',
            'proses' => 'Menutup proyek bisnis secara formal.',
            'link_terkait' => 'http://example.com/business-closed-project',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'business-closed-project',
        ]);
    }
}