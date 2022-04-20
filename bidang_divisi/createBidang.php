<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
$id_divisi = $_GET['id_divisi'];
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id_bidang']) && !empty($_POST['id_bidang']) && $_POST['id_bidang'] != 'auto' ? $_POST['id_bidang'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';

    $objectJabatan = $_POST['jabatan'];
    // Insert new record into the contacts table
    if ($objectJabatan != '') {
        $stmt = $pdo->prepare('INSERT INTO bidang_divisi VALUES (?, ?, ?)');
        $stmt->execute([$id, $jabatan, $id_divisi]);
        // Output message
        $msg = 'Bidang Berhasil Ditambahkan!';
    } else {
        $msg = 'Isi Data Terlebih Dahulu';
    }
}
?>


<?= template_header_bidang('Create Bidanng') ?>

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
    <h2>Tambah bidang</h2>
    <form action="createBidang.php?id_divisi=<?= $id_divisi ?>" method="post">
        <label for="id">ID</label>
        <label for="jabatan">Jabatan</label>
        <input type="text" name="id_bidang" value="auto" id="id">
        <input type="text" name="jabatan" id="jabatan" required>
        <input type="submit" value="Tambah">
    </form>
    <a href="readBidang.php?id_divisi=<?= $id_divisi ?> &confirm=kembali" class="create-contact2">Kembali</a>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>