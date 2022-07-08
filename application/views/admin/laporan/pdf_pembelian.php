<?php


// Require composer autoload
require_once 'vendor/autoload.php';
// Create an instance of the class:


// Write some HTML code:

$beli_notrans = $this->uri->segment(4);
$tgl_mulai = $this->uri->segment(5);
$tgl_selesai = $this->uri->segment(6);


// queri untuk pertanggal

$ambil = $this->db->query("SELECT DISTINCT beli_notrans, beli_tanggal, suplier_nama FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
$row = $ambil->result_array();

// print untuk per kode

$getdata = $this->db->query("SELECT DISTINCT beli_notrans, beli_tanggal, suplier_nama  FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_notrans='$beli_notrans'");
$rows = $getdata->result_array();
if (!$row) {
    $isi = "<h1 align='center'>Toko Bangunan Suci Jaya </h1>";
    $isi .=    "<h2 align='center'> Laporan Pembelian No. Transaksi :" . $beli_notrans . "</h2>";
    $isi .=  "<table align='center' class='table table=bordered' border='1' cellspacing='0'>";
    $isi .= "<thead>";
    $isi .=  "<tr>
    <th>No</th>
    <th>No.Transaksi</th>
    <th style='width:12%'>Tanggal Beli</th>
    <th style='width:12%'>Nama Supplier</th>
    <th style='width:12%'> Nama Barang </th>
    <th> Jumlah </th>
    <th style='width:15%'>Harga Beli</th>
    <th style='width:15%'>Subtolal</th>
    </tr>";
    $isi .= "</thead>";
    $isi .= "<tbody>";
    foreach ($rows as $key => $val) {
        $id = $val["beli_notrans"];
        $periksa = $this->db->query("SELECT * FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
        JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_notrans='$beli_notrans' AND a.beli_notrans='$id'");
        $jml = $periksa->num_rows();
        $nomor = $key + 1;
        $isi .=  "<tr>";
        if ($jml > 1) {
            $isi .=   "<td align='center' rowspan='$jml'>" . $nomor . "</td>";
            $isi .=   "<td rowspan='$jml'>" . $val["beli_notrans"] . "</td>";
            $isi .=   "<td  rowspan='$jml'>" . date('d-m-Y', strtotime($val["beli_tanggal"])) . "</td>";
            $isi .=  "<td  rowspan='$jml'>" . $val["suplier_nama"] . "</td>";

            $nox = 1;
            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_beli_jumlah"];
                $hb = $dt["barang_harpok"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $isi .= "<td>" . $dt["barang_nama"] . "</td>";
                $isi .= "<td align='center'>" . $dt["d_beli_jumlah"] . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["barang_harpok"]) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
                $isi .= "</tr>";

                if ($nox < $jml) {
                    $isi .= "<tr>";
                }

                $nox++;
            }
        } else {


            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_beli_jumlah"];
                $hb = $dt["barang_harpok"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $isi .=   "<td align='center'>" . $nomor . "</td>";
                $isi .=   "<td>" . $val["beli_notrans"] . "</td>";
                $isi .=   "<td>" . date('d-m-Y', strtotime($val["beli_tanggal"])) . "</td>";
                $isi .=  "<td>" . $val["suplier_nama"] . "</td>";
                $isi .= "<td>" . $dt["barang_nama"] . "</td>";
                $isi .= "<td align='center'>" . $dt["d_beli_jumlah"] . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["barang_harpok"], 2) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
            }
        }
    }



    $isi .= "</tbody>";
    $isi .= "<tfoot>";
    $isi .= "<tr>";
    $isi .= "<th colspan='7'>Total</th>";
    $isi .= "<td align='right'> Rp. " . number_format($totalb, 2, '.', '.') . "</td>";
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
    $isi .= "<h2 align='center'> Laporan Pembelian tanggal : " . date("d-m-Y", strtotime($tgl_mulai)) . " s/d " . date("d-m-Y", strtotime($tgl_selesai)) . "</h2>";
    $isi .=  "<table align='center' class='table table=bordered'  cellspacing='0' border='1'>";
    $isi .= "<thead>";
    $isi .= "<tr>
        <th>No</th>
    <th>No.Transaksi</th>
    <th style='width:12%'>Tanggal Beli</th>
    <th style='width:12%'>Nama Supplier</th>
    <th style='width:12%'> Nama Barang </th>
    <th> Jumlah </th>
    <th style='width:15%'>Harga Beli</th>
    <th style='width:15%'>Subtolal</th>
    </tr>";
    $isi .= "</thead>";
    $isi .= "<tbody>";
    $totalb = 0;
    foreach ($row as $key => $value) {
        $id = $value["beli_notrans"];
        $periksa = $this->db->query("SELECT * FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
        JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND a.beli_notrans='$id'");
        $jml = $periksa->num_rows();
        $nomor = $key + 1;
        $isi .=  "<tr>";
        if ($jml > 1) {
            $isi .=   "<td align='center' rowspan='$jml'>" . $nomor . "</td>";
            $isi .=   "<td rowspan='$jml'>" . $value["beli_notrans"] . "</td>";
            $isi .=   "<td  rowspan='$jml'>" . date('d-m-Y', strtotime($value["beli_tanggal"])) . "</td>";
            $isi .=  "<td  rowspan='$jml'>" . $value["suplier_nama"] . "</td>";

            $nox = 1;
            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_beli_jumlah"];
                $hb = $dt["barang_harpok"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $isi .= "<td>" . $dt["barang_nama"] . "</td>";
                $isi .= "<td align='center'>" . $dt["d_beli_jumlah"] . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["barang_harpok"]) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
                $isi .= "</tr>";

                if ($nox < $jml) {
                    $isi .= "<tr>";
                }

                $nox++;
            }
        } else {


            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_beli_jumlah"];
                $hb = $dt["barang_harpok"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;
                $isi .=   "<td align='center'>" . $nomor . "</td>";
                $isi .=   "<td>" . $value["beli_notrans"] . "</td>";
                $isi .=   "<td>" . date('d-m-Y', strtotime($value["beli_tanggal"])) . "</td>";
                $isi .=  "<td>" . $value["suplier_nama"] . "</td>";
                $isi .= "<td>" . $dt["barang_nama"] . "</td>";
                $isi .= "<td align='center'>" . $dt["d_beli_jumlah"] . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($dt["barang_harpok"], 2) . "</td>";
                $isi .= "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
            }
        }
    }

    $isi .= "</tbody>";
    $isi .= "<tfoot>";
    $isi .= "<tr>";
    $isi .= "<th colspan='7'>Total</th>";
    $isi .= "<td align='right'> Rp. " . number_format($totalb) . "</td>";
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