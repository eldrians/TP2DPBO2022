<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['nim'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM pengurus WHERE nim = ?');
    $stmt->execute([$_GET['nim']]);
    $pengurus = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$pengurus) {
        exit('pengurus doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM pengurus WHERE nim = ?');
            $stmt->execute([$_GET['nim']]);
            $msg = 'Pengurus Berhasil di Hapus!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: readPengurus.php?');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?= template_header_bidang('Delete Pengurus') ?>

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
    <h2>Delete pengurus - <?= $pengurus['nama'] ?></h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
        <a href="readPengurus.php?id_bidang=<?= $pengurus['id_bidang'] ?>" class="create-contact2">Kembali</a>
    <?php else : ?>
        <p>Yakin Ingin Menghapus Pengurus - <?= $pengurus['nama'] ?>?</p>
        <div class="yesno">
            <a href="deletePengurus.php?nim=<?= $pengurus['nim'] ?>&confirm=yes">Yes</a>
            <a href="deletePengurus.php?nim=<?= $pengurus['nim'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?= template_footer() ?>