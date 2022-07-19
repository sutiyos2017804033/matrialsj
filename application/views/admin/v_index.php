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
                        $dt = date('m');
                        $vl = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual where month(jual_tanggal)='$dt'")->row_array();

                        ?>
                        <h1>
                            Rp.<?= number_format($vl['total']); ?>
                            </h2>

                    </div>
                </div>
                <div class="col-md-4" style="padding:5px">
                    <div style="width:340px;height:173px;padding:10px;background-color:crimson;color:white">
                        <h4>
                            BARANG SUDAH HABIS </h4>
                        <hr style="border-style:groove;border-color:lightblue">
                        <h6> <b>3 Teratas</b> </h6>
                        <?php
                        $dt = date('d');
                        $n = 1;
                        $v = $this->db->query("SELECT * FROM tbl_barang where barang_stok = 0 limit 3")->result_array();
                        foreach ($v as $i) {
                        ?>
                            <h7>
                                <?= $n++; ?>.
                                <?= $i['barang_nama'] ?> | Stok : <?= $i['barang_stok'] ?>
                                <br>
                            </h7>
                        <?php }  ?>

                    </div>
                </div>

                <div class="col-md-4" style="padding:5px">
                    <div class="bg-warning" style="width:340px;height:173px;padding:10px;background-color:gold;color:black">
                        <h4>
                            BARANG HAMPIR HABIS =< 10 </h4>
                                <hr style="border-style:groove;border-color:lightblue">
                                <h6> <b>3 Teratas</b> </h6>
                                <?php
                                $dt = date('d');
                                $n = 1;
                                $v = $this->db->query("SELECT * FROM tbl_barang where barang_stok <= 10 limit 3")->result_array();
                                foreach ($v as $i) {
                                ?>
                                    <h7>
                                        <?= $n++; ?>.
                                        <?= $i['barang_nama'] ?> | Stok : <?= $i['barang_stok'] ?>
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
                        $dt = date('m');
                        $vl = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual where month(jual_tanggal)='$dt'")->row_array();

                        ?>
                        <h1>
                            Rp.<?= number_format($vl['total']); ?>
                            </h2>

                    </div>
                </div>
                <div class="col-md-4" style="padding:5px">
                    <div style="width:340px;height:173px;padding:10px;background-color:crimson;color:white">
                        <h4>
                            BARANG SUDAH HABIS </h4>
                        <hr style="border-style:groove;border-color:lightblue">
                        <h6> <b>3 Teratas</b> </h6>
                        <?php
                        $dt = date('d');
                        $n = 1;
                        $v = $this->db->query("SELECT * FROM tbl_barang where barang_stok = 0 limit 3")->result_array();
                        foreach ($v as $i) {
                        ?>
                            <h7>
                                <?= $n++; ?>.
                                <?= $i['barang_nama'] ?> | Stok : <?= $i['barang_stok'] ?>
                                <br>
                            </h7>
                        <?php }  ?>

                    </div>
                </div>

                <div class="col-md-4" style="padding:5px">
                    <div class="bg-warning" style="width:340px;height:173px;padding:10px;background-color:gold;color:black">
                        <h4>
                            BARANG HAMPIR HABIS =< 10 </h4>
                                <hr style="border-style:groove;border-color:lightblue">
                                <h6> <b>3 Teratas</b> </h6>
                                <?php
                                $dt = date('d');
                                $n = 1;
                                $v = $this->db->query("SELECT * FROM tbl_barang where barang_stok <= 10 limit 3")->result_array();
                                foreach ($v as $i) {
                                ?>
                                    <h7>
                                        <?= $n++; ?>.
                                        <?= $i['barang_nama'] ?> | Stok : <?= $i['barang_stok'] ?>
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
                <div class="col-md-11 portfolio-item">
                    <div class="thumbnail" style="height: 300px;">


                        <h3 class="card-title">GRAFIK PENJUALAN PERBULAN</h3>

                        <canvas id="myChart"></canvas>


                    </div>
                </div>


                <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Januari", "Februari", "Maret", "April", "Mei",
                                "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                            ],
                            datasets: [{
                                label: 'Grafik Penjualan',
                                data: [
                                    <?php
                                    $m = date('m');
                                    $y = date('Y');
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=01 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=02 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=03 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=04 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=05 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=06 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=07 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=08 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=09 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=10 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=11 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>,
                                    <?php
                                    $jumlah_bekerja = $this->db->query("SELECT sum(jual_total) as total FROM tbl_jual WHERE MONTH(jual_tanggal)=12 AND YEAR(jual_tanggal)='$y'")->row_array();
                                    echo $jumlah_bekerja['total'];
                                    ?>

                                ],
                                backgroundColor: [
                                    'rgb(37,9,149)',
                                    'rgb(64,191,253)',
                                    'rgb(164,191,3)',
                                    'rgb(111,191,3)',
                                    'rgb(122,191,333)',
                                    'rgb(64,991,333)',
                                    'rgb(64,191,3)',
                                    'rgb(64,191,3)',
                                    'rgb(64,191,3)',
                                    'rgb(64,191,3)',
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