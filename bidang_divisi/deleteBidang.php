<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_bidang'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM bidang_divisi WHERE id_bidang = ?');
    $stmt->execute([$_GET['id_bidang']]);
    $bidang = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$bidang) {
        exit('divisi doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM bidang_divisi WHERE id_bidang = ?');
            $stmt->execute([$_GET['id_bidang']]);
            $msg = 'Bidang Berhasil di Hapus!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: readBidang.php?');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?= template_header_bidang('Delete') ?>

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
    <h2>Hapus Bidang <?= $bidang['jabatan'] ?></h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
        <a href="readBidang.php?id_bidang=<?= $bidang['id_bidang'] ?>" class="create-contact2">Kembali</a>
    <?php else : ?>
        <p>Yakin ingin Menghapus Bidang <?= $bidang['jabatan'] ?>?</p>
        <div class="yesno">
            <a href="deleteBidang.php?id_bidang=<?= $bidang['id_bidang'] ?>&confirm=yes">Yes</a>
            <a href="deleteBidang.php?id_bidang=<?= $bidang['id_bidang'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?= template_footer() ?>