<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description">
    <meta name="author" content="">

    <title>Pembelian</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-datetimepicker.min.css' ?>">
</head>

<body style="font-family:'Courier New', Courier, monospace">

    <!-- Navigation -->


    <!-- Navigation -->
    <?php
    $this->load->view('admin/menu');
    ?>

    <div class="container">

        <div class="col-lg-12">
            <center><?php echo $this->session->flashdata('msg'); ?></center>
            <h1 class="page-header">Detail Pembelian Barang

                <button class="btn btn-success btn-xs tombolprint" onclick="window.print()">Print</button>
                <!-- <button <a class="btn btn-success btn-xs tombolprint" target="_blank" href="<?php echo base_url() . 'admin/excel' ?>">EXPORT EXCEL</a></button>  -->

            </h1>
        </div>

        <!-- /.row -->
        <!-- Projects Row -->
        <div class="container" style="padding: 40px;">
            <div class="row">
                <?php
                $beli_notrans = $this->uri->segment(4);
                $periksa = $this->db->query("SELECT * FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE a.beli_notrans='$beli_notrans' GROUP BY a.beli_notrans='$beli_notrans'");
                foreach ($periksa->result_array() as $row) {
                ?>

                    <div class="col-12">
                        <table>
                            <tr>
                                <th>No. Transaksi</th>
                                <th> &nbsp;&nbsp;:</th>
                                <th> &nbsp;<?= $row["beli_notrans"]; ?> </th>
                            </tr>
                            <tr>
                                <th>Tanggal Beli </th>
                                <th> &nbsp;&nbsp;:</th>
                                <th> &nbsp;<?= $row["beli_tanggal"]; ?> </th>
                            </tr>
                            <tr>
                                <th>Supplier </th>
                                <th> &nbsp;&nbsp;:</th>
                                <th> &nbsp;<?= $row["suplier_nama"]; ?> || <?= $row["suplier_alamat"]; ?></th>
                            </tr>
                        </table>

                    </div>
                <?php
                }
                ?>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <table style="width: 700px;" class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                            <thead>
                                <tr>
                                    <th style="text-align:center;width:40px;">No</th>
                                    <th style="text-align:center;">Kode Barang</th>
                                    <th style="text-align:center;">Nama Barang</th>
                                    <th style="text-align:center;">Jumlah Beli</th>
                                    <th style="text-align:center;">Harga Satuan</th>
                                    <th style="text-align:center;">Total</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $periksa = $this->db->query("SELECT *  FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE a.beli_notrans='$beli_notrans' ORDER BY a.beli_notrans='$beli_notrans' DESC");
                                ?>
                                <?php
                                $no = 1;
                                $total = 0;
                                $totalb = 0;

                                foreach ($periksa->result_array() as $row) {

                                    $total = $row['barang_harpok'];
                                    $jumlahbarang = $row["d_beli_jumlah"];
                                    $total2 = $total * $jumlahbarang;
                                    $totalb += $total2;

                                ?>
                                    <tr>
                                        <td style="text-align:center;"><?= $no ?></td>
                                        <td rowspan="1"><?= $row["barang_id"]; ?></td>
                                        <td><?= $row["barang_nama"]; ?></td>
                                        <td><?= $row["d_beli_jumlah"]; ?></td>
                                        <td style="text-align:right;">Rp. <?= number_format($row["barang_harpok"], 2); ?></td>
                                        <td style="text-align:right;">Rp. <?= number_format($total2, 2); ?></td>

                                    </tr>

                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total Bayar</th>
                                    <th style="text-align:right;">Rp. <?php echo number_format($totalb, 2); ?></th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
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
                    url: "<?php echo base_url() . 'admin/pembelian/get_barang'; ?>",
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