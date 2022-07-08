<?php
class M_laporanPDF extends CI_Model
{

	function laporanbeli($beli_notrans)

	{
		$query = $this->db->query("SELECT *  FROM tbl_beli a JOIN tbl_detail_beli b ON a.beli_notrans=b.d_beli_notrans JOIN tbl_barang c ON b.d_beli_barang_id=c.barang_id JOIN tbl_suplier d ON a.beli_suplier_id=d.suplier_id WHERE a.beli_notrans ='$beli_notrans'")->row_array($beli_notrans);
		return $query;
	}

	function laporanjual($jual_notrans)

	{
		$query = $this->db->query("SELECT *  FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id WHERE a.jual_notrans ='$jual_notrans'")->row_array($jual_notrans);
		return $query;
	}
}