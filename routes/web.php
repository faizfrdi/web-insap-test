<?php

use Illuminate\Support\Facades\Route;

// Route untuk halaman Home User
Route::get('/', function () {
    return view('home');
});

// Route untuk Login User//
use App\Http\Controllers\LoginController;
Route::get('/login', function () { return view('login');});
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

// Route untuk Search Form pada Tampilan User //
use App\Http\Controllers\SearchController;
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/admin', function () {
    return view('admin.layouts.admin');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Semua Route Untuk Dashboard Admin //
use App\Http\Controllers\Admin\AdminController;

// Route FAQ General (Admin)
use App\Http\Controllers\Admin\FAQController as AdminFAQController;

// Route FAQ Jasa Konstruksi (Admin)
use App\Http\Controllers\Admin\Faq\FaqJasaKonstruksi\GeneralController as AdminFaqJasaKonstruksiGeneralController;
use App\Http\Controllers\Admin\Faq\FaqJasaKonstruksi\FiModuleController as AdminFaqJasaKonstruksiFiModuleController;
use App\Http\Controllers\Admin\Faq\FaqJasaKonstruksi\PsModuleController as AdminFaqJasaKonstruksiPsModuleController;
use App\Http\Controllers\Admin\Faq\FaqJasaKonstruksi\SdModuleController as AdminFaqJasaKonstruksiSdModuleController;
use App\Http\Controllers\Admin\Faq\FaqJasaKonstruksi\MmModuleController as AdminFaqJasaKonstruksiMmModuleController;
use App\Http\Controllers\Admin\Faq\FaqJasaKonstruksi\CoFmModuleController as AdminFaqJasaKonstruksiCoFmModuleController;

// Route FAQ Manufacturing (Admin)
use App\Http\Controllers\Admin\Faq\FaqManufacturing\GeneralController as AdminFaqManufacturingGeneralController;
use App\Http\Controllers\Admin\Faq\FaqManufacturing\FiModuleController as AdminFaqManufacturingFiModuleController;
use App\Http\Controllers\Admin\Faq\FaqManufacturing\PsModuleController as AdminFaqManufacturingPsModuleController;
use App\Http\Controllers\Admin\Faq\FaqManufacturing\SdModuleController as AdminFaqManufacturingSdModuleController;
use App\Http\Controllers\Admin\Faq\FaqManufacturing\MmModuleController as AdminFaqManufacturingMmModuleController;
use App\Http\Controllers\Admin\Faq\FaqManufacturing\CoFmModuleController as AdminFaqManufacturingCoFmModuleController;

// Route FAQ Jasa Non Konstruksi (Admin)
use App\Http\Controllers\Admin\Faq\FaqJasaNonKonstruksi\GeneralController as AdminFaqJasaNonKonstruksiGeneralController;
use App\Http\Controllers\Admin\Faq\FaqJasaNonKonstruksi\FiModuleController as AdminFaqJasaNonKonstruksiFiModuleController;
use App\Http\Controllers\Admin\Faq\FaqJasaNonKonstruksi\PsModuleController as AdminFaqJasaNonKonstruksiPsModuleController;
use App\Http\Controllers\Admin\Faq\FaqJasaNonKonstruksi\SdModuleController as AdminFaqJasaNonKonstruksiSdModuleController;
use App\Http\Controllers\Admin\Faq\FaqJasaNonKonstruksi\MmModuleController as AdminFaqJasaNonKonstruksiMmModuleController;
use App\Http\Controllers\Admin\Faq\FaqJasaNonKonstruksi\CoFmModuleController as AdminFaqJasaNonKonstruksiCoFmModuleController;

// Route FAQ Capex Procurement (Admin)
use App\Http\Controllers\Admin\Faq\FaqCapexProcurement\GeneralController as AdminFaqCapexProcurementGeneralController;
use App\Http\Controllers\Admin\Faq\FaqCapexProcurement\FiModuleController as AdminFaqCapexProcurementFiModuleController;
use App\Http\Controllers\Admin\Faq\FaqCapexProcurement\PsModuleController as AdminFaqCapexProcurementPsModuleController;
use App\Http\Controllers\Admin\Faq\FaqCapexProcurement\SdModuleController as AdminFaqCapexProcurementSdModuleController;
use App\Http\Controllers\Admin\Faq\FaqCapexProcurement\MmModuleController as AdminFaqCapexProcurementMmModuleController;
use App\Http\Controllers\Admin\Faq\FaqCapexProcurement\CoFmModuleController as AdminFaqCapexProcurementCoFmModuleController;

// Route FAQ Internal Project (Admin)
use App\Http\Controllers\Admin\Faq\FaqInternalProject\GeneralController as AdminFaqInternalProjectGeneralController;
use App\Http\Controllers\Admin\Faq\FaqInternalProject\FiModuleController as AdminFaqInternalProjectFiModuleController;
use App\Http\Controllers\Admin\Faq\FaqInternalProject\PsModuleController as AdminFaqInternalProjectPsModuleController;
use App\Http\Controllers\Admin\Faq\FaqInternalProject\SdModuleController as AdminFaqInternalProjectSdModuleController;
use App\Http\Controllers\Admin\Faq\FaqInternalProject\MmModuleController as AdminFaqInternalProjectMmModuleController;
use App\Http\Controllers\Admin\Faq\FaqInternalProject\CoFmModuleController as AdminFaqInternalProjectCoFmModuleController;

// Route untuk SCENARIO pada tampilan Dashboard Admin //
use App\Http\Controllers\Admin\JasaKonstruksiController;
use App\Http\Controllers\Admin\JasaNonKonstruksiController;
use App\Http\Controllers\Admin\ManufacturingController;
use App\Http\Controllers\Admin\CapexProcurementController;
use App\Http\Controllers\Admin\InternalProjectController;

// Route untuk Information Updates Modul FICO/FM tampilan Admin // 
use App\Http\Controllers\Admin\FicoFmController;
use App\Http\Controllers\Admin\InfoGeneralController;
use App\Http\Controllers\Admin\PsController;
use App\Http\Controllers\Admin\SdController;
use App\Http\Controllers\Admin\MmController; 

// Route untuk membuka item SCENARIO pada sidebar di dalam Dashboard Admin //
use App\Http\Controllers\User\JasaKonstruksiController as UserJasaKonstruksiController;
Route::get('jasa_konstruksi/{slug}', [UserJasaKonstruksiController::class, 'showUser'])->name('scenarios.jasa-konstruksi');

use App\Http\Controllers\User\JasaNonKonstruksiController as UserJasaNonKonstruksiController;
Route::get('jasa_non_konstruksi/{slug}', [UserJasaNonKonstruksiController::class, 'showUser'])->name('scenarios.jasa-non-konstruksi');

use App\Http\Controllers\User\ManufacturingController as UserManufacturingController;
Route::get('manufacturing/{slug}', [UserManufacturingController::class, 'showUser'])->name('scenarios.manufacturing');

use App\Http\Controllers\User\CapexProcurementController as UserCapexProcurementController;
Route::get('capex_procurement/{slug}', [UserCapexProcurementController::class, 'showUser'])->name('scenarios.capex-procurement');

use App\Http\Controllers\User\InternalProjectController as UserInternalProjectController;
use App\Models\InfoGeneral;

Route::get('internal_project/{slug}', [UserInternalProjectController::class, 'showUser'])->name('scenarios.internal-project');

