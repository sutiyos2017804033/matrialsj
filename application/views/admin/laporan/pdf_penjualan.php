<?php


// Require composer autoload
require_once 'vendor/autoload.php';
// Create an instance of the class:


// Write some HTML code:

$jual_notrans = $this->uri->segment(4);
$tgl_mulai = $this->uri->segment(5);
$tgl_selesai = $this->uri->segment(6);


// queri untuk pertanggal

$ambil = $this->db->query("SELECT DISTINCT jual_notrans, jual_tanggal FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans
JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE jual_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
$row = $ambil->result_array();

// print untuk per kode

$getdata = $this->db->query("SELECT DISTINCT jual_notrans, jual_tanggal FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans
JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE jual_notrans='$jual_notrans'");
$rows = $getdata->result_array();
if (!$row) {
    $isi = "<h1 align='center'>Toko Bangunan Suci Jaya </h1>";
    $isi .=    "<h2 align='center'> Laporan Penjualan No. Transaksi :" . $jual_notrans . "</h2>";
    $isi .=  "<table align='center' class='table table=bordered' border='1' cellspacing='0'>";
    $isi .= "<thead>";
    $isi .=  "<tr>
    <th>No</th>
    <th>No.Transaksi</th>
    <th style='width:12%'>Tanggal jual</th>
   
    <th style='width:12%'> Nama Barang </th>
    <th> Jumlah </th>
    <th style='width:15%'>Harga jual</th>
    <th style='width:15%'>Subtolal</th>
    <th style='width:15%'>Diskon</th>
    <th style='width:15%'>T. Setelah Diskon</th>
    </tr>";
    $isi .= "</thead>";
    $isi .= "<tbody>";
    foreach ($rows as $key => $val) {
        $id = $val["jual_notrans"];
        $periksa = $this->db->query("SELECT * FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans
        JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE jual_notrans='$jual_notrans' AND a.jual_notrans='$id'");
        $jml = $periksa->num_rows();
        $todis = 0;
        $totalb = 0;
        $nomor = $key + 1;
        $isi .=  "<tr>";
        if ($jml > 1) {
            $isi .=   "<td align='center' rowspan='$jml'>" . $nomor . "</td>";
            $isi .=   "<td rowspan='$jml'>" . $val["jual_notrans"] . "</td>";
            $isi .=   "<td  rowspan='$jml'>" . date('d-m-Y', strtotime($val["jual_tanggal"])) . "</td>";


            $nox = 1;
            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_jual_qty"];
                $hb = $dt["barang_harjul"];
                $todis += $dt["d_jual_diskon"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $isi .= "<td>" . $dt["barang_nama"] . "</td>";
                $isi .= "<td align='center'>" . $dt["d_jual_qty"] . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["barang_harjul"]) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["d_jual_diskon"]) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal - $dt["d_jual_diskon"]) . "</td>";
                $isi .= "</tr>";

                if ($nox < $jml) {
                    $isi .= "<tr>";
                }

                $nox++;
            }
        } else {


            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_jual_qty"];
                $hb = $dt["barang_harjul"];
                $todis += $dt["d_jual_diskon"];

                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $isi .=   "<td align='center'>" . $nomor . "</td>";
                $isi .=   "<td>" . $val["jual_notrans"] . "</td>";
                $isi .=   "<td>" . date('d-m-Y', strtotime($val["jual_tanggal"])) . "</td>";

                $isi .= "<td>" . $dt["barang_nama"] . "</td>";
                $isi .= "<td align='center'>" . $dt["d_jual_qty"] . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["barang_harjul"], 2) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["d_jual_diskon"]) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal - $dt["d_jual_diskon"]) . "</td>";
            }
        }
    }



    $isi .= "</tbody>";
    $isi .= "<tfoot>";
    $isi .= "<tr>";
    $isi .= "<th colspan='6'>Total</th>";
    $isi .= "<th align='right' > Rp. " . number_format($totalb) . "</th>";
    $isi .= "<th align='right'> Rp. " . number_format($todis) . "</th>";
    $isi .= "<th align='right'> Rp. " . number_format($totalb - $todis) . "</th>";
    $isi .= "</tr>";
    $isi .= "</tfoot>";
    $isi .= "</table>";
    $isi .= "<br>";

    $user = $this->db->query("SELECT *  FROM tbl_user WHERE user_level=3");
    $adminn = $user->row_array();

    $isi .= "<small style='font-style: italic'> dicetak oleh : " . $this->session->userdata("nama") . "</small>";
    $isi .= "<p align='right'>Tangerang : " . date('d - m - Y') . " </p>";
    $isi .= "<h5 align='right'>Pemilik </h5>";
    $isi .= "<br>";
    $isi .= "<h5 align='right'>" . $adminn['user_nama'] . "</h5>";


    $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    $mpdf->WriteHTML($isi);

    $mpdf->Output();
} else {

    // print untuk per tanggal


    $isi = " <h1 align='center'>Toko Bangunan Suci Jaya </h1>";
    $isi .= "<h2 align='center'> Laporan Penjualan tanggal : " . date("d-m-Y", strtotime($tgl_mulai)) . " s/d " . date("d-m-Y", strtotime($tgl_selesai)) . "</h2>";
    $isi .=  "<table align='center' class='table table=bordered'  cellspacing='0' border='1'>";
    $isi .= "<thead>";
    $isi .= "<tr>
        <th>No</th>
    <th>No.Transaksi</th>
    <th style='width:12%'>Tanggal jual</th>
   
    <th style='width:12%'> Nama Barang </th>
    <th> Jumlah </th>
    <th style='width:15%'>Harga jual</th>
    <th style='width:15%'>Subtolal</th>
    <th style='width:15%'>Diskon</th>
    <th style='width:15%'>T. Setelah Diskon</th>
    </tr>";
    $isi .= "</thead>";
    $isi .= "<tbody>";
    $totalb = 0;
    foreach ($row as $key => $value) {
        $id = $value["jual_notrans"];
        $periksa = $this->db->query("SELECT * FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans
        JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE jual_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND a.jual_notrans='$id'");
        $jml = $periksa->num_rows();
        $nomor = $key + 1;
        $isi .=  "<tr>";
        if ($jml > 1) {
            $isi .=   "<td align='center' rowspan='$jml'>" . $nomor . "</td>";
            $isi .=   "<td rowspan='$jml'>" . $value["jual_notrans"] . "</td>";
            $isi .=   "<td  rowspan='$jml'>" . date('d-m-Y', strtotime($value["jual_tanggal"])) . "</td>";


            $nox = 1;
            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_jual_qty"];
                $hb = $dt["barang_harjul"];
                $todis += $dt["d_jual_diskon"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $isi .= "<td>" . $dt["barang_nama"] . "</td>";
                $isi .= "<td align='center'>" . $dt["d_jual_qty"] . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["barang_harjul"]) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["d_jual_diskon"]) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal - $dt["d_jual_diskon"]) . "</td>";
                $isi .= "</tr>";

                if ($nox < $jml) {
                    $isi .= "<tr>";
                }

                $nox++;
            }
        } else {


            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_jual_qty"];
                $hb = $dt["barang_harjul"];
                $todis += $dt["d_jual_diskon"];

                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $isi .=   "<td align='center'>" . $nomor . "</td>";
                $isi .=   "<td>" . $value["jual_notrans"] . "</td>";
                $isi .=   "<td>" . date('d-m-Y', strtotime($value["jual_tanggal"])) . "</td>";

                $isi .= "<td>" . $dt["barang_nama"] . "</td>";
                $isi .= "<td align='center'>" . $dt["d_jual_qty"] . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["barang_harjul"], 2) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["d_jual_diskon"]) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal - $dt["d_jual_diskon"]) . "</td>";
            }
        }
    }

    $isi .= "</tbody>";
    $isi .= "<tfoot>";
    $isi .= "<tr>";
    $isi .= "<th colspan='6'>Total</th>";
    $isi .= "<th align='right' > Rp. " . number_format($totalb) . "</th>";
    $isi .= "<th align='right'> Rp. " . number_format($todis) . "</th>";
    $isi .= "<th align='right'> Rp. " . number_format($totalb - $todis) . "</th>";
    $isi .= "</tr>";
    $isi .= "</tfoot>";
    $isi .= "</table>";
    $isi .= "<br>";

    $isi .= "<small style='font-style: italic'> dicetak oleh : " . $this->session->userdata("nama") . "</small>";
    date_default_timezone_set('Asia/Jakarta');
    $tgl = date("d M Y");
    $isi .= "<p align='right'>Tangerang : " . $tgl . " </p>";
    $isi .= "<h5 align='right'>Pemilik </h5>";
    $isi .= "<br>";

    $user = $this->db->query("SELECT * FROM tbl_user WHERE user_level=3");
    $adminn = $user->row_array();

    $isi .= "<h5 align='right'>" . $adminn['user_nama'] . "</h5>";




    $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    $mpdf->AddPage('L');
    $mpdf->WriteHTML($isi);

    // Output a PDF file directly to the browser
    $mpdf->Output();
}