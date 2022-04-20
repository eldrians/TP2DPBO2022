<?php
include 'functions.php';
require 'function.php';
$nim = $_GET['nim'];
$sql_pengurus = "select * from pengurus where nim = '$nim'";
$q = mysqli_query($conn, $sql_pengurus);
?>

<?= template_header_review('Home') ?>

<style>
    .content {
        display: flex;
        padding: 100px;
        justify-content: center;
        text-align: center;
    }

    .content .box .gambar {
        text-align: center;
        margin-top: 40px;
    }

    .content .box h4 {
        font-size: 35px;
        margin: 0;
    }

    .content .box h6 {
        font-size: 30px;
        margin: 0;
    }

    .content .box p {
        margin-top: 5px;
    }

    .box {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin: 10px;
    }
</style>

<div class="content">
    <?php
    $data =  mysqli_fetch_array($q);
    $nim = $data['nim'];
    $id_bidang = $data['id_bidang'];
    $foto = $data['foto'];
    ?>
    <div class="box">
        <div class="gambar"><?php echo "<img src='assets/images/" . $foto . "'height='300' width='300'>" ?></div>
        <h4><?= $data['nama'] ?></h4>
        <h6><?= $data['nim'] ?></h6>
        <p>
            <?php
            $sql_bidang = "select * from bidang_divisi where id_bidang = '$id_bidang'";
            $q_bidang = mysqli_query($conn, $sql_bidang);
            $data_bidang =  mysqli_fetch_assoc($q_bidang);
            echo $data_bidang['jabatan'] . "<br>";
            $id_divisi = $data_bidang['id_divisi'];
            $sql_divisi = "select * from divisi where id_divisi = '$id_divisi'";
            $q_divisi = mysqli_query($conn, $sql_divisi);
            $data_divisi = mysqli_fetch_assoc($q_divisi);
            echo $data_divisi['nama_divisi'];
            ?>
        </p>
    </div>
</div>

<?= template_footer() ?>