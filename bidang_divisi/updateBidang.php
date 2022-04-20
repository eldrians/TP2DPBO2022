<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id_bidang'])) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id_bidang']) ? $_POST['id_bidang'] : NULL;
        $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';

        // Update the record
        
        if (isset($_GET['confirm'])) {
            if ($_GET['confirm'] == 'update') {
                $stmt = $pdo->prepare('UPDATE bidang_divisi SET id_bidang = ?, jabatan = ? WHERE id_bidang = ?');
                $stmt->execute([$id, $jabatan, $_GET['id_bidang']]);
                $msg = 'Bidang Berhasil di Update!';
            } else {
                header('Location: readBidang.php');
                exit;
            }
        }
        // Get the contact from the contacts table
        $stmt = $pdo->prepare('SELECT * FROM bidang_divisi WHERE id_bidang = ?');
        $stmt->execute([$_GET['id_bidang']]);
        $bidang = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$bidang) {
            exit('bidang doesn\'t exist with that ID!');
        }
} else {
    exit('No ID specified!');
}
?>



<?= template_header_bidang('Update Bidang') ?>

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
    <h2>Update Bidang <?= $bidang['jabatan'] ?></h2>
    <form action="updateBidang.php?id_bidang=<?= $bidang['id_bidang'] ?> &confirm=update" method="post">
        <label for="id">ID</label>
        <label for="jabatan">Jabatan</label>
        <input type="text" name="id_bidang" value="<?= $bidang['id_bidang'] ?>" id="id">
        <input type="text" name="jabatan" value="<?= $bidang['jabatan'] ?>" id="jabatan">
        <input type="submit" value="Update" >
    </form>
    <a href="readBidang.php?id_divisi=<?= $bidang['id_divisi'] ?> &confirm=kembali" class="create-contact2">Kembali</a>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>