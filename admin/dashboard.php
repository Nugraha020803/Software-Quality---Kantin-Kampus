<?php
session_start();
include('../includes/db_connect.php');
include('header.php');

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil jumlah Menu
$pdo = connectDB();
$stmt = $pdo->query("SELECT COUNT(*) AS total_menus FROM menu");
$menu_count = $stmt->fetch(PDO::FETCH_ASSOC)['total_menus'];

// Ambil jumlah Order
$stmt = $pdo->query("SELECT COUNT(*) AS total_orders FROM orders");
$order_count = $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'];
?>

<section>
    <h2>Selamat Datang, <?php echo $_SESSION['admin']; ?>!</h2>
    <p>Ini adalah dashboard admin kantin.</p>

    <div class="row">
        <!-- Card for Menu -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Menus</h5>
                    <p class="card-text"><?php echo $menu_count; ?> Menus</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text"><?php echo $order_count; ?> Orders</p>
                </div>
            </div>
        </div>


    </div>
</section>

<?php include('footer.php'); ?>
