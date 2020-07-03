<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('profil_m');
        $this->load->helper('url');
        $this->load->model('daftar_laporan_m', 'laporan');
        if (!$this->session->userdata('ID_USR')) {
            redirect('auth');
        }
        // is_logged_in();
    }
    public function index()
    {

        $data['admin'] = $this->db->get_where('tb_user', [
            'ID_USR' =>
            $this->session->userdata('ID_USR')
        ])->row_array();
        $data['tb_admin'] = $this->profil_m->tampil_data(); //Untuk me-load fungsi tampil_data() di modal profil_m
        $data['notif'] = $this->laporan->getLaporanUnread()->result_array();
        $data['notifcount'] = $this->laporan->getLaporanUnread()->num_rows();
        $data['role'] = $this->session->userdata('ROLE');
        $this->load->view("admin/includes/head", $data);
        $this->load->view("admin/includes/sidebar", $data);
        $this->load->view("admin/includes/navbar", $data);
        $this->load->view('admin/profil_v', $data);
        $this->load->view("admin/includes/footer.php");
        $this->load->view("admin/includes/js.php");
    }

    // baris kode function update adalah method yang diajalankan ketika tombol submit pada form v_edit ditekan, method ini berfungsi untuk merekam data, memperbarui baris database yang dimaksud, lalu mengarahkan pengguna ke controller crud method index
    function update()
    {
        // keempat baris kode ini berfungsi untuk merekam data yang dikirim melalui method post
        // Post versi terbaru :D
        $data['tb_admin'] = $this->db->get_where('tb_user', [
            'ID_USR' =>
            $this->session->userdata('ID_USR')
        ])->row_array();

        $id = $this->input->post('ID_USR');
        $nama = $this->input->post('NAMA');
        $email = $this->input->post('EMAIL');
        $nomer = $this->input->post('NOMER');
        $alamat = $this->input->post('ALAMAT');
        //cek jika ada gambar

        $upload_image = $_FILES['GAMBAR'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/Profile/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('GAMBAR')) {
                $old_image = $data['tb_admin']['GAMBAR'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('GAMBAR', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->set('NAMA', $nama);
        $this->db->set('EMAIL', $email);
        $this->db->set('NOMER', $nomer);
        $this->db->set('ALAMAT', $alamat);
        $this->db->where('ID_USR', $id);
        $this->db->update('tb_user');
        // baris kode yang mengerahkan pengguna ke link base_url()crud/index/
        redirect('admin/profil/index');
    }

    public function changePassword()
    {
        //untuk mengecek session sesuai dengan email saat login
        $data['tb_user'] = $this->db->get_where('tb_user', ['ID_USR' =>
        $this->session->userdata('ID_USR')])->row_array();

        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required|trim', [
            'required' => 'Mohon isi password saat ini!'
        ]);
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[8]|matches[new_password2]', [
            'required' => 'Mohon isi password baru!',
            'min_length' => 'Password minimal 8 digit',
            'matches' => 'Password tidak sesuai'
        ]);
        $this->form_validation->set_rules('new_password2', 'Ulangi Password', 'required|trim|min_length[8]|matches[new_password1]', [
            'required' => 'Mohon ulangi password baru!',
            'min_length' => 'Password minimal 8 digit'
        ]);

        if ($this->form_validation->run() == false) {
            // memparsing ke dalam v_changepassword 
            $data['admin'] = $this->db->get_where('tb_user', [
                'ID_USR' =>
                $this->session->userdata('ID_USR')
            ])->row_array();
            $data['tb_admin'] = $this->profil_m->tampil_data(); //Untuk me-load fungsi tampil_data() di modal profil_m
            $data['notif'] = $this->laporan->getLaporanUnread()->result_array();
            $data['notifcount'] = $this->laporan->getLaporanUnread()->num_rows();
            $data['role'] = $this->session->userdata('ROLE');
            $this->load->view("admin/includes/head", $data);
            $this->load->view("admin/includes/sidebar", $data);
            $this->load->view("admin/includes/navbar", $data);
            $this->load->view('admin/ubahpw_v', $data);
            $this->load->view("admin/includes/footer.php");
            $this->load->view("admin/includes/js.php");
        } else {

            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            //melakukan pengecekan password apakah password yang diketik oleh user sama dengan yang ada dalam database
            if (md5($current_password) != $data['tb_user']['PASSWORD']) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role= "alert">Password yang anda masukkan salah!</div>');
                redirect('profile/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role= "alert">Password tidak boleh sama dengan sebelumnya !</div>');
                    redirect('profile/changepassword');
                } else {
                    $password_hash = md5($new_password);

                    $this->db->set('PASSWORD', $password_hash);
                    $this->db->where('ID_USR', $this->session->userdata('ID_USR'));
                    $this->db->update('tb_user');


                    $this->session->set_flashdata('password_changed', '<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
                    redirect('admin/profil');
                }
            }
        }
    }

    public function edit_password()
    {
        $data['title'] = 'Edit Password';
        $data['user'] = $this->db->get_where('tb_user', ['ID_USR' =>

        $this->session->userdata('ID_USR')])->row_array();
        $data['notif'] = $this->laporan->getLaporanUnread()->result_array();
        $data['notifcount'] = $this->laporan->getLaporanUnread()->num_rows();

        $this->form_validation->set_rules('passwordSkrg', 'PasswordSkrg', 'required|trim');
        $this->form_validation->set_rules('passwordBaru1', 'Password Baru', 'required|trim|min_length[8]|matches[passwordBaru2]');
        $this->form_validation->set_rules('passwordBaru2', 'Pengulangan Password Baru', 'required|trim|min_length[8]|matches[passwordBaru1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_password', $data);
            $this->load->view('templates/footer');
        } else {
            $passwordSkrg = $this->input->post('passwordSkrg');
            $passwordBaru = $this->input->post('passwordBaru1');
            if (!password_verify($passwordSkrg, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Lama Salah</div>');
                redirect('user/edit_password');
            } else {
                if ($passwordSkrg == $passwordBaru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Tidak Boleh Sama!</div>');
                    redirect('user/edit_password');
                } else {
                    //Sudah OKE!

                    $passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

                    $this->db->set('password', $passwordHash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Telah Berhasil Diganti</div>');
                    redirect('user/edit_password');
                }
            }
        }
    }
}
