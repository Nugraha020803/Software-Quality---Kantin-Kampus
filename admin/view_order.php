<?php
session_start();
include('../includes/db_connect.php');
include('header.php');

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID pesanan dari URL
$order_id = $_GET['id'];

// Mengambil detail pesanan berdasarkan ID
$pdo = connectDB();
$stmt = $pdo->prepare("SELECT orders.id, menu.name,  orders.nama, orders.quantity, orders.total_price, orders.status, orders.kelas, orders.nohp, orders.order_date
                       FROM orders 
                       JOIN menu ON orders.menu_id = menu.id
                       WHERE orders.id = ?");
$stmt->execute([$order_id]);

// Jika pesanan tidak ditemukan
if ($stmt->rowCount() == 0) {
    echo "Pesanan tidak ditemukan.";
    exit();
}

$order = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<section class="order-detail-section">
    <h2>Detail Pesanan</h2>

    <table class="order-detail-table">
        <tr>
            <th>ID Pesanan</th>
            <td><?php echo $order['id']; ?></td>
        </tr>
        <tr>
            <th>Nama Pembeli</th>
            <td><?php echo htmlspecialchars($order['nama']); ?></td>
        </tr>
        <tr>
            <th>Menu</th>
            <td><?php echo htmlspecialchars($order['name']); ?></td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td><?php echo $order['quantity']; ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td><?php echo number_format($order['total_price'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo htmlspecialchars($order['status']); ?></td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td><?php echo htmlspecialchars($order['kelas']); ?></td>
        </tr>
        <tr>
            <th>Nomor WhatsApp</th>
            <td><?php echo htmlspecialchars($order['nohp']); ?></td>
        </tr>
        <tr>
            <th>Tanggal Pemesanan</th>
            <td><?php echo date('d-m-Y H:i:s', strtotime($order['order_date'])); ?></td>
        </tr>
    </table>
    <br>

    <a href="manage_orders.php" class="btn btn-primary">Kembali ke Daftar Pesanan</a>
</section>

<?php include('footer.php'); ?>
