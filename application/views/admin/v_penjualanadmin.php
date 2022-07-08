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

    <!-- Page Content -->

    <div class="col-lg-12">
        <center><?php echo $this->session->flashdata('msg'); ?></center>
        <h3 class="page-header">Transaksi Penjualan
        </h3>
    </div>
    </div>
    <!-- /.row -->




    <a class="btn btn-info btn-lg" href="<?php echo base_url('admin/penjualan/'); ?>">Tambah</a>
    <hr>


    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mylove">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>
                        <th>No Transaksi</th>
                        <th>Waktu Transaksi</th>

                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $periksa = $this->db->query("SELECT *  FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id GROUP BY a.jual_notrans DESC");
                    $ceking = $this->db->query("SELECT *  FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id ORDER BY a.jual_notrans DESC");
                    ?>
                    <?php
                    $no = 1;
                    foreach ($periksa->result_array() as $row) {

                    ?>
                    <tr>
                        <td style=" text-align:center;"><?= $no ?></td>
                        <td><?= $row["jual_notrans"]; ?></td>
                        <td style="text-align:right;"><?= date("d-m-Y, H:i:s", strtotime($row["jual_tanggal"])); ?>
                        </td>
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning"
                                href="<?php echo base_url('admin/penjualanadmin/detail_penjualan/' . $row['jual_notrans']); ?>"
                                title="Detail"><span class="fa fa-search"></span></a>
                            <a class="btn btn-xs btn-danger"
                                href="#modalHapusPenjualan<?php echo $row["jual_notrans"] ?>" data-toggle="modal"
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


    <?php
    foreach ($ceking->result_array() as $a) {
        $id = $a['jual_notrans'];
        $nm = $a['barang_nama'];
        $stn = $a['barang_satuan'];
        $harpok = $a['barang_harpok'];
        $stok = $a['barang_stok'];

        // $kat_id = $a['barang_kategori_id'];
        // $kat_nama = $a['kategori_nama'];
    ?>
    <div id="modalEditPenjualan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Edit Barang</h3>
                </div>
                <form class="form-horizontal" method="post"
                    action="<?php echo base_url() . 'admin/barang/edit_barang' ?>">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">No Transaksi</label>
                            <div class="col-xs-9">
                                <input name="kobar" class="form-control" type="text" value="<?php echo $id; ?>"
                                    placeholder="No Transaksi..." style="width:335px;" readonly>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-xs-3">Nama Barang : </label>
                            <div class="col-xs-9">
                                <p>
                                    <?php

                                        $querybarang = $this->db->get('tbl_barang');

                                        foreach ($querybarang->result_array() as $row) : ?>
                                    <?php echo $row["barang_nama"]; ?> <br>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-xs-3">Satuan</label>
                            <div class="col-xs-9">
                                <select name="satuan" class="selectpicker show-tick form-control"
                                    data-live-search="true" title="Pilih Satuan" data-width="80%"
                                    placeholder="Pilih Satuan" required>

                                    <?php

                                        $query = $this->db->get('tbl_satuan');

                                        foreach ($query->result_array() as $row) : ?>
                                    <option value="<?php echo $row["satuan_nama"]; ?>" <?php if ($stn == $row["satuan_nama"]) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                        <?php echo $row["satuan_nama"]; ?></option>
                                    <?php endforeach ?>


                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Harga Pokok</label>
                            <div class="col-xs-9">
                                <input name="harpok" class="harpok form-control" type="text"
                                    value="<?php echo $harpok; ?>" placeholder="Harga Pokok..." style="width:335px;"
                                    required>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-xs-3">Harga Jual</label>
                            <div class="col-xs-9">
                                <input name="harjul" class="harjul form-control" type="text"
                                    value="<?php echo $harjul; ?>" placeholder="Harga Jual Grosir..."
                                    style="width:335px;" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <!-- end modal edit -->
    <!-- modal hapus -->

    <!-- ============ MODAL HAPUS =============== -->
    <?php
    foreach ($periksa->result_array() as $a) {
        $id = $a['jual_notrans'];

    ?>
    <div id="modalHapusPenjualan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Hapus Data</h3>
                </div>
                <form class="form-horizontal" method="post"
                    action="<?php echo base_url() . 'admin/penjualanadmin/hapus_penjualan' ?>">
                    <div class="modal-body">
                        <p>Yakin mau menghapus data ini..?</p>
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


    </div>
    <!-- /.container -->

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
        $('#jml_uang').on("input", function() {
            var total = $('#total').val();
            var jumuang = $('#jml_uang').val();
            var hsl = jumuang.replace(/[^\d]/g, "");
            $('#jml_uang2').val(hsl);
            $('#kembalian').val(hsl - total);
        })

    });
    </script>



    <script type="text/javascript">
    $(document).ready(function() {
        $('#mydata').DataTable();
    });
    </script>



    <script type="text/javascript">
    $(function() {
        $('.jml_uang').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('#jml_uang2').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ''
        });
        $('#kembalian').priceFormat({
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
        $("#kode_brg").on("input", function() {
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
    $(document).ready(function() {
        $('#mylove').DataTable({
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