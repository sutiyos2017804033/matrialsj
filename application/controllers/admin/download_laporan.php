<?php


class download_laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        };

        $this->load->model('m_laporanPDF');
    }
    function laporanbeliexcel($beli_notrans)
    {
        if ($this->session->userdata('akses') == '1' || '3') {

            $detail =  $this->m_laporanPDF->laporanbeli($beli_notrans);
            $data['detail'] = $detail;

            $this->load->view('admin/laporan/excel_pembelian', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    function laporanbelipdf($beli_notrans)
    {
        if ($this->session->userdata('akses') == '1' || '3') {

            $detail =  $this->m_laporanPDF->laporanbeli($beli_notrans);
            $data['detail'] = $detail;

            $this->load->view('admin/laporan/pdf_pembelian', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    function laporanjualexcel($jual_notrans)
    {
        if ($this->session->userdata('akses') == '1' || '3') {

            $detail =  $this->m_laporanPDF->laporanjual($jual_notrans);
            $data['detail'] = $detail;

            $this->load->view('admin/laporan/excel_penjualan', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    function laporanjualpdf($jual_notrans)
    {
        if ($this->session->userdata('akses') == '1' || '3') {

            $detail =  $this->m_laporanPDF->laporanbeli($jual_notrans);
            $data['detail'] = $detail;

            $this->load->view('admin/laporan/pdf_penjualan', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
}