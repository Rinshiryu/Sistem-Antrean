<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balimud</title>
    <link rel="icon" type="image/png" href="{{ asset('image/login/logors.png') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <!-- HEADER -->
    <div class="hero">

        <div class="logo-box">
            <i class="fa-solid fa-hospital"></i>
        </div>

        <h1>BALIMUD</h1>

    </div>

    <div class="notice">
        Perhatian! harap ambil 1 antrean sesuai dengan poli yang dituju!
    </div>

    @if(session('success'))
    <div style="
        background:#d4edda;
        color:#155724;
        padding:15px;
        margin:20px;
        border-radius:10px;
        font-weight:bold;
    ">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- POLI -->
    <section class="poli-container">

        <!-- POLI UMUM -->
        <div class="poli-card">
            <div class="icon-circle">
                <i class="fa-solid fa-stethoscope"></i>
            </div>

            <h2>Poli Umum</h2>

            <span class="kode">Kode A</span>

            <button onclick="openQueueModal('A')">
                Ambil Antrean
            </button>
        </div>

        <!-- POLI GIGI -->
        <div class="poli-card">
            <div class="icon-circle">
                <i class="fa-solid fa-tooth"></i>
            </div>

            <h2>Poli Gigi</h2>

            <span class="kode">Kode B</span>

            <button onclick="openQueueModal('B')">
                Ambil Antrean
            </button>
        </div>

        <!-- POLI KIA -->
        <div class="poli-card">
            <div class="icon-circle">
                <i class="fa-solid fa-children"></i>
            </div>

            <h2>Poli KIA</h2>

            <span class="kode">Kode C</span>

            <button onclick="openQueueModal('C')">
                Ambil Antrean
            </button>
        </div>

        <!-- POLI THT -->
        <div class="poli-card">
            <div class="icon-circle">
                <i class="fa-solid fa-ear-listen"></i>
            </div>

            <h2>Poli THT</h2>

            <span class="kode">Kode D</span>

            <button onclick="openQueueModal('D')">
                Ambil Antrean
            </button>
        </div>

    </section>

    <!-- STATUS ANTREAN -->
    <section class="queue-container">

        <!-- POLI A -->
        <div class="queue-card">

            <h2>Nomor Antrean</h2>

            <span class="kode">Kode A</span>

            <div class="queue-box">

                <div>
                    <small>Saat ini</small>
                    <div class="current" id="current-A">--</div>
                </div>

                <div>
                    <small>Selanjutnya</small>
                    <div class="next" id="next-A">--</div>
                </div>

            </div>

        </div>

        <!-- POLI B -->
        <div class="queue-card">

            <h2>Nomor Antrean</h2>

            <span class="kode">Kode B</span>

            <div class="queue-box">

                <div>
                    <small>Saat ini</small>
                    <div class="current" id="current-B">--</div>
                </div>

                <div>
                    <small>Selanjutnya</small>
                    <div class="next" id="next-B">--</div>
                </div>

            </div>

        </div>

        <!-- POLI C -->
        <div class="queue-card">

            <h2>Nomor Antrean</h2>

            <span class="kode">Kode C</span>

            <div class="queue-box">

                <div>
                    <small>Saat ini</small>
                    <div class="current" id="current-C">--</div>
                </div>

                <div>
                    <small>Selanjutnya</small>
                    <div class="next" id="next-C">--</div>
                </div>

            </div>

        </div>

        <!-- POLI D -->
        <div class="queue-card">

            <h2>Nomor Antrean</h2>

            <span class="kode">Kode D</span>

            <div class="queue-box">

                <div>
                    <small>Saat ini</small>
                    <div class="current" id="current-D">--</div>
                </div>

                <div>
                    <small>Selanjutnya</small>
                    <div class="next" id="next-D">--</div>
                </div>

            </div>

        </div>

    </section>

    <!-- MODAL ANTREAN -->
    <div id="queueModal" class="modal-overlay" style="display:none;">

        <div class="modal-box">

            <h3>Form Pengambilan Antrean</h3>

            <form action="{{ route('ambil.antrean') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="kode_poli"
                       id="kode_poli">

                <div class="form-group">
                    <label>NIK / No KTP</label>
                    <input type="text"
                           name="nik"
                           required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text"
                           name="nama_pasien"
                           required>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date"
                           name="tanggal_lahir"
                           required>
                </div>

                <div class="form-group">
                    <label>Jadwal Kedatangan</label>
                    <input type="date"
                           name="jadwal_kedatangan"
                           required>
                </div>

                <div class="form-group">
                    <label>Keluhan Singkat</label>
                    <textarea
                        name="keluhan"
                        rows="3"
                        required></textarea>
                </div>

                <div class="modal-actions">

                    <button type="button"
                            class="btn-cancel"
                            onclick="closeQueueModal()">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn-submit">
                        Ambil Antrean
                    </button>

                </div>

            </form>

        </div>

    </div>
        <form action="{{ route('logout') }}" method="POST" class="logout-form-float">
            @csrf
            <button type="submit" class="btn-logout-float" title="Logout dari Sistem">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
    <footer></footer>

    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>