// Route untuk halaman Login Admin
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// Middleware untuk route yang hanya bisa diakses setelah login sebagai Admin
Route::middleware('auth:admin')->group(function () {
    
    // Dashboard Admin
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Logout Admin
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // Route untuk FAQ General
    Route::get('admin/faq/faq-general', [AdminFAQController::class, 'index'])->name('faq-general.index');
    Route::get('admin/faq/faq-general/create', [AdminFAQController::class, 'create'])->name('faq-general.create');
    Route::post('admin/faq/faq-general', [AdminFAQController::class, 'store'])->name('faq-general.store');
    Route::get('admin/faq/faq-general/{faq}/edit', [AdminFAQController::class, 'edit'])->name('faq-general.edit');
    Route::put('admin/faq/faq-general/{faq}', [AdminFAQController::class, 'update'])->name('faq-general.update');
    Route::delete('admin/faq/faq-general/{faq}', [AdminFAQController::class, 'destroy'])->name('faq-general.destroy');

    // Routes untuk General - FAQ Jasa Konstruksi
    Route::get('admin/faq/faq-jasa-konstruksi/general', [AdminFaqJasaKonstruksiGeneralController::class, 'index'])->name('faq-jasa-konstruksi.general.index');
    Route::get('admin/faq/faq-jasa-konstruksi/general/create', [AdminFaqJasaKonstruksiGeneralController::class, 'create'])->name('faq-jasa-konstruksi.general.create');
    Route::post('admin/faq/faq-jasa-konstruksi/general', [AdminFaqJasaKonstruksiGeneralController::class, 'store'])->name('faq-jasa-konstruksi.general.store');
    Route::get('admin/faq/faq-jasa-konstruksi/general/{faq}/edit', [AdminFaqJasaKonstruksiGeneralController::class, 'edit'])->name('faq-jasa-konstruksi.general.edit');
    Route::put('admin/faq/faq-jasa-konstruksi/general/{faq}', [AdminFaqJasaKonstruksiGeneralController::class, 'update'])->name('faq-jasa-konstruksi.general.update');
    Route::delete('admin/faq/faq-jasa-konstruksi/general/{faq}', [AdminFaqJasaKonstruksiGeneralController::class, 'destroy'])->name('faq-jasa-konstruksi.general.destroy');

    // Routes untuk FI Module - FAQ Jasa Konstruksi
    Route::get('admin/faq/faq-jasa-konstruksi/fi-module', [AdminFaqJasaKonstruksiFiModuleController::class, 'index'])->name('faq-jasa-konstruksi.fi-module.index');
    Route::get('admin/faq/faq-jasa-konstruksi/fi-module/create', [AdminFaqJasaKonstruksiFiModuleController::class, 'create'])->name('faq-jasa-konstruksi.fi-module.create');
    Route::post('admin/faq/faq-jasa-konstruksi/fi-module', [AdminFaqJasaKonstruksiFiModuleController::class, 'store'])->name('faq-jasa-konstruksi.fi-module.store');
    Route::get('admin/faq/faq-jasa-konstruksi/fi-module/{faq}/edit', [AdminFaqJasaKonstruksiFiModuleController::class, 'edit'])->name('faq-jasa-konstruksi.fi-module.edit');
    Route::put('admin/faq/faq-jasa-konstruksi/fi-module/{faq}', [AdminFaqJasaKonstruksiFiModuleController::class, 'update'])->name('faq-jasa-konstruksi.fi-module.update');
    Route::delete('admin/faq/faq-jasa-konstruksi/fi-module/{faq}', [AdminFaqJasaKonstruksiFiModuleController::class, 'destroy'])->name('faq-jasa-konstruksi.fi-module.destroy');

    // Routes untuk PS Module - FAQ Jasa Konstruksi
    Route::get('admin/faq/faq-jasa-konstruksi/ps-module', [AdminFaqJasaKonstruksiPsModuleController::class, 'index'])->name('faq-jasa-konstruksi.ps-module.index');
    Route::get('admin/faq/faq-jasa-konstruksi/ps-module/create', [AdminFaqJasaKonstruksiPsModuleController::class, 'create'])->name('faq-jasa-konstruksi.ps-module.create');
    Route::post('admin/faq/faq-jasa-konstruksi/ps-module', [AdminFaqJasaKonstruksiPsModuleController::class, 'store'])->name('faq-jasa-konstruksi.ps-module.store');
    Route::get('admin/faq/faq-jasa-konstruksi/ps-module/{faq}/edit', [AdminFaqJasaKonstruksiPsModuleController::class, 'edit'])->name('faq-jasa-konstruksi.ps-module.edit');
    Route::put('admin/faq/faq-jasa-konstruksi/ps-module/{faq}', [AdminFaqJasaKonstruksiPsModuleController::class, 'update'])->name('faq-jasa-konstruksi.ps-module.update');
    Route::delete('admin/faq/faq-jasa-konstruksi/ps-module/{faq}', [AdminFaqJasaKonstruksiPsModuleController::class, 'destroy'])->name('faq-jasa-konstruksi.ps-module.destroy');

    // Routes untuk SD Module - FAQ Jasa Konstruksi
    Route::get('admin/faq/faq-jasa-konstruksi/sd-module', [AdminFaqJasaKonstruksiSdModuleController::class, 'index'])->name('faq-jasa-konstruksi.sd-module.index');
    Route::get('admin/faq/faq-jasa-konstruksi/sd-module/create', [AdminFaqJasaKonstruksiSdModuleController::class, 'create'])->name('faq-jasa-konstruksi.sd-module.create');
    Route::post('admin/faq/faq-jasa-konstruksi/sd-module', [AdminFaqJasaKonstruksiSdModuleController::class, 'store'])->name('faq-jasa-konstruksi.sd-module.store');
    Route::get('admin/faq/faq-jasa-konstruksi/sd-module/{faq}/edit', [AdminFaqJasaKonstruksiSdModuleController::class, 'edit'])->name('faq-jasa-konstruksi.sd-module.edit');
    Route::put('admin/faq/faq-jasa-konstruksi/sd-module/{faq}', [AdminFaqJasaKonstruksiSdModuleController::class, 'update'])->name('faq-jasa-konstruksi.sd-module.update');
    Route::delete('admin/faq/faq-jasa-konstruksi/sd-module/{faq}', [AdminFaqJasaKonstruksiSdModuleController::class, 'destroy'])->name('faq-jasa-konstruksi.sd-module.destroy');

    // Routes untuk MM Module - FAQ Jasa Konstruksi
    Route::get('admin/faq/faq-jasa-konstruksi/mm-module', [AdminFaqJasaKonstruksiMmModuleController::class, 'index'])->name('faq-jasa-konstruksi.mm-module.index');
    Route::get('admin/faq/faq-jasa-konstruksi/mm-module/create', [AdminFaqJasaKonstruksiMmModuleController::class, 'create'])->name('faq-jasa-konstruksi.mm-module.create');
    Route::post('admin/faq/faq-jasa-konstruksi/mm-module', [AdminFaqJasaKonstruksiMmModuleController::class, 'store'])->name('faq-jasa-konstruksi.mm-module.store');
    Route::get('admin/faq/faq-jasa-konstruksi/mm-module/{faq}/edit', [AdminFaqJasaKonstruksiMmModuleController::class, 'edit'])->name('faq-jasa-konstruksi.mm-module.edit');
    Route::put('admin/faq/faq-jasa-konstruksi/mm-module/{faq}', [AdminFaqJasaKonstruksiMmModuleController::class, 'update'])->name('faq-jasa-konstruksi.mm-module.update');
    Route::delete('admin/faq/faq-jasa-konstruksi/mm-module/{faq}', [AdminFaqJasaKonstruksiMmModuleController::class, 'destroy'])->name('faq-jasa-konstruksi.mm-module.destroy');

    // Routes untuk CO/FM Module - FAQ Jasa Konstruksi
    Route::get('admin/faq/faq-jasa-konstruksi/co-fm-module', [AdminFaqJasaKonstruksiCoFmModuleController::class, 'index'])->name('faq-jasa-konstruksi.co-fm-module.index');
    Route::get('admin/faq/faq-jasa-konstruksi/co-fm-module/create', [AdminFaqJasaKonstruksiCoFmModuleController::class, 'create'])->name('faq-jasa-konstruksi.co-fm-module.create');
    Route::post('admin/faq/faq-jasa-konstruksi/co-fm-module', [AdminFaqJasaKonstruksiCoFmModuleController::class, 'store'])->name('faq-jasa-konstruksi.co-fm-module.store');
    Route::get('admin/faq/faq-jasa-konstruksi/co-fm-module/{faq}/edit', [AdminFaqJasaKonstruksiCoFmModuleController::class, 'edit'])->name('faq-jasa-konstruksi.co-fm-module.edit');
    Route::put('admin/faq/faq-jasa-konstruksi/co-fm-module/{faq}', [AdminFaqJasaKonstruksiCoFmModuleController::class, 'update'])->name('faq-jasa-konstruksi.co-fm-module.update');
    Route::delete('admin/faq/faq-jasa-konstruksi/co-fm-module/{faq}', [AdminFaqJasaKonstruksiCoFmModuleController::class, 'destroy'])->name('faq-jasa-konstruksi.co-fm-module.destroy');

    // Routes untuk General - FAQ Manufacturing
    Route::get('admin/faq/faq-manufacturing/general', [AdminFaqManufacturingGeneralController::class, 'index'])->name('faq-manufacturing.general.index');
    Route::get('admin/faq/faq-manufacturing/general/create', [AdminFaqManufacturingGeneralController::class, 'create'])->name('faq-manufacturing.general.create');
    Route::post('admin/faq/faq-manufacturing/general', [AdminFaqManufacturingGeneralController::class, 'store'])->name('faq-manufacturing.general.store');
    Route::get('admin/faq/faq-manufacturing/general/{faq}/edit', [AdminFaqManufacturingGeneralController::class, 'edit'])->name('faq-manufacturing.general.edit');
    Route::put('admin/faq/faq-manufacturing/general/{faq}', [AdminFaqManufacturingGeneralController::class, 'update'])->name('faq-manufacturing.general.update');
    Route::delete('admin/faq/faq-manufacturing/general/{faq}', [AdminFaqManufacturingGeneralController::class, 'destroy'])->name('faq-manufacturing.general.destroy');

    // Routes untuk FI Module - FAQ Manufacturing
    Route::get('admin/faq/faq-manufacturing/fi-module', [AdminFaqManufacturingFiModuleController::class, 'index'])->name('faq-manufacturing.fi-module.index');
    Route::get('admin/faq/faq-manufacturing/fi-module/create', [AdminFaqManufacturingFiModuleController::class, 'create'])->name('faq-manufacturing.fi-module.create');
    Route::post('admin/faq/faq-manufacturing/fi-module', [AdminFaqManufacturingFiModuleController::class, 'store'])->name('faq-manufacturing.fi-module.store');
    Route::get('admin/faq/faq-manufacturing/fi-module/{faq}/edit', [AdminFaqManufacturingFiModuleController::class, 'edit'])->name('faq-manufacturing.fi-module.edit');
    Route::put('admin/faq/faq-manufacturing/fi-module/{faq}', [AdminFaqManufacturingFiModuleController::class, 'update'])->name('faq-manufacturing.fi-module.update');
    Route::delete('admin/faq/faq-manufacturing/fi-module/{faq}', [AdminFaqManufacturingFiModuleController::class, 'destroy'])->name('faq-manufacturing.fi-module.destroy');

    // Routes untuk PS Module - FAQ Manufacturing
    Route::get('admin/faq/faq-manufacturing/ps-module', [AdminFaqManufacturingPsModuleController::class, 'index'])->name('faq-manufacturing.ps-module.index');
    Route::get('admin/faq/faq-manufacturing/ps-module/create', [AdminFaqManufacturingPsModuleController::class, 'create'])->name('faq-manufacturing.ps-module.create');
    Route::post('admin/faq/faq-manufacturing/ps-module', [AdminFaqManufacturingPsModuleController::class, 'store'])->name('faq-manufacturing.ps-module.store');
    Route::get('admin/faq/faq-manufacturing/ps-module/{faq}/edit', [AdminFaqManufacturingPsModuleController::class, 'edit'])->name('faq-manufacturing.ps-module.edit');
    Route::put('admin/faq/faq-manufacturing/ps-module/{faq}', [AdminFaqManufacturingPsModuleController::class, 'update'])->name('faq-manufacturing.ps-module.update');
    Route::delete('admin/faq/faq-manufacturing/ps-module/{faq}', [AdminFaqManufacturingPsModuleController::class, 'destroy'])->name('faq-manufacturing.ps-module.destroy');

    // Routes untuk SD Module - FAQ Manufacturing
    Route::get('admin/faq/faq-manufacturing/sd-module', [AdminFaqManufacturingSdModuleController::class, 'index'])->name('faq-manufacturing.sd-module.index');
    Route::get('admin/faq/faq-manufacturing/sd-module/create', [AdminFaqManufacturingSdModuleController::class, 'create'])->name('faq-manufacturing.sd-module.create');
    Route::post('admin/faq/faq-manufacturing/sd-module', [AdminFaqManufacturingSdModuleController::class, 'store'])->name('faq-manufacturing.sd-module.store');
    Route::get('admin/faq/faq-manufacturing/sd-module/{faq}/edit', [AdminFaqManufacturingSdModuleController::class, 'edit'])->name('faq-manufacturing.sd-module.edit');
    Route::put('admin/faq/faq-manufacturing/sd-module/{faq}', [AdminFaqManufacturingSdModuleController::class, 'update'])->name('faq-manufacturing.sd-module.update');
    Route::delete('admin/faq/faq-manufacturing/sd-module/{faq}', [AdminFaqManufacturingSdModuleController::class, 'destroy'])->name('faq-manufacturing.sd-module.destroy');

    // Routes untuk MM Module - FAQ Manufacturing
    Route::get('admin/faq/faq-manufacturing/mm-module', [AdminFaqManufacturingMmModuleController::class, 'index'])->name('faq-manufacturing.mm-module.index');
    Route::get('admin/faq/faq-manufacturing/mm-module/create', [AdminFaqManufacturingMmModuleController::class, 'create'])->name('faq-manufacturing.mm-module.create');
    Route::post('admin/faq/faq-manufacturing/mm-module', [AdminFaqManufacturingMmModuleController::class, 'store'])->name('faq-manufacturing.mm-module.store');
    Route::get('admin/faq/faq-manufacturing/mm-module/{faq}/edit', [AdminFaqManufacturingMmModuleController::class, 'edit'])->name('faq-manufacturing.mm-module.edit');
    Route::put('admin/faq/faq-manufacturing/mm-module/{faq}', [AdminFaqManufacturingMmModuleController::class, 'update'])->name('faq-manufacturing.mm-module.update');
    Route::delete('admin/faq/faq-manufacturing/mm-module/{faq}', [AdminFaqManufacturingMmModuleController::class, 'destroy'])->name('faq-manufacturing.mm-module.destroy');

    // Routes untuk CO/FM Module - FAQ Manufacturing
    Route::get('admin/faq/faq-manufacturing/co-fm-module', [AdminFaqManufacturingCoFmModuleController::class, 'index'])->name('faq-manufacturing.co-fm-module.index');
    Route::get('admin/faq/faq-manufacturing/co-fm-module/create', [AdminFaqManufacturingCoFmModuleController::class, 'create'])->name('faq-manufacturing.co-fm-module.create');
    Route::post('admin/faq/faq-manufacturing/co-fm-module', [AdminFaqManufacturingCoFmModuleController::class, 'store'])->name('faq-manufacturing.co-fm-module.store');
    Route::get('admin/faq/faq-manufacturing/co-fm-module/{faq}/edit', [AdminFaqManufacturingCoFmModuleController::class, 'edit'])->name('faq-manufacturing.co-fm-module.edit');
    Route::put('admin/faq/faq-manufacturing/co-fm-module/{faq}', [AdminFaqManufacturingCoFmModuleController::class, 'update'])->name('faq-manufacturing.co-fm-module.update');
    Route::delete('admin/faq/faq-manufacturing/co-fm-module/{faq}', [AdminFaqManufacturingCoFmModuleController::class, 'destroy'])->name('faq-manufacturing.co-fm-module.destroy');

    // Routes untuk General - FAQ Jasa Non Konstruksi
    Route::get('admin/faq/faq-jasa-non-konstruksi/general', [AdminFaqJasaNonKonstruksiGeneralController::class, 'index'])->name('faq-jasa-non-konstruksi.general.index');
    Route::get('admin/faq/faq-jasa-non-konstruksi/general/create', [AdminFaqJasaNonKonstruksiGeneralController::class, 'create'])->name('faq-jasa-non-konstruksi.general.create');
    Route::post('admin/faq/faq-jasa-non-konstruksi/general', [AdminFaqJasaNonKonstruksiGeneralController::class, 'store'])->name('faq-jasa-non-konstruksi.general.store');
    Route::get('admin/faq/faq-jasa-non-konstruksi/general/{faq}/edit', [AdminFaqJasaNonKonstruksiGeneralController::class, 'edit'])->name('faq-jasa-non-konstruksi.general.edit');
    Route::put('admin/faq/faq-jasa-non-konstruksi/general/{faq}', [AdminFaqJasaNonKonstruksiGeneralController::class, 'update'])->name('faq-jasa-non-konstruksi.general.update');
    Route::delete('admin/faq/faq-jasa-non-konstruksi/general/{faq}', [AdminFaqJasaNonKonstruksiGeneralController::class, 'destroy'])->name('faq-jasa-non-konstruksi.general.destroy');

    // Routes untuk FI Module - FAQ Jasa Non Konstruksi
    Route::get('admin/faq/faq-jasa-non-konstruksi/fi-module', [AdminFaqJasaNonKonstruksiFiModuleController::class, 'index'])->name('faq-jasa-non-konstruksi.fi-module.index');
    Route::get('admin/faq/faq-jasa-non-konstruksi/fi-module/create', [AdminFaqJasaNonKonstruksiFiModuleController::class, 'create'])->name('faq-jasa-non-konstruksi.fi-module.create');
    Route::post('admin/faq/faq-jasa-non-konstruksi/fi-module', [AdminFaqJasaNonKonstruksiFiModuleController::class, 'store'])->name('faq-jasa-non-konstruksi.fi-module.store');
    Route::get('admin/faq/faq-jasa-non-konstruksi/fi-module/{faq}/edit', [AdminFaqJasaNonKonstruksiFiModuleController::class, 'edit'])->name('faq-jasa-non-konstruksi.fi-module.edit');
    Route::put('admin/faq/faq-jasa-non-konstruksi/fi-module/{faq}', [AdminFaqJasaNonKonstruksiFiModuleController::class, 'update'])->name('faq-jasa-non-konstruksi.fi-module.update');
    Route::delete('admin/faq/faq-jasa-non-konstruksi/fi-module/{faq}', [AdminFaqJasaNonKonstruksiFiModuleController::class, 'destroy'])->name('faq-jasa-non-konstruksi.fi-module.destroy');

    // Routes untuk PS Module - FAQ Jasa Non Konstruksi
    Route::get('admin/faq/faq-jasa-non-konstruksi/ps-module', [AdminFaqJasaNonKonstruksiPsModuleController::class, 'index'])->name('faq-jasa-non-konstruksi.ps-module.index');
    Route::get('admin/faq/faq-jasa-non-konstruksi/ps-module/create', [AdminFaqJasaNonKonstruksiPsModuleController::class, 'create'])->name('faq-jasa-non-konstruksi.ps-module.create');
    Route::post('admin/faq/faq-jasa-non-konstruksi/ps-module', [AdminFaqJasaNonKonstruksiPsModuleController::class, 'store'])->name('faq-jasa-non-konstruksi.ps-module.store');
    Route::get('admin/faq/faq-jasa-non-konstruksi/ps-module/{faq}/edit', [AdminFaqJasaNonKonstruksiPsModuleController::class, 'edit'])->name('faq-jasa-non-konstruksi.ps-module.edit');
    Route::put('admin/faq/faq-jasa-non-konstruksi/ps-module/{faq}', [AdminFaqJasaNonKonstruksiPsModuleController::class, 'update'])->name('faq-jasa-non-konstruksi.ps-module.update');
    Route::delete('admin/faq/faq-jasa-non-konstruksi/ps-module/{faq}', [AdminFaqJasaNonKonstruksiPsModuleController::class, 'destroy'])->name('faq-jasa-non-konstruksi.ps-module.destroy');

    // Routes untuk SD Module - FAQ Jasa Non Konstruksi
    Route::get('admin/faq/faq-jasa-non-konstruksi/sd-module', [AdminFaqJasaNonKonstruksiSdModuleController::class, 'index'])->name('faq-jasa-non-konstruksi.sd-module.index');
    Route::get('admin/faq/faq-jasa-non-konstruksi/sd-module/create', [AdminFaqJasaNonKonstruksiSdModuleController::class, 'create'])->name('faq-jasa-non-konstruksi.sd-module.create');
    Route::post('admin/faq/faq-jasa-non-konstruksi/sd-module', [AdminFaqJasaNonKonstruksiSdModuleController::class, 'store'])->name('faq-jasa-non-konstruksi.sd-module.store');
    Route::get('admin/faq/faq-jasa-non-konstruksi/sd-module/{faq}/edit', [AdminFaqJasaNonKonstruksiSdModuleController::class, 'edit'])->name('faq-jasa-non-konstruksi.sd-module.edit');
    Route::put('admin/faq/faq-jasa-non-konstruksi/sd-module/{faq}', [AdminFaqJasaNonKonstruksiSdModuleController::class, 'update'])->name('faq-jasa-non-konstruksi.sd-module.update');
    Route::delete('admin/faq/faq-jasa-non-konstruksi/sd-module/{faq}', [AdminFaqJasaNonKonstruksiSdModuleController::class, 'destroy'])->name('faq-jasa-non-konstruksi.sd-module.destroy');

    // Routes untuk MM Module - FAQ Jasa Non Konstruksi
    Route::get('admin/faq/faq-jasa-non-konstruksi/mm-module', [AdminFaqJasaNonKonstruksiMmModuleController::class, 'index'])->name('faq-jasa-non-konstruksi.mm-module.index');
    Route::get('admin/faq/faq-jasa-non-konstruksi/mm-module/create', [AdminFaqJasaNonKonstruksiMmModuleController::class, 'create'])->name('faq-jasa-non-konstruksi.mm-module.create');
    Route::post('admin/faq/faq-jasa-non-konstruksi/mm-module', [AdminFaqJasaNonKonstruksiMmModuleController::class, 'store'])->name('faq-jasa-non-konstruksi.mm-module.store');
    Route::get('admin/faq/faq-jasa-non-konstruksi/mm-module/{faq}/edit', [AdminFaqJasaNonKonstruksiMmModuleController::class, 'edit'])->name('faq-jasa-non-konstruksi.mm-module.edit');
    Route::put('admin/faq/faq-jasa-non-konstruksi/mm-module/{faq}', [AdminFaqJasaNonKonstruksiMmModuleController::class, 'update'])->name('faq-jasa-non-konstruksi.mm-module.update');
    Route::delete('admin/faq/faq-jasa-non-konstruksi/mm-module/{faq}', [AdminFaqJasaNonKonstruksiMmModuleController::class, 'destroy'])->name('faq-jasa-non-konstruksi.mm-module.destroy');

    // Routes untuk CO/FM Module - FAQ Jasa Non Konstruksi
    Route::get('admin/faq/faq-jasa-non-konstruksi/co-fm-module', [AdminFaqJasaNonKonstruksiCoFmModuleController::class, 'index'])->name('faq-jasa-non-konstruksi.co-fm-module.index');
    Route::get('admin/faq/faq-jasa-non-konstruksi/co-fm-module/create', [AdminFaqJasaNonKonstruksiCoFmModuleController::class, 'create'])->name('faq-jasa-non-konstruksi.co-fm-module.create');
    Route::post('admin/faq/faq-jasa-non-konstruksi/co-fm-module', [AdminFaqJasaNonKonstruksiCoFmModuleController::class, 'store'])->name('faq-jasa-non-konstruksi.co-fm-module.store');
    Route::get('admin/faq/faq-jasa-non-konstruksi/co-fm-module/{faq}/edit', [AdminFaqJasaNonKonstruksiCoFmModuleController::class, 'edit'])->name('faq-jasa-non-konstruksi.co-fm-module.edit');
    Route::put('admin/faq/faq-jasa-non-konstruksi/co-fm-module/{faq}', [AdminFaqJasaNonKonstruksiCoFmModuleController::class, 'update'])->name('faq-jasa-non-konstruksi.co-fm-module.update');
    Route::delete('admin/faq/faq-jasa-non-konstruksi/co-fm-module/{faq}', [AdminFaqJasaNonKonstruksiCoFmModuleController::class, 'destroy'])->name('faq-jasa-non-konstruksi.co-fm-module.destroy');

    // Routes untuk General - FAQ Capex Procurement
    Route::get('admin/faq/faq-capex-procurement/general', [AdminFaqCapexProcurementGeneralController::class, 'index'])->name('faq-capex-procurement.general.index');
    Route::get('admin/faq/faq-capex-procurement/general/create', [AdminFaqCapexProcurementGeneralController::class, 'create'])->name('faq-capex-procurement.general.create');
    Route::post('admin/faq/faq-capex-procurement/general', [AdminFaqCapexProcurementGeneralController::class, 'store'])->name('faq-capex-procurement.general.store');
    Route::get('admin/faq/faq-capex-procurement/general/{faq}/edit', [AdminFaqCapexProcurementGeneralController::class, 'edit'])->name('faq-capex-procurement.general.edit');
    Route::put('admin/faq/faq-capex-procurement/general/{faq}', [AdminFaqCapexProcurementGeneralController::class, 'update'])->name('faq-capex-procurement.general.update');
    Route::delete('admin/faq/faq-capex-procurement/general/{faq}', [AdminFaqCapexProcurementGeneralController::class, 'destroy'])->name('faq-capex-procurement.general.destroy');

    // Routes untuk FI Module - FAQ Capex Procurement
    Route::get('admin/faq/faq-capex-procurement/fi-module', [AdminFaqCapexProcurementFiModuleController::class, 'index'])->name('faq-capex-procurement.fi-module.index');
    Route::get('admin/faq/faq-capex-procurement/fi-module/create', [AdminFaqCapexProcurementFiModuleController::class, 'create'])->name('faq-capex-procurement.fi-module.create');
    Route::post('admin/faq/faq-capex-procurement/fi-module', [AdminFaqCapexProcurementFiModuleController::class, 'store'])->name('faq-capex-procurement.fi-module.store');
    Route::get('admin/faq/faq-capex-procurement/fi-module/{faq}/edit', [AdminFaqCapexProcurementFiModuleController::class, 'edit'])->name('faq-capex-procurement.fi-module.edit');
    Route::put('admin/faq/faq-capex-procurement/fi-module/{faq}', [AdminFaqCapexProcurementFiModuleController::class, 'update'])->name('faq-capex-procurement.fi-module.update');
    Route::delete('admin/faq/faq-capex-procurement/fi-module/{faq}', [AdminFaqCapexProcurementFiModuleController::class, 'destroy'])->name('faq-capex-procurement.fi-module.destroy');

    // Routes untuk PS Module - FAQ Capex Procurement
    Route::get('admin/faq/faq-capex-procurement/ps-module', [AdminFaqCapexProcurementPsModuleController::class, 'index'])->name('faq-capex-procurement.ps-module.index');
    Route::get('admin/faq/faq-capex-procurement/ps-module/create', [AdminFaqCapexProcurementPsModuleController::class, 'create'])->name('faq-capex-procurement.ps-module.create');
    Route::post('admin/faq/faq-capex-procurement/ps-module', [AdminFaqCapexProcurementPsModuleController::class, 'store'])->name('faq-capex-procurement.ps-module.store');
    Route::get('admin/faq/faq-capex-procurement/ps-module/{faq}/edit', [AdminFaqCapexProcurementPsModuleController::class, 'edit'])->name('faq-capex-procurement.ps-module.edit');
    Route::put('admin/faq/faq-capex-procurement/ps-module/{faq}', [AdminFaqCapexProcurementPsModuleController::class, 'update'])->name('faq-capex-procurement.ps-module.update');
    Route::delete('admin/faq/faq-capex-procurement/ps-module/{faq}', [AdminFaqCapexProcurementPsModuleController::class, 'destroy'])->name('faq-capex-procurement.ps-module.destroy');

    // Routes untuk SD Module - FAQ Capex Procurement
    Route::get('admin/faq/faq-capex-procurement/sd-module', [AdminFaqCapexProcurementSdModuleController::class, 'index'])->name('faq-capex-procurement.sd-module.index');
    Route::get('admin/faq/faq-capex-procurement/sd-module/create', [AdminFaqCapexProcurementSdModuleController::class, 'create'])->name('faq-capex-procurement.sd-module.create');
    Route::post('admin/faq/faq-capex-procurement/sd-module', [AdminFaqCapexProcurementSdModuleController::class, 'store'])->name('faq-capex-procurement.sd-module.store');
    Route::get('admin/faq/faq-capex-procurement/sd-module/{faq}/edit', [AdminFaqCapexProcurementSdModuleController::class, 'edit'])->name('faq-capex-procurement.sd-module.edit');
    Route::put('admin/faq/faq-capex-procurement/sd-module/{faq}', [AdminFaqCapexProcurementSdModuleController::class, 'update'])->name('faq-capex-procurement.sd-module.update');
    Route::delete('admin/faq/faq-capex-procurement/sd-module/{faq}', [AdminFaqCapexProcurementSdModuleController::class, 'destroy'])->name('faq-capex-procurement.sd-module.destroy');

    // Routes untuk MM Module - FAQ Capex Procurement
    Route::get('admin/faq/faq-capex-procurement/mm-module', [AdminFaqCapexProcurementMmModuleController::class, 'index'])->name('faq-capex-procurement.mm-module.index');
    Route::get('admin/faq/faq-capex-procurement/mm-module/create', [AdminFaqCapexProcurementMmModuleController::class, 'create'])->name('faq-capex-procurement.mm-module.create');
    Route::post('admin/faq/faq-capex-procurement/mm-module', [AdminFaqCapexProcurementMmModuleController::class, 'store'])->name('faq-capex-procurement.mm-module.store');
    Route::get('admin/faq/faq-capex-procurement/mm-module/{faq}/edit', [AdminFaqCapexProcurementMmModuleController::class, 'edit'])->name('faq-capex-procurement.mm-module.edit');
    Route::put('admin/faq/faq-capex-procurement/mm-module/{faq}', [AdminFaqCapexProcurementMmModuleController::class, 'update'])->name('faq-capex-procurement.mm-module.update');
    Route::delete('admin/faq/faq-capex-procurement/mm-module/{faq}', [AdminFaqCapexProcurementMmModuleController::class, 'destroy'])->name('faq-capex-procurement.mm-module.destroy');

    // Routes untuk CO/FM Module - FAQ Capex Procurement
    Route::get('admin/faq/faq-capex-procurement/co-fm-module', [AdminFaqCapexProcurementCoFmModuleController::class, 'index'])->name('faq-capex-procurement.co-fm-module.index');
    Route::get('admin/faq/faq-capex-procurement/co-fm-module/create', [AdminFaqCapexProcurementCoFmModuleController::class, 'create'])->name('faq-capex-procurement.co-fm-module.create');
    Route::post('admin/faq/faq-capex-procurement/co-fm-module', [AdminFaqCapexProcurementCoFmModuleController::class, 'store'])->name('faq-capex-procurement.co-fm-module.store');
    Route::get('admin/faq/faq-capex-procurement/co-fm-module/{faq}/edit', [AdminFaqCapexProcurementCoFmModuleController::class, 'edit'])->name('faq-capex-procurement.co-fm-module.edit');
    Route::put('admin/faq/faq-capex-procurement/co-fm-module/{faq}', [AdminFaqCapexProcurementCoFmModuleController::class, 'update'])->name('faq-capex-procurement.co-fm-module.update');
    Route::delete('admin/faq/faq-capex-procurement/co-fm-module/{faq}', [AdminFaqCapexProcurementCoFmModuleController::class, 'destroy'])->name('faq-capex-procurement.co-fm-module.destroy');

    // Routes untuk General - FAQ Internal Project
    Route::get('admin/faq/faq-internal-project/general', [AdminFaqInternalProjectGeneralController::class, 'index'])->name('faq-internal-project.general.index');
    Route::get('admin/faq/faq-internal-project/general/create', [AdminFaqInternalProjectGeneralController::class, 'create'])->name('faq-internal-project.general.create');
    Route::post('admin/faq/faq-internal-project/general', [AdminFaqInternalProjectGeneralController::class, 'store'])->name('faq-internal-project.general.store');
    Route::get('admin/faq/faq-internal-project/general/{faq}/edit', [AdminFaqInternalProjectGeneralController::class, 'edit'])->name('faq-internal-project.general.edit');
    Route::put('admin/faq/faq-internal-project/general/{faq}', [AdminFaqInternalProjectGeneralController::class, 'update'])->name('faq-internal-project.general.update');
    Route::delete('admin/faq/faq-internal-project/general/{faq}', [AdminFaqInternalProjectGeneralController::class, 'destroy'])->name('faq-internal-project.general.destroy');

    // Routes untuk FI Module - FAQ Internal Project
    Route::get('admin/faq/faq-internal-project/fi-module', [AdminFaqInternalProjectFiModuleController::class, 'index'])->name('faq-internal-project.fi-module.index');
    Route::get('admin/faq/faq-internal-project/fi-module/create', [AdminFaqInternalProjectFiModuleController::class, 'create'])->name('faq-internal-project.fi-module.create');
    Route::post('admin/faq/faq-internal-project/fi-module', [AdminFaqInternalProjectFiModuleController::class, 'store'])->name('faq-internal-project.fi-module.store');
    Route::get('admin/faq/faq-internal-project/fi-module/{faq}/edit', [AdminFaqInternalProjectFiModuleController::class, 'edit'])->name('faq-internal-project.fi-module.edit');
    Route::put('admin/faq/faq-internal-project/fi-module/{faq}', [AdminFaqInternalProjectFiModuleController::class, 'update'])->name('faq-internal-project.fi-module.update');
    Route::delete('admin/faq/faq-internal-project/fi-module/{faq}', [AdminFaqInternalProjectFiModuleController::class, 'destroy'])->name('faq-internal-project.fi-module.destroy');

    // Routes untuk PS Module - FAQ Internal Project
    Route::get('admin/faq/faq-internal-project/ps-module', [AdminFaqInternalProjectPsModuleController::class, 'index'])->name('faq-internal-project.ps-module.index');
    Route::get('admin/faq/faq-internal-project/ps-module/create', [AdminFaqInternalProjectPsModuleController::class, 'create'])->name('faq-internal-project.ps-module.create');
    Route::post('admin/faq/faq-internal-project/ps-module', [AdminFaqInternalProjectPsModuleController::class, 'store'])->name('faq-internal-project.ps-module.store');
    Route::get('admin/faq/faq-internal-project/ps-module/{faq}/edit', [AdminFaqInternalProjectPsModuleController::class, 'edit'])->name('faq-internal-project.ps-module.edit');
    Route::put('admin/faq/faq-internal-project/ps-module/{faq}', [AdminFaqInternalProjectPsModuleController::class, 'update'])->name('faq-internal-project.ps-module.update');
    Route::delete('admin/faq/faq-internal-project/ps-module/{faq}', [AdminFaqInternalProjectPsModuleController::class, 'destroy'])->name('faq-internal-project.ps-module.destroy');

    // Routes untuk SD Module - FAQ Internal Project
    Route::get('admin/faq/faq-internal-project/sd-module', [AdminFaqInternalProjectSdModuleController::class, 'index'])->name('faq-internal-project.sd-module.index');
    Route::get('admin/faq/faq-internal-project/sd-module/create', [AdminFaqInternalProjectSdModuleController::class, 'create'])->name('faq-internal-project.sd-module.create');
    Route::post('admin/faq/faq-internal-project/sd-module', [AdminFaqInternalProjectSdModuleController::class, 'store'])->name('faq-internal-project.sd-module.store');
    Route::get('admin/faq/faq-internal-project/sd-module/{faq}/edit', [AdminFaqInternalProjectSdModuleController::class, 'edit'])->name('faq-internal-project.sd-module.edit');
    Route::put('admin/faq/faq-internal-project/sd-module/{faq}', [AdminFaqInternalProjectSdModuleController::class, 'update'])->name('faq-internal-project.sd-module.update');
    Route::delete('admin/faq/faq-internal-project/sd-module/{faq}', [AdminFaqInternalProjectSdModuleController::class, 'destroy'])->name('faq-internal-project.sd-module.destroy');

    // Routes untuk MM Module - FAQ Internal Project
    Route::get('admin/faq/faq-internal-project/mm-module', [AdminFaqInternalProjectMmModuleController::class, 'index'])->name('faq-internal-project.mm-module.index');
    Route::get('admin/faq/faq-internal-project/mm-module/create', [AdminFaqInternalProjectMmModuleController::class, 'create'])->name('faq-internal-project.mm-module.create');
    Route::post('admin/faq/faq-internal-project/mm-module', [AdminFaqInternalProjectMmModuleController::class, 'store'])->name('faq-internal-project.mm-module.store');
    Route::get('admin/faq/faq-internal-project/mm-module/{faq}/edit', [AdminFaqInternalProjectMmModuleController::class, 'edit'])->name('faq-internal-project.mm-module.edit');
    Route::put('admin/faq/faq-internal-project/mm-module/{faq}', [AdminFaqInternalProjectMmModuleController::class, 'update'])->name('faq-internal-project.mm-module.update');
    Route::delete('admin/faq/faq-internal-project/mm-module/{faq}', [AdminFaqInternalProjectMmModuleController::class, 'destroy'])->name('faq-internal-project.mm-module.destroy');

    // Routes untuk CO/FM Module - FAQ Internal Project
    Route::get('admin/faq/faq-internal-project/co-fm-module', [AdminFaqInternalProjectCoFmModuleController::class, 'index'])->name('faq-internal-project.co-fm-module.index');
    Route::get('admin/faq/faq-internal-project/co-fm-module/create', [AdminFaqInternalProjectCoFmModuleController::class, 'create'])->name('faq-internal-project.co-fm-module.create');
    Route::post('admin/faq/faq-internal-project/co-fm-module', [AdminFaqInternalProjectCoFmModuleController::class, 'store'])->name('faq-internal-project.co-fm-module.store');
    Route::get('admin/faq/faq-internal-project/co-fm-module/{faq}/edit', [AdminFaqInternalProjectCoFmModuleController::class, 'edit'])->name('faq-internal-project.co-fm-module.edit');
    Route::put('admin/faq/faq-internal-project/co-fm-module/{faq}', [AdminFaqInternalProjectCoFmModuleController::class, 'update'])->name('faq-internal-project.co-fm-module.update');
    Route::delete('admin/faq/faq-internal-project/co-fm-module/{faq}', [AdminFaqInternalProjectCoFmModuleController::class, 'destroy'])->name('faq-internal-project.co-fm-module.destroy');

    // Route untuk Scenario Jasa Konstruksi
    Route::get('admin/jasa-konstruksi', [JasaKonstruksiController::class, 'index'])->name('jasa-konstruksi.index');
    Route::get('admin/jasa-konstruksi/create', [JasaKonstruksiController::class, 'create'])->name('jasa-konstruksi.create');
    Route::post('admin/jasa-konstruksi', [JasaKonstruksiController::class, 'store'])->name('jasa-konstruksi.store');
    Route::get('admin/jasa-konstruksi/{jasa_konstruksi}/edit', [JasaKonstruksiController::class, 'edit'])->name('jasa-konstruksi.edit');
    Route::put('admin/jasa-konstruksi/{jasa_konstruksi}', [JasaKonstruksiController::class, 'update'])->name('jasa-konstruksi.update');
    Route::delete('admin/jasa-konstruksi/{jasa_konstruksi}', [JasaKonstruksiController::class, 'destroy'])->name('jasa-konstruksi.destroy');

    // Route untuk Scenario Jasa Non Konstruksi
    Route::get('admin/jasa-non-konstruksi', [JasaNonKonstruksiController::class, 'index'])->name('jasa-non-konstruksi.index');
    Route::get('admin/jasa-non-konstruksi/create', [JasaNonKonstruksiController::class, 'create'])->name('jasa-non-konstruksi.create');
    Route::post('admin/jasa-non-konstruksi', [JasaNonKonstruksiController::class, 'store'])->name('jasa-non-konstruksi.store');
    Route::get('admin/jasa-non-konstruksi/{jasa_non_konstruksi}/edit', [JasaNonKonstruksiController::class, 'edit'])->name('jasa-non-konstruksi.edit');
    Route::put('admin/jasa-non-konstruksi/{jasa_non_konstruksi}', [JasaNonKonstruksiController::class, 'update'])->name('jasa-non-konstruksi.update');
    Route::delete('admin/jasa-non-konstruksi/{jasa_non_konstruksi}', [JasaNonKonstruksiController::class, 'destroy'])->name('jasa-non-konstruksi.destroy');

    // Route untuk Scenario Manufacturing
    Route::get('admin/manufacturing', [ManufacturingController::class, 'index'])->name('manufacturing.index');
    Route::get('admin/manufacturing/create', [ManufacturingController::class, 'create'])->name('manufacturing.create');
    Route::post('admin/manufacturing', [ManufacturingController::class, 'store'])->name('manufacturing.store');
    Route::get('admin/manufacturing/{manufacturing}/edit', [ManufacturingController::class, 'edit'])->name('manufacturing.edit');
    Route::put('admin/manufacturing/{manufacturing}', [ManufacturingController::class, 'update'])->name('manufacturing.update');
    Route::delete('admin/manufacturing/{manufacturing}', [ManufacturingController::class, 'destroy'])->name('manufacturing.destroy');

    // Route untuk Scenario Capex Procurement
    Route::get('admin/capex-procurement', [CapexProcurementController::class, 'index'])->name('capex-procurement.index');
    Route::get('admin/capex-procurement/create', [CapexProcurementController::class, 'create'])->name('capex-procurement.create');
    Route::post('admin/capex-procurement', [CapexProcurementController::class, 'store'])->name('capex-procurement.store');
    Route::get('admin/capex-procurement/{capex_procurement}/edit', [CapexProcurementController::class, 'edit'])->name('capex-procurement.edit');
    Route::put('admin/capex-procurement/{capex_procurement}', [CapexProcurementController::class, 'update'])->name('capex-procurement.update');
    Route::delete('admin/capex-procurement/{capex_procurement}', [CapexProcurementController::class, 'destroy'])->name('capex-procurement.destroy');

    // Route untuk Scenario Internal Project
    Route::get('admin/internal-project', [InternalProjectController::class, 'index'])->name('internal-project.index');
    Route::get('admin/internal-project/create', [InternalProjectController::class, 'create'])->name('internal-project.create');
    Route::post('admin/internal-project', [InternalProjectController::class, 'store'])->name('internal-project.store');
    Route::get('admin/internal-project/{internal_project}/edit', [InternalProjectController::class, 'edit'])->name('internal-project.edit');
    Route::put('admin/internal-project/{internal_project}', [InternalProjectController::class, 'update'])->name('internal-project.update');
    Route::delete('admin/internal-project/{internal_project}', [InternalProjectController::class, 'destroy'])->name('internal-project.destroy');

    // Route untuk Information Updates Modul General
    Route::get('admin/info-general', [InfoGeneralController::class, 'index'])->name('info-general.index');
    Route::get('admin/info-general/create', [InfoGeneralController::class, 'create'])->name('info-general.create');
    Route::post('admin/info-general', [InfoGeneralController::class, 'store'])->name('info-general.store');
    Route::get('admin/info-general/{info_general}/edit', [InfoGeneralController::class, 'edit'])->name('info-general.edit');
    Route::put('admin/info-general/{info_general}', [InfoGeneralController::class, 'update'])->name('info-general.update');
    Route::delete('admin/info-general/{info_general}', [InfoGeneralController::class, 'destroy'])->name('info-general.destroy');
    
    // Route untuk Information Updates Modul FICO/FM
    Route::get('admin/fico-fm', [FicoFmController::class, 'index'])->name('fico-fm.index');
    Route::get('admin/fico-fm/create', [FicoFmController::class, 'create'])->name('fico-fm.create');
    Route::post('admin/fico-fm', [FicoFmController::class, 'store'])->name('fico-fm.store');
    Route::get('admin/fico-fm/{fico_fm}/edit', [FicoFmController::class, 'edit'])->name('fico-fm.edit');
    Route::put('admin/fico-fm/{fico_fm}', [FicoFmController::class, 'update'])->name('fico-fm.update');
    Route::delete('admin/fico-fm/{fico_fm}', [FicoFmController::class, 'destroy'])->name('fico-fm.destroy');
    
    // Route untuk Information Updates Modul PS
    Route::get('admin/ps', [PsController::class, 'index'])->name('ps.index');
    Route::get('admin/ps/create', [PsController::class, 'create'])->name('ps.create');
    Route::post('admin/ps', [PsController::class, 'store'])->name('ps.store');
    Route::get('admin/ps/{ps}/edit', [PsController::class, 'edit'])->name('ps.edit');
    Route::put('admin/ps/{ps}', [PsController::class, 'update'])->name('ps.update');
    Route::delete('admin/ps/{ps}', [PsController::class, 'destroy'])->name('ps.destroy');
    
    // Route untuk Information Updates Modul SD
    Route::get('admin/sd', [SdController::class, 'index'])->name('sd.index');
    Route::get('admin/sd/create', [SdController::class, 'create'])->name('sd.create');
    Route::post('admin/sd', [SdController::class, 'store'])->name('sd.store');
    Route::get('admin/sd/{sd}/edit', [SdController::class, 'edit'])->name('sd.edit');
    Route::put('admin/sd/{sd}', [SdController::class, 'update'])->name('sd.update');
    Route::delete('admin/sd/{sd}', [SdController::class, 'destroy'])->name('sd.destroy');

    // Route untuk Information Updates Modul MM
    Route::get('admin/mm', [MmController::class, 'index'])->name('mm.index');
    Route::get('admin/mm/create', [MmController::class, 'create'])->name('mm.create');
    Route::post('admin/mm', [MmController::class, 'store'])->name('mm.store');
    Route::get('admin/mm/{mm}/edit', [MmController::class, 'edit'])->name('mm.edit');
    Route::put('admin/info-general/{mm}', [MmController::class, 'update'])->name('mm.update');
    Route::delete('admin/mm/{mm}', [MmController::class, 'destroy'])->name('mm.destroy');
});

