<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Dashboard extends CI_Controller {
    public function __contruct()
    {
        parent::__contruct();
    }

    public function index()
    {
        // memanggil halaman view admin/dashboard_v
        $this->load->view("admin/dashboard_v");
    }
}