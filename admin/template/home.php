<h3>Dashboard</h3>
<br />
<?php
$sql = " select * from barang where stok <= 3";
$row = $config->prepare($sql);
$row->execute();
$r = $row->rowCount();
if ($r > 0) {
?>
<?php
    echo "
		<div class='alert alert-warning'>
			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
			<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
		</div>
		";
}
?>
<?php $hasil_barang = $lihat->barang_row(); ?>
<?php $hasil_kategori = $lihat->kategori_row(); ?>
<?php $stok = $lihat->barang_stok_row(); ?>
<?php $jual = $lihat->jual_row(); ?>

<style>
    .colom {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .text {
        margin-left: 20px;
    }

    .text i {
        font-size: 23px;
        padding: 10px;
        border-radius: 50%;
        color: #CDB8A5;
    }

    .card {
        margin-bottom: 20px;
        width: 270px;
        height: 208px;
        transition: all 0.2s;
        position: relative;
        cursor: pointer;
    }

    .card-inner {
        width: inherit;
        height: inherit;
        background: rgba(255, 255, 255, .05);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(10px);
        border-radius: 8px;
    }

    .card:hover {
        transform: scale(1.04) rotate(1deg);
    }

    @keyframes move-up6 {
        to {
            transform: translateY(-10px);
        }
    }

    @keyframes move-down1 {
        to {
            transform: translateY(10px);
        }
    }

    .button {
        padding: 8px 12px 8px 16px;
        height: 40px;
        width: 128px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .lable {
        margin-top: 1px;
    }

    .button:hover .svg-icon {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        25% {
            transform: rotate(-8deg);
        }

        50% {
            transform: rotate(0deg);
        }

        75% {
            transform: rotate(8deg);
        }

        100% {
            transform: rotate(0deg);
        }
    }
</style>



<!--  -->
<div class='colom'>
    <div class="card">
        <div class="card-inner">
            <div class="text-dark text">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Nama Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_barang); ?></h1>
                </center>
            </div>
            <div class='lable'>
                <a class="button" href='index.php?page=barang'>
                    <svg class="svg-icon" width="35" viewBox="0 0 24 24" height="35" fill="none">
                        <g stroke-width="2" stroke-linecap="round" stroke="#CDB8A5" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="m3 7h17c.5523 0 1 .44772 1 1v11c0 .5523-.4477 1-1 1h-16c-.55228 0-1-.4477-1-1z"></path>
                            <path d="m3 4.5c0-.27614.22386-.5.5-.5h6.29289c.13261 0 .25981.05268.35351.14645l2.8536 2.85355h-10z"></path>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-inner">
            <div class="text-dark text">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Stok Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($stok['jml']); ?></h1>
                </center>
            </div>
            <div class='lable'>
                <a class="button" href='index.php?page=barang'>
                    <svg class="svg-icon" width="35" viewBox="0 0 24 24" height="35" fill="none">
                        <g stroke-width="2" stroke-linecap="round" stroke="#CDB8A5" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="m3 7h17c.5523 0 1 .44772 1 1v11c0 .5523-.4477 1-1 1h-16c-.55228 0-1-.4477-1-1z"></path>
                            <path d="m3 4.5c0-.27614.22386-.5.5-.5h6.29289c.13261 0 .25981.05268.35351.14645l2.8536 2.85355h-10z"></path>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-inner">
            <div class="text-dark text">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Telah Terjual</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($jual['stok']); ?></h1>
                </center>
            </div>
            <div class='lable'>
                <a class="button" href='index.php?page=laporan'>
                    <svg class="svg-icon" width="35" viewBox="0 0 24 24" height="35" fill="none">
                        <g stroke-width="2" stroke-linecap="round" stroke="#CDB8A5" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="m3 7h17c.5523 0 1 .44772 1 1v11c0 .5523-.4477 1-1 1h-16c-.55228 0-1-.4477-1-1z"></path>
                            <path d="m3 4.5c0-.27614.22386-.5.5-.5h6.29289c.13261 0 .25981.05268.35351.14645l2.8536 2.85355h-10z"></path>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-inner">
            <div class="text-dark text">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Kategori Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_kategori); ?></h1>
                </center>
            </div>
            <div class='lable'>
                <a class="button" href='index.php?page=kategori'>
                    <svg class="svg-icon" width="35" viewBox="0 0 24 24" height="35" fill="none">
                        <g stroke-width="2" stroke-linecap="round" stroke="#CDB8A5" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="m3 7h17c.5523 0 1 .44772 1 1v11c0 .5523-.4477 1-1 1h-16c-.55228 0-1-.4477-1-1z"></path>
                            <path d="m3 4.5c0-.27614.22386-.5.5-.5h6.29289c.13261 0 .25981.05268.35351.14645l2.8536 2.85355h-10z"></path>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </div>

</div>