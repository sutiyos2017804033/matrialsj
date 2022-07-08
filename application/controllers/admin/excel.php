<?php

class excel extends CI_Controller
{
    function index()
    {
        if ($this->session->userdata('akses') == '1' || '3') {

            $this->load->view('admin/excel.php');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
}
