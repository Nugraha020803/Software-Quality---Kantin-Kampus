<?php
session_start();
include('../includes/db_connect.php');
include('header.php');

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Mengambil semua pesanan dari database
$pdo = connectDB();
$stmt = $pdo->query("SELECT orders.id, menu.name, orders.nama, orders.kelas, orders.nohp, orders.quantity, orders.total_price, orders.status 
                     FROM orders 
                     JOIN menu ON orders.menu_id = menu.id");
?>

<section>
    <h2>Kelola Pesanan</h2>
    <br>
    <!-- Tombol untuk menambah order -->
    <button id="addOrderBtn" class="btn btn-primary">Tambah Pesanan</button>

    <!-- Modal Tambah Pesanan -->
    <div id="modal-orders" class="modal-orders">
        <div class="modal-orders-content">
            <span class="modal-orders-close">&times;</span>
            <h3>Tambah Pesanan</h3>
            <form action="process_order.php" method="POST">
                <!-- Input Nama Pengguna -->
                <label for="name">Nama Pengguna:</label>
                <input type="text" name="name" id="name" required placeholder="Masukkan nama pengguna"><br><br>

                <!-- Input Kelas -->
                <label for="kelas">Kelas:</label>
                <input type="text" name="kelas" id="kelas" required placeholder="Masukkan kelas Anda"><br><br>

                <!-- Input WhatsApp -->
                <label for="whatsapp">WhatsApp:</label>
                <input type="number" name="nohp" id="whatsapp" required placeholder="Nomor WhatsApp (misal: +62 8123456789)"><br><br>

                <!-- Pilihan Menu -->
                <label for="menu_id">Pilih Menu:</label>
                <select name="menu_id" id="menu_id" required>
                    <?php
                    // Menampilkan daftar menu
                    $menuStmt = $pdo->query("SELECT id, name FROM menu");
                    while ($menu = $menuStmt->fetch()) {
                        echo "<option value='" . $menu['id'] . "'>" . htmlspecialchars($menu['name']) . "</option>";
                    }
                    ?>
                </select><br><br>

                <!-- Input Jumlah -->
                <label for="quantity">Jumlah:</label>
                <input type="number" name="quantity" id="quantity" min="1" required><br><br>

                <button type="submit" class="btn-primary">Tambah Pesanan</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Pesanan -->
    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Pembeli</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo number_format($row['total_price'], 0, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <a href="update_order_status.php?id=<?php echo $row['id']; ?>&status=completed" class="btn btn-success">Selesai</a>
                        <a href="update_order_status.php?id=<?php echo $row['id']; ?>&status=cancelled" class="btn btn-danger">Batal</a>
                        <a href="view_order.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Lihat Detail</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include('footer.php'); ?>