// Route untuk halaman Home
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk FAQ General (Tampilan User)
use App\Http\Controllers\FaqController;
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// Route untuk Info Updates (Tampilan User)
use App\Http\Controllers\InfoController;
    Route::get('/info/general', [InfoController::class, 'general'])->name('info.general');
    Route::get('/info/info-general/{id}', [InfoGeneralController::class, 'showPublic'])->name('info-general.public.show');
    Route::get('/info/fico-fm', [InfoController::class, 'ficoFm'])->name('info.fico-fm');
    Route::get('/info/fico-fm/{id}', [FicoFmController::class, 'showPublic'])->name('fico-fm.public.show');
    Route::get('/info/ps', [InfoController::class, 'ps'])->name('info.ps');
    Route::get('/info/ps/{id}', [PsController::class, 'showPublic'])->name('ps.public.show');
    Route::get('/info/sd', [InfoController::class, 'sd'])->name('info.sd');
    Route::get('/info/sd/{id}', [SdController::class, 'showPublic'])->name('sd.public.show');
    Route::get('/info/mm', [InfoController::class, 'mm'])->name('info.mm');
    Route::get('/info/mm/{id}', [MmController::class, 'showPublic'])->name('mm.public.show');

// Route untuk FAQ Jasa Konstruksi (Tampilan User)
use App\Http\Controllers\Faq\FaqJasaKonstruksi\GeneralController;
use App\Http\Controllers\Faq\FaqJasaKonstruksi\FiModuleController;
use App\Http\Controllers\Faq\FaqJasaKonstruksi\SdModuleController;
use App\Http\Controllers\Faq\FaqJasaKonstruksi\PsModuleController;
use App\Http\Controllers\Faq\FaqJasaKonstruksi\CoFmModuleController;
use App\Http\Controllers\Faq\FaqJasaKonstruksi\MmModuleController;

