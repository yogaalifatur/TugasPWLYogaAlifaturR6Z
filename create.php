<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $no_obat = isset($_POST['no_obat']) ? $_POST['no_obat'] : '';
    $nama_obat = isset($_POST['nama_obat']) ? $_POST['nama_obat'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    $stok = isset($_POST['stok']) ? $_POST['stok'] : '';
    $harga_beli = isset($_POST['harga_beli']) ? $_POST['harga_beli'] : '';
    $harga_jual = isset($_POST['harga_jual']) ? $_POST['harga_jual'] : '';
    $kadaluarsa = isset($_POST['kadaluarsa']) ? $_POST['kadaluarsa'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO kontak VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $no_obat, $nama_obat, $kategori, $deskripsi, $stok, $harga_beli, $harga_jual, $kadaluarsa]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Data Obat</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="nama">No Obat</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="no_obat" id="no_obat">
        <label for="email">Nama Obat</label>
        <label for="notelp">Kategori</label>
        <input type="text" name="nama_obat" id="nama_obat">
        <input type="text" name="kategori" id="kategori">
        <label for="pekerjaan">Deskripsi</label>
        <label for="notelp">Stok</label>
        <input type="text" name="deskripsi" id="deskripsi">
        <input type="text" name="stok" id="stok">
        <label for="notelp">Harga Beli</label>
        <input type="text" name="harga_beli" id="harga_beli">
        <label for="notelp">Harga Jual</label>
        <input type="text" name="harga_jual" id="harga_jual">
        <label for="notelp">Kadaluarsa</label>
        <input type="text" name="kadaluarsa" id="kadaluarsa">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>