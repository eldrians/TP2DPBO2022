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
$id_bidang = $_GET['id_bidang'];
$stmt = $pdo->prepare('SELECT * FROM pengurus WHERE id_bidang = "$id_bidang" ORDER BY nim LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$bidang = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_pengurus = $pdo->query('SELECT COUNT(*) FROM pengurus WHERE id_bidang = "$id_bidang"')->fetchColumn();

if (!isset($_GET['id_bidang'])) {
    header("Location: ../bidang_divisi/readBidang.php");
    exit();
}

$sql = "select * from pengurus where id_bidang='$id_bidang' order by nim asc";
$sql2 = "select * from bidang_divisi where id_bidang='$id_bidang'";
$q = mysqli_query($conn, $sql);
$q2 = mysqli_query($conn, $sql2);
// Get the total number of divisi, this is so we can determine whether there should be a next and previous button
?>


<?= template_header_pengurus('Pengurus') ?>

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
    <h2>Daftar Nama Pada Bidang
        <?php
        $data =  mysqli_fetch_assoc($q2);
        echo $data['jabatan'];
        ?>
    </h2>
    <a href="createPengurus.php?id_bidang=<?= $data['id_bidang'] ?>" class="create-contact">Tambah Pengurus</a>
    <a href="../bidang_divisi/readBidang.php?id_divisi= <?= $data['id_divisi'] ?>" class="create-contact2">Kembali</a>
    <table>
        <thead>
            <tr>
                <td>No</td>
                <td>NIM</td>
                <td>Nama</td>
                <td>Semester</td>
                <td>Foto</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($data =  mysqli_fetch_array($q)) {
                $nim = $data['nim'];
                $foto = $data['foto'];
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['nim'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['semester'] ?></td>
                    <td><?php echo "<img src='../assets/images/" . $foto . "'height='100' width='100'>" ?></td>
                    <td class="actions">
                        <a href="updatePengurus.php?nim=<?= $nim ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="deletePengurus.php?nim=<?= $nim ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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
            <a href="readPengurus.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_pengurus) : ?>
            <a href="readPengurus.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>