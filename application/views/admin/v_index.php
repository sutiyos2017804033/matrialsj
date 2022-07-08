<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By Mfikri.com">
    <meta name="author" content="M Fikri Setiadi">

    <title>Aplikasi Penjualan</title>
    <?php
    $this->load->view('admin/footer');
    ?>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">

    <link href="<?php echo base_url() . 'assets/img/logo.png' ?>" rel="icon">

    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url() . 'assets/vendor/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() . 'assets/vendor/fontawesome-free/css/all.min.css' ?>" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() . 'assets/css/sb-admin.css' ?>" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    <script src="<?php echo base_url() . 'vendor/chartjs/Chart.js' ?>"></script>

</head>

<body>

    <?php $h = $this->session->userdata('akses'); ?>
    <?php $u = $this->session->userdata('user'); ?>

    <!-- Navigation -->
    <?php
    if ($h == '2') {

        $this->load->view('admin/menutop');
    } else {
        $this->load->view('admin/menu');
    } ?>
    <!-- Page Content -->
    <div class="contianer" style="padding: 20px;">

        <?php $h = $this->session->userdata('akses'); ?>
        <?php $u = $this->session->userdata('user'); ?>

        <?php
        if ($h == '1' || $h == '3') { ?>

            <div class=" row">
                <div class="col-md-4" style="padding:5px ;" style="height:800px">
                    <div class="bg-info" style="width:340px;height:173px;padding:10px">
                        <h4>
                            PENDAPATAN BULAN INI
                        </h4>
                        <hr style="border-style:groove;border-color:lightblue">
                        <?php
                        $dt = date('d');
                        $vl = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual where month(jual_tanggal)='$dt'")->row_array();

                        ?>
                        <h1>
                            Rp.<?= number_format($vl['total']); ?>
                            </h2>

                    </div>
                </div>
                <div class="col-md-4" style="padding:5px">
                    <div class="bg-success" style="width:340px;height:173px;padding:10px">
                        <h4>
                            BARANG HAMPIR HABIS =< 10 </h4>
                                <hr style="border-style:groove;border-color:lightblue">
                                <h6> <b>3 Teratas</b> </h6>
                                <?php
                                $dt = date('d');
                                $v = $this->db->query("SELECT * FROM tbl_barang where barang_stok >= 34 limit 3")->result_array();
                                foreach ($v as $i) {
                                ?>
                                    <h7>
                                        <?= $i['barang_nama'] ?>
                                        <br>
                                    </h7>
                                <?php }  ?>

                    </div>
                </div>
                <div class="col-md-4" style="padding:5px ;" style="height:800px">
                    <div class="bg-warning" style="width:340px;height:173px;padding:10px">
                        <h4>
                            BARANG PALING LARIS </h4>
                        <hr style="border-style:groove;border-color:lightblue">
                        <h6> <b>3 Teratas</b> </h6>
                        <?php
                        $dt = date('d');
                        $v = $this->db->query("SELECT d_jual_barang_nama, SUM(d_jual_qty) as qty FROM tbl_detail_jual
                    GROUP BY d_jual_barang_nama ORDER BY  qty DESC LIMIT 3;")->result_array();
                        foreach ($v as $i) {
                        ?>
                            <h7>
                                <?= $i['d_jual_barang_nama'] ?>
                                <br>
                            </h7>
                        <?php }  ?>

                    </div>
                </div>
            </div>
        <?php  } ?>


        <?php
        if ($h == '2') { ?>

            <div class=" row" style="padding: 50px;">
                <div class="col-md-4" style="padding:5px ;" style="height:800px">
                    <div class="bg-info" style="width:340px;height:173px;padding:10px">
                        <h4>
                            PENDAPATAN BULAN INI
                        </h4>
                        <hr style="border-style:groove;border-color:lightblue">
                        <?php
                        $dt = date('d');
                        $vl = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual where month(jual_tanggal)='$dt'")->row_array();

                        ?>
                        <h1>
                            Rp.<?= number_format($vl['total']); ?>
                            </h2>

                    </div>
                </div>
                <div class="col-md-4" style="padding:5px">
                    <div class="bg-success" style="width:340px;height:173px;padding:10px">
                        <h4>
                            BARANG HAMPIR HABIS =< 10 </h4>
                                <hr style="border-style:groove;border-color:lightblue">
                                <h6> <b>3 Teratas</b> </h6>
                                <?php
                                $dt = date('d');
                                $v = $this->db->query("SELECT * FROM tbl_barang where barang_stok >= 34 limit 3")->result_array();
                                foreach ($v as $i) {
                                ?>
                                    <h7>
                                        <?= $i['barang_nama'] ?>
                                        <br>
                                    </h7>
                                <?php }  ?>

                    </div>
                </div>
                <div class="col-md-4" style="padding:5px ;" style="height:800px">
                    <div class="bg-warning" style="width:340px;height:173px;padding:10px">
                        <h4>
                            BARANG PALING LARIS </h4>
                        <hr style="border-style:groove;border-color:lightblue">
                        <h6> <b>3 Teratas</b> </h6>
                        <?php
                        $dt = date('d');
                        $v = $this->db->query("SELECT d_jual_barang_nama, SUM(d_jual_qty) as qty FROM tbl_detail_jual
                    GROUP BY d_jual_barang_nama ORDER BY  qty DESC LIMIT 3;")->result_array();
                        foreach ($v as $i) {
                        ?>
                            <h7>
                                <?= $i['d_jual_barang_nama'] ?>
                                <br>
                            </h7>
                        <?php }  ?>

                    </div>
                </div>
            </div>
        <?php  } ?>



    </div>

    </div>
    <!-- /.row -->
    <div class="container">
        <?php $h = $this->session->userdata('akses'); ?>
        <?php $u = $this->session->userdata('user'); ?>

        <!-- Projects Row -->
        <!-- konten admin -->
        <div class="row">
            <?php if ($h == '1') { ?>
                <div class="col-lg-12">

                </div>
                <div class="col-md-6 portfolio-item">
                    <div class="thumbnail" style="height: 400px;">


                        <h3 class="card-title">GRAFIK PENJUALAN</h3>

                        <canvas id="myChart"></canvas>


                    </div>
                </div>


                <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["2020", "2021", "2022", "2023"],
                            datasets: [{
                                label: 'Grafik Penjualan',
                                data: [
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT * FROM tbl_jual WHERE YEAR (jual_tanggal)='2020';");
                                    echo $jumlah_bekerja->num_rows();
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT * FROM tbl_jual WHERE YEAR (jual_tanggal)='2021';");
                                    echo $jumlah_bekerja->num_rows();
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT * FROM tbl_jual WHERE YEAR (jual_tanggal)='2022';");
                                    echo $jumlah_bekerja->num_rows();
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT * FROM tbl_jual WHERE YEAR (jual_tanggal)='2023';");
                                    echo $jumlah_bekerja->num_rows();
                                    ?>,

                                ],
                                backgroundColor: [
                                    'rgb(37,9,149)',
                                    'rgb(64,191,253)',
                                    'rgb(64,191,3)',

                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 1, 235, 1)',
                                    'rgba(255, 206, 86, 1)'

                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>

                <?php
                $data = $this->db->query("SELECT d_jual_barang_nama, SUM(d_jual_total) d_jual_total 
            FROM tbl_detail_jual GROUP BY d_jual_barang_nama 
            ORDER BY d_jual_total DESC LIMIT 1")
                ?>
                <?php

                foreach ($data->result() as $pie) {
                    $nama[] = $pie->d_jual_barang_nama;
                    $total[] = (float) $pie->d_jual_total;
                } ?>

                <script>
                    var ctx = document.getElementById("barang").getContext('2d');
                    var barang = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: <?php echo json_encode($nama); ?>,
                            datasets: [{
                                label: 'Grafik Penjualan',
                                data: [

                                    <?php echo json_encode($total); ?>

                                ],
                                backgroundColor: [
                                    'rgb(0,191,255)',
                                    'rgba(250, 0, 0)',
                                    'rgba(250,9, 10)'

                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 0)'

                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>

            <?php } ?>
        </div>




        <!-- /.row -->

        <!-- Projects Row -->


        <!-- /.row -->

        <!-- /.container -->

        <?php
        $this->load->view('admin/header');
        ?>
</body>

</html>