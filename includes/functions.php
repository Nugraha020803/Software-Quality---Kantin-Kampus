<?php
include_once('db_connect.php');  // Menggunakan include_once untuk mencegah penginclude-an ganda

// Fungsi untuk menghitung total harga pesanan
// functions.php
// functions.php

function calculateTotalPrice($menu_id, $quantity) {
    $pdo = connectDB(); // Menghubungkan ke database
    $stmt = $pdo->prepare("SELECT price FROM menu WHERE id = ?");
    $stmt->execute([$menu_id]);
    $menu = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Periksa apakah menu ditemukan
    if ($menu) {
        return $menu['price'] * $quantity; // Menghitung total harga
    }
    
    // Jika menu tidak ditemukan, kembalikan harga 0
    return 0;
}



// Fungsi untuk validasi input email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Fungsi untuk menambahkan log aktivitas
function logActivity($action) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("INSERT INTO logs (action) VALUES (?)");
    $stmt->execute([$action]);
}
?>

