<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Perawat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
        $this->load->model('Poli_model');
        $this->load->model('Pasien_model');
        $this->load->model('Anggota_model');
        $this->load->model('RM_model');
        $this->load->model('User_model');
        $this->load->model('Perawat_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Akun Pegawai";
        $data['pegawai'] = $this->Perawat_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Pegawai/vw_pegawai", $data);
        $this->load->view("layout/footer");
    }

    function edit($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['pegawai'] = $this->Perawat_model->getById($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'nama' => $this->input->post('nama'),
            'nip' => $this->input->post('nip'),
            'ttl' => $this->input->post('ttl'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'alamat' => $this->input->post('alamat'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'hp' => $this->input->post('hp'),
            'kelamin' => $this->input->post('kelamin'),
            'pendidikan' => $this->input->post('pendidikan'),
            'jabatan' => $this->input->post('jabatan'),
            'email' => $this->input->post('email'),
        ];
        // print_r($data);
        // die;
        $id = $this->input->post('id');
        $this->Perawat_model->update(['id' => $id], $data);

        // print_r($db);
        // die;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai Berhasil Diubah!</div>');
        redirect('Perawat');
    }
    function tambah()
    {
        $data['judul'] = "Halaman Tambah Pegawai";
        $data['pasien'] = $this->Perawat_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Pegawai/vw_tambah_perawat", $data);
        $this->load->view("layout/footer");
    }
    function button_tambah()
    {
        $data['judul'] = "Halaman Tambah Perawat";
        $nama = $this->input->post('nama');
        $nip = $this->input->post('nip');
        //$email = substr($nama, 0, 4) . substr($nik, 0, 3) . '@gmail.com';
        $data = [
            'nama' => $nama,
            'nip' => $nip,
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'ttl' => $this->input->post('ttl'),
            'alamat' => $this->input->post('alamat'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelamin' => $this->input->post('kelamin'),
            'hp' => $this->input->post('hp'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('email'),
            'jabatan' => $this->input->post('jabatan'),
            'pendidikan' => $this->input->post('pendidikan'),
        ];
        $data1 = [
            //'nama' => $this->input->post('nama'),
            'name' => $nama,
            'email' => $this->input->post('email'),
            'nik' => $nip,
            'password' => password_hash($this->input->post('email'), PASSWORD_DEFAULT),
            'role_id' => 3,
            'status' => 'Pegawai',
        ];
        // print_r($data);
        // die;
        //$this->Perawat_model->insert($data);
        $this->User_model->insert($data1);
        $this->load->model('Perawat_model');
        $this->load->database();
        $this->Perawat_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai Berhasil Ditambah!</div>');
        redirect('Perawat');
    }
    function hapus($id)
    {
        $this->Perawat_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai Berhasil Dihapus!</div>');
        }
        redirect('Perawat');
    }
}
