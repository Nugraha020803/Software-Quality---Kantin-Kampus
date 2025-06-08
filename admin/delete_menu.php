<?php
session_start();
include('../includes/db_connect.php');

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Menghapus menu berdasarkan ID
if (isset($_GET['id'])) {
    $menu_id = $_GET['id'];

    // Hapus menu dari database
    $pdo = connectDB();
    $stmt = $pdo->prepare("DELETE FROM menu WHERE id = ?");
    $stmt->execute([$menu_id]);

    $success_message = "Menu berhasil dihapus!";
}

// Mengarahkan kembali ke halaman kelola menu
header("Location: manage_menu.php");
exit();
?>
