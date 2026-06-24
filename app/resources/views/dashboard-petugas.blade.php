<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - BALIMUD</title>
    
    <link rel="stylesheet" href="{{ asset('css/dashboard-petugas.css') }}">
</head>
<body>

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
            <a href="#">Logout</a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="top-accent"></div>

        <div class="antrian-grid">
            
            @php
                $polis = [
                    ['kode' => 'Kode a'], ['kode' => 'Kode b'], 
                    ['kode' => 'Kode c'], ['kode' => 'Kode d']
                ];
            @endphp

            @foreach ($polis as $poli)
            <div class="antrian-card">
                <h2>Nomer Antrian</h2>
                <div class="badge-kode">{{ $poli['kode'] }}</div>

                <div class="nomer-display">
                    <div class="nomer-box">
                        <span>Saat ini</span>
                        <div class="angka-box angka-saat-ini">01</div>
                    </div>
                    <div class="nomer-box">
                        <span>Selanjutnya</span>
                        <div class="angka-box angka-selanjutnya">02</div>
                    </div>
                </div>

                <button class="btn-selanjutnya">Selanjutnya</button>
                <div class="action-row">
                    <button class="btn-lewati">Lewati</button>
                    <button class="btn-notif">
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
            </div>
    </main>

</body>
</html>