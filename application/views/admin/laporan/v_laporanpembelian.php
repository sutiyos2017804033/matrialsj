<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="denicahayaterang">

    <title>Aplikasi Penjualan</title>
    <?php
    $this->load->view('admin/footer');
    ?>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/dist/css/bootstrap-select.css' ?>" rel="stylesheet">
</head>

<body>

    <!-- Navigation -->
    <?php
    $this->load->view('admin/menu');
    ?>


    <?php

    $semuadata = array();
    $tgl_mulai = "-";
    $tgl_selesai = "-";
    $beli_notrans = "-";

    $quer = $this->db->query("SELECT *  FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
    JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id GROUP BY a.beli_notrans");
    $rowss = $quer->result_array();

    $ambil = $this->db->query("SELECT *  FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
    JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id GROUP BY a.beli_notrans");
    $row = $ambil->result_array();

    if (isset($_POST["kirim"])) {
        $tgl_mulai = $_POST["tglm"];
        $tgl_selesai = $_POST["tgls"];


        $ambil = $this->db->query("SELECT *  FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
    JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' GROUP BY a.beli_notrans");
        $row = $ambil->result_array();
        if (!$row) {
            echo "
			<script>
				alert ('tidak ada data , masukan keyword dengan benar');
				document.location.href = 'pembelianlaporan';
			</script>
		";
        }

        // var_dump($row);
    } else {
        if (isset($_POST["cari"])) {
            $beli_notrans = $_POST["beli_notrans"];

            $ambil = $this->db->query("SELECT *  FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
    JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_notrans='$beli_notrans' GROUP BY a.beli_notrans");
            $row = $ambil->result_array();
        }
        // if (!$row) {
        //     echo "
        // 	<script>
        // 		alert ('tidak ada data silah kan masukan keyword dengan benar!!');
        // 		document.location.href = 'pembelianlaporan';
        // 	</script>
        // ";
        // }
    }

    ?>



    <div class="content-wrapper mt-3">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h3 class="card-title">Laporan Pembelian</h3>
                            </div> -->

                            <div class="card-body">


                                <h2>Laporan Pembelian dari <?php echo $tgl_mulai; ?> hingga <?php echo $tgl_selesai ?>
                                </h2>
                                <hr>

                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Tanggal Mulai</label>
                                                <input type="date" class="form-control" name="tglm" value="<?php echo date("d-m-Y", strtotime($tgl_mulai));
                                                                                                            ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Tanggal Selesai</label>
                                                <input type="date" class="form-control" name="tgls"
                                                    value="<?php echo date("d-m-Y", strtotime($tgl_selesai)) ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label>&nbsp;</label><br>
                                            <button class="btn btn-success" name="kirim">Lihat</button>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <select name='beli_notrans' class='form-control select2' required>
                                                    <option>- Pilih No Transaksi -</option>
                                                    <?php
                                                    foreach ($rowss as $pem) {
                                                        echo "<option value='$pem[beli_notrans]'>$pem[beli_notrans]</option>";
                                                    } ?>
                                                </select>

                                            </div>


                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <button class="btn btn-success" name="cari">Lihat</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>

                            <table id="laptabel" class="table table-sm table-borderless" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Transaksi</th>
                                        <th>Tanggal Beli</th>
                                        <th>Nama Supplier</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;
                                    $totalb = 0;
                                    $total = 0;
                                    foreach ($row as $value) {
                                        $total = $value["barang_harpok"];
                                        $totalb += $total;
                                    ?>

                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $value["beli_notrans"]; ?></td>
                                        <td><?= date("d-m-Y", strtotime($value["beli_tanggal"])); ?></td>
                                        <td><?= $value["suplier_nama"]; ?></td>

                                    </tr>
                                    <?php
                                        $no++;
                                    };
                                    ?>
                                </tbody>


                            </table>
                        </div>
                        <?php
                        // if (!$value['beli_nofak']) {  
                        ?>
                        <?php //echo "Data kosong" 
                        ?>
                        <?php //} else { 
                        ?>
                        <a class="btn btn-xs btn-warning"
                            href="<?php echo base_url('admin/download_laporan/laporanbeliexcel/' . $beli_notrans . '/'  . $tgl_mulai . '/' . $tgl_selesai); ?>"><span
                                class="fa fa-print"></span>Excel</a>

                        <?php // } 
                        ?>
                        <a class="btn btn-xs btn-info" target="blank"
                            href="<?php echo base_url('admin/download_laporan/laporanbelipdf/' . $beli_notrans . '/'  . $tgl_mulai . '/' . $tgl_selesai); ?>"><span
                                class="fa fa-print"></span>PDF</a>
                    </div>

                </div>
            </div>
    </div>
    </section>
    </div>


    <!-- jQuery -->
    <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() . 'assets/dist/js/bootstrap-select.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/moment.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>

    <script>
    $(document).ready(function() {
        $('#laptabel').DataTable();
    });
    </script>

</body>

</html>