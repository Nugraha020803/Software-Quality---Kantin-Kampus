<?php
// blackbox_test.php

include('../config/config.php');

// Fungsi untuk menguji login dengan input yang salah
function testLoginWithInvalidData() {
    $loginData = [
        ['username' => '', 'password' => '', 'expected' => 'Username dan password tidak boleh kosong'],
        ['username' => 'admin', 'password' => '', 'expected' => 'Password tidak boleh kosong'],
        ['username' => 'wrong_user', 'password' => 'wrong_pass', 'expected' => 'Username atau password salah'],
        // Menambahkan data dengan username yang valid dan password salah untuk memastikan testing lebih baik
        ['username' => 'admin', 'password' => 'wrongpassword', 'expected' => 'Username atau password salah']
    ];

    foreach ($loginData as $data) {
        $response = login($data['username'], $data['password']);
        echo "Testing with username: <strong>{$data['username']}</strong> and password: <strong>{$data['password']}</strong><br>";

        if ($response == $data['expected']) {
            echo "<span style='color: green;'>Test Passed: {$data['expected']} is the correct response.</span><br>";
        } else {
            echo "<span style='color: red;'>Test Failed: Expected <strong>{$data['expected']}</strong> but got <strong>$response</strong></span><br>";
        }
        echo "<hr>";  // Adds a horizontal line between each test for better separation
    }
}

// Fungsi login simulasi untuk pengujian
function login($username, $password) {
    // Cek apakah username atau password kosong
    if ($username == '' && $password == '') {
        return 'Username dan password tidak boleh kosong';
    } elseif ($password == '') {
        return 'Password tidak boleh kosong';  // Menangani kasus password kosong
    } elseif ($username == '') {
        return 'Username tidak boleh kosong';  // Menangani kasus username kosong
    }

    $pdo = connectDB();
    // Mengecek apakah password sudah dienkripsi (md5)
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->execute([$username, md5($password)]);  // MD5 password untuk pencocokan

    // Jika tidak ditemukan
    if ($stmt->rowCount() == 0) {
        return 'Username atau password salah';
    }

    // Jika ditemukan
    return 'Login berhasil';
}

// Jalankan pengujian login
testLoginWithInvalidData();
?>
