# BALIMUD - Sistem Antrean Klinik Berbasis Web

## Deskripsi

BALIMUD adalah sistem antrean klinik berbasis web yang dibangun menggunakan Laravel. Sistem ini memungkinkan pasien untuk melakukan registrasi akun, login, mengambil nomor antrean sesuai poli tujuan, serta memantau status antrean secara online.

## Fitur

### Pasien

* Registrasi akun
* Login akun
* Melihat daftar poli
* Mengambil nomor antrean
* Mengisi data pasien sebelum mengambil antrean
* Melihat nomor antrean yang sedang berjalan

### Petugas

* Login petugas
* Melihat daftar antrean pasien
* Mengelola antrean
* Memanggil antrean berikutnya
* Memperbarui status antrean

---

## Teknologi yang Digunakan

* Laravel
* PHP
* MySQL
* HTML
* CSS
* JavaScript
* Laragon
* HeidiSQL

---

## Struktur Database

### Tabel akun_pengguna

| Kolom    | Tipe         |
| -------- | ------------ |
| id_akun  | INT (PK)     |
| username | VARCHAR(50)  |
| password | VARCHAR(255) |
| role     | VARCHAR(20)  |
| telepon  | VARCHAR(20)  |

### Tabel pasien

| Kolom         | Tipe        |
| ------------- | ----------- |
| id_pasien     | INT (PK)    |
| nama_pasien   | VARCHAR(50) |
| tanggal_lahir | DATE        |
| keluhan       | TEXT        |
| id_akun       | INT (FK)    |

### Tabel poli

| Kolom     | Tipe        |
| --------- | ----------- |
| id_poli   | INT (PK)    |
| nama_poli | VARCHAR(50) |
| kode_poli | CHAR(1)     |

### Tabel antrean

| Kolom             | Tipe     |
| ----------------- | -------- |
| id_antrean        | INT (PK) |
| tanggal_periksa   | DATE     |
| nomor_urut        | INT      |
| kode_poli         | CHAR(1)  |
| jadwal_kedatangan | DATE     |
| status            | ENUM     |
| id_pasien         | INT (FK) |
| id_akun           | INT (FK) |
| id_poli           | INT (FK) |

---

## Daftar Poli

| Kode | Nama Poli |
| ---- | --------- |
| A    | Poli Umum |
| B    | Poli Gigi |
| C    | Poli KIA  |
| D    | Poli THT  |

---

## Instalasi

### Clone Repository

```bash
git clone https://github.com/username/Sistem-Antrean.git
cd balimed
```

### Install Dependency

```bash
composer install
```

### Konfigurasi Environment

Salin file .env:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

### Konfigurasi Database

Atur koneksi database pada file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=balimed
DB_USERNAME=root
DB_PASSWORD=
```

### Jalankan Migrasi

```bash
php artisan migrate
```

atau import file SQL yang telah disediakan.

### Menjalankan Project

```bash
php artisan serve
```

Akses aplikasi:

```text
http://127.0.0.1:8000
```

---

## Alur Sistem

1. Pengguna melakukan registrasi akun.
2. Pengguna login ke sistem.
3. Pengguna memilih poli tujuan.
4. Pengguna mengisi data pasien.
5. Sistem membuat nomor antrean otomatis berdasarkan poli yang dipilih.
6. Data pasien dan antrean disimpan ke database.
7. Petugas memanggil antrean sesuai urutan.
8. Status antrean diperbarui secara realtime.

---

## Tim Pengembang

### Kelompok Sistem Antrean Klinik BALIMED (nanti diedit)

* Ketua Tim 
* Backend Developer
* Frontend Developer
* Database Designer
* UI/UX Designer


---

## Lisensi

Project ini dibuat untuk keperluan akademik dan pembelajaran.
