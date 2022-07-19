<?php
class M_barang extends CI_Model
{

	function hapus_barang($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_barang where barang_id='$kode'");
		return $hsl;
	}

	function update_barang($kobar, $nabar, $sup, $kat, $satuan, $harpok, $harjul, $stok)
	{
		$user_id = $this->session->userdata('idadmin');
		$hsl = $this->db->query("UPDATE tbl_barang SET barang_nama='$nabar',barang_satuan='$satuan',barang_harpok='$harpok',barang_harjul='$harjul',barang_stok='$stok',barang_tgl_last_update=NOW(),barang_kategori_id='$kat', id_supplier='$sup',barang_user_id='$user_id' WHERE barang_id='$kobar'");
		return $hsl;
	}

	function tampil_barang()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id JOIN tbl_suplier a ON tbl_barang.id_supplier=a.suplier_id ");
		return $hsl;
	}

	function simpan_barang($kobar, $sup, $nabar, $kat, $satuan, $harpok, $harjul, $stok)
	{
		$user_id = $this->session->userdata('idadmin');
		$hsl = $this->db->query("INSERT INTO tbl_barang (barang_id,barang_nama,barang_satuan,barang_harpok,barang_harjul,barang_stok,barang_kategori_id, id_supplier, barang_user_id) VALUES ('$kobar','$nabar','$satuan','$harpok','$harjul','$stok','$kat','$sup','$user_id')");
		return $hsl;
	}


	function get_barang($kobar)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_barang where barang_id='$kobar'");
		return $hsl;
	}

	function get_kobar()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(barang_id,4)) AS kd_max FROM tbl_barang");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%04s", $tmp);
			}
		} else {
			$kd = "001";
		}
		return "BR" . $kd;
	}
}
