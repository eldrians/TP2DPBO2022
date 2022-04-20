<?php
include 'functions.php';
require 'function.php';

$sql_pengurus = "select * from pengurus";
$q = mysqli_query($conn, $sql_pengurus);
?>

<?= template_header('Home') ?>

<style>
	.content {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		grid-row: 50px;
		justify-content: center;
		text-align: center;
	}

	.content .box .gambar {
		text-align: center;
		margin-top: 40px;
	}

	.content .box h4 {
		margin: 0;
	}

	.content .box h6 {
		margin: 0;
	}

	.content .box p {
		margin-top: 5px;
	}

	.box {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		border: 1px solid black;
		border-radius: 10px;
		margin: 10px;
	}

	.content a{
		text-decoration: none;
		color: black;
	}
</style>

<div class="content">
	<?php
	while ($data =  mysqli_fetch_array($q)) {
		$nim = $data['nim'];
		$id_bidang = $data['id_bidang'];
		$foto = $data['foto'];
	?>
		<a href="review.php?nim=<?= $nim ?>">
			<div class="box">
				<div class="gambar"><?php echo "<img src='assets/images/" . $foto . "'height='100' width='100'>" ?></div>
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
		</a>
	<?php
	}
	?>
</div>

<?= template_footer() ?>