<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AkunPengguna;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:50|unique:akun_pengguna,username',
            'password' => 'required|min:6|confirmed',
        ]);

        AkunPengguna::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
            'telepon' => '62'.$request->phone
        ]);

        return redirect('/')
            ->with('success', 'Registrasi berhasil');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $akun = AkunPengguna::where('username', $request->username)->first();

        if (!$akun) {
            return back()->withErrors([
                'login' => 'Username tidak ditemukan'
            ]);
        }

        if (!Hash::check($request->password, $akun->password)) {
            return back()->withErrors([
                'login' => 'Password salah'
            ]);
        }

        session([
            'id_akun' => $akun->id_akun,
            'username' => $akun->username,
            'role' => $akun->role
        ]);

        if ($akun->role === 'petugas') {
            return redirect('/dashboard-petugas');
        }

        return redirect('/main');
    }
}