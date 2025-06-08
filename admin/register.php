<?php
session_start();
include('../includes/db_connect.php');

// Handle registration form submission
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $created_at = date('Y-m-d H:i:s'); // Timestamp for registration

    // Check if username already exists
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        // Insert new admin data
        $stmt = $pdo->prepare("INSERT INTO admin (username, password, created_at) VALUES (?, ?, ?)");
        $stmt->execute([$username, md5($password), $created_at]);

        $success_message = "Admin baru berhasil didaftarkan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>

    <style>
        /* Body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Kontainer untuk Form Login */
        .register-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Judul Halaman */
        h2 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 600;
        }

        /* Label */
        label {
            font-size: 1rem;
            color: #333;
            margin-bottom: 8px;
            text-align: left;
            display: block;
        }

        /* Input Field */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        /* Fokus pada Input Field */
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #f39c12;
            outline: none;
        }

        /* Tombol Daftar */
        button {
            background-color: #f39c12;
            color: #fff;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Efek Hover pada Tombol */
        button:hover {
            background-color: #e67e22;
        }

        /* Pesan Error */
        p {
            color: #e74c3c;
            font-size: 1rem;
            margin-top: 15px;
        }

        /* Pesan Sukses */
        .success-message {
            color: green;
            font-size: 1rem;
            margin-top: 15px;
        }

        /* Responsif: Ukuran tampilan kecil */
        @media (max-width: 768px) {
            .register-container {
                padding: 30px;
                max-width: 350px;
            }

            h2 {
                font-size: 1.8rem;
            }

            input[type="text"],
            input[type="password"] {
                padding: 10px;
            }

            button {
                padding: 10px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Daftar Admin Kantin</h2>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>

            <button type="submit" name="register">Daftar</button>
        </form>

        <a href="login.php" class="btn-register">Login</a>

        <?php
        if (isset($error)) {
            echo "<p>$error</p>";
        }
        if (isset($success_message)) {
            echo "<p class='success-message'>$success_message</p>";
        }
        ?>
    </div>
</body>
</html>
