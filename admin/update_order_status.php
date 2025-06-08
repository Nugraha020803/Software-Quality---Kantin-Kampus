<?php
session_start();
include('../includes/db_connect.php');

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari URL
$order_id = $_GET['id'];
$new_status = $_GET['status'];

// Validasi status yang diterima (hanya bisa 'completed' atau 'cancelled')
if ($new_status != 'completed' && $new_status != 'cancelled') {
    echo "Status tidak valid.";
    exit();
}

// Update status pesanan di database
$pdo = connectDB();
$stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
$stmt->execute([$new_status, $order_id]);

// Redirect kembali ke halaman daftar pesanan
header("Location: manage_orders.php");
exit();
?>
