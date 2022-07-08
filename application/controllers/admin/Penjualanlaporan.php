<?php
class Penjualanlaporan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_satuan');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1' || '3') {
			$data['data'] = $this->m_barang->tampil_barang();
			$data['kat'] = $this->m_kategori->tampil_kategori();
			$data['kat2'] = $this->m_kategori->tampil_kategori();
			$data['data2'] = $this->m_satuan->tampil_satuan();
			$this->load->view('admin/laporan/v_laporanpenjualan', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}