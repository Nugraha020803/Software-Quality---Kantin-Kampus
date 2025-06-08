```markdown
# Aplikasi Kantin Kampus

Aplikasi berbasis web untuk mengelola kantin kampus. Aplikasi ini memungkinkan pengguna untuk melakukan pemesanan, melihat menu, dan bagi administrator untuk mengelola menu dan pesanan. Proyek ini dibuat sebagai bagian dari tugas mata kuliah di universitas.

## Penulis

1. **Arya Nugraha**  
   NIM: 20221310064

2. **Denita Alhamdina Putri Arisandi**  
   NIM: 20221310013

3. **Sri Purnama Royani Putri**  
   NIM: 20211310066

4. **Melvin Chairul Azfa**  
   NIM: 20211310019

## Informasi Mata Kuliah

- **Program Studi:** Teknik Informatika  
- **Dosen Pengampu:** Deni Suprihadi, S.T, M.Kom., MCE.  
- **Universitas:** Universitas Kebangsaan Republik Indonesia  
- **Tahun:** 2025  

## Struktur Proyek

Repositori ini terstruktur sebagai berikut:

```

/kantin\_kampus/
│
├── /assets/               # Berisi file CSS, JS, gambar, dll.
│   ├── /css/              # File CSS
│   ├── /js/               # File JavaScript
│   └── /images/           # File gambar (gambar menu, dll.)
│
├── /config/               # File konfigurasi untuk koneksi database dan pengaturan lainnya
│
├── /includes/             # File PHP untuk fungsi umum, header, footer, dll.
│
├── /tests/                # Folder untuk pengujian blackbox, whitebox, greybox
│   ├── blackbox\_test.php  # Pengujian blackbox
│   ├── whitebox\_test.php  # Pengujian whitebox
│   └── greybox\_test.php   # Pengujian greybox
│
├── /public/               # Halaman-halaman yang dapat diakses publik
│
├── /admin/                # Halaman untuk admin kantin

````

## Fitur

- **Pengguna:**  
  - Melihat daftar menu
  - Melakukan pemesanan
  - Melacak status pesanan

- **Admin:**  
  - Mengelola menu (menambah, mengedit, menghapus)
  - Mengelola pesanan (melihat, mengubah status)

## Instalasi

1. Clone repositori ini ke mesin lokal Anda.
   
   ```bash
   git clone https://github.com/Nugraha020803/Software-Quality---Kantin-Kampus.git
````

2. Siapkan server pengembangan lokal (misalnya menggunakan XAMPP, WAMP, atau MAMP).

3. Impor skema database (`db_kantin.sql`) ke dalam database MySQL lokal Anda.

4. Perbarui konfigurasi database di direktori `/config/` jika diperlukan.

5. Jalankan proyek dengan membuka `http://localhost/kantin_kampus/` di browser Anda.

## Pengujian

Proyek ini mencakup tiga jenis pengujian untuk metodologi pengujian yang berbeda:

* **Blackbox Testing:** Menguji aplikasi dari perspektif pengguna, memeriksa fungsionalitas umum fitur-fitur aplikasi.
* **Whitebox Testing:** Menguji logika internal aplikasi, termasuk fungsi dan metode yang digunakan untuk perhitungan dan pemrosesan logika.
* **Greybox Testing:** Menggabungkan aspek dari pengujian blackbox dan whitebox, berfokus pada fungsionalitas end-to-end serta pengetahuan internal kode.

Untuk menjalankan pengujian ini, cukup navigasikan ke direktori `/tests/` dan jalankan file pengujian yang sesuai. Hasil pengujian akan ditampilkan di browser Anda.

## Berkontribusi

Jika Anda memiliki saran untuk meningkatkan proyek ini, silakan fork repositori ini, buat perubahan, dan kirimkan pull request.

```

### Penjelasan:

- **Struktur Proyek:** Menjelaskan bagaimana struktur proyek Anda diatur, sehingga orang lain bisa dengan mudah mengerti struktur folder dan file dalam repositori.
- **Fitur:** Memberikan gambaran mengenai fitur yang tersedia untuk pengguna dan admin dalam aplikasi.
- **Instalasi:** Petunjuk langkah-demi-langkah bagaimana cara mengatur dan menjalankan aplikasi di lingkungan pengembangan lokal.
- **Pengujian:** Menyediakan informasi tentang jenis pengujian yang dilakukan dan bagaimana cara menjalankan pengujian tersebut.
- **Berkontribusi:** Menyediakan instruksi bagi orang lain yang ingin berkontribusi dalam proyek ini.

README ini memberikan gambaran umum dan instruksi lengkap bagi siapa saja yang ingin memahami atau berkontribusi pada proyek Anda.
```
