<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // memanggil model laporan_m
        $this->load->model('laporan_m', 'laporan'); // <- laporan digunakan untuk merubah/alias dari laporan_m jadi cukup menuliskan laporan
    }

    function index()
    {
        $data["tb_kategori"] = $this->laporan->getKategori();

        // validasi data
        $this->form_validation->set_rules($this->laporan->rules());
        if ($this->form_validation->run() == FALSE) {
            // memanggil halaman view admin/laporan_v.php
            $this->load->view('laporan_v', $data);
        } else {
            $this->laporan->tambahLaporan();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('beranda');
        }
        // memanggil halaman view admin/laporan_v
        // $this->load->view("laporan_v");
    }
}