Route::get('/faq-jasa-konstruksi', [GeneralController::class, 'index'])->name('faq.jasa-konstruksi');
Route::get('/faq-jasa-konstruksi/fi', [FiModuleController::class, 'index'])->name('faq.fi');
Route::get('/faq-jasa-konstruksi/sd', [SdModuleController::class, 'index'])->name('faq.sd');
Route::get('/faq-jasa-konstruksi/ps', [PsModuleController::class, 'index'])->name('faq.ps');
Route::get('/faq-jasa-konstruksi/co-fm', [CoFmModuleController::class, 'index'])->name('faq.co-fm');
Route::get('/faq-jasa-konstruksi/mm', [MmModuleController::class, 'index'])->name('faq.mm');

// Route untuk FAQ Manufacturing (Tampilan User)
use App\Http\Controllers\Faq\FaqManufacturing\GeneralController as ManufacturingGeneralController;
use App\Http\Controllers\Faq\FaqManufacturing\FiModuleController as ManufacturingFiModuleController;
use App\Http\Controllers\Faq\FaqManufacturing\SdModuleController as ManufacturingSdModuleController;
use App\Http\Controllers\Faq\FaqManufacturing\PsModuleController as ManufacturingPsModuleController;
use App\Http\Controllers\Faq\FaqManufacturing\CoFmModuleController as ManufacturingCoFmModuleController;
use App\Http\Controllers\Faq\FaqManufacturing\MmModuleController as ManufacturingMmModuleController;

