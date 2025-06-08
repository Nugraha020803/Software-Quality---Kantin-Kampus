<?php
// whitebox_test.php

include_once('../includes/functions.php');  // Meng-include functions.php, yang sudah meng-include db_connect.php
include_once('../includes/db_connect.php');  // Menggunakan include_once untuk menghindari deklarasi ulang connectDB()

// Fungsi untuk menguji perhitungan harga total
function testCalculateTotalPrice() {
    // Simulasi input: menu_id = 1, quantity = 2
    $result = calculateTotalPrice(1, 2);  // Misalnya, harga per item adalah 15000
    $expected = 30000;  // Total harga yang diharapkan: 15000 * 2 = 30000
    assert($result == $expected, "Test failed: expected $expected but got $result");
    echo "Test Passed: Menu ID 1 dengan Quantity 2 berhasil dihitung menjadi Rp " . number_format($expected, 0, ',', '.') . "<br>";

    // Simulasi input: menu_id = 2, quantity = 3
    $result = calculateTotalPrice(2, 3);  // Misalnya, harga per item adalah 12000
    $expected = 36000;  // Total harga yang diharapkan: 12000 * 3 = 36000
    assert($result == $expected, "Test failed: expected $expected but got $result");
    echo "Test Passed: Menu ID 2 dengan Quantity 3 berhasil dihitung menjadi Rp " . number_format($expected, 0, ',', '.') . "<br>";

    // Simulasi input: menu_id = 3, quantity = 1
    $result = calculateTotalPrice(3, 1);  // Misalnya, harga per item adalah 20000
    $expected = 20000;  // Total harga yang diharapkan: 20000 * 1 = 20000
    assert($result == $expected, "Test failed: expected $expected but got $result");
    echo "Test Passed: Menu ID 3 dengan Quantity 1 berhasil dihitung menjadi Rp " . number_format($expected, 0, ',', '.') . "<br>";

    // Simulasi input dengan menu ID yang tidak valid
    $result = calculateTotalPrice(999, 2);  // Menu ID tidak ada
    $expected = 0;  // Jika menu ID tidak ditemukan, harga harus 0
    assert($result == $expected, "Test failed: expected $expected but got $result");
    echo "Test Passed: Menu ID 999 tidak ditemukan, total harga dihitung menjadi Rp " . number_format($expected, 0, ',', '.') . "<br>";

    echo "<h3>All tests passed successfully!</h3>";
    echo "Semua pengujian berhasil, perhitungan harga total berfungsi dengan baik sesuai dengan input yang diberikan.";
}

// Jalankan pengujian perhitungan harga total
testCalculateTotalPrice();
?>
