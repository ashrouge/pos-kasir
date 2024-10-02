<?php
session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';

    if (!empty($_GET['kategori'])) {
        $nama= htmlentities($_POST['kategori']);
        $id= htmlentities($_POST['id']);
        $data[] = $nama;
        $data[] = $id;
        $sql = 'UPDATE kategori SET  nama_kategori=? WHERE id_kategori=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=kategori&uid='.$id.'&success-edit=edit-data"</script>';
    }

    if (!empty($_GET['stok'])) {
        $restok = htmlentities($_POST['restok']);
        $id = htmlentities($_POST['id']);
        $dataS[] = $id;
        $sqlS = 'select*from barang WHERE id_barang=?';
        $rowS = $config -> prepare($sqlS);
        $rowS -> execute($dataS);
        $hasil = $rowS -> fetch();

        $stok = $restok + $hasil['stok'];

        $data[] = $stok;
        $data[] = $id;
        $sql = 'UPDATE barang SET stok=? WHERE id_barang=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
    }

    if (!empty($_GET['barang'])) {
        $id = $_POST['id'];
        $kategori = $_POST['kategori'];
        $nama = $_POST['nama'];
        $merk = $_POST['merk'];
        $beli = $_POST['beli'];
        $jual = $_POST['jual'];
        $stok = $_POST['stok'];
        $satuan = $_POST['satuan'];
        $tgl = $_POST['tgl'];
    
        // Ambil gambar lama dari basis data menggunakan id_barang
        $sql_gambar_lama = 'SELECT gambar FROM barang WHERE id_barang = ?';
        $row_gambar_lama = $config->prepare($sql_gambar_lama);
        $row_gambar_lama->execute([$id]);
        $gambar_lama = $row_gambar_lama->fetchColumn();
    
        // Periksa apakah ada file gambar yang diunggah
        if (!empty($_FILES['gambar']['name'])) {
            $gambar = $_FILES['gambar']['name']; // Nama file gambar yang diunggah
            $tmpName = $_FILES['gambar']['tmp_name']; // Lokasi file gambar sementara
    
            $gambar_paths = []; // Array untuk menyimpan path gambar
    
            // Loop melalui array gambar
            foreach ($gambar as $key => $name) {
                $tmp = $tmpName[$key]; // Lokasi file gambar sementara untuk gambar saat ini
    
                if (!empty($name)) { // Periksa apakah ada file gambar yang diunggah
                    $gambar_path = '../../assets/uploads/' . $name; // Path lengkap untuk menyimpan gambar
    
                    // Pindahkan gambar yang diunggah ke direktori penyimpanan
                    move_uploaded_file($tmp, $gambar_path);
    
                    $gambar_paths[] = $gambar_path; // Simpan path gambar dalam array gambar_paths
                } else {
                    $gambar_paths[] = $gambar_lama; // Tetapkan path gambar lama ke array gambar_paths
                }
            }
        } else {
            $gambar_paths[] = $gambar_lama; // Tetapkan path gambar lama ke array gambar_paths
        }
    
        $data[] = $kategori;
        $data[] = $nama;
        $data[] = $merk;
        $data[] = $beli;
        $data[] = $jual;
        $data[] = $stok;
        $data[] = $satuan;
        $data[] = $tgl;
        $data[] = implode(',', $gambar_paths); // Simpan array gambar_paths dalam array data sebagai serialized string
        $data[] = $id;
    
        $sql = 'UPDATE barang 
                SET id_kategori=?, nama_barang=?, merk=?, harga_beli=?, harga_jual=?, stok=?,satuan_barang=?, tgl_input=?, gambar=? 
                WHERE id_barang=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=barang/edit&barang='.$id.'&success=edit-data"</script>';
    }
    
    
    
    

    if (!empty($_GET['gambar'])) {
        $id = htmlentities($_POST['id']);
        set_time_limit(0);
        $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );

        if ($_FILES['foto']["error"] > 0) {
            $output['error']= "Error in File";
        } elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
        } elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
            echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB");window.location="../../index.php?page=user"</script>';
        } else {
            $dir = '../../assets/img/user/';
            $tmp_name = $_FILES['foto']['tmp_name'];
            $name = time().basename($_FILES['foto']['name']);
            if (move_uploaded_file($tmp_name, $dir.$name)) {
                //post foto lama
                $foto2 = $_POST['foto2'];
                //remove foto di direktori
                unlink('../../assets/img/user/'.$foto2.'');
                //input foto
                $id = $_POST['id'];
                $data[] = $name;
                $data[] = $id;
                $sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
                $row = $config -> prepare($sql);
                $row -> execute($data);
                echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
            } else {
                echo '<script>alert("Masukan Gambar !");window.location="../../index.php?page=user"</script>';
            }
        }
    }

    if (!empty($_GET['profil'])) {
      try {
          $id = htmlentities($_POST['id']);
          $nama = htmlentities($_POST['nama']);
          $tlp = htmlentities($_POST['tlp']);
          $email = htmlentities($_POST['email']);
  
          $data[] = $nama;
          $data[] = $tlp;
          $data[] = $email;
          $data[] = $id;
          $sql = 'UPDATE member SET nm_member=?,telepon=?,email=? WHERE id_member=?';
          $row = $config->prepare($sql);
          $row->execute($data);
          echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
      } catch (PDOException $e) {
          // Tangkap kesalahan PDO
          echo "Error: " . $e->getMessage();
      } catch (Exception $e) {
          // Tangkap kesalahan umum
          echo "Error: " . $e->getMessage();
      }
  }
    if (!empty($_GET['pass'])) {
        $id = htmlentities($_POST['id']);
        $user = htmlentities($_POST['user']);
        $pass = htmlentities($_POST['pass']);

        $data[] = $user;
        $data[] = $pass;
        $data[] = $id;
        $sql = 'UPDATE login SET user=?,pass=md5(?) WHERE id_member=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
    }

    if (!empty($_GET['jual'])) {
        $id = htmlentities($_POST['id']);
        $id_barang = htmlentities($_POST['id_barang']);
        $jumlah = htmlentities($_POST['jumlah']);

        $sql_tampil = "select *from barang where barang.id_barang=?";
        $row_tampil = $config -> prepare($sql_tampil);
        $row_tampil -> execute(array($id_barang));
        $hasil = $row_tampil -> fetch();

        if ($hasil['stok'] >= $jumlah) {

            // Mengupdate jumlah dan total penjualan
            $jual = $hasil['harga_jual'];
            $total = $jual * $jumlah;
            $data1 = array($jumlah, $total, $id);
            $sql1 = 'UPDATE penjualan SET jumlah=?, total=? WHERE id_penjualan=?';
            $row1 = $config->prepare($sql1);
            $row1->execute($data1);

            // Mengurangi stok barang
            $newStok = $hasil['stok'] - $jumlah;
            $updateSql = 'UPDATE barang SET stok=? WHERE id_barang=?';
            $updateRow = $config->prepare($updateSql);
            $updateRow->execute(array($newStok, $id_barang));

            echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
        } else {
            echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }

    if (!empty($_GET['cari_barang'])) {
        $cari = trim(strip_tags($_POST['keyword']));
        if ($cari == '') {
        } else {
            $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
					from barang inner join kategori on barang.id_kategori = kategori.id_kategori
					where barang.id_barang like '%$cari%' or barang.nama_barang like '%$cari%' or barang.merk like '%$cari%'";
            $row = $config -> prepare($sql);
            $row -> execute();
            $hasil1= $row -> fetchAll();
            ?>
		<table class="table table-stripped" width="100%" id="example2">
			<tr>
				<th>ID Barang</th>
				<th>Nama Barang</th>
				<th>Merk</th>
				<th>Harga Jual</th>
				<th>Aksi</th>
			</tr>
		<?php foreach ($hasil1 as $hasil) {?>
			<tr>
				<td><?php echo $hasil['id_barang'];?></td>
				<td><?php echo $hasil['nama_barang'];?></td>
				<td><?php echo $hasil['merk'];?></td>
				<td><?php echo $hasil['harga_jual'];?></td>
				<td>
				<a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['id_barang'];?>&id_kasir=<?php echo $_SESSION['admin']['id_member'];?>" 
					class="btn btn-success">
					<i class="fa fa-shopping-cart"></i></a></td>
			</tr>
		<?php }?>
		</table>
<?php
        }
    }
}
