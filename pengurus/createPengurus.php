<?php
include '../functions.php';
require '../function.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
$id_bidang = $_GET['id_bidang'];
if (isset($_POST['submit'])) {
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $semester = isset($_POST['semester']) ? $_POST['semester'] : '';
    $targetDir = "assets/images/";
    $fileName = basename($_FILES['foto']["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    // Insert new record into the contacts table
    $objectNama = $_POST['nama'];
    if ($objectNama != '') {
        $stmt = $pdo->prepare('INSERT INTO pengurus VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$nim, $nama, $semester, $fileName, $id_bidang]);
        // Output message
        $msg = 'Pengurus Berhasil Ditambahkan!';
    } else {
        $msg = 'Isi Data Terlebih Dahulu';
    }
}
?>


<?= template_header_bidang('Create Pengurus') ?>

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
    <h2>Form Tambah Pengurus</h2>
    <form action="createPengurus.php?id_bidang=<?= $id_bidang ?>" method="post" enctype="multipart/form-data">
        <label for="nim">NIM</label>
        <label for="nama">Nama</label>
        <input type="text" name="nim" id="nim">
        <input type="text" name="nama" id="nama">
        <label for="semester">Semester</label>
        <label for="foto">Foto</label>
        <input type="text" name="semester" id="semester">
        <input type="file" name="foto" id="foto">
        <input type="submit" name="submit" value="Tambah">
    </form>
    <a href="readPengurus.php?id_bidang=<?= $id_bidang ?> &confirm=kembali" class="create-contact2">Kembali</a>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>