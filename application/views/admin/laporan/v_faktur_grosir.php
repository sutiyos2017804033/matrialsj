<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Struk Pembelian Barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php //echo base_url('assets/css/laporan.css') 
                                    ?>" />
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
</head>

<body onload="window.print()">
    <div>
        <table align="center" style="width:600px;">
            <tr>
                <center> <img src="<?php echo base_url() . 'assets/img/kop_surat.png' ?>" width="100" height="100" />
                </center>
            </tr>

            <tr>
                <center>

                    <h4>Toko Bangunan Suci Jaya </h4>
                </center>
            </tr>
            <tr>
                <center>

                    <h5>Jl. Parakan - Rumbut Ds. Nameng Kec. Rangkas Bitung <br>
                        Telp. 085217133859</h5>
                </center>
            </tr>
        </table>
        <br>

        <?php
        $b = $data->row_array();
        ?>
        <table class="table" align="center" style="width: 650px;">
            <tr>
                <center>
                    <td> <b>Struk Pembelian</b></td>
                </center>
                <td>

                </td>

            </tr>
            <tr>
                <th style="width:150px;">No. Transaksi</th>
                <th style="width:50px;">: <?php echo $b['jual_notrans']; ?></th>

            </tr>
            <tr>
                <th style="text-align:left;">Tanggal</th>
                <th style="text-align:left;">: <?php echo $b['jual_tanggal']; ?></th>
            </tr>
            <tr>
                <th style="text-align:left;">Kasir</th>
                <th style="text-align:left;">: <?php echo $this->session->userdata('nama'); ?></th>
            </tr>

        </table>
        <table class="table" align="center" style="width:650px;margin-bottom:20px;">
            <thead>
                <tr class="danger">
                    <th style="width:50px;">No</th>
                    <th style="text-align: center;">Nama Barang</th>
                    <th style="text-align: center;">Satuan</th>
                    <th style="text-align: center;">Harga</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th style="text-align: center;">Diskon</th>
                    <th style="text-align: center;">SubTotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;

                    $nabar = $i['d_jual_barang_nama'];
                    $satuan = $i['d_jual_barang_satuan'];

                    $harjul = $i['d_jual_barang_harjul'];
                    $qty = $i['d_jual_qty'];
                    $diskon = $i['d_jual_diskon'];
                    $total = $i['d_jual_total'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="text-align:left;"><?php echo $nabar; ?></td>
                        <td style="text-align:center;"><?php echo $satuan; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                        <td style="text-align:center;"><?php echo $qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($diskon); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($total - $diskon); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>

                <tr>
                    <td colspan="6" style="text-align:right;"><b>Total</b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['jual_total']); ?></b></td>

                </tr>
                <tr>
                    <td colspan="6" style="text-align:right;"><b>Tunai</b></td>
                    <td style="text-align:right;">
                        <b><?php echo 'Rp ' . number_format($b['jual_jml_uang']); ?></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align:right;"><b>Kembalian</b></td>
                    <td style="text-align:right;">
                        <b><?php echo 'Rp ' . number_format($b['jual_kembalian']); ?></b>
                    </td>
                </tr>
            </tfoot>
        </table>
        <table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td></td>
        </table>

        <center>
            <h4> Terima kasih atas kunjunganya </h4>
            <p><?= $b['jual_keterangan'] ?></p>
        </center>
        <table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <th><br /><br /></th>
            </tr>
            <tr>
                <th align="left"></th>
            </tr>
        </table>
    </div>


</body>

</html>