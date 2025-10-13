<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JasaKonstruksi;

class CreateJasaKonstruksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_konstruksis', function (Blueprint $table) {
            $table->id();
            $table->string('urutan'); // Kolom baru untuk urutan
            $table->string('judul'); // Kolom baru untuk judul
            $table->text('input_process'); // Kolom baru untuk Input Process
            $table->text('output_process'); // Kolom baru untuk Output Process
            $table->string('pic'); // Kolom baru untuk PIC
            $table->string('t_code'); // Kolom baru untuk T – Code
            $table->text('proses'); // Kolom baru untuk Proses
            $table->string('link_terkait')->nullable(); // Kolom baru untuk Link Terkait
            $table->string('module'); // Kolom module yang tetap ada
            $table->string('image')->nullable(); // Kolom image yang opsional
            $table->string('slug')->unique()->nullable(); // Slug untuk URL
            $table->timestamps();
        });

        // Seed data awal jasa konstruksi
        $this->seedJasaKonstruksiData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jasa_konstruksis');
    }

    /**
     * Seed data awal jasa konstruksi.
     */
    private function seedJasaKonstruksiData()
    {
        JasaKonstruksi::create([
            'urutan' => '1',
            'judul' => 'Posting Biaya Tender',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'John Doe',
            't_code' => 'T12345',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/posting-biaya-tender',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'posting-biaya-tender',
        ]);
    
        JasaKonstruksi::create([
            'urutan' => '2',
            'judul' => 'Profit Center',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Jane Doe',
            't_code' => 'T23456',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/profit-center',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'profit-center',
        ]);

        JasaKonstruksi::create([
            'urutan' => '3',
            'judul' => 'Project Definition, WBS Element & Milestone',
            'input_process' => 'Project Template (Excel)', 
            'output_process' => 'Project Definition, WBS Element & Milestone',
            'pic' => 'Tim Proyek',
            't_code' => 'CJ20N, Z10PS001',
            'proses' => 'Tim Proyek membuat project template dalam format Excel.',
            'link_terkait' => 'Pedoman master data dalam menyusun Project Structure WBS : https://adhi.co.id/s/masterdataps',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-definition-wbs-element-milestone',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '4',
            'judul' => 'Create Procurement Statement',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Procurement Specialist',
            't_code' => 'MM004',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/create-procurement-statement',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'create-procurement-statement',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '5',
            'judul' => 'Project Cost Planning',
            'input_process' => 'Project Template (Excel)', 
            'output_process' => 'Activity Element, Service Specification & Material Component',
            'pic' => 'Tim Proyek',
            't_code' => 'CJ20N, Z10PS001',
            'proses' => 'Tim Proyek menambahkan objek ke dalam struktur proyek berupa Activity Element, Service Specification, dan Material Component.',
            'link_terkait' => 'Master Data Bahan, Service dan Alat Terupdate : https://adhi.co.id/s/masterdatamm',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-cost-planning',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '6',
            'judul' => 'Project Budget',
            'input_process' => 'Project Template (Excel)', 
            'output_process' => 'Project Structure Created',
            'pic' => 'Tim Proyek',
            't_code' => 'CJ20N, Z10PS001',
            'proses' => 'Tim Proyek melakukan perencanaan dalam proyek dengan cara membuat struktur proyek, settlement rule, scheduling, network header, network activity, activity element , dan revenue plan. Project dapat menjadi budget dengan proses : • Original Budget, adalah nilai anggaran awal yang diberikan di dalam suatu WBS (berdasarkan Rencana Anggaran Biaya yang telah dibuat oleh team proyek dan juga sudah disetujui), termasuk WBS addendum yang baru dibuat (system status CRTD). • Budget Update, adalah suatu proses yang mengakibatkan anggaran suatu WBS berubah secara current budget tanpa mempengaruhi nilai original budget-nya. Terdapat 3 proses budget update, antara lain: o Budget Supplement, adalah suatu proses penambahan nilai terhadap suatu WBS yang akan menambah nilai current budget dari sisi total dalam 1 Project. o Budget Return, adalah suatu proses pengurangan nilai dari suatu current budget dan berdampak pada penurunan nilai current budget dari sisi total dalam 1 Project. o Budget Transfer, adalah suatu proses alokasi/transfer anggaran antar WBS.',
            'link_terkait' => 'Maintain UID Approval Budget : https://adhi.co.id/s/maintainuidapproval',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-budget',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '7',
            'judul' => 'Project Release',
            'input_process' => 'ID Project', 
            'output_process' => 'System Status REL',
            'pic' => 'Tim Proyek',
            't_code' => 'CJ20N, CJ02',
            'proses' => 'Tim Proyek melakukan Release atas Project Structure yang telah selesai dibuat dan sudah diapprove budgetnya',
            'link_terkait' => '-',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-release',
        ]);

        JasaKonstruksi::create([
            'urutan' => '8',
            'judul' => 'Generate Contract from Project',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Legal Counsel',
            't_code' => 'SD008',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/generate-contract-from-project',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'generate-contract-from-project',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '9',
            'judul' => 'Down Payment Request Customer',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Sales Representative',
            't_code' => 'SD009',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/down-payment-request-customer',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'down-payment-request-customer',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '10',
            'judul' => 'Posting Down Payment Customer',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Financial Accountant',
            't_code' => 'FI010',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/posting-down-payment-customer',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'posting-down-payment-customer',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '11',
            'judul' => 'Automatic Purchase Requisition',
            'input_process' => 'Activity, Material, Activity Services', 
            'output_process' => 'Terbentuk PR',
            'pic' => 'Tim Proyek',
            't_code' => 'CJ20N',
            'proses' => 'Tim Proyek melakukan release activity yang akan memicu terbentuknya PR secara otomatis',
            'link_terkait' => '-',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'automatic-purchase-requisition',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '12',
            'judul' => 'Purchase Requisition Release',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Procurement Head',
            't_code' => 'MM012',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/purchase-requisition-release',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-requisition-release',
        ]);

        JasaKonstruksi::create([
            'urutan' => '13',
            'judul' => 'Request for Quotation',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Procurement Specialist',
            't_code' => 'MM013',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/request-for-quotation',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'request-for-quotation',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '14a',
            'judul' => 'Purchase Order',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Procurement Manager',
            't_code' => 'MM014A',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/purchase-order',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'purchase-order',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '14b',
            'judul' => 'PO STO',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Logistics Coordinator',
            't_code' => 'MM014B',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/po-sto',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'po-sto',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '15',
            'judul' => 'Good Receipt / Service Entry Sheet',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Warehouse Manager',
            't_code' => 'MM015',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/good-receipt-service-entry-sheet',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-receipt-service-entry-sheet',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '16',
            'judul' => 'Invoice Receipt',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Accounts Payable Specialist',
            't_code' => 'FI016',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/invoice-receipt',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'invoice-receipt',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '17',
            'judul' => 'Outgoing Payment',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Financial Controller',
            't_code' => 'FI017',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/outgoing-payment',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'outgoing-payment',
        ]);

        JasaKonstruksi::create([
            'urutan' => '18',
            'judul' => 'Good Issue PO STO Sender',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Logistics Coordinator',
            't_code' => 'MM018',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/good-issue-po-sto-sender',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-issue-po-sto-sender',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '19',
            'judul' => 'Good Receipt PO STO Receiver',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Warehouse Manager',
            't_code' => 'MM019',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/good-receipt-po-sto-receiver',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-receipt-po-sto-receiver',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '20',
            'judul' => 'Good Issue to Project',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Project Logistics Specialist',
            't_code' => 'MM020',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/good-issue-to-project',
            'module' => 'MM Module',
            'image' => null,
            'slug' => 'good-issue-to-project',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '21',
            'judul' => 'Confirmation and Progress',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Project Manager',
            't_code' => 'PS021',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/confirmation-and-progress',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'confirmation-and-progress',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '22',
            'judul' => 'Project Progress Analysis',
            'input_process' => 'Project Definition dan WBS Element', 
            'output_process' => 'Progress Plan atau Actual Progress',
            'pic' => 'Tim Proyek',
            't_code' => 'Z10PS001, CJS2, KB31N',
            'proses' => 'Tim Proyek melakukan input progress plan atau actual progress.',
            'link_terkait' => '-',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-progress-analysis',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '23',
            'judul' => 'Revenue Progress from WBS',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Financial Controller',
            't_code' => 'SD023',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/revenue-progress-from-wbs',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'revenue-progress-from-wbs',
        ]);

        JasaKonstruksi::create([
            'urutan' => '24',
            'judul' => 'Posting Revenue/ Piutang Prestasi',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Financial Accountant',
            't_code' => 'SD024',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/posting-revenue-piutang-prestasi',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'posting-revenue-piutang-prestasi',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '25',
            'judul' => 'Billing Plan (Termin) Processing',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Billing Specialist',
            't_code' => 'SD025',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/billing-plan-termin-processing',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'billing-plan-termin-processing',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '26',
            'judul' => 'Billing Processing',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Accounts Receivable Manager',
            't_code' => 'SD026',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/billing-processing',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'billing-processing',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '27',
            'judul' => 'Clearing Piutang Prestasi',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Financial Controller',
            't_code' => 'FI027',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/clearing-piutang-prestasi',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'clearing-piutang-prestasi',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '28',
            'judul' => 'Incoming Payment & Clearing DP',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Treasury Manager',
            't_code' => 'FI028',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/incoming-payment-clearing-dp',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'incoming-payment-clearing-dp',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '29',
            'judul' => 'Project Cash Management',
            'input_process' => 'ID Project', 
            'output_process' => 'Report Project Cash Management',
            'pic' => 'Tim Project, Departemen, Kantor Pusat',
            't_code' => 'CJIA',
            'proses' => 'Menampilkan Report Project Cash Management.',
            'link_terkait' => '-',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'project-cash-management',
        ]);

        JasaKonstruksi::create([
            'urutan' => '30',
            'judul' => 'Settlement',
            'input_process' => 'ID Project', 
            'output_process' => 'Settlement Rule created',
            'pic' => 'Tim Proyek',
            't_code' => 'CJ20N, CJ02',
            'proses' => 'Tim Proyek melakukan input settlement rule dengan receiver profitability segment untuk proses bisnis proyek konstruksi dan proyek investasi, AuC / Asset untuk untuk proses bisnis proyek aset, sales order untuk proses bisnis proyek manufaktur.',
            'link_terkait' => '-',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'settlement',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '31',
            'judul' => 'Monthly Closing – Result Analysis',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Financial Controller',
            't_code' => 'CO031',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/monthly-closing-result-analysis',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'monthly-closing-result-analysis',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '32',
            'judul' => 'CO-PA Report',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Business Analyst',
            't_code' => 'CO032',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/co-pa-report',
            'module' => 'CO/FM Module',
            'image' => null,
            'slug' => 'co-pa-report',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '33',
            'judul' => 'Technically Completed (PHO)',
            'input_process' => 'ID Project', 
            'output_process' => 'System Status TECO',
            'pic' => 'Tim Proyek',
            't_code' => 'CJ20N, CJ02',
            'proses' => 'Proses ini ini akan membatasi segala aktivitas yang menghasilkan biaya terhadap WBS element. Walaupun demikian, aktivitas finansial misalnya proses invoice masih dapat dilakukan setelah berlakunya status TECO',
            'link_terkait' => '-',
            'module' => 'PS Module',
            'image' => null,
            'slug' => 'technically-completed-pho',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '34',
            'judul' => 'Posting Cost During Warranty',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Warranty Manager',
            't_code' => 'FI034',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/posting-cost-during-warranty',
            'module' => 'FI Module',
            'image' => null,
            'slug' => 'posting-cost-during-warranty',
        ]);
        
        JasaKonstruksi::create([
            'urutan' => '35',
            'judul' => 'Retensi',
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'pic' => 'Contract Administrator',
            't_code' => 'SD035',
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/retensi',
            'module' => 'SD Module',
            'image' => null,
            'slug' => 'retensi',
        ]);

        JasaKonstruksi::create([ 
            'urutan' => '36', 
            'judul' => 'Billing Retensi', 
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'pic' => 'John Doe', 
            't_code' => 'T12345', 
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/billing-retensi', 
            'module' => 'SD Module', 
            'image' => null, 
            'slug' => 'billing-retensi', 
        ]);
        
        JasaKonstruksi::create([ 
            'urutan' => '37', 
            'judul' => 'Incoming Payment Retention and Clearing', 
            'input_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'output_process' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 
            'pic' => 'John Doe', 
            't_code' => 'T12345', 
            'proses' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'link_terkait' => 'http://example.com/incoming-payment-retention-clearing', 
            'module' => 'FI Module', 
            'image' => null, 
            'slug' => 'incoming-payment-retention-clearing', 
        ]);
        
        JasaKonstruksi::create([ 
            'urutan' => '38', 
            'judul' => 'Business Closed Project (FHO)', 
            'input_process' => 'ID Project', 
            'output_process' => 'System Status CLSD', 
            'pic' => 'Tim Proyek', 
            't_code' => 'CJ20N, CJ02', 
            'proses' => 'Tim Proyek mengubah system status Project menjadi CLSD atas dasar semua transaksi pada Proyek sudah selesai dan Proyek sudah masuk fase FHO (Final Hand Over).',
            'link_terkait' => '-', 
            'module' => 'PS Module', 
            'image' => null, 
            'slug' => 'business-closed-project-fho', 
        ]);
    }
}