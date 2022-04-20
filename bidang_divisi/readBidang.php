<?php
include '../functions.php';
require '../function.php';

// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our divisi table, LIMIT will determine the page
$id_divisi = $_GET['id_divisi'];
$stmt = $pdo->prepare('SELECT * FROM bidang_divisi WHERE id_divisi = "$id_divisi" ORDER BY id_bidang LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$bidang = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_divisi = $pdo->query('SELECT COUNT(*) FROM bidang_divisi WHERE id_divisi = "$id_divisi"')->fetchColumn();

if (!isset($_GET['id_divisi'])) {
    header("Location: ../divisi/readDivisi.php");
    exit();
}

$sql = "select * from bidang_divisi where id_divisi='$id_divisi' order by id_bidang asc";
$sql2 = "select * from divisi where id_divisi='$id_divisi'";
$q = mysqli_query($conn, $sql);
$q2 = mysqli_query($conn, $sql2);
// Get the total number of divisi, this is so we can determine whether there should be a next and previous button
?>


<?= template_header_bidang('Bidang Divisi') ?>

<style>
    .create-contact2 {
        display: inline-block;
        text-decoration: none;
        background-color: red;
        font-weight: bold;
        font-size: 14px;
        color: #FFFFFF;
        padding: 10px 15px;
        margin: 15px 0;
    }

    .create-contact2:hover {
        background-color: #a80505;
        ;
    }
</style>

<div class="content read">
    <h2>Daftar Bidang pada Divisi
        <?php
        $data =  mysqli_fetch_assoc($q2);
        echo $data['nama_divisi'];
        ?>
    </h2>
    <a href="createBidang.php?id_divisi=<?= $data['id_divisi'] ?>" class="create-contact">Tambah Bidang</a>
    <a href="../divisi/readDivisi.php" class="create-contact2">Kembali</a>
    <table>
        <thead>
            <tr>
                <td>No</td>
                <td>Jabatan</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($data =  mysqli_fetch_assoc($q)) {
                $id_bidang = $data['id_bidang'];
                $id_divisi = $data['id_divisi'];
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['jabatan'] ?></td>
                    <td class="actions">
                        <a href="updateBidang.php?id_bidang=<?= $id_bidang ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="deleteBidang.php?id_bidang=<?= $id_bidang ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                        <a href="../pengurus/readPengurus.php?id_bidang=<?= $id_bidang ?>&id_divisi=<?= $id_divisi ?>" class="bidang">Daftar Nama</a>
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="readBidang.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_divisi) : ?>
            <a href="readBidang.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>