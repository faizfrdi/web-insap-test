<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JasaKonstruksi;
use App\Models\Manufacturing;
use App\Models\JasaNonKonstruksi;
use App\Models\CapexProcurement;
use App\Models\InternalProject;
use App\Models\ActivityLog;
use App\Models\Visitor; // Model untuk data pengunjung
use Carbon\Carbon;

class AdminController extends Controller
{
    // Menampilkan form login untuk admin
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('admin.dashboard'))->with('login_success', 'Login berhasil! Selamat datang di dashboard admin.');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('logout_success', 'Logout berhasil! Anda telah keluar dari dashboard admin.');
    }

    // Dashboard admin, mengambil data dari database
    public function dashboard(Request $request)
    {
        // Mengambil jumlah data dari database untuk setiap kategori
        $jasaKonstruksiCount = JasaKonstruksi::count();
        $manufacturingCount = Manufacturing::count();
        $jasaNonKonstruksiCount = JasaNonKonstruksi::count();
        $capexProcurementCount = CapexProcurement::count();
        $internalProjectCount = InternalProject::count();

        // Mendapatkan halaman saat ini untuk masing-masing pagination
        $activityPage = $request->input('activity_page', 1); // Default halaman 1 untuk aktivitas

        // Mengambil aktivitas terbaru dengan pagination (5 per halaman)
        $recentActivities = ActivityLog::orderBy('created_at', 'desc')->paginate(5, ['*'], 'activity_page', $activityPage);

        // Menghitung jumlah aktivitas baru dalam 24 jam terakhir
        $newActivityCount = ActivityLog::where('created_at', '>=', Carbon::now()->subDay())->count();

        // **Mengambil data pengunjung website dari database**
        // Mengambil data pengunjung selama 7 hari terakhir dari tabel visitors
        $visitorData = Visitor::where('visit_date', '>=', Carbon::today()->subDays(6))
            ->orderBy('visit_date', 'asc')
            ->get();

        // Membuat array untuk grafik dengan default 0
        $visitorCount = array_fill(0, 7, 0); // Inisialisasi 7 hari dengan 0

        foreach ($visitorData as $visitor) {
            // Hitung index untuk memasukkan data ke array, berdasarkan hari (0: Minggu, 6: Sabtu)
            $index = Carbon::parse($visitor->visit_date)->dayOfWeek;
            $visitorCount[$index] = $visitor->visit_count;
        }

        $visitorStats = $this->getVisitorStats();

        // Mengirim data ke view dashboard
        return view('admin.dashboard', compact(
            'jasaKonstruksiCount',
            'manufacturingCount',
            'jasaNonKonstruksiCount',
            'capexProcurementCount',
            'internalProjectCount',
            'recentActivities',
            'newActivityCount',
            'visitorCount', // Mengirim data pengunjung ke view
            'visitorStats' // Tambahkan ini
        ));
    }

    // Tambahkan method ini di dalam class AdminController
    private function getVisitorStats()
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $monthStart = Carbon::now()->startOfMonth();

        return [
            'today' => Visitor::whereDate('visit_date', $today)->sum('visit_count'),
            'week' => Visitor::whereBetween('visit_date', [$weekStart, Carbon::now()])->sum('visit_count'),
            'month' => Visitor::whereBetween('visit_date', [$monthStart, Carbon::now()])->sum('visit_count'),
        ];
    }
}