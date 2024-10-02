<?php
$id = $_SESSION['admin']['id_member'];
$hasil = $lihat->member_edit($id);
?>
<h4>Profil Pengguna Aplikasi</h4>
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
	.pembungkus {
		background: rgba(255, 255, 255, .05);
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
		backdrop-filter: blur(10px);
	}

	/*  */
	.input {
		color: #61677A;
		font-weight: 700;
		width: 100%;
		padding: 12px 18px;
		font-size: 16px;
		box-shadow: 0;
		border: none;
		border-radius: 25px;
		background-color: #F1EFEF;
		transition: all .3s;
	}

	.input::placeholder {
		color: #ce9797;
		font-size: 14px;
	}

	.input:focus {
		outline: none;
		box-shadow: 0px 3px 12px 1px rgba(195, 187, 187, 0.75);
		-webkit-box-shadow: 0px 3px 12px 1px rgba(195, 187, 187, 0.75);
		-moz-box-shadow: 0px 3px 12px 1px rgba(195, 187, 187, 0.75);
		border: none;
		transition: all .3s;
	}

	/*  */
	.button {
		border: none;
		color: #fff;
		background-image: linear-gradient(30deg, #7E6F64, #CDB8A5);
		border-radius: 10px;
		background-size: 100% auto;
		font-size: 15px;
		padding: 8px 20px;
	}

	.button:hover {
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


<div class="row">
	<div class="col-sm-3">
		<div class="card card-primary">
			<div class="card-header pembungkus">
				<h5 class="mt-2"><i class="fa fa-user"></i> Foto Pengguna </h5>
			</div>
			<div class="card-body">
				<img src="assets/img/user/<?php echo $hasil['gambar']; ?>" alt="#" class="img-fluid w-100" />
			</div>
			<div class="card-footer">
				<form method="POST" action="fungsi/edit/edit.php?gambar=user" enctype="multipart/form-data">
					<input type="file" accept="image/*" name="foto">
					<input type="hidden" value="<?php echo $hasil['gambar']; ?>" name="foto2">
					<input type="hidden" name="id" value="<?php echo $hasil['id_member']; ?>">
					<br><br>
					<button class="button" type="submit" value="Tambah">
						<i class="fas fa-edit mr-1"></i> Ganti Foto
					</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="card card-primary">
			<div class="card-header pembungkus">
				<h5 class="mt-2"><i class="fa fa-user"></i> Kelola Pengguna </h5>
			</div>
			<div class="card-body">
				<div class="box-content">
					<form class="form-horizontal" method="POST" action="fungsi/edit/edit.php?profil=edit" enctype="multipart/form-data">
						<fieldset>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Nama </label>
								<div class="input-group">
									<input type="text" class="input" name="nama" data-items="4" value="<?php echo $hasil['nm_member']; ?>" required="required" />
									<!-- <input type="text" class="form-control" style="border-radius:0px;" name="nama" data-items="4" value="<?php echo $hasil['nm_member']; ?>" required="required" /> -->
								</div>
							</div>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Email </label>
								<div class="input-group">
									<input class="input" type="email" name="email" value="<?php echo $hasil['email']; ?>" required="required" />
									<!-- <input type="email" class="form-control" style="border-radius:0px;" name="email" value="<?php echo $hasil['email']; ?>" required="required" /> -->
								</div>
							</div>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Telepon </label>
								<div class="input-group">
									<input class="input" type="text" name="tlp" value="<?php echo $hasil['telepon']; ?>" required="required" />
									<!-- <input type="text" class="form-control" style="border-radius:0px;" name="tlp" value="<?php echo $hasil['telepon']; ?>" required="required" /> -->
								</div>
							</div>
							<input type="hidden" name="id" value="<?php echo $hasil['id_member']; ?>">
							<button class="button" name="btn" value="Tambah">
								<i class="fas fa-edit"></i> Ubah Profil
							</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="card card-primary">
			<div class="card-header pembungkus">
				<h5 class="mt-2"><i class="fa fa-lock"></i> Ganti Password</h5>
			</div>
			<div class="card-body">
				<div class="box-content">
					<form class="form-horizontal" method="POST" action="fungsi/edit/edit.php?pass=ganti-pas">
						<fieldset>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Username </label>
								<div class="input-group">
									<input class="input" type="text" name="user" data-items="4" value="<?php echo $hasil['user']; ?>" />
									<!-- <input type="text" class="form-control" style="border-radius:0px;" name="user" data-items="4" value="<?php echo $hasil['user']; ?>" /> -->
								</div>
							</div>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Password Baru</label>
								<div class="input-group">
									<input class="input" type="password" placeholder="Enter Your New Password" id="pass" name="pass" data-items="4" value="" required="required" />
									<!-- <input type="password" class="form-control" placeholder="Enter Your New Password" id="pass" name="pass" data-items="4" value="" required="required" /> -->
								</div>
							</div>
							<input type="hidden" class="form-control" style="border-radius:0px;" name="id" value="<?php echo $hasil['id_member']; ?>" required="required" />
							<button class="button" type="submit" value="Tambah" name="proses"><i class="fas fa-edit"></i> Ubah Password</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>