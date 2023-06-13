<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Akun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->model('Anggota_model');
        $this->load->model('User_model');
        $this->load->model('RM_model');
        $this->load->model('Akses_model');
        //is_logged_in();
    }
    function index()
    {
        $data['judul'] = "Halaman Akun Pegawai";
        $data['akun'] = $this->User_model->get();
        $data['level'] = $this->User_model->getLevel();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Akun/vw_akun", $data);
        $this->load->view("layout/footer");
    }
    function tambah()
    {
        $data = [
            'name' => $this->input->post('nama'),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'password' => password_hash($this->input->post('email'), PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            'role_id' => 3,
            'status' => 'Pegawai',
        ];
        // print_r($data);
        // die;
        $this->User_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Akun');
    }

    function hapus($id)
    {
        $this->User_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Akun');
    }

    function edit($id)
    {
        $data['level'] = $this->User_model->getLevel();
        $data['akun'] = $this->User_model->getById($id);
        $data = [
            // 'id_pasien' => $this->input->post('id_pasien'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'role_id' => $this->input->post('role_id'),

        ];
        // print_r($data);
        // die;
        $id = $this->input->post('id');
        $this->User_model->update(['id' => $id], $data);
        // print_r($db);
        // die;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Akun');
    }
    function hak_akses()
    {
        $data['judul'] = "Halaman Manajemen Hak Akses";
        $data['akses'] = $this->User_model->getAkses();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Akun/vw_hak_akses", $data);
        $this->load->view("layout/footer");
    }
    function tambah_akses()
    {
        $data = [
            'nama_role' => $this->input->post('nama_role'),
            'level' => $this->input->post('level'),
        ];
        // print_r($data);
        // die;
        $this->Akses_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Akun/hak_akses');
    }
    function edit_hak_akses($id)
    {
        //$data['level'] = $this->User_model->getLevel();
        $data['akses'] = $this->User_model->getByRoleId($id);
        $data = [
            // 'id_pasien' => $this->input->post('id_pasien'),
            'nama_role' => $this->input->post('nama_role'),
            'level' => $this->input->post('level'),
        ];
        // print_r($data);
        // die;
        $id = $this->input->post('id');
        $this->User_model->updateRole(['id' => $id], $data);
        // print_r($db);
        // die;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Akun/hak_akses');
    }
    function hapus_akses($id)
    {
        $this->User_model->deleteAkses($id);
        // print_r($id);
        // die;
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
        }
        redirect('Akun/hak_akses');
    }
}
