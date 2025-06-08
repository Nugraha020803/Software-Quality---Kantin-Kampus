<?php
session_start();
include('../includes/db_connect.php');
include('header.php');

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan data menu yang akan diedit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM menu WHERE id = ?");
    $stmt->execute([$id]);
    $menu = $stmt->fetch();

    if (!$menu) {
        echo "Menu tidak ditemukan!";
        exit();
    }
}

// Update harga menu
if (isset($_POST['update_price'])) {
    $new_price = $_POST['price'];

    // Update harga di database
    $stmt = $pdo->prepare("UPDATE menu SET price = ? WHERE id = ?");
    $stmt->execute([$new_price, $id]);

    // Pesan sukses
    $success_message = "Harga menu berhasil diperbarui!";

    // Redirect kembali ke halaman manage_menu.php setelah update
    header("Location: manage_menu.php");
    exit();
}

?>

<section>
    <h2>Edit Harga Menu</h2>
    
    <!-- Form untuk mengedit harga -->
    <form action="edit_menu.php?id=<?php echo $id; ?>" method="POST">
        <label for="name">Nama Menu:</label>
        <input type="text" value="<?php echo htmlspecialchars($menu['name']); ?>" disabled><br><br>

        <label for="description">Deskripsi:</label>
        <textarea disabled><?php echo htmlspecialchars($menu['description']); ?></textarea><br><br>

        <label for="price">Harga Baru:</label>
        <input type="number" name="price" value="<?php echo $menu['price']; ?>" required><br><br>
        <label for="image_url">Foto:</label>
        <br>
            <?php if ($menu['image_url']) { ?>
            <a href="../assets/image/<?php echo $menu['image_url']; ?>" target="_blank">
                <img src="../assets/image/<?php echo $menu['image_url']; ?>" alt="<?php echo $menu['name']; ?>" width="200">
            </a>
        <?php } ?>

        <button type="submit" name="update_price" class="btn-primary">Perbarui Harga</button>
    </form>

    <?php if (isset($success_message)) echo "<p>$success_message</p>"; ?>
</section>

<?php include('footer.php'); ?>
