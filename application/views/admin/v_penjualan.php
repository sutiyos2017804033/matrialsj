<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description">
    <meta name="author">
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-datetimepicker.min.css' ?>">
</head>

<body style="background-color:#fff;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ;">

    <!-- Navigation -->
    <?php
    $this->load->view('admin/menutop');
    ?>

    <!-- Page Content -->
    <div class="container" style="margin-top: 90px;">

        <div class="col-lg-12">
            <center><?php echo $this->session->flashdata('msg'); ?></center>
            <h1 class="page-header">Transaksi Penjualan

            </h1>
        </div>

        <div class="row">

            <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">01. Input Barang terlebih dahulu</div>
                    <div class="panel-body">

                        <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Cari
                                Barang</small></a>

                        <form action="<?php echo base_url() . 'admin/penjualan/add_to_cart' ?>" method="post">
                            <table style="color:#000000">
                                <tr>
                                    <th>Kode Barang</th>
                                </tr>
                                <tr>
                                    <th width="200px">
                                        <select class="form-control selectpicker" title="Cari Barang" data-live-search="true" name="kode_brg" id="kode_brg">
                                            <?php
                                            $var = $this->db->query("SELECT * FROM tbl_barang")->result_array();
                                            foreach ($var as $key => $row) { ?>

                                                <option value="<?= $row['barang_id'] ?>"><?= $row['barang_id'] ?> | <?= $row['barang_nama'] ?> | Stok : | <?= $row['barang_stok'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <!-- <input size="20px" type="text" name="kode_brg" id="kode_brg"> -->
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="detail_barang">
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-8">

                <div class="panel panel-primary">
                    <div class="panel-heading">02. input Data Penjualan</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:20px;color:#000000;">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th style="text-align:center;">Satuan</th>
                                    <th style="text-align:center;">Harga(Rp)</th>
                                    <th style="text-align:center;">Qty</th>
                                    <th style="text-align:center;">Sub Total</th>
                                    <th style="text-align:center;">Diskon(Rp)</th>
                                    <th style="text-align:center;">T.Setelah Diskon</th>
                                    <th style="width:100px;text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($this->cart->contents() as $items) : ?>
                                    <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                                    <tr>
                                        <td><?= $items['id']; ?></td>
                                        <td><?= $items['name']; ?></td>
                                        <td style="text-align:center;"><?= $items['satuan']; ?></td>
                                        <td style="text-align:right;"><?php echo number_format($items['amount']); ?></td>
                                        <td style="text-align:center;"><?php echo number_format($items['qty']); ?></td>
                                        <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?> </td>
                                        <td style="text-align:right;"><?php echo number_format($items['disc']); ?></td>
                                        <td style="text-align:right;">
                                            <?php echo number_format($items['subtotal'] - $items['disc']); ?></td>


                                        <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/penjualan/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                                    </tr>

                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <form action="<?php echo base_url() . 'admin/penjualan/simpan_penjualan' ?>" method="post">
                            <table>

                                <?php $b = 0;
                                foreach ($this->cart->contents() as $items)

                                    $b += $items['disc'];

                                ?>

                                <tr>
                                    <td style="width:760px;" rowspan="2">
                                        <button type="submit" class="btn btn-dark btn-lg">
                                            Simpan</button>
                                    </td>
                                    <th style="width:140px;">Total Belanja(Rp)</th>
                                    <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total() - $b); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                                    </th>
                                    <input type="hidden" id="total" name="total" value="<?php
                                                                                        echo $this->cart->total() - $b ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                                </tr>
                                <tr>
                                    <th>Tunai(Rp)</th>
                                    <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                                    <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th>Kembalian(Rp)</th>
                                    <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                                    </th>
                                </tr>

                            </table>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">

            <!-- /.row -->
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
                                        <!-- <th style="width:100px;text-align:center;">Aksi</th> -->
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
                                            <!-- <td style="text-align:center;">
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
                                                <button disabled type="submit" class="btn btn-xs btn-info"
                                                    title="Pilih"><span class="fa fa-edit"></span>Pilih</button>
                                            </form>
                                        </td> -->
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

            <hr>



        </div>
        <!-- /.container -->
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
            $("#kode_brg").on("change", function() {
                var kobar = {
                    kode_brg: $(this).val()
                };
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/penjualan/get_barang'; ?>",
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


</body>

</html>