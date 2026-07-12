<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // ================================================================
    // HELPER: Ambil info diskon cukur berdasarkan user_id
    // ================================================================
    private function getDiskonCukur($userId)
    {
        // Cek tier dari yang tertinggi dulu
        if (DB::table('diamond')->where('user_id', $userId)->exists()) {
            $tier = 'diamond';
        } elseif (DB::table('platinum')->where('user_id', $userId)->exists()) {
            $tier = 'platinum';
        } elseif (DB::table('gold')->where('user_id', $userId)->exists()) {
            $tier = 'gold';
        } else {
            return ['tier' => null, 'persen' => 0]; // Bukan member, tidak ada diskon
        }

        $data = DB::table('member_tiers')->where('tier', $tier)->first();
        return [
            'tier'  => $tier,
            'persen' => $data ? $data->diskon_cukur : 0
        ];
    }

    // ================================================================
    // 1. Tampilkan daftar Barber
    // ================================================================
    public function showBarbers(Request $request)
    {
        $barbers    = Barber::all();
        $service_id = $request->query('service_id');
        return view('book', compact('barbers', 'service_id'));
    }

    // ================================================================
    // 2. Tampilkan halaman pilih tanggal
    // ================================================================
    public function showTanggal(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        $artisan_id = $request->query('artisan');
        $service_id = $request->query('service_id');

        if (empty($artisan_id) || empty($service_id)) {
            return redirect()->route('home');
        }

        $dataBarber  = Barber::find($artisan_id);
        $dataService = Service::find($service_id);

        // Hitung preview diskon untuk ditampilkan di halaman pilih tanggal
        $diskonInfo  = $this->getDiskonCukur(Auth::id());
        $potongan    = (int) ($dataService->harga * $diskonInfo['persen'] / 100);
        $hargaFinal  = $dataService->harga - $potongan;

        return view('tanggal_book', compact('dataBarber', 'dataService', 'diskonInfo', 'potongan', 'hargaFinal'));
    }

    // ================================================================
    // 3. Proses Booking dengan Diskon Member
    // ================================================================
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response("<script>
                alert('Sistem mendeteksi kamu belum login! Silakan login ulang.');
                window.history.back();
            </script>");
        }

        try {
            $jamDariForm      = $request->input('jam');
            $jamUntukDatabase = date('H:i:s', strtotime($jamDariForm));
            $tanggal          = $request->input('tanggal');
            $barberId         = $request->input('artisan');
            $serviceId        = $request->input('service_id');
            $userId           = Auth::id();

            // Validasi double booking
            $isBooked = Booking::where('tanggal', $tanggal)
                               ->where('waktu', $jamUntukDatabase)
                               ->where('barber_id', $barberId)
                               ->exists();

            if ($isBooked) {
                return response("<script>
                    alert('Maaf, jadwal pada tanggal dan jam tersebut sudah penuh. Silakan pilih waktu lain.');
                    window.history.back();
                </script>");
            }

            // === HITUNG DISKON MEMBER ===
            $service     = Service::find($serviceId);
            $diskonInfo  = $this->getDiskonCukur($userId);
            $persen      = $diskonInfo['persen'];
            $potongan    = (int) ($service->harga * $persen / 100);
            $hargaFinal  = $service->harga - $potongan;

            // Simpan booking beserta info diskon
            Booking::create([
                'user_id'      => $userId,
                'barber_id'    => $barberId,
                'service_id'   => $serviceId,
                'tanggal'      => $tanggal,
                'waktu'        => $jamUntukDatabase,
                'status'       => 'pending',
                'harga_final'  => $hargaFinal,   // harga setelah diskon
                'diskon_persen'=> $persen,        // % diskon yang dipakai
            ]);

            return response("<script>
                alert('Booking berhasil! Harga: Rp " . number_format($hargaFinal, 0, ',', '.') . " (diskon {$persen}%)');
                window.location.href='" . url('/') . "';
            </script>");

        } catch (\Exception $e) {
            dd([
                "Pesan Error" => $e->getMessage(),
                "Data Form"   => $request->all()
            ]);
        }
    }
}