<?php
include('../includes/db_connect.php');  // Menyertakan file db_connect.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $menu_id = $_POST['menu_id'];
    $nama = $_POST['name'];
    $kelas = $_POST['kelas'];
    $nohp = $_POST['nohp'];
    $quantity = $_POST['quantity'];

    // Mengambil harga menu dari database
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT price FROM menu WHERE id = ?");
    $stmt->execute([$menu_id]);
    $menu = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($menu) {
        $total_price = $menu['price'] * $quantity;  // Menghitung total harga

        // Menyimpan data pesanan ke dalam database
        $stmt = $pdo->prepare("INSERT INTO orders (menu_id, nama, kelas, nohp, quantity, total_price, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $status = 'pending';  // Status pesanan baru adalah pending
        $stmt->execute([$menu_id, $nama, $kelas, $nohp, $quantity, $total_price, $status]);

        // Redirect dan tampilkan pesan sukses menggunakan JavaScript
        echo "<script>alert('Pesanan Anda berhasil dibuat!'); window.location.href = '../public/menu.php';</script>";
    } else {
        echo "<script>alert('Menu yang dipilih tidak valid.'); window.location.href = '../public/menu.php';</script>";
    }
} else {
    echo "<script>alert('Metode request tidak valid.'); window.location.href = '../public/menu.php';</script>";
}
?>
