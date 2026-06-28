<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien;
use App\Models\Antrean;
use App\Models\Poli;
class AntreanController extends Controller
{
    public function index()
    {
        if (!session()->has('id_akun')) {
            return redirect('/');
        }
        $polis = DB::table('poli')->get();
        return view('dashboard-petugas', compact('polis'));
    }

    public function getLiveData()
    {
        $polis = DB::table('poli')->get();
        $data = [];

        foreach ($polis as $poli) {
            $current = DB::table('antrean')
                ->where('id_poli', $poli->id_poli)
                ->whereDate('tanggal_periksa', now())
                ->where('status', 'dipanggil')
                ->first();

            $next = DB::table('antrean')
                ->where('id_poli', $poli->id_poli)
                ->whereDate('tanggal_periksa', now())
                ->where('status', 'menunggu')
                ->orderBy('nomor_urut', 'asc')
                ->first();

            $data[] = [
                'id_poli' => $poli->id_poli,
                'current_number' => $current ? str_pad($current->nomor_urut, 2, '0', STR_PAD_LEFT) : '--',
                'next_number' => $next ? str_pad($next->nomor_urut, 2, '0', STR_PAD_LEFT) : '--'
            ];
        }

        return response()->json(['status' => 'success', 'data' => $data]);
    }

    public function manualAntrean(Request $request)
    {
        $idPoli = $request->id_poli;
        $nomorBaru = $request->nomor_urut;

        DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->whereDate('tanggal_periksa', now())
            ->where('status', 'dipanggil')
            ->update(['status' => 'selesai']);

        $target = DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->where('nomor_urut', $nomorBaru)
            ->whereDate('tanggal_periksa', now())
            ->first();

        if ($target) {
            DB::table('antrean')
                ->where('id_antrean', $target->id_antrean)
                ->update(['status' => 'dipanggil']);
            
            $pesan = "Nomor urut $nomorBaru berhasil dipanggil secara manual!";
        } else {
            return response()->json([
                'status' => 'error', 
                'message' => "Nomor urut $nomorBaru belum terdaftar di sistem!"
            ]);
        }

        return $this->getResponseData($idPoli, $pesan);
    }

    public function nextAntrean(Request $request)
    {
        $idPoli = $request->id_poli;

        DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->where('status', 'dipanggil')
            ->update(['status' => 'selesai']);


        $next = DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->whereDate('tanggal_periksa', now())
            ->where('status', 'menunggu')
            ->orderBy('nomor_urut', 'asc')
            ->first();


        if ($next) {
            DB::table('antrean')
                ->where('id_antrean', $next->id_antrean)
                ->update(['status' => 'dipanggil']);
        }

        return $this->getResponseData($idPoli, 'Antrean selanjutnya berhasil dipanggil!');
    }

    public function skipAntrean(Request $request)
    {
        $idPoli = $request->id_poli;


        DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->where('status', 'dipanggil')
            ->update(['status' => 'dilewati']);


        $next = DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->whereDate('tanggal_periksa', now())
            ->where('status', 'menunggu')
            ->orderBy('nomor_urut', 'asc')
            ->first();

        if ($next) {
            DB::table('antrean')
                ->where('id_antrean', $next->id_antrean)
                ->update(['status' => 'dipanggil']);
        }

        return $this->getResponseData($idPoli, 'Antrean dilewati, memanggil nomor berikutnya.');
    }

    public function recallAntrean(Request $request)
    {
        return $this->getResponseData($request->id_poli, 'Memanggil ulang antrean saat ini...');
    }


    private function getResponseData($idPoli, $message)
    {

        $current = DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->where('status', 'dipanggil')
            ->whereDate('tanggal_periksa', now())
            ->first();

        $next = DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->where('status', 'menunggu')
            ->whereDate('tanggal_periksa', now())
            ->orderBy('nomor_urut', 'asc')
            ->first();

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'current_number' => $current ? str_pad($current->nomor_urut, 2, '0', STR_PAD_LEFT) : '--',
            'next_number' => $next ? str_pad($next->nomor_urut, 2, '0', STR_PAD_LEFT) : '--',
            'id_poli' => $idPoli
        ]);
    }

