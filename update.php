<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $no_obat = isset($_POST['no_obat']) ? $_POST['no_obat'] : '';
        $nama_obat = isset($_POST['nama_obat']) ? $_POST['nama_obat'] : '';
        $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
        $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
        $stok = isset($_POST['stok']) ? $_POST['stok'] : '';
        $harga_beli = isset($_POST['harga_beli']) ? $_POST['harga_beli'] : '';
        $harga_jual = isset($_POST['harga_jual']) ? $_POST['harga_jual'] : '';
        $kadaluarsa = isset($_POST['kadaluarsa']) ? $_POST['kadaluarsa'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE kontak SET id = ?, no_obat = ?, nama_obat = ?, kategori = ?, deskripsi = ?, stok = ?, harga_beli ?, harga_jual = ?, kadaluarsa = ? WHERE id = ?');
        $stmt->execute([$id, $no_obat, $nama_obat, $kategori, $deskripsi, $stok, $harga_jual, $harga_beli, $kadaluarsa, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Data Obat doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="no_buku">No Obat</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="nama" value="<?=$contact['no_obat']?>" id="no_obat">
        <label for="nama_buku">Nama Obat</label>
        <label for="kategori">kategori</label>
        <input type="text" name="nama_obat" value="<?=$contact['nama_obat']?>" id="nama_obat">
        <input type="text" name="kategori" value="<?=$contact['kategori']?>" id="kategori">
        <label for="deskripsi">Deskripsi</label>
        <label for="stok">stok</label>
        <input type="text" name="deskripsi" value="<?=$contact['deskripsi']?>" id="deskripsi">
        <input type="text" name="stok" value="<?=$contact['stok']?>" id="stok">
        <label for="harga_beli">Harga Beli</label>
        <input type="text" name="harga_beli" value="<?=$contact['harga_beli']?>" id="harga_beli">
        <label for="harga_jual">Harga Jual</label>
        <input type="text" name="harga_jual" value="<?=$contact['harga_jual']?>" id="harga_jual">
        <label for="kadaluarsa">Kadaluarsa</label>
        <input type="text" name="kadaluarsa" value="<?=$contact['kadaluarsa']?>" id="kadaluarsa">

        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>