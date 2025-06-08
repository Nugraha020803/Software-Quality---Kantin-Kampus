<?php
include('../includes/db_connect.php');  // Menyertakan file db_connect.php
include('../includes/header.php');
?>

<main>
    <section class="order-form-section">
        <h1>Formulir Pemesanan</h1>
        <form action="../config/process_order.php" method="POST">
            <!-- Input Nama -->
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" required placeholder="Masukkan nama lengkap">

            <!-- Input Kelas -->
            <label for="kelas">Kelas:</label>
            <input type="text" name="kelas" id="kelas" required placeholder="Masukkan kelas Anda">

            <!-- Input WhatsApp -->
            <label for="whatsapp">WhatsApp:</label>
            <input type="number" name="nohp" id="whatsapp" required placeholder="Nomor WhatsApp (misal: +62 8123456789)">

            <!-- Pilihan Menu -->
            <label for="menu_id">Pilih Menu:</label>
            <select name="menu_id" id="menu_id" required>
                <option value="" disabled selected>Pilih menu</option>
                <?php
                $pdo = connectDB();
                $stmt = $pdo->query("SELECT * FROM menu");
                while ($row = $stmt->fetch()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                }
                ?>
            </select>

            <!-- Input Jumlah -->
            <label for="quantity">Jumlah:</label>
            <input type="number" name="quantity" id="quantity" min="1" required placeholder="Jumlah pesanan">

            <!-- Tombol Submit -->
            <button type="submit">Pesan</button>
        </form>
    </section>
</main>

<?php
include('../includes/footer.php');
?>
