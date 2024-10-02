        <h4>Data Barang</h4>
        <br />
        <?php if (isset($_GET['success-stok'])) { ?>
            <div class="alert alert-success">
                <p>Tambah Stok Berhasil !</p>
            </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success">
                <p>Tambah Data Berhasil !</p>
            </div>
        <?php } ?>
        <?php if (isset($_GET['remove'])) { ?>
            <div class="alert alert-danger">
                <p>Hapus Data Berhasil !</p>
            </div>
        <?php } ?>

        <?php
        $sql = " select * from barang where stok <= 3";
        $row = $config->prepare($sql);
        $row->execute();
        $r = $row->rowCount();
        if ($r > 0) {
            echo "
				<div class='alert alert-warning'>
					<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
					<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Cek Barang <i class='fa fa-angle-double-right'></i></a></span>
				</div>
				";
        }
        ?>
        <!-- Trigger the modal with a button -->
        <style>
            .wrapper {
                display: inline-flex;
                list-style: none;
                height: 70px;
                width: 100%;
            }

            .wrapper .icon {
                position: relative;
                background: #fff;
                border-radius: 50%;
                margin: 10px;
                width: 50px;
                height: 50px;
                font-size: 18px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
                cursor: pointer;
                transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }

            .wrapper .tooltip {
                position: absolute;
                top: 0;
                font-size: 14px;
                background: #fff;
                color: #fff;
                padding: 5px 8px;
                border-radius: 5px;
                box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
                opacity: 0;
                pointer-events: none;
                transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }

            .wrapper .tooltip::before {
                position: absolute;
                content: "";
                height: 8px;
                width: 8px;
                background: #fff;
                bottom: -3px;
                left: 50%;
                transform: translate(-50%) rotate(45deg);
                transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }

            .wrapper .icon:hover .tooltip {
                top: -45px;
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
            }

            .wrapper .icon:hover span,
            .wrapper .icon:hover .tooltip {
                text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.1);
            }

            .wrapper .tambah:hover,
            .wrapper .tambah:hover .tooltip,
            .wrapper .tambah:hover .tooltip::before {
                background: #1877F2;
                color: #fff;
            }

            .wrapper .sortir:hover,
            .wrapper .sortir:hover .tooltip,
            .wrapper .sortir:hover .tooltip::before {
                background: #FFC436;
                color: #fff;
            }

            .wrapper .refres:hover,
            .wrapper .refres:hover .tooltip,
            .wrapper .refres:hover .tooltip::before {
                background: #03C988;
                color: #fff;
            }

            /*  */
            .bin-button {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                width: 45px;
                height: 45px;
                border-radius: 10px;
                background-color: rgb(255, 95, 95);
                cursor: pointer;
                border: 2px solid rgb(255, 201, 201);
                transition-duration: 0.3s;
                position: relative;
                overflow: hidden;
            }

            .bin-bottom {
                width: 15px;
                z-index: 2;
            }

            .bin-top {
                width: 17px;
                transform-origin: right;
                transition-duration: 0.3s;
                z-index: 2;
            }

            .bin-button:hover .bin-top {
                transform: rotate(45deg);
            }

            .bin-button:hover {
                background-color: rgb(255, 0, 0);
            }

            .bin-button:active {
                transform: scale(0.9);
            }

            .garbage {
                position: absolute;
                width: 14px;
                height: auto;
                z-index: 1;
                opacity: 0;
                transition: all 0.3s;
            }

            .bin-button:hover .garbage {
                animation: throw 0.4s linear;
            }

            @keyframes throw {
                from {
                    transform: translate(-400%, -700%);
                    opacity: 0;
                }

                to {
                    transform: translate(0%, 0%);
                    opacity: 1;
                }
            }

            /*  */
            .editBtn {
                margin-bottom: 5px;
                width: 43px;
                height: 43px;
                border-radius: 10px;
                border: none;
                background-color: #F0DE36;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.123);
                cursor: pointer;
                position: relative;
                overflow: hidden;
                transition: all 0.3s;
            }

            .editBtn::before {
                content: "";
                width: 200%;
                height: 200%;
                background-color: #F4CE14;
                position: absolute;
                z-index: 1;
                transform: scale(0);
                transition: all 0.3s;
                border-radius: 50%;
                filter: blur(10px);
            }

            .editBtn:hover::before {
                transform: scale(1);
            }

            .editBtn svg {
                height: 17px;
                fill: white;
                z-index: 3;
                transition: all 0.2s;
                transform-origin: bottom;
            }

            .editBtn:hover svg {
                transform: rotate(-15deg) translateX(5px);
            }

            .editBtn::after {
                content: "";
                width: 25px;
                height: 1.5px;
                position: absolute;
                bottom: 19px;
                left: -5px;
                background-color: white;
                border-radius: 2px;
                z-index: 2;
                transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.5s ease-out;
            }

            .editBtn:hover::after {
                transform: scaleX(1);
                left: 0px;
                transform-origin: right;
            }

            .pembungkus-btn {
                margin-left: 10px;
                margin-top: 5px;
            }

            .tabel {
                background-color: #F3F8FF;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
                backdrop-filter: blur(10px);
            }

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
        <ul class="wrapper">
            <li class="icon tambah">
                <span class="tooltip">Tambah</span>
                <span type="button" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i></span>
            </li>
            <li class="icon sortir">
                <span class="tooltip">Sortir</span>
                <a href="index.php?page=barang&stok=yes"><i class="fa fa-list"></i></a>
            </li>
            <li class="icon refres">
                <span class="tooltip">Refresh</span>
                <a href="index.php?page=barang"><i class="fa fa-refresh"></i></a>
            </li>
        </ul>
        <!-- <button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Insert Data</button>
        <a href="index.php?page=barang&stok=yes" class="btn btn-warning btn-md mr-2">
            <i class="fa fa-list"></i> Sortir Stok Kurang</a>
        <a href="index.php?page=barang" class="btn btn-success btn-md">
            <i class="fa fa-refresh"></i> Refresh Data</a>
        <div class="clearfix"></div>
        <br /> -->

        <!-- view barang -->
        <div class="tabel card card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="example1">
                    <thead>
                        <tr style="background:#45474B;color:#ddd;">
                            <th>No.</th>
                            <th>ID Barang</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Merk</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalBeli = 0;
                        $totalJual = 0;
                        $totalStok = 0;
                        if ($_GET['stok'] == 'yes') {
                            $hasil = $lihat->barang_stok();
                        } else {
                            $hasil = $lihat->barang();
                        }
                        $no = 1;
                        foreach ($hasil as $isi) {

                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $isi['id_barang']; ?></td>
                                <td>
                                    <div class="d-flex">
                                        <?php
                                        $gambar_paths = explode(",", $isi['gambar']);
                                        // Loop melalui gambar produk untuk menampilkan gambar dalam tabel
                                        foreach ($gambar_paths as $image) {
                                            echo '<img src="assets/uploads/' . $image . '" width="100" height="100">';;
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td><?php echo $isi['nama_kategori']; ?></td>
                                <td><?php echo $isi['nama_barang']; ?></td>
                                <td><?php echo $isi['merk']; ?></td>
                                <td>
                                    <?php if ($isi['stok'] == '0') { ?>
                                        <button class="btn btn-danger"> Habis</button>
                                    <?php } else { ?>
                                        <?php echo $isi['stok']; ?>
                                    <?php } ?>
                                </td>
                                <td>Rp.<?php echo number_format($isi['harga_beli']); ?>,-</td>
                                <td>Rp.<?php echo number_format($isi['harga_jual']); ?>,-</td>
                                <td> <?php echo $isi['satuan_barang']; ?></td>
                                <td>
                                    <?php if ($isi['stok'] <=  '3') { ?>
                                        <form method="POST" action="fungsi/edit/edit.php?stok=edit">
                                            <input type="text" name="restok" class="form-control">
                                            <input type="hidden" name="id" value="<?php echo $isi['id_barang']; ?>" class="form-control">
                                            <button class="btn btn-primary btn-sm">
                                                Restok
                                            </button>
                                            <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id_barang']; ?>" onclick="javascript:return confirm('Hapus Data barang ?');">
                                                <button class="btn btn-danger btn-sm">Hapus</button></a>
                                        </form>
                                    <?php } else { ?>

                                        <div class="pembungkus-btn">
                                            <a href="index.php?page=barang/edit&barang=<?php echo $isi['id_barang']; ?>">
                                                <!-- <button class="btn btn-warning btn-xs">Edit</button> -->
                                                <button class="editBtn">
                                                    <svg height="1em" viewBox="0 0 512 512">
                                                        <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                                    </svg>
                                                </button>

                                            </a>
                                            <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id_barang']; ?>" onclick="javascript:return confirm('Hapus Data barang ?');">
                                                <!-- <button class="btn btn-danger btn-xs">Hapus</button> -->
                                                <button class="bin-button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 39 7" class="bin-top">
                                                        <line stroke-width="4" stroke="white" y2="5" x2="39" y1="5"></line>
                                                        <line stroke-width="3" stroke="white" y2="1.5" x2="26.0357" y1="1.5" x1="12"></line>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 33 39" class="bin-bottom">
                                                        <mask fill="white" id="path-1-inside-1_8_19">
                                                            <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"></path>
                                                        </mask>
                                                        <path mask="url(#path-1-inside-1_8_19)" fill="white" d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"></path>
                                                        <path stroke-width="4" stroke="white" d="M12 6L12 29"></path>
                                                        <path stroke-width="4" stroke="white" d="M21 6V29"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 89 80" class="garbage">
                                                        <path fill="white" d="M20.5 10.5L37.5 15.5L42.5 11.5L51.5 12.5L68.75 0L72 11.5L79.5 12.5H88.5L87 22L68.75 31.5L75.5066 25L86 26L87 35.5L77.5 48L70.5 49.5L80 50L77.5 71.5L63.5 58.5L53.5 68.5L65.5 70.5L45.5 73L35.5 79.5L28 67L16 63L12 51.5L0 48L16 25L22.5 17L20.5 10.5Z"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    <?php } ?>
                            </tr>
                        <?php
                            $no++;
                            $totalBeli += $isi['harga_beli'] * $isi['stok'];
                            $totalJual += $isi['harga_jual'] * $isi['stok'];
                            $totalStok += $isi['stok'];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr style="background:#45474B;color:#ddd;">
                            <th colspan="6">Total </td>
                            <th><?php echo $totalStok; ?></td>
                            <th>Rp.<?php echo number_format($totalBeli); ?>,-</td>
                            <th>Rp.<?php echo number_format($totalJual); ?>,-</td>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- end view barang -->
        <!-- tambah barang MODALS-->
        <!-- Modal -->

        <div id="myModal" class="modal fade" style="backdrop-filter: blur(15px);" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="tabel modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#45474B;color:#fff;">
                        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang</h5>
                        <button type="button" class="close" style="color: #ddd;" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST" action="fungsi/tambah/tambah.php?barang=tambah" enctype="multipart/form-data">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <?php
                                $format = $lihat->barang_id();
                                ?>
                                <tr>
                                    <td>ID Barang</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format; ?>" class="form-control" name="id"></td>
                                </tr>
                                <tr>
                                    <td>Gambar</td>
                                    <td>
                                        <input type="file" id="gambar" name="gambar[]" accept="gambar/*" multiple required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Kategori</td>
                                    <td>
                                        <select name="kategori" class="form-control" required>
                                            <option value="#">Pilih Kategori</option>
                                            <?php $kat = $lihat->kategori();
                                            foreach ($kat as $isi) {     ?>
                                                <option value="<?php echo $isi['id_kategori']; ?>">
                                                    <?php echo $isi['nama_kategori']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td><input type="text" placeholder="Nama Barang" required class="form-control" name="nama"></td>
                                </tr>
                                <tr>
                                    <td>Merk Barang</td>
                                    <td><input type="text" placeholder="Merk Barang" required class="form-control" name="merk"></td>
                                </tr>
                                <tr>
                                    <td>Harga Beli</td>
                                    <td><input type="number" placeholder="Harga beli" required class="form-control" name="beli"></td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td><input type="number" placeholder="Harga Jual" required class="form-control" name="jual"></td>
                                </tr>
                                <tr>
                                    <td>Satuan Barang</td>
                                    <td><input type="text" placeholder="Satuan Barang" required class="form-control" name="satuan"></td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td><input type="number" required Placeholder="Stok" class="form-control" name="stok"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Input</td>
                                    <td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i"); ?>" name="tgl"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="update"><i class="fa fa-plus"></i> Insert
                                Data</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>