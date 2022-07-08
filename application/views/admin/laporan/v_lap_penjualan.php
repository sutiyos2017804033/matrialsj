<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan data penjualan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
</head>

<body onload="window.print()">
    <div id="laporan">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
            <!--<tr>
    <td><img src="<? php // echo base_url().'assets/img/kop_surat.png'
                    ?>"/></td>
</tr>-->
        </table>

        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;paddin-left:20px;">
                    <center>
                        <h4>LAPORAN PENJUALAN TOKO CAHAYA TERANG</h4>
                    </center><br />
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:800px;paddin-left:20px;">
                    <center>
                        <h4>Toko Cahaya Terang</h4>
                    </center><br />
                </td>
            </tr>

        </table>

        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>

        <table border="1" align="center" style="width:900px;margin-bottom:20px;">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga Jual</th>
                    <th>Qty</th>
                    <th>Diskon</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;
                    $nofak = $i['jual_notrans'];
                    $tgl = $i['jual_tanggal'];
                    $barang_id = $i['d_jual_barang_id'];
                    $barang_nama = $i['d_jual_barang_nama'];
                    $barang_satuan = $i['d_jual_barang_satuan'];
                    $barang_harjul = $i['d_jual_barang_harjul'];
                    $barang_qty = $i['d_jual_qty'];
                    $barang_diskon = $i['d_jual_diskon'];
                    $barang_total = $i['d_jual_total'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="padding-left:5px;"><?php echo $nofak; ?></td>
                        <td style="text-align:center;"><?php echo $tgl; ?></td>
                        <td style="text-align:center;"><?php echo $barang_id; ?></td>
                        <td style="text-align:left;"><?php echo $barang_nama; ?></td>
                        <td style="text-align:left;"><?php echo $barang_satuan; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_harjul); ?></td>
                        <td style="text-align:center;"><?php echo $barang_qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_diskon); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_total); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php
                $b = $jml->row_array();
                ?>
                <tr>
                    <td colspan="9" style="text-align:center;"><b>Total</b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['total']); ?></b></td>
                </tr>
            </tfoot>
        </table>
        <table align="left" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td>
                    <p> Dicetak Oleh : <?php echo $this->session->userdata('nama'); ?> </p>
                </td>
        </table>


        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td align="right">Tangerang, <?php echo date('d-M-Y') ?></td>

            </tr>
            <tr>
                <td align="right">
                    <p> Pemilik </p>
                </td>
            </tr>

            <tr>
                <td><br /><br /><br /><br /></td>
            </tr>
            <tr>
                <td align="right">Muhyidin</td>
            </tr>
            <tr>
                <td align="center"></td>
            </tr>
        </table>
        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <th><br /><br /></th>
            </tr>
            <tr>
                <th align="left"></th>
            </tr>
        </table>
    </div>
</body>

</html>_