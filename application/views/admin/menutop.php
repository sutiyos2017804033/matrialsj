<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:darkblue;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="color:white;" href="<?php echo base_url() . 'welcome' ?>">Aplikasi</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php $h = $this->session->userdata('akses'); ?>
                <?php $u = $this->session->userdata('user'); ?>
                <?php if ($h == '1') { ?>
                    <li class="dropdown">
                        <a style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span style="color:white;" aria-hidden="true"></span>Master</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url() . 'admin/barang' ?>"><span class="fa fa-shopping-cart" aria-hidden="true"></span>Data Barang</a></li>
                            <li><a href="<?php echo base_url() . 'admin/satuan' ?>"><span class="fa fa-cubes" aria-hidden="true"></span>Data Satuan</a></li>
                            <li><a href="<?php echo base_url() . 'admin/suplier' ?>"><span class="fa fa-cubes" aria-hidden="true"></span>Data Supplier</a></li>
                        </ul>
                    </li>
                    <!--dropdown-->
                    <li class="dropdown">
                        <a style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span style="color:white;" aria-hidden="true"></span> Transaksi</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url() . 'admin/penjualanadmin' ?>"><span class="fa fa-shopping-cart" aria-hidden="true"></span>Input Data Penjualan</a></li>
                            <li><a href="<?php echo base_url() . 'admin/pembelian' ?>"><span class="fa fa-cubes" aria-hidden="true"></span>Input Data Pembelian</a></li>

                        </ul>
                    </li>
                    <!--ending dropdown-->
                    <li>
                        <a style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span style="color:white;" aria-hidden="true"></span>Laporan</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url() . 'admin/penjualanadmin' ?>"><span class="fa fa-shopping-cart" aria-hidden="true"></span>Laporan Penjualan</a></li>
                            <li><a href="<?php echo base_url() . 'admin/pembelian' ?>"><span class="fa fa-cubes" aria-hidden="true"></span>Laporan Pembelian</a></li>

                        </ul>

                    </li>

                <?php } ?>

                <?php if ($h == '2') { ?>
                    <!--dropdown-->
                    <li class="dropdown">
                        <a style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span style="color:white;" aria-hidden="true"></span> Transaksi</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url() . 'admin/penjualan' ?>"><span class="fa fa-shopping-cart" aria-hidden="true"></span>Input Data Penjualan</a></li>

                        </ul>
                    </li>
                    <!--ending dropdown-->
                <?php } ?>
            </ul>









            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown nav navbar-nav navbar-right">
                    <a style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Logout"> <img style="" width="25px" src="<?php echo base_url() . 'assets/img/logo.png' ?>" />
                        <?php echo $this->session->userdata('nama'); ?></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a style="color:black;" href="<?php echo base_url() . 'administrator/logout' ?>"><span class="fa fa-user"></span> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>


        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>