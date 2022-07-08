<?php
class M_laporan extends CI_Model
{
	function get_stok_barang()
	{
		$hsl = $this->db->query("SELECT kategori_id,kategori_nama,barang_nama,barang_stok FROM tbl_kategori JOIN tbl_barang ON kategori_id=barang_kategori_id GROUP BY kategori_id,barang_nama");
		return $hsl;
	}
	function get_data_barang()
	{
		$hsl = $this->db->query("SELECT kategori_id,barang_id,kategori_nama,barang_nama,barang_satuan,barang_harjul,barang_stok FROM tbl_kategori JOIN tbl_barang ON kategori_id=barang_kategori_id GROUP BY kategori_id,barang_nama");
		return $hsl;
	}
	function get_data_penjualan()
	{
		$hsl = $this->db->query("SELECT jual_notrans,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans ORDER BY jual_notrans DESC");
		return $hsl;
	}
	function get_total_penjualan()
	{
		$hsl = $this->db->query("SELECT jual_notrans,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans ORDER BY jual_notrans DESC");
		return $hsl;
	}
	function get_data_jual_pertanggal($tanggal)
	{
		$hsl = $this->db->query("SELECT jual_notrans,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans WHERE DATE(jual_tanggal)='$tanggal' ORDER BY jual_notrans DESC");
		return $hsl;
	}
	function get_data__total_jual_pertanggal($tanggal)
	{
		$hsl = $this->db->query("SELECT jual_notrans,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans WHERE DATE(jual_tanggal)='$tanggal' ORDER BY jual_notrans DESC");
		return $hsl;
	}
	function get_bulan_jual()
	{
		$hsl = $this->db->query("SELECT DISTINCT DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan FROM tbl_jual");
		return $hsl;
	}
	function get_tahun_jual()
	{
		$hsl = $this->db->query("SELECT DISTINCT YEAR(jual_tanggal) AS tahun FROM tbl_jual");
		return $hsl;
	}
	function get_jual_perbulan($bulan)
	{
		$hsl = $this->db->query("SELECT jual_notrans,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_notrans DESC");
		return $hsl;
	}
	function get_total_jual_perbulan($bulan)
	{
		$hsl = $this->db->query("SELECT jual_notrans,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_notrans DESC");
		return $hsl;
	}
	function get_jual_pertahun($tahun)
	{
		$hsl = $this->db->query("SELECT jual_notrans,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans WHERE YEAR(jual_tanggal)='$tahun' ORDER BY jual_notrans DESC");
		return $hsl;
	}
	function get_total_jual_pertahun($tahun)
	{
		$hsl = $this->db->query("SELECT jual_notrans,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans WHERE YEAR(jual_tanggal)='$tahun' ORDER BY jual_notrans DESC");
		return $hsl;
	}
	// PEMBELIAN
	function get_data_pembelian()
	{
		$hsl = $this->db->query("SELECT beli_notrans,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,beli_suplier_id,d_beli_id,d_beli_barang_id,d_beli_harga,d_beli_jumlah,d_beli_total FROM tbl_beli JOIN tbl_detail_beli ON beli_notrans=d_beli_notrans ORDER BY beli_notrans DESC");
		return $hsl;
	}
	function get_total_pembelian()
	{
		$hsl = $this->db->query("SELECT beli_notrans,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,beli_suplier_id,d_beli_id,d_beli_barang_id,d_beli_harga,d_beli_jumlah,sum(d_beli_total) as total FROM tbl_beli JOIN tbl_detail_beli ON beli_notrans=d_beli_notrans ORDER BY beli_notrans DESC");
		return $hsl;
	}
	//=========Laporan Laba rugi============
	function get_lap_laba_rugi($bulan)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%d %M %Y %H:%i:%s') as jual_tanggal,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon) AS untung_bersih FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
	function get_total_lap_laba_rugi($bulan)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,SUM(((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon)) AS total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_juatrans WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
}
