<?php
require 'config.php';
include $view;
$lihat = new view($config);
$toko = $lihat->toko();
$hsl = $lihat->penjualan();
?>
<html>

<head>
	<title>print</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<style>
		.center-card {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		.nota {
			margin: auto;
			width: 300px;
			padding: 20px;
			border: 1px solid #ccc;
			font-family: Arial, sans-serif;
			background-color: #fff;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.nota-header {
			text-align: center;
			margin-bottom: 10px;
		}

		.nota-date {
			font-size: 12px;
			margin-bottom: 5px;
		}

		.nota-table {
			width: 100%;
			border-collapse: collapse;
		}

		.nota-table th,
		.nota-table td {
			padding: 5px;
			border-bottom: 1px solid #ccc;
		}


		.nota-table th {
			text-align: center;
		}

		.nota-values {
			text-align: right;
		}

		.text-center {
			text-align: center;
		}

		.nota-total {
			display: flex;
			justify-content: space-between;
			margin-top: 10px;
		}

		.nota-total p {
			margin: 0;
		}
	</style>
</head>

<body>
	<script>
		window.print();
	</script>
	<div class="center-card">
		<div class="nota">
			<div class="nota-header">
				<h3>Arunika's Collection</h3>
				<p class="nota-date"><?php echo date("j F Y, G:i"); ?></p>
				<p class="nota-date">Kasir: <?php echo $_GET['nm_member']; ?></p>
			</div>

			<table class="nota-table">
				<thead>
					<tr>
						<th>No.</th>
						<th>Barang</th>
						<th>Jumlah</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($hsl as $isi) { ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $isi['nama_barang']; ?></td>
							<td><?php echo $isi['jumlah']; ?></td>
							<td>Rp.<?php echo number_format($isi['total']); ?></td>
						</tr>
					<?php $no++;
					} ?>
				</tbody>
			</table>

			<div class="nota-total">
				<div>
					<p>Total:</p>
					<p>Bayar:</p>
					<p>Kembali:</p>
				</div>
				<div class="nota-values">
					<?php $hasil = $lihat->jumlah(); ?>
					<p>Rp.<?php echo number_format($hasil['bayar']); ?>,--</p>
					<p>Rp.<?php echo number_format($_GET['bayar']); ?>,--</p>
					<p>Rp.<?php echo number_format($_GET['kembali']); ?>,--</p>
				</div>
			</div>

			<p class="text-center">Terima Kasih Telah berbelanja di toko kami!</p>
		</div>
	</div>
</body>

</html>