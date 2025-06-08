<?php
session_start();
include('../includes/db_connect.php');

// Memeriksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Memproses pesanan
if (isset($_POST['name'], $_POST['kelas'], $_POST['nohp'], $_POST['menu_id'], $_POST['quantity'])) {
    $name = $_POST['name'];
    $kelas = $_POST['kelas'];
    $nohp = $_POST['nohp'];
    $menu_id = $_POST['menu_id'];
    $quantity = $_POST['quantity'];

    // Mengambil harga menu dari database
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT price FROM menu WHERE id = ?");
    $stmt->execute([$menu_id]);
    $menu = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($menu) {
        $total_price = $menu['price'] * $quantity;

        // Menyimpan data pesanan ke dalam database tanpa user_id
        $stmt = $pdo->prepare("INSERT INTO orders (menu_id, nama, kelas, nohp, quantity, total_price, status) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $status = 'pending';  // Status pesanan baru adalah pending
        $stmt->execute([$menu_id, $name, $kelas, $nohp, $quantity, $total_price, $status]);

        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Menu tidak ditemukan!";
    }
}
?>
