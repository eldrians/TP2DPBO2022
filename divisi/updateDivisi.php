<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id_divisi'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id_divisi']) ? $_POST['id_divisi'] : NULL;
        $nama = isset($_POST['nama_divisi']) ? $_POST['nama_divisi'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE divisi SET id_divisi = ?, nama_divisi = ? WHERE id_divisi = ?');
        $stmt->execute([$id, $nama, $_GET['id_divisi']]);
        $msg = 'Divisi Berhasil di Update!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM divisi WHERE id_divisi = ?');
    $stmt->execute([$_GET['id_divisi']]);
    $divisi = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$divisi) {
        exit('divisi doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?= template_header_divisi('updateDivisi') ?>

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
    <h2>Update Divisi - <?= $divisi['nama_divisi'] ?></h2>
    <form action="updateDivisi.php?id_divisi=<?= $divisi['id_divisi'] ?>" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id_divisi" value="<?= $divisi['id_divisi'] ?>" id="id">
        <input type="text" name="nama_divisi" value="<?= $divisi['nama_divisi'] ?>" id="nama">
        <input type="submit" value="Update">
    </form>
    <a href="readDivisi.php" class="create-contact2">Kembali</a>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>