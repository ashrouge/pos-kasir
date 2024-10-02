<?php

session_start();
if (!empty($_SESSION['admin'])) {
  require '../../config.php';
  if (!empty($_GET['kategori'])) {
    $nama = $_POST['kategori'];
    $tgl = date("j F Y, G:i");
    $data[] = $nama;
    $data[] = $tgl;
    $sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
    $row = $config->prepare($sql);
    $row->execute($data);
    echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_GET['barang'])) {
      $id = $_POST['id'];
      $kategori = $_POST['kategori'];
      $nama = $_POST['nama'];
      $merk = $_POST['merk'];
      $beli = $_POST['beli'];
      $jual = $_POST['jual'];
      $satuan = $_POST['satuan'];
      $stok = $_POST['stok'];
      $tgl = $_POST['tgl'];

      // Proses gambar
      if (!empty($_FILES['gambar']['name'][0])) {
        $gambar = $_FILES['gambar']['name']; // Nama file gambar yang diunggah
        $tmpName = $_FILES['gambar']['tmp_name']; // Lokasi file gambar sementara

        $gambar_paths = []; // Array untuk menyimpan path gambar

        // Loop melalui array gambar
        foreach ($gambar as $key => $name) {
          $tmp = $tmpName[$key]; // Lokasi file gambar sementara untuk gambar saat ini
          $gambar_path = '../../assets/uploads/' . $name; // Path lengkap untuk menyimpan gambar

          // Pindahkan gambar yang diunggah ke direktori penyimpanan
          if (move_uploaded_file($tmp, $gambar_path)) {
            $gambar_paths[] = $gambar_path; // Simpan path gambar dalam array gambar_paths
          } else {
            // Penanganan kesalahan jika gagal mengunggah gambar
            echo json_encode(["error" => "Gagal mengunggah gambar."]);
            exit; // Keluar dari skrip
          }
        }
      }

      $data[] = $id;
      $data[] = $kategori;
      $data[] = $nama;
      $data[] = $merk;
      $data[] = $beli;
      $data[] = $jual;
      $data[] = $satuan;
      $data[] = $stok;
      $data[] = $tgl;
      $data[] = implode(',', $gambar_paths); // Menggabungkan array gambar_paths menjadi string dipisahkan koma

      $sql = 'INSERT INTO barang (id_barang, id_kategori, nama_barang, merk, harga_beli, harga_jual, satuan_barang, stok, tgl_input, gambar) VALUES (?,?,?,?,?,?,?,?,?,?)';

      try {
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
      } catch (PDOException $e) {
        echo json_encode(["error" => "Gagal menambahkan data: " . $e->getMessage()]);
      }
    }
  } else {
    echo json_encode(["error" => "Perintah salah"]);
  }




  if (!empty($_GET['jual'])) {
    $id = $_GET['id'];

    // get tabel barang id_barang
    $sql = 'SELECT * FROM barang WHERE id_barang = ?';
    $row = $config->prepare($sql);
    $row->execute(array($id));
    $hsl = $row->fetch();

    if ($hsl['stok'] > 0) {
      $kasir =  $_GET['id_kasir'];
      $jumlah = 1;
      $total = $hsl['harga_jual'];
      $tgl = date("j F Y, G:i");

      $data1[] = $id;
      $data1[] = $kasir;
      $data1[] = $jumlah;
      $data1[] = $total;
      $data1[] = $tgl;

      $sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
      $row1 = $config->prepare($sql1);
      $row1->execute($data1);

      $newStok = $hsl['stok'] - 1;
      $updateSql = 'UPDATE barang SET stok = ? WHERE id_barang = ?';
      $updateRow = $config->prepare($updateSql);
      $updateRow->execute(array($newStok, $id));


      echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
    } else {
      echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
    }
  }
}
