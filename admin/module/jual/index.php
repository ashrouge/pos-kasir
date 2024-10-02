<?php
$id = $_SESSION['admin']['id_member'];
$hasil = $lihat->member_edit($id);
?>
<h4>Keranjang Penjualan</h4>
<br>
<?php if (isset($_GET['success'])) { ?>
	<div class="alert alert-success">
		<p>Edit Data Berhasil !</p>
	</div>
<?php } ?>
<?php if (isset($_GET['remove'])) { ?>
	<div class="alert alert-danger">
		<p>Hapus Data Berhasil !</p>
	</div>
<?php } ?>
<style>
	.add {
		border: none;
		color: #fff;
		font-weight: bold;
		background-image: linear-gradient(30deg, #7E6F64, #CDB8A5);
		border-radius: 10px;
		background-size: 100% auto;
		font-size: 15px;
		padding: 8px 20px;
	}

	.add:hover {
		background-position: right center;
		background-size: 200% auto;
		-webkit-animation: pulse 2s infinite;
		animation: pulse512 1.5s infinite;
	}

	@keyframes pulse512 {
		0% {
			box-shadow: 0 0 0 0 #CDB8A5;
		}

		70% {
			box-shadow: 0 0 0 10px rgb(218 103 68 / 0%);
		}

		100% {
			box-shadow: 0 0 0 0 rgb(218 103 68 / 0%);
		}
	}
</style>
<div class="row">
	<div class="col-lg-5">
		<div class="card mt-4">
			<div class="row" style="padding: 20px 10px 5px; border-radius: 5px;">
				<?php
				$hasil = $lihat->barang();
				foreach ($hasil as $row) :
					$gambar_paths = explode(",", $row['gambar']);
				?>
					<div class="col-lg-6 mb-3">
						<form action="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $row['id_barang']; ?>&id_kasir=<?php echo $_SESSION['admin']['id_member']; ?>" method="post">
							<div class="card">
								<div id="carousel<?php echo $productId; ?>" class="carousel slide" data-ride="carousel" data-interval="false">
									<div class="carousel-inner">
										<?php
										// Loop melalui gambar produk untuk membuat carousel items
										foreach ($gambar_paths as $index => $image) {
											$active = ($index == 0) ? 'active' : '';
											echo '<div class="carousel-item ' . $active . '">';
											echo '<img class="d-block w-100 card-img-top" src="assets/uploads/' . $image . '" alt="Product Image">';
											echo '</div>';
										}
										?>
									</div>
									<a class="carousel-control-prev" href="#carousel<?php echo $productId; ?>" role="button" data-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#carousel<?php echo $productId; ?>" role="button" data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
								<div class="card-body">
									<p class="card-text"><?= $row['nama_barang']; ?></p>
									<p class="card-text">Rp. <?= $row['harga_jual']; ?></p>
									<button type="submit" class="add">Tambah Keranjang</button>
								</div>
							</div>
						</form>
					</div>
				<?php
				endforeach;
				?>
			</div>
		</div>
	</div>

	<style>
		.cetak {
			color: #090909;
			padding: 0.7em 1.7em;
			font-size: 15px;
			border-radius: 0.5em;
			background: #e8e8e8;
			border: 1px solid #e8e8e8;
			transition: all .3s;
			box-shadow: 6px 6px 12px #c5c5c5,
				-6px -6px 12px #ffffff;
		}

		.cetak i {
			color: #607274;
			font-size: 25px;
		}

		.cetak:hover {
			border: 1px solid white;
		}

		.cetak:active {
			box-shadow: 4px 4px 12px #c5c5c5,
				-4px -4px 12px #ffffff;
		}

		/*  */
		.tabel {
			background-color: #F3F8FF;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
			backdrop-filter: blur(10px);
		}

		/*  */
		/* Note that you only needs to edit the config to customize the button! */

		.plusButton {
			/* Config start */
			--plus_sideLength: 2.5rem;
			--plus_topRightTriangleSideLength: 0.9rem;
			/* Config end */
			position: relative;
			display: flex;
			justify-content: center;
			align-items: center;
			border: 1px solid white;
			width: var(--plus_sideLength);
			height: var(--plus_sideLength);
			background-color: #000000;
			overflow: hidden;
		}

		.plusButton::before {
			position: absolute;
			content: "";
			top: 0;
			right: 0;
			width: 0;
			height: 0;
			border-width: 0 var(--plus_topRightTriangleSideLength) var(--plus_topRightTriangleSideLength) 0;
			border-style: solid;
			border-color: transparent white transparent transparent;
			transition-timing-function: ease-in-out;
			transition-duration: 0.2s;
		}

		.plusButton:hover {
			cursor: pointer;
		}

		.plusButton:hover::before {
			--plus_topRightTriangleSideLength: calc(var(--plus_sideLength) * 2);
		}

		.plusButton:focus-visible::before {
			--plus_topRightTriangleSideLength: calc(var(--plus_sideLength) * 2);
		}

		.plusButton>.plusIcon {
			fill: white;
			width: calc(var(--plus_sideLength) * 0.7);
			height: calc(var(--plus_sideLength) * 0.7);
			z-index: 1;
			transition-timing-function: ease-in-out;
			transition-duration: 0.2s;
		}

		.plusButton:hover>.plusIcon {
			fill: black;
			transform: rotate(180deg);
		}

		.plusButton:focus-visible>.plusIcon {
			fill: black;
			transform: rotate(180deg);
		}
		.refresh{
			padding: 10px;
			border-radius: 5px;
			background-color: #7E6F64;
			transition: 0.3s;
		}
		.refresh:hover{
			background-color: #CDB8A5;
		}
	</style>

	<div class="col-lg-7">
		<div class="tabel card card-primary">
			<div class="card-header" style="background:#45474B;color:#fff;">
				<h5 style="font-weight: bold;"><i class="fa fa-shopping-cart"></i> KASIR
					<a class="refresh float-right" onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="fungsi/hapus/hapus.php?penjualan=jual">
						<i class="fa fa-refresh fa-spin" style="font-size:24px ; color: #fff;"></i>
					</a>
				</h5>
			</div>
			<div class="card-body">
				<div id="keranjang" class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<td><b>Tanggal</b></td>
							<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i"); ?>" name="tgl"></td>
						</tr>
					</table>
					<table class="table table-bordered w-100" id="example1">
						<thead>
							<tr>
								<td> No</td>
								<td> Nama Barang</td>
								<td style="width:10%;"> Jumlah</td>
								<td style="width:20%;"> Subtotal</td>
								<td> Kasir</td>
								<td> Aksi</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_bayar = 0;
							$no = 1;
							$hasil_penjualan = $lihat->penjualan();
							?>
							<?php foreach ($hasil_penjualan  as $isi) { ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $isi['nama_barang']; ?></td>
									<td>
										<!-- aksi ke table penjualan -->
										<form method="POST" action="fungsi/edit/edit.php?jual=jual">
											<input type="number" name="jumlah" value="<?php echo $isi['jumlah']; ?>" class="form-control">
											<input type="hidden" name="id" value="<?php echo $isi['id_penjualan']; ?>" class="form-control">
											<input type="hidden" name="id_barang" value="<?php echo $isi['id_barang']; ?>" class="form-control">
									</td>
									<td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
									<td><?php echo $isi['nm_member']; ?></td>
									<td>
										<button type="submit" class="btn btn-warning">
											<i class="fas fa-edit"></i>
										</button>
										</form>
										<!-- aksi ke table penjualan -->
										<a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan']; ?>&brg=<?php echo $isi['id_barang']; ?>
											&jml=<?php echo $isi['jumlah']; ?>" class="btn btn-danger"><i class="fa fa-times"></i>
										</a>
									</td>
								</tr>
							<?php
								$no++;
								$total_bayar += $isi['total'];
							}
							?>
						</tbody>
					</table>
					<br />
					<?php $hasil = $lihat->jumlah(); ?>
					<div id="kasirnya">
						<table class="table table-stripped">
							<?php
							// proses bayar dan ke nota
							if (!empty($_GET['nota'] == 'yes')) {
								$total = $_POST['total'];
								$bayar = $_POST['bayar'];
								if (!empty($bayar)) {
									$hitung = $bayar - $total;
									if ($bayar >= $total) {
										$id_barang = $_POST['id_barang'];
										$id_member = $_POST['id_member'];
										$jumlah = $_POST['jumlah'];
										$total = $_POST['total1'];
										$tgl_input = $_POST['tgl_input'];
										$periode = $_POST['periode'];
										$jumlah_dipilih = count($id_barang);

										for ($x = 0; $x < $jumlah_dipilih; $x++) {

											$d = array($id_barang[$x], $id_member[$x], $jumlah[$x], $total[$x], $tgl_input[$x], $periode[$x]);
											$sql = "INSERT INTO nota (id_barang,id_member,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?)";
											$row = $config->prepare($sql);
											$row->execute($d);

											// ubah stok barang
											$sql_barang = "SELECT * FROM barang WHERE id_barang = ?";
											$row_barang = $config->prepare($sql_barang);
											$row_barang->execute(array($id_barang[$x]));
											$hsl = $row_barang->fetch();

											$stok = $hsl['stok'];
											$idb  = $hsl['id_barang'];

											$total_stok = $stok - $jumlah[$x];
											// echo $total_stok;
											$sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
											$row_stok = $config->prepare($sql_stok);
											$row_stok->execute(array($total_stok, $idb));
										}
										echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
									} else {
										echo '<script>alert("Uang Kurang ! Rp.' . $hitung . '");</script>';
									}
								}
							}
							?>
							<!-- aksi ke table nota -->
							<form method="POST" action="index.php?page=jual&nota=yes#kasirnya">
								<?php foreach ($hasil_penjualan as $isi) {; ?>
									<input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang']; ?>">
									<input type="hidden" name="id_member[]" value="<?php echo $isi['id_member']; ?>">
									<input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah']; ?>">
									<input type="hidden" name="total1[]" value="<?php echo $isi['total']; ?>">
									<input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input']; ?>">
									<input type="hidden" name="periode[]" value="<?php echo date('m-Y'); ?>">
								<?php $no++;
								} ?>
								<tr>
									<td>Total</td>
									<td><input type="text" class="form-control" name="total" value="<?php echo $total_bayar; ?>"></td>

									<td>Bayar </td>
									<td><input type="text" class="form-control" name="bayar" value="<?php echo $bayar; ?>"></td>
									<td><button class="btn btn-success"> Bayar</button>
										<?php if (!empty($_GET['nota'] == 'yes')) { ?>
											<a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
												<b>RESET</b></a>
									</td><?php } ?></td>
								</tr>
							</form>
							<!-- aksi ke table nota -->
							<tr>
								<td>Kembali</td>
								<td><input type="text" class="form-control" value="<?php echo $hitung; ?>"></td>
								<td></td>
								<td>
									<a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member']; ?>
									&bayar=<?php echo $bayar; ?>&kembali=<?php echo $hitung; ?>" target="_blank">
										<button class="cetak">
											<i class="fa-solid fa-print"></i>
										</button>
										<!-- <button class="cetak">
											<i class="fa-solid fa-print"></i>
										</button> -->
									</a>
								</td>
							</tr>
						</table>
						<br />
						<br />
					</div>
				</div>
			</div>
		</div>
	</div>


	<script>
		// AJAX call for autocomplete 
		$(document).ready(function() {
			$("#cari").change(function() {
				$.ajax({
					type: "POST",
					url: "fungsi/edit/edit.php?cari_barang=yes",
					data: 'keyword=' + $(this).val(),
					beforeSend: function() {
						$("#hasil_cari").hide();
						$("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
					},
					success: function(html) {
						$("#tunggu").html('');
						$("#hasil_cari").show();
						$("#hasil_cari").html(html);
					}
				});
			});
		});
		//To select country name
	</script>