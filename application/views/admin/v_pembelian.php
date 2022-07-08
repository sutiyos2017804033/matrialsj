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
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . 'assets/css/bootstrap-datetimepicker.min.css' ?>">
</head>

<body>

    <!-- Navigation -->
    <?php
    $this->load->view('admin/menu');
    ?>


    <div class="col-lg-12">
        <center><?php echo $this->session->flashdata('msg'); ?></center>
        <h3 class="page-header">Pembelian Barang
            </h1>
    </div>
    </div>

    <!-- /.row -->
    <a class="btn btn-info" href="<?= base_url() . 'admin/pembelian/tambah_pembelian' ?>">Tambah Pembelian</a>

    <hr>


    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="myda">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>
                        <th>No. Transaksi</th>
                        <th>Nama Supplier</th>
                        <th>Tanggal Beli</th>
                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $periksa = $this->db->query("SELECT *  FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id GROUP BY a.beli_notrans DESC");
                    $ceking = $this->db->query("SELECT *  FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id ORDER BY a.beli_notrans DESC");
                    ?>
                    <?php
                    $no = 1;
                    foreach ($periksa->result_array() as $row) {

                    ?>
                    <tr>
                        <td style="text-align:center;"><?= $no ?></td>
                        <td><?= $row["beli_notrans"]; ?></td>
                        <td><?= $row["suplier_nama"]; ?></td>
                        <td style="text-align:right;"><?= date("d-m-Y", strtotime($row["beli_tanggal"])); ?></td>

                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-info"
                                href="<?php echo base_url('admin/pembelian/detail_pembelian/' . $row['beli_notrans']); ?>"
                                title="Detail"><span class="fa fa-search"></span></a>
                            <a class="btn btn-xs btn-danger"
                                href="#modalHapusPembelian<?php echo $row["beli_notrans"] ?>" data-toggle="modal"
                                title="Hapus"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>

                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <!-- /.container -->





    <!-- ============ MODAL ADD =============== -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Data Barang</h3>
                </div>
                <div class="modal-body" style="overflow:scroll;height:500px;">

                    <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                        <thead>
                            <tr>
                                <th style="text-align:center;width:40px;">No</th>
                                <th style="width:120px;">Kode Barang</th>
                                <th style="width:240px;">Nama Barang</th>
                                <th>Satuan</th>
                                <th style="width:100px;">Harga</th>
                                <th>Stok</th>
                                <th style="width:100px;text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($data->result_array() as $a) :
                                $no++;
                                $id = $a['barang_id'];
                                $nm = $a['barang_nama'];
                                $satuan = $a['barang_satuan'];
                                $harpok = $a['barang_harpok'];
                                $harjul = $a['barang_harjul'];
                                $stok = $a['barang_stok'];

                                $kat_id = $a['barang_kategori_id'];
                                $kat_nama = $a['kategori_nama'];
                            ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $nm; ?></td>
                                <td style="text-align:center;"><?php echo $satuan; ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                <td style="text-align:center;"><?php echo $stok; ?></td>
                                <td style="text-align:center;">
                                    <form action="<?php echo base_url() . 'admin/penjualan/add_to_cart' ?>"
                                        method="post">
                                        <input type="hidden" name="kode_brg" value="<?php echo $id ?>">
                                        <input type="hidden" name="nabar" value="<?php echo $nm; ?>">
                                        <input type="hidden" name="satuan" value="<?php echo $satuan; ?>">
                                        <input type="hidden" name="stok" value="<?php echo $stok; ?>">
                                        <input type="hidden" name="harjul"
                                            value="<?php echo number_format($harjul); ?>">
                                        <input type="hidden" name="diskon" value="0">
                                        <input type="hidden" name="qty" value="1" required>
                                        <button disabled type="submit" class="btn btn-xs btn-info" title="Pilih"><span
                                                class="fa fa-edit"></span>Pilih</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>

                </div>
            </div>
        </div>
    </div>

    <!--END MODAL-->























    <!-- modal hapus -->

    <!-- ============ MODAL HAPUS =============== -->
    <?php
    foreach ($periksa->result_array() as $a) {
        $id = $a['beli_notrans'];

    ?>
    <div id="modalHapusPembelian<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Hapus Barang</h3>
                </div>
                <form class="form-horizontal" method="post"
                    action="<?php echo base_url() . 'admin/pembelian/hapus_pembelian' ?>">
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
    $(document).ready(function() {
        $('#myda').DataTable();
    });
    </script>



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