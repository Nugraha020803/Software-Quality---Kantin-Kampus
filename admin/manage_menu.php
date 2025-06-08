<?php
session_start();
include('../includes/db_connect.php');
include('header.php');

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Menambahkan menu baru
if (isset($_POST['add_menu'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Proses upload gambar
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $imageName = time() . '_' . basename($image['name']);
        $targetDir = "../assets/image/"; // Direktori untuk menyimpan gambar
        $targetFile = $targetDir . $imageName;

        // Memastikan ekstensi file gambar yang diterima
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                // Menyimpan data menu ke database termasuk path gambar
                $pdo = connectDB();
                $stmt = $pdo->prepare("INSERT INTO menu (name, description, price, image_url) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $description, $price, $imageName]);

                $success_message = "Menu baru berhasil ditambahkan!";
            } else {
                $error_message = "Gagal meng-upload gambar.";
            }
        } else {
            $error_message = "Hanya gambar dengan format JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        }
    }
}

// Mengambil semua menu dari database
$pdo = connectDB();
$stmt = $pdo->query("SELECT * FROM menu");

?>

<section>
    <h2>Kelola Menu Kantin</h2>
    <br>
    <!-- Tombol untuk membuka modal-menu -->
    <button id="addMenuBtn" class="btn btn-primary">Tambah Menu</button>

    <!-- Modal Tambah Menu -->
    <div id="addMenuModal" class="modal-menu">
        <div class="modal-menu-content">
            <span class="modal-menu-close">&times;</span>
            <h3>Tambah Menu Baru</h3>
            <form action="manage_menu.php" method="POST" enctype="multipart/form-data">
                <label for="name">Nama Menu:</label>
                <input type="text" name="name" required><br><br>

                <label for="description">Deskripsi:</label>
                <textarea name="description" required></textarea><br><br>

                <label for="price">Harga:</label>
                <input type="number" name="price" required><br><br>

                <label for="image">Gambar Menu:</label>
                <input type="file" name="image" accept="image/*" required><br><br>

                <button type="submit" name="add_menu" class="btn-primary">Tambah Menu</button>
            </form>

            <?php if (isset($success_message)) echo "<p>$success_message</p>"; ?>
            <?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
        </div>
    </div>

    <!-- Daftar Menu -->
    <table>
        <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                    <td>
                        <?php if ($row['image_url']) { ?>
                        <a href="../assets/image/<?php echo $row['image_url']; ?>" target="_blank">
                            <img src="../assets/image/<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" width="50">
                        </a>
                    <?php } ?>
                    </td>

                    <td>
    <a href="edit_menu.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>  
    <a href="delete_menu.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Hapus</a>
</td>

                  

                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>


<!-- Modal Tambah Menu -->
<div id="addMenuModal" class="modal-menu">
    <div class="modal-menu-content">
        <span class="modal-menu-close">&times;</span>
        <h3>Tambah Menu Baru</h3>

        <!-- Form untuk menambah menu dengan file gambar -->
        <form action="manage_menu.php" method="POST" enctype="multipart/form-data">
            <label for="name">Nama Menu:</label>
            <input type="text" name="name" required><br><br>

            <label for="description">Deskripsi:</label>
            <textarea name="description" required></textarea><br><br>

            <label for="price">Harga:</label>
            <input type="number" name="price" required><br><br>

            <label for="image">Gambar Menu:</label>
            <input type="file" name="image" accept="image/*" required><br><br>

            <button type="submit" name="add_menu" class="btn-primary">Tambah Menu</button>
        </form>

        <?php if (isset($success_message)) echo "<p>$success_message</p>"; ?>
    </div>
</div>


<?php include('footer.php'); ?>

