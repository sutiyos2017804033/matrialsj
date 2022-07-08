<link rel="stylesheet" href="<?php echo base_url() . 'assets/cssprint/style.css' ?>">
<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper" style="background-color:darkslategray;">
        <ul class="sidebar-nav  pesan3">
            <li style="margin-top: 20px;margin-left:30px ;" class="sidebar-brand"><a href="<?php echo base_url() . 'welcome' ?>"><img src="<?php echo base_url() . 'assets/img/logo.png' ?>" style="width:150px"></a>
            </li>
            <?php $h = $this->session->userdata('akses'); ?>
            <?php $u = $this->session->userdata('user'); ?>
            <?php if ($h == '1') { ?>
                <br>
                <br>

                <div style="color:white" class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button style="color:white" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Master Data
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div style="color:white" class="card-body">
                        <li><a style="color:white" href="<?php echo base_url() . 'admin/kategori' ?>">Kategori</a>
                        </li>
                        <li><a style="color:white" href="<?php echo base_url() . 'admin/satuan' ?>">Satuan</a>
                        </li>
                        <li><a href="<?php echo base_url() . 'admin/suplier' ?>">Suplier</a></li>
                        <li><a href="<?php echo base_url() . 'admin/barang' ?>">Barang</a>
                        </li>
                        <li><a href="<?php echo base_url() . 'admin/pengguna' ?>">Pengguna</a>
                        </li>

                        <!-- <li><a href="<?php echo base_url() . 'admin/retur' ?>">Retur Penjualan</a>
                </li> -->
                    </div>
                </div>


                <div class="card-header" id="headingTo">
                    <h5 class="mb-0">
                        <button style="color:white" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTo" aria-expanded="false" aria-controls="collapseTo">
                            Transaksi
                        </button>
                    </h5>
                </div>
                <div id="collapseTo" class="collapse" aria-labelledby="headingTo" data-parent="#accordion">
                    <div class="card-body">
                        <li> <a href="<?php echo base_url() . 'admin/pembelian' ?>">Pembelian</a> </li>

                        <li><a href="<?php echo base_url() . 'admin/penjualanadmin' ?>">Penjualan</a></li>

                    </div>
                </div>
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button style="color:white" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Laporan
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <li> <a href="<?php echo base_url() . 'admin/pembelianlaporan' ?>">Laporan Pembelian </a> </li>
                        <li> <a href="<?php echo base_url() . 'admin/laporanbarang' ?>">Laporan Barang</a> </li>
                        <li> <a href="<?php echo base_url() . 'admin/penjualanlaporan' ?>">Laporan Penjualan</a> </li>
                    </div>
                </div>


                <!-- <li><a href="<?php echo base_url() . 'admin/grafik' ?>">Grafik</a></li> -->



                <li><a href="<?php echo base_url() . 'administrator/logout' ?>">Logout</a>
                </li>
            <?php } ?>
            <?php if ($h == '2') { ?>
                <li><a href="<?php echo base_url() . 'admin/penjualan' ?>">Transaksi Penjualan</a>
                <li><a href="<?php echo base_url() . 'administrator/logout' ?>">Logout</a>
                </li>
            <?php } ?>
            <!-- pemilik -->

            <?php if ($h == '3') { ?>
                <div class="card-header" id="headingThree" style="margin-top: 60px;;">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Laporan
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <li> <a href="<?php echo base_url() . 'admin/pembelianlaporan' ?>">Laporan Pembelian </a> </li>
                        <li> <a href="<?php echo base_url() . 'admin/laporanbarang' ?>">Laporan Barang</a> </li>
                        <li> <a href="<?php echo base_url() . 'admin/penjualanlaporan' ?>">Laporan Penjualan</a> </li>
                    </div>
                </div>
                </li>

                </li>
                <li><a href="<?php echo base_url() . 'administrator/logout' ?>">Logout</a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <!-- Page content -->
    <div id="page-content-wrapper">
        <div id="modalpesan" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Pesan Notifikasi</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $periksa = $this->db->query("SELECT *  FROM tbl_barang WHERE barang_stok");
                        foreach ($periksa->result_array() as $key => $value) :
                            $notif = $value['barang_stok'];
                            if ($notif <= 10) { ?>
                                <div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'>
                                    </span><?php echo $value['barang_id'] ?> | <?php echo $value['barang_nama'] ?> | Stok :
                                    <?php echo $value['barang_stok'] ?><a style='color:red'> Stok Barang Hampir Habis</a> <a style='color:blue'>Hubungin Admin Untuk Membeli Barang</a></div>
                            <?php  } ?>
                        <?php endforeach ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">