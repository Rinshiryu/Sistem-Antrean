
function handleAntrean(action, idPoli) {
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    
    if (!metaTag) {
        console.error('CSRF token tidak ditemukan di HTML!');
        showAlert('Error: Keamanan sistem tidak valid.');
        return;
    }

    const csrfToken = metaTag.getAttribute('content');
    const url = `/petugas/antrean/${action}`;

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ id_poli: idPoli })
    })
    .then(response => {
        if (!response.ok) throw new Error('Terjadi masalah pada koneksi ke server.');
        return response.json();
    })
    .then(data => {
        if(data.status === 'success') {
            document.getElementById(`current-${data.id_poli}`).innerText = data.current_number;
            document.getElementById(`next-${data.id_poli}`).innerText = data.next_number;
            showAlert(data.message);

            if (action === 'recall' || action === 'next') {
                console.log(`[Sistem Audio] Memanggil nomor urut ${data.current_number} ke Poli ${data.id_poli}`);
            }
        }
    })
    .catch(error => {
        console.error('Error Fetch:', error);
        showAlert('Gagal menghubungi server database!');
    });
}


function editManual(idPoli) {
    const inputNomor = prompt("Masukkan nomor antrean yang ingin dipanggil manual (contoh: 5):");
    
    if (!inputNomor || isNaN(inputNomor)) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/petugas/antrean/manual', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ 
            id_poli: idPoli,
            nomor_urut: parseInt(inputNomor)
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            document.getElementById(`current-${data.id_poli}`).innerText = data.current_number;
            document.getElementById(`next-${data.id_poli}`).innerText = data.next_number;
            showAlert(data.message);
        } else {
            showAlert(data.message || 'Error mengubah nomor!');
        }
    })
    .catch(error => {
        console.error('Error Manual Edit:', error);
        showAlert('Gagal mengeksekusi panggilan manual!');
    });
}

function showAlert(message) {
    const alertBox = document.getElementById('alert-box');
    const alertMsg = document.getElementById('alert-message');
    
    alertMsg.innerText = message;
    alertBox.style.display = 'block';

    setTimeout(() => {
        alertBox.style.display = 'none';
    }, 3000);
}

function fetchLiveData() {
    fetch('/petugas/antrean/live-data')
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            data.data.forEach(poli => {
                const currentEl = document.getElementById(`current-${poli.id_poli}`);
                const nextEl = document.getElementById(`next-${poli.id_poli}`);
                
                if (currentEl) currentEl.innerText = poli.current_number;
                if (nextEl) nextEl.innerText = poli.next_number;
            });
        }
    })
    .catch(error => console.error('Error Live Data:', error));
}

setInterval(fetchLiveData, 3000);
fetchLiveData();

function openModalPasien() {
    document.getElementById('form-tambah-pasien').reset();
    document.getElementById('modal-pasien').style.display = 'flex';
}

function closeModalPasien() {
    document.getElementById('modal-pasien').style.display = 'none';
}

function submitPasienBaru(event) {
    // Mencegah halaman reload
    event.preventDefault();

    const nama = document.getElementById('input-nama').value;
    const tgl = document.getElementById('input-tgl').value;
    const idPoli = document.getElementById('input-poli').value;
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/petugas/antrean/tambah-pasien', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            nama_pasien: nama,
            tanggal_lahir: tgl,
            id_poli: idPoli
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            closeModalPasien();
            showAlert(data.message);
            fetchLiveData(); 
        } else {
            showAlert('Gagal menambahkan pasien!');
        }
    })
    .catch(error => {
        console.error('Error Input Pasien:', error);
        showAlert('Terjadi kesalahan pada server saat mengirim form.');
    });
}