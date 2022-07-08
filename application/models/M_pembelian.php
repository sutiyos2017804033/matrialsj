<?php
class M_pembelian extends CI_Model
{

	// function simpan_pembelian($nofak, $tglfak, $suplier, $beli_kode)
	function simpan_pembelian($nofak, $tglfak, $suplier)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_beli (beli_notrans,beli_tanggal,beli_suplier_id,beli_user_id) VALUES ('$nofak','$tglfak','$suplier','$idadmin')");
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_beli_notrans' 		=>	$nofak,
				'd_beli_barang_id'	=>	$item['id'],
				'd_beli_harga'		=>	$item['price'],
				'd_beli_jumlah'		=>	$item['qty'],
				'd_beli_total'		=>	$item['subtotal'],
				// 'd_beli_kode'		=>	$beli_kode
			);
			$this->db->insert('tbl_detail_beli', $data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok+'$item[qty]',barang_harpok='$item[price]',barang_harjul='$item[harga]' where barang_id='$item[id]'");
		}
		return true;
	}
	// function get_kobel()
	// {
	// 	$q = $this->db->query("SELECT MAX(RIGHT(beli_kode,6)) AS kd_max FROM tbl_beli WHERE DATE(beli_tanggal)=CURDATE()");
	// 	$kd = "";
	// 	if ($q->num_rows() > 0) {
	// 		foreach ($q->result() as $k) {
	// 			$tmp = ((int)$k->kd_max) + 1;
	// 			$kd = sprintf("%03s", $tmp);
	// 		}
	// 	} else {
	// 		$kd = "000001";
	// 	}
	// 	return "A" . date('dmy') . $kd;
	// }



	function hapus_pembelian($kode)
	{
		$hsl = $this->db->query("DELETE tbl_beli, tbl_detail_beli FROM tbl_beli  
		INNER JOIN tbl_detail_beli ON tbl_beli.beli_notrans=tbl_detail_beli.d_beli_notrans   
		WHERE tbl_beli.beli_notrans ='$kode'");
		return $hsl;
	}

	function detail_pembelian($beli_notrans = NULL)

	{
		$query = $this->db->query("SELECT *  FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE a.beli_notrans ='$beli_notrans'  ORDER BY a.beli_notrans")->row_array($beli_notrans);
		return $query;
	}
}