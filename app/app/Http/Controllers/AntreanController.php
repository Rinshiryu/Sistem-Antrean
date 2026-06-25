<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Antrean;
use App\Models\Poli;

class AntreanController extends Controller
{
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
}