public function tambahPasienBaru(Request $request)
    {
        $nama = $request->nama_pasien;
        $tglLahir = $request->tanggal_lahir;
        $idPoli = $request->id_poli;

        $idAkun = session('id_akun', 1); 

        $poliMaster = DB::table('poli')->where('id_poli', $idPoli)->first();

        $idPasienBaru = DB::table('pasien')->insertGetId([
            'nama_pasien' => $nama,
            'tanggal_lahir' => $tglLahir,
            'id_akun' => $idAkun 
        ]);

        $lastAntrean = DB::table('antrean')
            ->where('id_poli', $idPoli)
            ->whereDate('tanggal_periksa', now()->toDateString())
            ->orderBy('nomor_urut', 'desc')
            ->first();

        $nomorBaru = $lastAntrean ? $lastAntrean->nomor_urut + 1 : 1;

        DB::table('antrean')->insert([
            'tanggal_periksa' => now()->toDateString(),
            'jadwal_kedatangan' => now()->toDateString(),
            'kode_poli' => $poliMaster ? $poliMaster->kode_poli : null,
            'nomor_urut' => $nomorBaru,
            'status' => 'menunggu',
            'id_pasien' => $idPasienBaru,
            'id_akun' => $idAkun,
            'id_poli' => $idPoli
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "Pasien $nama berhasil didaftarkan ke Poli $idPoli dengan Nomor $nomorBaru!"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'tanggal_lahir' => 'required',
            'keluhan' => 'required',
            'jadwal_kedatangan' => 'required',
            'kode_poli' => 'required'
        ]);

        $idAkun = session('id_akun');

        if (!$idAkun) {
            return redirect('/')
                ->withErrors([
                    'login' => 'Silakan login terlebih dahulu'
                ]);
        }

        $poli = Poli::where(
            'kode_poli',
            $request->kode_poli
        )->first();

        if (!$poli) {
            return back()->withErrors([
                'poli' => 'Poli tidak ditemukan'
            ]);
        }

        $pasien = Pasien::create([
            'nama_pasien' => $request->nama_pasien,
            'tanggal_lahir' => $request->tanggal_lahir,
            'keluhan' => $request->keluhan,
            'id_akun' => $idAkun
        ]);

        $nomorTerakhir = Antrean::whereDate(
            'tanggal_periksa',
            $request->jadwal_kedatangan
        )
        ->where(
            'kode_poli',
            $request->kode_poli
        )
        ->max('nomor_urut');

        $nomorBaru = ($nomorTerakhir ?? 0) + 1;

        Antrean::create([
            'tanggal_periksa' => $request->jadwal_kedatangan,
            'nomor_urut' => $nomorBaru,
            'kode_poli' => $request->kode_poli,
            'jadwal_kedatangan' => $request->jadwal_kedatangan,
            'status' => 'menunggu',
            'id_pasien' => $pasien->id_pasien,
            'id_akun' => $idAkun,
            'id_poli' => $poli->id_poli
        ]);

        $nomorAntrean =
            $request->kode_poli .
            str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);

        return redirect('/main')
            ->with('success', 'Nomor antrean Anda: ' . $nomorAntrean);
    }
    public function statusAntrean()
    {
        $polis = Poli::all();

        $data = [];

        foreach($polis as $poli)
        {
            $current = Antrean::where('id_poli',$poli->id_poli)
                ->whereDate('tanggal_periksa',today())
                ->where('status','dipanggil')
                ->first();

            $next = Antrean::where('id_poli',$poli->id_poli)
                ->whereDate('tanggal_periksa',today())
                ->where('status','menunggu')
                ->orderBy('nomor_urut')
                ->first();

            $data[] = [
                'kode'=>$poli->kode_poli,
                'current'=>$current
                    ? str_pad($current->nomor_urut,2,'0',STR_PAD_LEFT)
                    : '--',
                'next'=>$next
                    ? str_pad($next->nomor_urut,2,'0',STR_PAD_LEFT)
                    : '--'
            ];
        }

        return response()->json($data);
    }
}