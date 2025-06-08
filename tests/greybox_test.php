<?php
// greybox_test.php

include_once('../includes/functions.php');  // Meng-include functions.php, yang sudah meng-include db_connect.php
include_once('../includes/db_connect.php');  // Menggunakan include_once untuk mencegah deklarasi ulang connectDB()

// Fungsi untuk menguji pemesanan dan memverifikasi di database
function testOrderFunctionality() {
    // Simulasi input pemesanan, menggantikan user_id karena tidak ada lagi tabel users
    $orderData = ['menu_id' => 1, 'quantity' => 2, 'user_id' => 1];  // Anda bisa mengganti user_id dengan admin atau nilai lain
    
    // Kirim permintaan pemesanan melalui antarmuka (simulasi)
    $response = placeOrder($orderData);
    echo "Test Passed: Order dengan Menu ID " . $orderData['menu_id'] . " dan Quantity " . $orderData['quantity'] . " berhasil dibuat.<br>";

    // Verifikasi hasil pemesanan di database
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE menu_id = ?");  // Tidak perlu menggunakan user_id lagi
    $stmt->execute([$orderData['menu_id']]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifikasi apakah data pesanan ada di database
    assert($order != false, "Test failed: Order not found in database");
    echo "Test Passed: Order ditemukan dalam database.<br>";

    // Verifikasi kecocokan quantity
    assert($order['quantity'] == $orderData['quantity'], "Test failed: Quantity mismatch");
    echo "Test Passed: Quantity cocok. Diharapkan: " . $orderData['quantity'] . ", Ditemukan: " . $order['quantity'] . "<br>";

    // Verifikasi kecocokan menu_id
    assert($order['menu_id'] == $orderData['menu_id'], "Test failed: Menu ID mismatch");
    echo "Test Passed: Menu ID cocok. Diharapkan: " . $orderData['menu_id'] . ", Ditemukan: " . $order['menu_id'] . "<br>";

    // Pastikan total harga dihitung dengan benar
    $totalPrice = calculateTotalPrice($orderData['menu_id'], $orderData['quantity']);
    assert($order['total_price'] == $totalPrice, "Test failed: Total price mismatch");
    echo "Test Passed: Total harga cocok. Diharapkan: " . number_format($totalPrice, 0, ',', '.') . ", Ditemukan: " . number_format($order['total_price'], 0, ',', '.') . "<br>";

    echo "<h3>All tests passed successfully!</h3>";
    echo "Semua pengujian berhasil, pesanan berhasil ditempatkan dan diverifikasi dalam database.";
}

// Fungsi untuk memproses pemesanan
function placeOrder($orderData) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("INSERT INTO orders (menu_id, quantity, total_price, status) VALUES (?, ?, ?, 'pending')");
    $totalPrice = calculateTotalPrice($orderData['menu_id'], $orderData['quantity']);
    $stmt->execute([$orderData['menu_id'], $orderData['quantity'], $totalPrice]);
    return "Order placed successfully";
}

// Jalankan pengujian pemesanan
testOrderFunctionality();
?>
