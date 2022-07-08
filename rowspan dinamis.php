<table class="table table-bordered table-condensed" style="font-size:11px;" id="myda">
    <thead>
        <tr>
            <th style="text-align:center;width:40px;">No</th>
            <th>No. Transaksi</th>
            <th>Nama Barang</th>
            <!-- <th>Tanggal Beli</th> -->
            <th style="width:100px;text-align:center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ok = $this->db->query("SELECT DISTINCT beli_notrans FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id ORDER BY a.beli_notrans DESC");
        $ceking = $this->db->query("SELECT *  FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id ORDER BY a.beli_notrans DESC")->result_array();
        ?>
        <?php
        $no = 1;

        foreach ($ok->result_array() as $row) {
            $id = $row["beli_notrans"];
            $periksa = $this->db->query("SELECT *  FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id where a.beli_notrans='$id'");

            $jml = $periksa->num_rows();
        ?>
        <tr>

            <?php if ($jml > 1) { ?>
            <td rowspan="<?php echo $jml; ?>" style="text-align:center;"><?= $no ?></td>

            <td rowspan="<?php echo $jml; ?>"><?= $row["beli_notrans"]; ?></td>

            <?php
                    $nox = 1;
                    foreach ($periksa->result_array() as $dt) {
                    ?>
            <td><?= $dt["barang_nama"]; ?></td>

            <td style="text-align:center;">
                <a class="btn btn-xs btn-warning" href="<?php echo base_url('admin/pembelian/detail_pembelian/' . $row['beli_notrans']);
                                                                    ?>" title="Detail"><span
                        class="fa fa-search"></span></a>
                <a class="btn btn-xs btn-danger" href="#modalHapusPembelian<?php echo $row["beli_notrans"]
                                                                                        ?>" data-toggle="modal"
                    title="Hapus"><span class="fa fa-trash"></span></a>
            </td>
        </tr>
        <?php if ($nox < $jml) {
                            echo "<tr>";
                        } ?>

        <?php
                        $nox++;
                    }
                } else {
                    foreach ($periksa->result_array() as $dt) {
        ?>
        <td style="text-align:center;"><?php echo $no; ?></td>
        <td><?php echo $row["beli_notrans"]; ?></td>
        <td><?php echo $dt["barang_nama"]; ?></td>
        <td style="text-align:center;">


            <a class="btn btn-xs btn-warning" href="<?php echo base_url('admin/pembelian/detail_pembelian/' . $row['beli_notrans']);
                                                        ?>" title="Detail"><span class="fa fa-search"></span></a>
            <a class="btn btn-xs btn-danger" href="#modalHapusPembelian<?php echo $row["beli_notrans"]
                                                                            ?>" data-toggle="modal" title="Hapus"><span
                    class="fa fa-trash"></span></a>

        </td>
        <?php }
                }
    ?>
        </tr>
        <?php $no++;
        }
?>


    </tbody>
</table>