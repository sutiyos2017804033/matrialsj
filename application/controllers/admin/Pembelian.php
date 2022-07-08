<?php
class Pembelian extends CI_Controller
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
		$this->load->model('m_suplier');
		$this->load->model('m_pembelian');
	}
	function index()
	{
		if ($this->session->userdata('akses') == '1') {
			$data['data'] = $this->m_barang->tampil_barang();
			$data['sup'] = $this->m_suplier->tampil_suplier();
			$this->load->view('admin/v_pembelian', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function tambah_pembelian()
	{
		if ($this->session->userdata('akses') == '1') {
			$data['data'] = $this->m_barang->tampil_barang();

			$data['sup'] = $this->m_suplier->tampil_suplier();
			$this->load->view('admin/tambah_pembelian', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function get_barang()
	{
		if ($this->session->userdata('akses') == '1') {
			$kobar = $this->input->post('kode_brg');
			$x['brg'] = $this->m_barang->get_barang($kobar);
			$this->load->view('admin/v_detail_barang_beli', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function add_to_cart()
	{
		if ($this->session->userdata('akses') == '1') {

			// $this->session->set_userdata('nofak', $nofak);
			// $this->session->set_userdata('tglfak', $tgl);
			// $this->session->set_userdata('suplier', $suplier);
			$kobar = $this->input->post('kode_brg');
			$produk = $this->m_barang->get_barang($kobar);
			$i = $produk->row_array();
			$data = array(
				'id'       => $i['barang_id'],
				'name'     => $i['barang_nama'],
				'satuan'   => $i['barang_satuan'],
				'price'    => $this->input->post('harpok'),
				'harga'    => $this->input->post('harjul'),
				'qty'      => $this->input->post('jumlah')
			);

			$nofak = $this->input->post('nofak');
			$sql = $this->db->query("SELECT beli_notrans FROM tbl_beli where beli_notrans ='$nofak'");
			$cek_nofak = $sql->num_rows();
			if ($cek_nofak > 0) {
				echo "
			<script>
				alert ('NO transaksi sudah ada');
				document.location.href = '';
			</script>
		";
			} else {
				$this->cart->insert($data);
			}

			redirect('admin/pembelian/tambah_pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function remove()
	{
		if ($this->session->userdata('akses') == '1') {
			$row_id = $this->uri->segment(4);
			$this->cart->update(array(
				'rowid'      => $row_id,
				'qty'     => 0
			));
			redirect('admin/pembelian/tambah_pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function simpan_pembelian()
	{
		if ($this->session->userdata('akses') == '1') {
			$nofak = $this->input->post('nofak');
			$tgl = $this->input->post('tgl');
			$suplier = $this->input->post('suplier');


			$backurl = base_url() . 'admin/pembelian/tambah_pembelian';
			$sql = $this->db->query("SELECT beli_notrans FROM tbl_beli where beli_notrans ='$nofak'");
			$cek_nofak = $sql->num_rows();
			if ($cek_nofak > 0) {
				echo "
				<script>
					alert ('No Transaksi sudah ada');
					document.location.href = '$backurl';
				</script>
			";
			} elseif (!$this->cart->contents()) {
				echo "
				<script>
					alert ('data barang kosong periksa kembali data yang anda input');
					document.location.href = '$backurl';
				</script>
			";
			} else {
				$this->m_pembelian->simpan_pembelian($nofak, $tgl, $suplier);
				echo "
				<script>
					alert ('data berhasil ditambahkan!!');
					document.location.href = 'pembelian';
				</script>
			";
				$this->cart->destroy();
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function hapus_pembelian()
	{
		if ($this->session->userdata('akses') == '1') {
			$kode = $this->input->post('kode');

			$this->m_pembelian->hapus_pembelian($kode);
			echo "
			<script>
				alert ('data berhasil dihapus!!');
				document.location.href = 'pembelian';
			</script>
		";

			// redirect('admin/pembelian');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function detail_pembelian($beli_notrans)
	{
		if ($this->session->userdata('akses') == '1') {
			$detail = $this->m_pembelian->detail_pembelian($beli_notrans);
			$data['detail'] = $detail;
			$this->load->view('admin/v_detailpembelian', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}