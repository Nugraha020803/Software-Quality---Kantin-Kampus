<?php
include('../includes/db_connect.php');  // Menyertakan file db_connect.php
include('../includes/header.php');
?>

<main>
    <section class="menu-section">
        <h1>Menu Kantin</h1>
        <div class="menu-grid">
            <?php
            // Ambil data menu dari database
            $pdo = connectDB(); // Fungsi ini akan bekerja setelah db_connect.php di-include
            $stmt = $pdo->query("SELECT * FROM menu");
            while ($row = $stmt->fetch()) {
                // Menggunakan path lengkap untuk gambar
                $image_url = '../assets/image/' . htmlspecialchars($row['image_url']);  // Menambahkan prefix 'assets/image/'

                // Menampilkan setiap item menu
                echo "<div class='menu-item'>";
                echo "<img src='" . $image_url . "' alt='" . htmlspecialchars($row['name']) . "' class='menu-item-image'>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<p>Harga: Rp " . number_format($row['price'], 0, ',', '.') . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </section>
</main>

<?php
include('../includes/footer.php');
?>
