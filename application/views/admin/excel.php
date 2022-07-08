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

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan Pembelian.xls");
    ?>

    <!-- Navigation -->



    <div class="col-lg-12">
        <center><?php echo $this->session->flashdata('msg'); ?></center>
        <h1 class="page-header">Detail Pembelian
            <small>Barang</small>
        </h1>
    </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    <div class="row">
        <?php
        $periksa = $this->db->query("SELECT * FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id GROUP BY a.beli_notrans DESC");
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
                <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Beli</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $periksa = $this->db->query("SELECT *  FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id ORDER BY a.beli_notrans DESC");
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
    <!-- /.container -->
    <!-- MODAL EDIT DAN HAPUS -->

    <!-- ============ MODAL EDIT =============== -->

    <?php
    // foreach ($periksa->result_array() as $a) {
    //     $id = $a['beli_nofak'];
    //     $nm_s = $a['suplier_nama'];
    //     $nm = $a['barang_nama'];
    //     $tgl_beli = $a['beli_tanggal'];
    // $harpok = $a['barang_harpok'];
    // $stok = $a['barang_stok'];
    // $min_stok = $a['barang_min_stok'];
    // $kat_id = $a['barang_kategori_id'];
    // $kat_nama = $a['kategori_nama'];
    ?>
    <!-- <div id="modalDetailPembelian<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Detail</h3>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">No Nota :</label>
                            <div class="col-xs-9">
                                <p><?php echo $id; ?></p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Beli :</label>
                            <div class="col-xs-9">
                                <p> <?php echo $tgl_beli; ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Nama Supplier</label>
                            <div class="col-xs-9">
                                <p> <?php echo $nm_s; ?>"
                            </div>
                        </div>


                        <div class="form-group">

                            <label class="control-label col-xs-3">Nama Barang</label>
                            <div class="col-xs-9">

                                <?php foreach ($ceking->result_array() as $k2) {
                                    $id_kat = $k2['barang_id'];
                                    $nm_kat = $k2['barang_nama'];
                                ?>
                                    <?php echo $id_kat; ?> <br> <?php echo $nm_kat; ?>
                                <?php } ?>

                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button type="submit" class="btn btn-info" onclick="printPage()">Print</button>
                    </div>

                </div>
            </div>
        </div>
    <?php
    // }
    ?> -->
    <!-- end modal edit -->
    <!-- modal hapus -->

    <!-- ============ MODAL HAPUS =============== -->
    <?php
    foreach ($periksa->result_array() as $a) {
        $id = $a['beli_notrans'];

    ?>
        <div id="modalHapusPembelian<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Barang</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/pembelian/hapus_pembelian' ?>">
                        <div class="modal-body">
                            <p>Yakin mau menghapus data barang ini..?</p>
                            <input name="kode" type="hidden" value="<?php echo $id; ?>">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

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


    <!-- jQuery -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable({
                "language": {
                    "search": "Cari",
                    "info": "Menampilkan _START_ Sampai _END_ Dari _TOTAL_ data",
                    "lengthMenu": "Menampilkan _MENU_ baris",
                    "infoEmpty": "Tidak ditemukan",
                    "infoFiltered": "(pencarian dari _MAX_ data)",
                    "zeroRecords": "Data tidak ditemukan",
                    "paginate": {
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya",
                    }
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