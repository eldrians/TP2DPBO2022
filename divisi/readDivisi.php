<?php
include '../functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our divisi table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM divisi ORDER BY id_divisi LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$divisi = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of divisi, this is so we can determine whether there should be a next and previous button
$num_divisi = $pdo->query('SELECT COUNT(*) FROM divisi')->fetchColumn();
?>


<?= template_header_divisi('Divisi') ?>

<div class="content read">
    <h2>Daftar Divisi</h2>
    <a href="createDivisi.php" class="create-contact">Tambah Divisi</a>
    <table>
        <thead>
            <tr>
                <td>No</td>
                <td>Nama Divisi</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($divisi as $divisi) : ?>
                <tr>
                    <td><?php echo $no?></td>
                    <td><?= $divisi['nama_divisi'] ?></td>
                    <td class="actions">
                        <a href="updateDivisi.php?id_divisi=<?= $divisi['id_divisi'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="deleteDivisi.php?id_divisi=<?= $divisi['id_divisi'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                        <a href="../bidang_divisi/readBidang.php?id_divisi=<?= $divisi['id_divisi'] ?>" class="bidang">Daftar Bidang</a>
                    </td>
                </tr>
            <?php 
            $no++;
            endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="readDivisi.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_divisi) : ?>
            <a href="readDivisi.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>r