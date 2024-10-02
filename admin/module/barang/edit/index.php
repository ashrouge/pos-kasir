<?php
$id = $_GET['barang'];
$hasil = $lihat->barang_edit($id);
?>
<style>
	.button {
		display: block;
		position: relative;
		width: 56px;
		height: 56px;
		margin: 0;
		overflow: hidden;
		outline: none;
		background-color: transparent;
		border: 0;
	}

	.button:before,
	.button:after {
		content: "";
		position: absolute;
		border-radius: 50%;
		inset: 7px;
	}

	.button:before {
		border: 4px solid #F0EEEF;
		transition: opacity .4s cubic-bezier(.77, 0, .175, 1) 80ms, transform .5s cubic-bezier(.455, .03, .515, .955) 80ms;
	}

	.button:after {
		border: 4px solid #96daf0;
		transform: scale(1.3);
		transition: opacity .4s cubic-bezier(.165, .84, .44, 1), transform .5s cubic-bezier(.25, .46, .45, .94);
		opacity: 0;
	}

	.button:hover:before,
	.button:focus:before {
		opacity: 0;
		transform: scale(0.7);
		transition: opacity .4s cubic-bezier(.165, .84, .44, 1), transform .5s cubic-bezier(.25, .46, .45, .94);
	}

	.button:hover:after,
	.button:focus:after {
		opacity: 1;
		transform: scale(1);
		transition: opacity .4s cubic-bezier(.77, 0, .175, 1) 80ms, transform .5s cubic-bezier(.455, .03, .515, .955) 80ms;
	}

	.button-box {
		display: flex;
		position: absolute;
		top: 0;
		left: 0;
	}

	.button-elem {
		display: block;
		width: 20px;
		height: 20px;
		margin: 17px 18px 0 18px;
		transform: rotate(180deg);
		fill: #F0EEEF;
	}

	.update:hover .update-box,
	.update:focus .update-box {
		transition: .4s;
		transform: translateX(-56px);
	}

	.tabel {
		background-color: #F3F8FF;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
		backdrop-filter: blur(10px);
	}
	/*  */
	.update {
		border: none;
		color: #fff;
		background-image: linear-gradient(30deg, #7E6F64, #CDB8A5);
		border-radius: 10px;
		background-size: 100% auto;
		font-size: 15px;
		padding: 8px 20px;
	}

	.update:hover {
		background-position: right center;
		background-size: 200% auto;
		-webkit-animation: pulse 2s infinite;
		animation: pulse512 1.5s infinite;
	}

	@keyframes pulse512 {
		0% {
			box-shadow: 0 0 0 0 #CDB8A5  ;
		}

		70% {
			box-shadow: 0 0 0 10px rgb(218 103 68 / 0%);
		}

		100% {
			box-shadow: 0 0 0 0 rgb(218 103 68 / 0%);
		}
	}
</style>

<a href="index.php?page=barang">
	<!-- <i class="fa fa-angle-left"></i> -->
	<button class="button">
		<div class="button-box">
			<span class="button-elem">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 40">
					<path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z" fill="black"></path>
				</svg>
			</span>
			<span class="button-elem">
				<svg viewBox="0 0 46 40">
					<path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z" fill="black"></path>
				</svg>
			</span>

		</div>
	</button>
</a>
<h4>Edit Barang</h4>
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
<div class="tabel card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<form action="fungsi/edit/edit.php?barang=edit" method="POST" enctype="multipart/form-data">
				<tr>
					<td>ID Barang</td>
					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['id_barang']; ?>" name="id"></td>
				</tr>
				<tr>
					<td>Gambar</td>
					<td>
						<?php if (!empty($hasil['gambar'])) { ?>
							<img src="assets/uploads/<?php echo $hasil['gambar']; ?>" width="100" height="100"><br><br>
						<?php } ?>
						<input type="file" id="gambar" name="gambar" multiple>
					</td>
				</tr>
				<tr>
					<td>Kategori</td>
					<td>
						<select name="kategori" class="form-control">
							<option value="<?php echo $hasil['id_kategori']; ?>"><?php echo $hasil['nama_kategori']; ?></option>
							<option value="#">Pilih Kategori</option>
							<?php $kat = $lihat->kategori();
							foreach ($kat as $isi) { 	?>
								<option value="<?php echo $isi['id_kategori']; ?>"><?php echo $isi['nama_kategori']; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Nama Barang</td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['nama_barang']; ?>" name="nama"></td>
				</tr>
				<tr>
					<td>Merk Barang</td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['merk']; ?>" name="merk"></td>
				</tr>
				<tr>
					<td>Harga Beli</td>
					<td><input type="number" class="form-control" value="<?php echo $hasil['harga_beli']; ?>" name="beli"></td>
				</tr>
				<tr>
					<td>Harga Jual</td>
					<td><input type="number" class="form-control" value="<?php echo $hasil['harga_jual']; ?>" name="jual"></td>
				</tr>
				<tr>
					<td>Satuan Barang</td>
					<td>
						<input type="text" placeholder="Satuan Barang" required class="form-control" name="satuan" value="<?php echo $hasil['satuan']; ?>">
					</td>
				</tr>
				<tr>
					<td>Stok</td>
					<td><input type="number" class="form-control" value="<?php echo $hasil['stok']; ?>" name="stok"></td>
				</tr>
				<tr>
					<td>Tanggal Update</td>
					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i"); ?>" name="tgl"></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" class="update"><i class="fa fa-edit"></i> Update Data</button></td>
				</tr>
			</form>
		</table>
	</div>
</div>