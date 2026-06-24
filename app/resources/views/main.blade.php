<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balimud</title>

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

    <!-- POLI -->
    <section class="poli-container">

        <div class="poli-card">
            <div class="icon-circle">
                <i class="fa-solid fa-stethoscope"></i>
            </div>

            <h2>Poli Umum</h2>

            <span class="kode">Kode a</span>

            <button>Ambil Antrian</button>
        </div>

        <div class="poli-card">
            <div class="icon-circle">
                <i class="fa-solid fa-tooth"></i>
            </div>

            <h2>Poli Gigi</h2>

            <span class="kode">Kode b</span>

            <button>Ambil Antrian</button>
        </div>

        <div class="poli-card">
            <div class="icon-circle">
                <i class="fa-solid fa-children"></i>
            </div>

            <h2>Poli KIA</h2>

            <span class="kode">Kode c</span>

            <button>Ambil Antrian</button>
        </div>

        <div class="poli-card">
            <div class="icon-circle">
                <i class="fa-solid fa-ear-listen"></i>
            </div>

            <h2>Poli THT</h2>

            <span class="kode">Kode d</span>

            <button>Ambil Antrian</button>
        </div>

    </section>

    <!-- STATUS ANTREAN -->
    <section class="queue-container">

        <div class="queue-card">

            <h2>Nomer Antrian</h2>

            <span class="kode">Kode a</span>

            <div class="queue-box">

                <div>
                    <small>Saat ini</small>
                    <div class="current">01</div>
                </div>

                <div>
                    <small>Selanjutnya</small>
                    <div class="next">02</div>
                </div>

            </div>

        </div>

        <div class="queue-card">

            <h2>Nomer Antrian</h2>

            <span class="kode">Kode b</span>

            <div class="queue-box">

                <div>
                    <small>Saat ini</small>
                    <div class="current">01</div>
                </div>

                <div>
                    <small>Selanjutnya</small>
                    <div class="next">02</div>
                </div>

            </div>

        </div>

        <div class="queue-card">

            <h2>Nomer Antrian</h2>

            <span class="kode">Kode c</span>

            <div class="queue-box">

                <div>
                    <small>Saat ini</small>
                    <div class="current">01</div>
                </div>

                <div>
                    <small>Selanjutnya</small>
                    <div class="next">02</div>
                </div>

            </div>

        </div>

        <div class="queue-card">

            <h2>Nomer Antrian</h2>

            <span class="kode">Kode d</span>

            <div class="queue-box">

                <div>
                    <small>Saat ini</small>
                    <div class="current">01</div>
                </div>

                <div>
                    <small>Selanjutnya</small>
                    <div class="next">02</div>
                </div>

            </div>

        </div>

    </section>

    <footer></footer>

</body>
</html>