Route::get('/faq-manufacturing', [ManufacturingGeneralController::class, 'index'])->name('faq.manufacturing');
Route::get('/faq-manufacturing/fi', [ManufacturingFiModuleController::class, 'index'])->name('faq.manufacturing.fi');
Route::get('/faq-manufacturing/sd', [ManufacturingSdModuleController::class, 'index'])->name('faq.manufacturing.sd');
Route::get('/faq-manufacturing/ps', [ManufacturingPsModuleController::class, 'index'])->name('faq.manufacturing.ps');
Route::get('/faq-manufacturing/co-fm', [ManufacturingCoFmModuleController::class, 'index'])->name('faq.manufacturing.co-fm');
Route::get('/faq-manufacturing/mm', [ManufacturingMmModuleController::class, 'index'])->name('faq.manufacturing.mm');

// Route untuk FAQ Jasa Non Konstruksi (Tampilan User)
use App\Http\Controllers\Faq\FaqJasaNonKonstruksi\GeneralController as JasaNonKonstruksiGeneralController;
use App\Http\Controllers\Faq\FaqJasaNonKonstruksi\FiModuleController as JasaNonKonstruksiFiModuleController;
use App\Http\Controllers\Faq\FaqJasaNonKonstruksi\SdModuleController as JasaNonKonstruksiSdModuleController;
use App\Http\Controllers\Faq\FaqJasaNonKonstruksi\PsModuleController as JasaNonKonstruksiPsModuleController;
use App\Http\Controllers\Faq\FaqJasaNonKonstruksi\CoFmModuleController as JasaNonKonstruksiCoFmModuleController;
use App\Http\Controllers\Faq\FaqJasaNonKonstruksi\MmModuleController as JasaNonKonstruksiMmModuleController;

