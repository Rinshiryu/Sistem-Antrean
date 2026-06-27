<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Petugas - BALIMUD</title>
    <link rel="icon" type="image/png" href="{{ asset('image/login/logors.png') }}">
    
    <link rel="stylesheet" href="{{ asset('css/dashboard-petugas.css') }}">
</head>
<body>

    <div id="alert-box" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #2295F4; color: white; padding: 15px 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.2); z-index: 1000; font-weight: bold; transition: 0.3s;">
        <span id="alert-message">Notifikasi</span>
    </div>

    <aside class="sidebar">
        <div class="logo-container">
            <div class="logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h1>BALIMUD</h1>
        </div>

        <nav class="nav-menu">
            <a href="#">Home</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="main-content">
        <div class="top-accent"></div>

        <button class="btn-tambah-pasien" onclick="openModalPasien()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pasien Baru
        </button>

        <div class="antrian-grid">
            @foreach ($polis as $poli)
            <div class="antrian-card">
                <h2>{{ $poli->nama_poli ?? 'Nomer Antrian' }}</h2>
                <div class="badge-kode">Kode Poli: {{ $poli->kode_poli }}</div>

                <div class="nomer-display">
                    <div class="nomer-box" style="position: relative;">
                        <span>Saat ini</span>
                        <div class="angka-box angka-saat-ini" id="current-{{ $poli->kode_poli }}">--</div>
                        
                        <button onclick="editManual({{ $poli->kode_poli }})" class="btn-edit-manual">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>

                    <div class="nomer-box">
                        <span>Selanjutnya</span>
                        <div class="angka-box angka-selanjutnya" id="next-{{ $poli->kode_poli }}">--</div>
                    </div>
                </div>

                <button onclick="handleAntrean('next', {{ $poli->kode_poli }})" class="btn-selanjutnya">Selanjutnya</button>
                <div class="action-row">
                    <button onclick="handleAntrean('skip', {{ $poli->kode_poli }})" class="btn-lewati">Lewati</button>
                    <button onclick="handleAntrean('recall', {{ $poli->kode_poli }})" class="btn-notif">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="catatan-box">
            <h3>Catatan:</h3>
            <div class="catatan-item">
                <div class="catatan-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                </div>
                <span>kode a: Poli Umum</span>
            </div>
            <div class="catatan-item">
                <div class="catatan-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span>kode b: Poli Gigi</span>
            </div>
            <div class="catatan-item">
                <div class="catatan-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <span>kode c: Poli KIA</span>
            </div>
            <div class="catatan-item">
                <div class="catatan-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                </div>
                <span>kode d: Poli THT</span>
            </div>
        </div>
    </main>

    <div id="modal-pasien" class="modal-overlay" style="display: none;">
        <div class="modal-box">
            <h2>Form Pendaftaran Cepat</h2>
            
            <form id="form-tambah-pasien" onsubmit="submitPasienBaru(event)">
                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" id="input-nama" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" id="input-tgl" required>
                </div>

                <div class="form-group">
                    <label>Tujuan Poli</label>
                    <select id="input-poli" required>
                        @foreach($polis as $poli)
                            <option value="{{ $poli->id_poli }}">{{ $poli->nama_poli ?? 'Poli '.$poli->id_poli }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-batal" onclick="closeModalPasien()">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/dashboard-petugas.js') }}"></script>
</body>
</html>