<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['nim'])) {
    
        // This part is similar to the create.php, but instead we update a record and not insert
        $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $semester = isset($_POST['semester']) ? $_POST['semester'] : '';
        
        // Update the record
        
            if (isset($_GET['confirm'])) {
                if ($_GET['confirm'] == 'update') {
                    $stmt = $pdo->prepare('UPDATE pengurus SET nim = ?, nama = ?, semester = ? WHERE nim = ?');
                    $stmt->execute([$nim, $nama, $semester,  $_GET['nim']]);
                    $msg = 'Pengurus Berhasil di Update!';
                } else {
                    header('Location: readPengurus.php');
                    exit;
                }
            }
        
        // Get the contact from the contacts table
        $stmt = $pdo->prepare('SELECT * FROM pengurus WHERE nim = ?');
        $stmt->execute([$_GET['nim']]);
        $pengurus = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$pengurus) {
            exit('bidang doesn\'t exist with that ID!');
        }
      
}else {
        exit('No ID specified!');
}
?>



<?= template_header_bidang('Update Pengurus') ?>

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
    <h2>Update Pengurus - <?= $pengurus['nama'] ?></h2>
    <form action="updatePengurus.php?nim=<?= $pengurus['nim'] ?> &confirm=update" method="post">
        <label for="nim">NIM</label>
        <label for="nama">Nama</label>
        <input type="text" name="nim" value="<?= $pengurus['nim'] ?>" id="nim">
        <input type="text" name="nama" value="<?= $pengurus['nama'] ?>" id="nama">
        <label for="semester">Semester</label>
        <label for="foto">Foto</label>
        <input type="text" name="semester" value="<?= $pengurus['semester'] ?>" id="semester">
        <input type="file" name="foto" id="foto">
        <input type="submit" name="submit" value="Update">
    </form>
    <a href="readPengurus.php?id_bidang=<?= $pengurus['id_bidang'] ?> &confirm=kembali" class="create-contact2">Kembali</a>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>