Route::get('/faq-jasa-non-konstruksi', [JasaNonKonstruksiGeneralController::class, 'index'])->name('faq.jasa-non-konstruksi');
Route::get('/faq-jasa-non-konstruksi/fi', [JasaNonKonstruksiFiModuleController::class, 'index'])->name('faq.jasa-non-konstruksi.fi');
Route::get('/faq-jasa-non-konstruksi/sd', [JasaNonKonstruksiSdModuleController::class, 'index'])->name('faq.jasa-non-konstruksi.sd');
Route::get('/faq-jasa-non-konstruksi/ps', [JasaNonKonstruksiPsModuleController::class, 'index'])->name('faq.jasa-non-konstruksi.ps');
Route::get('/faq-jasa-non-konstruksi/co-fm', [JasaNonKonstruksiCoFmModuleController::class, 'index'])->name('faq.jasa-non-konstruksi.co-fm');
Route::get('/faq-jasa-non-konstruksi/mm', [JasaNonKonstruksiMmModuleController::class, 'index'])->name('faq.jasa-non-konstruksi.mm');

// Route untuk FAQ Capex Procurement (Tampilan User)
use App\Http\Controllers\Faq\FaqCapexProcurement\GeneralController as CapexProcurementGeneralController;
use App\Http\Controllers\Faq\FaqCapexProcurement\FiModuleController as CapexProcurementFiModuleController;
use App\Http\Controllers\Faq\FaqCapexProcurement\SdModuleController as CapexProcurementSdModuleController;
use App\Http\Controllers\Faq\FaqCapexProcurement\PsModuleController as CapexProcurementPsModuleController;
use App\Http\Controllers\Faq\FaqCapexProcurement\CoFmModuleController as CapexProcurementCoFmModuleController;
use App\Http\Controllers\Faq\FaqCapexProcurement\MmModuleController as CapexProcurementMmModuleController;

