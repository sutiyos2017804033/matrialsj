<?php


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Penjualan.xls");

$jual_notrans = $this->uri->segment(4);
$tgl_mulai = $this->uri->segment(5);
$tgl_selesai = $this->uri->segment(6);

// print untuk per kode
$ambil = $this->db->query("SELECT DISTINCT jual_notrans, jual_tanggal  FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans
JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE jual_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
$row = $ambil->result_array();



// print untuk per kode
$getdata = $this->db->query("SELECT *  FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans
JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE jual_notrans='$jual_notrans'");
$rows = $getdata->result_array();
if (!$row) {
    echo "<h1 align='center'>Toko Bangunan Suci Jaya </h1>";
    echo   "<h2 align='center'> Laporan Penjualan No. Transaksi :" . $jual_notrans . "</h2>";
    echo  "<table class='table table=bordered' border='1'>";
    echo "<thead>";
    echo  "<tr>
        <th>No</th>
        <th>No.Transaksi</th>
        <th>Tanggal jual</th>
        <th> Nama Barang </th>
        <th> Jumlah </th>
        <th>Harga jual</th>
        <th>Subtolal</th>
        <th>Diskon</th>
        <th>T. Setelah Diskon</th>
    </tr>";
    echo "</thead>";
    echo "<tbody>";
    $totalb = 0;
    $totald = 0;
    foreach ($rows as $key => $val) :
        $jum = $val["d_jual_qty"];
        $hb = $val["barang_harpok"];
        $totald += $val["d_jual_diskon"];
        $subtotal = $jum * $hb;
        $totalb += $subtotal;
        $nomor = $key + 1;
        echo  "<tr>";
        echo   "<td align='center'>" . $nomor . "</td>";
        echo   "<td>" . $val["jual_notrans"] . "</td>";
        echo   "<td>" .  date('d-m-Y', strtotime($val["jual_tanggal"])) . "</td>";
        echo  "<td>" . $val["barang_nama"] . "</td>";
        echo  "<td>" . $val["d_jual_qty"] . "</td>";
        echo "<td> Rp. " . number_format($val["barang_harpok"]) . "</td>";
        echo "<td> Rp. " . number_format($subtotal) . "</td>";
        echo "<td> Rp. " . number_format($val["d_jual_diskon"]) . "</td>";
        echo "<td align='right'> Rp. " . number_format($subtotal - $val["d_jual_diskon"]) . "</td>";
        echo "</tr>";
    endforeach;
    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<th colspan='6'>Total</th>";
    echo "<th align='right'> Rp. " . number_format($totalb) . "</th>";
    echo "<th align='right'> Rp. " . number_format($totald) . "</th>";
    echo "<th align='right'> Rp. " . number_format($totalb - $totald) . "</th>";
    echo "</tr>";
    echo "</tfoot>";
    echo "</table>";
    echo  "<br>";

    $user = $this->db->query("SELECT *  FROM tbl_user WHERE user_level=3");
    $adminn = $user->row_array();

    echo  "<small style='font-style: italic'> dicetak oleh : " . $this->session->userdata("nama") . "</small>";
    echo  "<p align='right'>Tangerang : " . date('d - m - Y') . " </p>";
    echo  "<h5 align='right'>Pemilik </h5>";
    echo  "<br>";
    echo "<h5 align='right'>" . $adminn['user_nama'] . "</h5>";
} else {

    //print untuk pertanggal

    echo " <h1 align='center'>Toko Bangunan Suci Jaya </h1>";
    echo "<h2 align='center'> Laporan Penjualan tanggal : " . date("d-m-Y", strtotime($tgl_mulai)) . " s/d " . date("d-m-Y", strtotime($tgl_selesai)) . "</h2>";
    echo  "<table class='table table=bordered' border='1'>";
    echo "<thead>";
    echo  "<tr>
    <th>No</th>
    <th>No.Transaksi</th>
    <th>Tanggal jual</th>
    <th> Nama Barang </th>
    <th> Jumlah </th>
    <th>Harga jual</th>
    <th>Subtolal</th>
    <th>Diskon</th>
    <th>T. Setelah Diskon</th>
    </tr>";
    echo "</thead>";
    echo "<tbody>";

    $totalb = 0;
    foreach ($row as $key => $value) {

        $id = $value["jual_notrans"];
        $periksa = $this->db->query("SELECT * FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans
        JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE jual_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND a.jual_notrans='$id'");
        $jml = $periksa->num_rows();
        $nomor = $key + 1;
        echo  "<tr>";


        if ($jml > 1) {


            echo   "<td align='center' rowspan='$jml'>" . $nomor . "</td>";
            echo   "<td rowspan='$jml' >" . $value["jual_notrans"] . "</td>";
            echo   "<td rowspan='$jml' >" .  date('d-m-Y', strtotime($value["jual_tanggal"])) . "</td>";



            $nox = 1;
            $totald = 0;
            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_jual_qty"];
                $hb = $dt["barang_harpok"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $totald += $dt["d_jual_diskon"];


                echo  "<td>" . $dt["barang_nama"] . "</td>";
                echo  "<td align='center'>" . $dt["d_jual_qty"] . "</td>";
                echo "<td  align='right'> Rp. " . number_format($dt["barang_harpok"]) . "</td>";
                echo "<td  align='right'> Rp. " . number_format($subtotal) . "</td>";
                echo "<td align='right'> Rp. " . number_format($dt["d_jual_diskon"]) . "</td>";
                echo "<td align='right'> Rp. " . number_format($subtotal - $dt["d_jual_diskon"]) . "</td>";
                echo "</tr>";

                if ($nox < $jml) {
                    echo "<tr>";
                }

                $nox++;
            }
        } else {


            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_jual_qty"];
                $hb = $dt["barang_harpok"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $totald += $dt["d_jual_diskon"];

                echo   "<td align='center'>" . $nomor . "</td>";
                echo   "<td>" . $value["jual_notrans"] . "</td>";
                echo   "<td>" . date('d-m-Y', strtotime($value["jual_tanggal"])) . "</td>";

                echo "<td>" . $dt["barang_nama"] . "</td>";
                echo "<td align='center'>" . $dt["d_jual_qty"] . "</td>";
                echo "<td align='right'> Rp. " . number_format($dt["barang_harpok"]) . "</td>";
                echo "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
                echo "<td align='right'> Rp. " . number_format($dt["d_jual_diskon"]) . "</td>";
                echo "<td align='right'> Rp. " . number_format($subtotal - $dt["d_jual_diskon"]) . "</td>";
            }
        }
    }


    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<th colspan='6'>Total</th>";
    echo "<th align='right'> Rp. " . number_format($totalb) . "</th>";
    echo "<th align='right'> Rp. " . number_format($totald) . "</th>";
    echo "<th align='right'> Rp. " . number_format($totalb - $totald) . "</th>";
    echo "</tr>";
    echo "</tfoot>";

    echo "</table>";
    echo  "<br>";

    $user = $this->db->query("SELECT *  FROM tbl_user WHERE user_level=3");
    $adminn = $user->row_array();

    echo  "<small style='font-style: italic'> dicetak oleh : " . $this->session->userdata("nama") . "</small>";
    echo  "<p align='right'>Tangerang : " . date('d - m - Y') . " </p>";
    echo  "<h5 align='right'>Pemilik </h5>";
    echo  "<br>";
    echo "<h5 align='right'>" . $adminn['user_nama'] . "</h5>";
}
