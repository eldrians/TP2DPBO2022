<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_divisi'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM divisi WHERE id_divisi = ?');
    $stmt->execute([$_GET['id_divisi']]);
    $divisi = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$divisi) {
        exit('divisi doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM divisi WHERE id_divisi = ?');
            $stmt->execute([$_GET['id_divisi']]);
            $msg = 'Divisi Berhasil Di Hapus!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: readDivisi.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?= template_header_divisi('Delete') ?>

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

<div class="content delete">
    <h2>Hapus Divisi - <?= $divisi['nama_divisi'] ?></h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
        <a href="readDivisi.php" class="create-contact2">Kembali</a>
    <?php else : ?>
        <p>Yakin Ingin Menhapus Divisi - <?= $divisi['nama_divisi'] ?>?</p>
        <div class="yesno">
            <a href="deleteDivisi.php?id_divisi=<?= $divisi['id_divisi'] ?>&confirm=yes">Yes</a>
            <a href="deleteDivisi.php?id_divisi=<?= $divisi['id_divisi'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?= template_footer() ?>