Route::get('/faq-capex-procurement', [CapexProcurementGeneralController::class, 'index'])->name('faq.capex-procurement');
Route::get('/faq-capex-procurement/fi', [CapexProcurementFiModuleController::class, 'index'])->name('faq.capex-procurement.fi');
Route::get('/faq-capex-procurement/sd', [CapexProcurementSdModuleController::class, 'index'])->name('faq.capex-procurement.sd');
Route::get('/faq-capex-procurement/ps', [CapexProcurementPsModuleController::class, 'index'])->name('faq.capex-procurement.ps');
Route::get('/faq-capex-procurement/co-fm', [CapexProcurementCoFmModuleController::class, 'index'])->name('faq.capex-procurement.co-fm');
Route::get('/faq-capex-procurement/mm', [CapexProcurementMmModuleController::class, 'index'])->name('faq.capex-procurement.mm');

// Route untuk FAQ Internal Project (Tampilan User)
use App\Http\Controllers\Faq\FaqInternalProject\GeneralController as InternalProjectGeneralController;
use App\Http\Controllers\Faq\FaqInternalProject\FiModuleController as InternalProjectFiModuleController;
use App\Http\Controllers\Faq\FaqInternalProject\SdModuleController as InternalProjectSdModuleController;
use App\Http\Controllers\Faq\FaqInternalProject\PsModuleController as InternalProjectPsModuleController;
use App\Http\Controllers\Faq\FaqInternalProject\CoFmModuleController as InternalProjectCoFmModuleController;
use App\Http\Controllers\Faq\FaqInternalProject\MmModuleController as InternalProjectMmModuleController;

