<?php

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    if (!empty($_GET['kategori'])) {
        $id= $_GET['id'];
        $data[] = $id;
        $sql = 'DELETE FROM kategori WHERE id_kategori=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=kategori&&remove=hapus-data"</script>';
    }

    if (!empty($_GET['barang'])) {
        $id= $_GET['id'];
        $data[] = $id;

        $sql = 'SELECT gambar FROM barang WHERE id_barang=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        $result = $row->fetch(PDO::FETCH_ASSOC);
        $gambar = $result['gambar'];

        $sql = 'DELETE FROM barang WHERE id_barang=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        
        unlink('../tambah/uploads/'.$gambar);
        echo '<script>window.location="../../index.php?page=barang&&remove=hapus-data"</script>';
    }

    if (!empty($_GET['jual'])) {
        $dataI[] = $_GET['brg'];
        $sqlI = 'select * from barang where id_barang=?';
        $rowI = $config -> prepare($sqlI);
        $rowI -> execute($dataI);
        $hasil = $rowI -> fetch();

        $id = $_GET['id'];
        $data[] = $id;

        $sql_penjualan = 'SELECT * FROM penjualan WHERE id_penjualan = ?';
        $row_penjualan = $config->prepare($sql_penjualan);
        $row_penjualan->execute($data);
        $penjualan = $row_penjualan->fetch();
        
        // Mengurangi stok barang yang dihapus dari penjualan
        $newStok = $hasil['stok'] + $penjualan['jumlah'];
        $updateSql = 'UPDATE barang SET stok = ? WHERE id_barang = ?';
        $updateRow = $config->prepare($updateSql);
        $updateRow->execute([$newStok, $hasil['id_barang']]);

        $sql = 'DELETE FROM penjualan WHERE id_penjualan=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);

        echo '<script>window.location="../../index.php?page=jual"</script>';
    }

    if (!empty($_GET['penjualan'])) {
        $sql = 'DELETE FROM penjualan';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }
    
    if (!empty($_GET['laporan'])) {
        $sql = 'DELETE FROM nota';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=laporan&remove=hapus"</script>';
    }
}
