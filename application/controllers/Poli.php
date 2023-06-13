<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Poli extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Antrian_model');
        $this->load->model('Poli_model');
        // $this->load->model('Pasien_model');
        // $this->load->model('Anggota_model');
        // $this->load->model('RM_model');
        $this->load->model('User_model');
        //$this->load->model('Perawat_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Poliknik";
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Poli/vw_poli", $data);
        $this->load->view("layout/footer");
    }

    function edit($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['poli'] = $this->Poli_model->getById($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'nama_poli' => $this->input->post('nama_poli'),
            'kode' => $this->input->post('kode'),
            'penjelasan' => $this->input->post('penjelasan'),

        ];
        // print_r($data);
        // die;
        $id = $this->input->post('id');
        $this->Poli_model->update(['id' => $id], $data);

        // print_r($db);
        // die;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai Berhasil Diubah!</div>');
        redirect('Poli');
    }
    function tambah()
    {
        $data['judul'] = "Halaman Tambah Pegawai";
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Pegawai/vw_tambah_perawat", $data);
        $this->load->view("layout/footer");
    }
    function button_tambah()
    {
        $data['judul'] = "Halaman Tambah Perawat";
        $nama = $this->input->post('nama_poli');
        $kode = $this->input->post('kode');
        //$email = substr($nama, 0, 4) . substr($nik, 0, 3) . '@gmail.com';
        $data = [
            'nama_poli' => $nama,
            'kode' => $kode,
            'penjelasan' => $this->input->post('penjelasan'),
        ];
        // print_r($data);
        // die;

        $this->Poli_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai Berhasil Ditambah!</div>');
        redirect('Poli');
    }
    function hapus($id)
    {
        $this->Poli_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai Berhasil Dihapus!</div>');
        }
        redirect('Poli');
    }
}