Route::get('/faq-internal-project', [InternalProjectGeneralController::class, 'index'])->name('faq.internal-project');
Route::get('/faq-internal-project/fi', [InternalProjectFiModuleController::class, 'index'])->name('faq.internal-project.fi');
Route::get('/faq-internal-project/sd', [InternalProjectSdModuleController::class, 'index'])->name('faq.internal-project.sd');
Route::get('/faq-internal-project/ps', [InternalProjectPsModuleController::class, 'index'])->name('faq.internal-project.ps');
Route::get('/faq-internal-project/co-fm', [InternalProjectCoFmModuleController::class, 'index'])->name('faq.internal-project.co-fm');
Route::get('/faq-internal-project/mm', [InternalProjectMmModuleController::class, 'index'])->name('faq.internal-project.mm');

// Route untuk Chatbot
use App\Http\Controllers\ChatbotController;

Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');
Route::post('/chatbot/response', [ChatbotController::class, 'getResponse'])->name('chatbot.response');
Route::get('/history', [ChatbotController::class, 'getChatHistory'])->name('chatbot.history');
Route::get('/chatbot/sessions', [ChatbotController::class, 'getChatSessions'])->name('chatbot.sessions');
Route::delete('/session', [ChatbotController::class, 'deleteChatSession'])->name('chatbot.delete-session');
Route::get('/model_faq', [ChatbotController::class, 'index'])->name('handleModel');

// Route untuk membuka item Scenario pada navbar di Tampilan User
use App\Http\Controllers\ScenarioNavbarController;

Route::get('/jasa-konstruksi', [ScenarioNavbarController::class, 'jasaKonstruksi'])->name('scenario-navbar.jasa-konstruksi');
Route::get('/scenario-navbar/jasa-konstruksi', function () {return view('scenario-navbar.jasa-konstruksi');});
Route::get('/manufacturing', [ScenarioNavbarController::class, 'manufacturing'])->name('scenario-navbar.manufacturing');
Route::get('/jasa-non-konstruksi', [ScenarioNavbarController::class, 'jasaNonKonstruksi'])->name('scenario-navbar.jasa-non-konstruksi');
Route::get('/capex-procurement', [ScenarioNavbarController::class, 'capexProcurement'])->name('scenario-navbar.capex-procurement');
Route::get('/internal-project', [ScenarioNavbarController::class, 'internalProject'])->name('scenario-navbar.internal-project');

// Route untuk membuka halaman Information Updates\
use App\Http\Controllers\Info\FicoFmInfoController;
use App\Http\Controllers\Info\InfoGeneralInfoController;
use App\Http\Controllers\Info\MmInfoController;   
use App\Http\Controllers\Info\PsInfoController;
use App\Http\Controllers\Info\SdInfoController;

Route::get('/info/info-general', [InfoGeneralInfoController::class, 'index'])->name('info.info-general');
Route::get('/info/fico-fm', [FicoFmInfoController::class, 'index'])->name('info.fico-fm');
Route::get('/info/ps', [PsInfoController::class, 'index'])->name('info.ps');
Route::get('/info/sd', [SdInfoController::class, 'index'])->name('info.sd');
Route::get('/info/mm', [MmInfoController::class, 'index'])->name('info.mm');