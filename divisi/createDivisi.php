<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id_divisi']) && !empty($_POST['id_divisi']) && $_POST['id_divisi'] != 'auto' ? $_POST['id_divisi'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama_divisi']) ? $_POST['nama_divisi'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO divisi VALUES (?, ?)');
    $stmt->execute([$id, $nama]);
    // Output message
    $msg = 'Divisi Berhasil Ditambahkan!';
}
?>

<?= template_header_divisi('Create') ?>

<style>
    .create-contact2 {
        display: inline-block;
        text-decoration: none;
        background-color: red;
        font-weight: bold;
        font-size: 14px;
        color: #FFFFFF;
        padding: 8px 73px;
    }

    .create-contact2:hover {
        background-color: #a80505;
        ;
    }
</style>

<div class="content update">
    <h2>Create Contact</h2>
    <form action="createDivisi.php" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id_divisi" value="auto" id="id">
        <input type="text" name="nama_divisi" id="nama">
        <input type="submit" value="Tambah">
    </form>
    <a href="readDivisi.php" class="create-contact2">Kembali</a>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>