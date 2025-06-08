<?php
// Konfigurasi database
define('DB_SERVER', 'localhost');  // Nama server database (bisa 'localhost' atau IP)
define('DB_USERNAME', 'root');     // Username untuk koneksi ke MySQL
define('DB_PASSWORD', '');         // Password untuk koneksi ke MySQL
define('DB_DATABASE', 'db_kantin'); // Nama database yang digunakan

// Fungsi untuk membuat koneksi ke database
function connectDB() {
    try {
        // Membuat koneksi menggunakan PDO (PHP Data Objects)
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        
        // Mengatur mode error ke exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
    } catch (PDOException $e) {
        // Jika koneksi gagal, tampilkan pesan error
        die("Connection failed: " . $e->getMessage());
    }
}
?>
