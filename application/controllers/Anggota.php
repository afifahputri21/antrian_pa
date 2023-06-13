<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Anggota  extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
        $this->load->model('Poli_model');
        $this->load->model('Pasien_model');
        $this->load->model('Anggota_model');
        $this->load->model('RM_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Anggota Pasien";
        $data['anggota'] = $this->Anggota_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Anggota/vw_anggota", $data);
        $this->load->view("layout/footer");
    }

    function edit($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['anggota'] = $this->Anggota_model->getById($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama Wajib di isi'
        ]);
        $this->form_validation->set_rules('nik', 'NIK', 'required', [
            'required' => 'NIK Wajib di isi'
        ]);
        $this->form_validation->set_rules('ttl', 'Tanggal Lahir', 'required', [
            'required' => 'Tanggal Lahir Wajib di isi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Alamat Wajib di isi'
        ]);
        $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required', [
            'required' => 'Kelurahan Wajib di isi'
        ]);
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required', [
            'required' => 'Kecamatan Wajib di isi'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
            'required' => 'Jenis Kelamin Wajib di isi'
        ]);
        $this->form_validation->set_rules('usia', 'Usia', 'required', [
            'required' => 'Usia Wajib di isi'
        ]);
        $this->form_validation->set_rules('goldar', 'Golangan Darah', 'required', [
            'required' => 'Golangan Darah Wajib di isi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("Anggota/vw_anggota", $data);
            $this->load->view("layout/footer");
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'ttl' => $this->input->post('ttl'),
                'alamat' => $this->input->post('alamat'),
                'kelurahan' => $this->input->post('kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'usia' => $this->input->post('usia'),
                'goldar' => $this->input->post('goldar'),
            ];
            // print_r($data);
            // die;
            $id = $this->input->post('id');
            $this->Anggota_model->update(['id' => $id], $data);

            // print_r($db);
            // die;
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
            redirect('Anggota');
        }
    }

    function hapus($id)
    {
        $this->Anggota_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Anggota');
    }
    function detail($id)
    {
        $data['judul'] = "Halaman Detail Anggota Pasien dan Catatan Rekam Medis";
        // $data['rm'] = $this->RM_model->getByPasien($id);
        $data['anggota'] = $this->Anggota_model->getById($id);
        $nik = $data['anggota']['nik'];
        $data['rm'] = $this->RM_model->getByNIK($nik);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Anggota/vw_detail_anggota", $data);
        $this->load->view("layout/footer");
    }
}
