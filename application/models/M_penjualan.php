<?php
class M_penjualan extends CI_Model
{

	function hapus_retur($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
		return $hsl;
	}

	function tampil_retur()
	{
		$hsl = $this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
		return $hsl;
	}

	function simpan_retur($kobar, $nabar, $satuan, $harjul, $qty, $keterangan)
	{
		$hsl = $this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
		return $hsl;
	}

	function simpan_penjualan2($nofak, $total, $jml_uang, $kembalian)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_jual (jual_notrans,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','eceran')");
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_jual_notrans' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual', $data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}
	function get_nofak()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(jual_notrans,6)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)=CURDATE()");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "0001";
		}
		return "TR" . date('dmy') . $kd;
	}

	//=====================Penjualan grosir================================
	function simpan_penjualan($nofak, $total, $jml_uang, $kembalian)
	{
		$idadmin = $this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_jual (jual_notrans,jual_total,jual_jml_uang,jual_kembalian,jual_user_id) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin')");
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_jual_notrans' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual', $data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}

	function cetak_faktur()
	{
		$nofak = $this->session->userdata('nofak');
		$hsl = $this->db->query("SELECT jual_notrans,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_notrans=d_jual_notrans WHERE jual_notrans='$nofak'");
		return $hsl;
	}


	function hapus_penjualan($kode)
	{
		$hsl = $this->db->query("DELETE tbl_jual, tbl_detail_jual FROM tbl_jual  
		INNER JOIN tbl_detail_jual ON tbl_jual.jual_notrans=tbl_detail_jual.d_jual_notrans   
		WHERE tbl_jual.jual_notrans ='$kode'");
		return $hsl;;
	}

	function detail_penjualan($jual_notrans = NULL)

	{
		$query = $this->db->query("SELECT *  FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_notrans=b.d_jual_notrans JOIN tbl_barang c ON b.d_jual_barang_id=c.barang_id  WHERE a.jual_notrans ='$jual_notrans'  ORDER BY a.jual_notrans")->row_array($jual_notrans);
		return $query;
	}
}