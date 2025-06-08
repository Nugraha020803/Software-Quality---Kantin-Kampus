    </div> <!-- End of content -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Kantin Kampus | Semua Hak Dilindungi</p>
    </footer>
        <script>
// Menampilkan modal saat tombol "Tambah Pesanan" diklik
document.getElementById('addOrderBtn').onclick = function() {
    document.getElementById('modal-orders').style.display = 'block';
}

// Menutup modal saat tombol close diklik
document.getElementsByClassName('modal-orders-close')[0].onclick = function() {
    document.getElementById('modal-orders').style.display = 'none';
}

// Menutup modal saat mengklik di luar modal
window.onclick = function(event) {
    if (event.target == document.getElementById('modal-orders')) {
        document.getElementById('modal-orders').style.display = 'none';
    }
}
</script>
    <script>
        // Mendapatkan elemen modal dan tombol
var modal = document.getElementById("addMenuModal");
var btn = document.getElementById("addMenuBtn");
var span = document.getElementsByClassName("modal-menu-close")[0];

// Ketika tombol ditekan, buka modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Ketika tombol close ditekan, tutup modal
span.onclick = function() {
    modal.style.display = "none";
}

// Ketika klik di luar modal, tutup modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

    </script>
    <script>
// Fungsi untuk membuka modal edit dengan data yang sudah ada
function openEditModal(id, name, description, price, image_url) {
    // Isi form dengan data menu
    document.getElementById('editMenuId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editPrice').value = price;
    document.getElementById('editMenuCurrentImage').value = image_url;

    // Tampilkan modal
    var modal = document.getElementById('modal-editMenu');
    modal.style.display = 'block';
}

// Menutup modal saat klik tombol close
var modalClose = document.getElementsByClassName('modal-editMenu-close')[0];
modalClose.onclick = function() {
    var modal = document.getElementById('modal-editMenu');
    modal.style.display = 'none';
}

// Menutup modal saat klik di luar modal
window.onclick = function(event) {
    var modal = document.getElementById('modal-editMenu');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
</body>
</html>
