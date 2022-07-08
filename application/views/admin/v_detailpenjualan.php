<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk MuhyidiN">
    <meta name="author" content="toko Muhyidin">

    <title>Aplikasi Penjualan</title>
    <?php
    $this->load->view('admin/footer');
    ?>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/cssprint/style.css' ?>">
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/dist/css/bootstrap-select.css' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-datetimepicker.min.css' ?>">
</head>

<body style="font-family:'Courier New', Courier, monospace">

    <!-- Navigation -->
    <?php
    $this->load->view('admin/menu');
    ?>


    <div class="col-lg-12">
        <center><?php echo $this->session->flashdata('msg'); ?></center>
        <h1 class="page-header">Detail Penjualan
            <small>Barang</small>
            <button class="btn btn-success btn-xs tombolprint" onclick="window.print()">Print</button>
            <!-- <button> <a class="btn btn-success btn-xs tombolprint" target="_blank" href="<?php echo base_url() . 'admin/excel' ?>">EXPORT EXCEL</a></button> -->

        </h1>

    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    <div class="row" style="padding: 40px;">
        <?php
        $jual_notrans = $this->uri->segment(4);
        $periksa = $this->db->query("SELECT * FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE a.jual_notrans='$jual_notrans' GROUP BY a.jual_notrans='$jual_notrans'");
        foreach ($periksa->result_array() as $row) {
        ?>

            <div class="col-12">
                <table border="0" align="left" style="width:700px;border:none;">
                    <tr>
                        <th style="text-align:left;">No.Transaksi</th>
                        <th style="text-align:left;">: <?php echo $row['jual_notrans']; ?></th>

                    </tr>
                    <tr>
                        <th style="text-align:left;">Tanggal</th>
                        <th style="text-align:left;">: <?php echo date("d-m-Y, H:i:s", strtotime($row["jual_tanggal"])); ?>
                        </th>

                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:left;">Keterangan</th>
                        <th style="text-align:left;">: - <?php //echo $b['jual_keterangan']; 
                                                            ?> </th>

                        </th>
                    </tr>
                </table>


            </div>
        <?php
        }
        ?>
        <br>
        <br> <br> <br>
        <div class="row">
            <div class="col-lg-12">
                <table style="width:800px;" class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th style="text-align:center;">Kode Barang</th>
                            <th style="text-align:center;">Nama Barang</th>
                            <th style="text-align:center;">Satuan</th>
                            <th style="text-align:center;">Jumlah Beli</th>
                            <th style="text-align:center;">Harga Jual</th>
                            <th style="text-align:center;">Diskon</th>
                            <th style="text-align:center;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $periksa = $this->db->query("SELECT *  FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE a.jual_notrans='$jual_notrans' ORDER BY a.jual_notrans='$jual_notrans' DESC");
                        ?>
                        <?php
                        $no = 1;
                        $total = 0;
                        $totalb = 0;

                        foreach ($periksa->result_array() as $row) {

                            $total = $row['barang_harjul'];
                            $jumlahbarang = $row["d_jual_qty"];
                            $total2 = $total * $jumlahbarang;
                            $totalb += $row['d_jual_total'];

                        ?>
                            <tr>
                                <td style=" text-align:center;"><?= $no ?></td>
                                <td rowspan="1"><?= $row["barang_id"]; ?></td>
                                <td><?= $row["barang_nama"]; ?></td>
                                <td><?= $row["barang_satuan"]; ?></td>
                                <td><?= $row["d_jual_qty"]; ?></td>
                                <td style="text-align:right;">Rp. <?= number_format($row["barang_harjul"]); ?></td>
                                <td style="text-align:right;">Rp. <?= number_format($row["d_jual_diskon"]); ?></td>
                                <td style="text-align:right;">Rp. <?= number_format($row["d_jual_total"]); ?></td>


                            </tr>

                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7">Total Bayar</th>
                            <th style="text-align:right;">Rp. <?php echo number_format($totalb); ?></th>

                        </tr>
                        <tr>
                            <th colspan="7" style="text-align:left;">Tunai</th>
                            <th style="text-align:right;">: <?php echo 'Rp ' . number_format($row['jual_jml_uang']); ?>
                        </tr>
                        <tr>
                            <th colspan="7" style="text-align:left;">Kembalian</th>
                            <th style="text-align:right;">: <?php echo 'Rp ' . number_format($row['jual_kembalian']); ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container -->



    <!-- end modal hapus -->
    <hr>
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
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker').datetimepicker({
                format: 'DD MMMM YYYY HH:mm',
            });

            $('#datepicker').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datepicker2').datetimepicker({
                format: 'YYYY-MM-DD',
            });

            $('#timepicker').datetimepicker({
                format: 'HH:mm'
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('.harpok').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: ','
            });
            $('.harjul').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: ','
            });
        });
    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            //Ajax kabupaten/kota insert
            $("#kode_brg").focus();
            $("#kode_brg").keyup(function() {
                var kobar = {
                    kode_brg: $(this).val()
                };
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/penjualanadmin/get_barang'; ?>",
                    data: kobar,
                    success: function(msg) {
                        $('#detail_barang').html(msg);
                    }
                });
            });

            $("#kode_brg").keypress(function(e) {
                if (e.which == 13) {
                    $("#jumlah").focus();
                }
            });
        });
    </script>


    <!-- jQuery -->

    <script type="text/javascript">
        $(function() {
            $('.harpok').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: ','
            });
            $('.harjul').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: ','
            });
        });
    </script>

</body>

</html>