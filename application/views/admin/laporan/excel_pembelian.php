<?php


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Pembelian.xls");

$beli_notrans = $this->uri->segment(4);
$tgl_mulai = $this->uri->segment(5);
$tgl_selesai = $this->uri->segment(6);

// print untuk per kode
$ambil = $this->db->query("SELECT DISTINCT beli_notrans, beli_tanggal, suplier_nama  FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
$row = $ambil->result_array();



// print untuk per kode
$getdata = $this->db->query("SELECT *  FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_notrans='$beli_notrans'");
$rows = $getdata->result_array();
if (!$row) {
    echo "<h1 align='center'>Toko Bangunan Suci Jaya </h1>";
    echo   "<h2 align='center'> Laporan Pembelian No. Transaksi :" . $beli_notrans . "</h2>";
    echo  "<table class='table table=bordered' border='1'>";
    echo "<thead>";
    echo  "<tr>
        <th>No</th>
        <th>No.Transaksi</th>
        <th>Tanggal Beli</th>
        <th>Nama Supplier</th>
        <th> Nama Barang </th>
        <th> Jumlah </th>
        <th>Harga Beli</th>
        <th>Subtolal</th>
    </tr>";
    echo "</thead>";
    echo "<tbody>";
    $totalb = 0;
    foreach ($rows as $key => $val) :
        $jum = $val["d_beli_jumlah"];
        $hb = $val["barang_harpok"];
        $subtotal = $jum * $hb;
        $totalb += $subtotal;
        $nomor = $key + 1;
        echo  "<tr>";
        echo   "<td align='center'>" . $nomor . "</td>";
        echo   "<td>" . $val["beli_notrans"] . "</td>";
        echo   "<td>" .  date('d-m-Y', strtotime($val["beli_tanggal"])) . "</td>";
        echo  "<td>" . $val["suplier_nama"] . "</td>";
        echo  "<td>" . $val["barang_nama"] . "</td>";
        echo  "<td>" . $val["d_beli_jumlah"] . "</td>";
        echo "<td> Rp. " . number_format($val["barang_harpok"], 2) . "</td>";
        echo "<td> Rp. " . number_format($subtotal, 2) . "</td>";
        echo "</tr>";
    endforeach;
    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<th colspan='7'>Total</th>";
    echo "<td align='right'> Rp. " . number_format($totalb, 2, '.', '.') . "</td>";
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
    echo "<h2 align='center'> Laporan Pembelian tanggal : " . date("d-m-Y", strtotime($tgl_mulai)) . " s/d " . date("d-m-Y", strtotime($tgl_selesai)) . "</h2>";
    echo  "<table class='table table=bordered' border='1'>";
    echo "<thead>";
    echo  "<tr>
    <th>No</th>
    <th>No.Transaksi</th>
    <th>Tanggal Beli</th>
    <th>Nama Supplier</th>

    <th> Nama Barang </th>
    <th> Jumlah </th>
    <th>Harga Beli</th>
    <th>Subtolal</th>
    </tr>";
    echo "</thead>";
    echo "<tbody>";

    $totalb = 0;
    foreach ($row as $key => $value) {

        $id = $value["beli_notrans"];
        $periksa = $this->db->query("SELECT * FROM `tbl_beli` a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans
        JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE beli_tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND a.beli_notrans='$id'");
        $jml = $periksa->num_rows();
        $nomor = $key + 1;
        echo  "<tr>";


        if ($jml > 1) {


            echo   "<td align='center' rowspan='$jml'>" . $nomor . "</td>";
            echo   "<td rowspan='$jml' >" . $value["beli_notrans"] . "</td>";
            echo   "<td rowspan='$jml' >" .  date('d-m-Y', strtotime($value["beli_tanggal"])) . "</td>";
            echo  "<td rowspan='$jml' >" . $value["suplier_nama"] . "</td>";


            $nox = 1;
            foreach ($periksa->result_array() as $dt) {
                $jum = $dt["d_beli_jumlah"];
                $hb = $dt["barang_harpok"];
                $subtotal = $jum * $hb;
                $totalb += $subtotal;
                $nomor = $key + 1;


                echo  "<td>" . $dt["barang_nama"] . "</td>";
                echo  "<td align='center'>" . $dt["d_beli_jumlah"] . "</td>";
                echo "<td  align='right'> Rp. " . number_format($dt["barang_harpok"]) . "</td>";
                echo "<td  align='right'> Rp. " . number_format($subtotal) . "</td>";
                echo "</tr>";

                if ($nox < $jml) {
                    echo "<tr>";
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

                echo   "<td align='center'>" . $nomor . "</td>";
                echo   "<td>" . $value["beli_notrans"] . "</td>";
                echo   "<td>" . date('d-m-Y', strtotime($value["beli_tanggal"])) . "</td>";
                echo  "<td>" . $value["suplier_nama"] . "</td>";
                echo "<td>" . $dt["barang_nama"] . "</td>";
                echo "<td align='center'>" . $dt["d_beli_jumlah"] . "</td>";
                echo "<td align='right'> Rp. " . number_format($dt["barang_harpok"]) . "</td>";
                echo "<td align='right'> Rp. " . number_format($subtotal) . "</td>";
            }
        }
    }


    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<th colspan='7'>Total</th>";
    echo "<td align='right'> Rp. " . number_format($totalb) . "</td>";
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
