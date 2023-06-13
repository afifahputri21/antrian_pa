<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->model('Pasien_model');
        $this->load->model('Anggota_model');
        $this->load->model('User_model');
        $this->load->model('RM_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Pasien";
        $data['pasien'] = $this->Pasien_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Pasien/vw_pasien", $data);
        $this->load->view("layout/footer");
    }
    function admin()
    {
        $data['judul'] = "Halaman Pasien";
        $data['pasien'] = $this->Pasien_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_pasien", $data);
        $this->load->view("layout/footer");
    }
    function edit($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['rm'] = $this->RM_model->getByPasien($id);
        // $data['rm1'] = $this->RM_model->getById($id);
        $data['pasien'] = $this->Pasien_model->getById($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

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
        $this->Pasien_model->update(['id' => $id], $data);

        // print_r($db);
        // die;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Pasien/admin');
        //}
    }

    function detail($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['rm'] = $this->RM_model->getByPasien($id);
        $data['anggota'] = $this->Anggota_model->getByRoot($id);
        $data['pasien'] = $this->Pasien_model->getById($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Pasien/vw_detail_pasien", $data);
        $this->load->view("layout/footer");
    }

    function edit_button($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['pasien'] = $this->Pasien_model->getById($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('tanggal_berobat', 'Tanggal Berobat', 'required', [
            'required' => 'Tanggal Beorbat Wajib di isi'
        ]);
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required', [
            'required' => 'Keluhan Penyakit Wajib di isi'
        ]);
        // $this->form_validation->set_rules('inisial', 'Inisial', 'required', [
        //     'required' => 'Inisial Wajib di isi'
        // ]);
        // $this->form_validation->set_rules('prodi', 'Prodi', 'required', [
        //     'required' => 'Prodi Wajib di isi'
        // ]);
        // $this->form_validation->set_rules('email', 'Email', 'required', [
        //     'required' => 'Email Wajib di isi'
        // ]);
        // $this->form_validation->set_rules('kompetensi', 'Kompetensi', 'required', [
        //     'required' => 'Kompetensi Wajib di isi'
        // ]);
        // if ($this->form_validation->run() == false) {
        $this->load->view("layout/header", $data);
        $this->load->view("Pasien/vw_edit_pasien", $data);
        $this->load->view("layout/footer");
        // } else {
        $data = [
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'ttl' => $this->input->post('ttl'),
            'alamat' => $this->input->post('alamat'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelamin' => $this->input->post('kelamin'),
        ];

        $id = $this->input->post('id');
        $this->Pasien_model->update(['id' => $id], $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Pasien');
    }
    public function export($id)
    {
        $dompdf = new Dompdf();
        //$date = date("Y-m-d");
        $data['rm'] = $this->RM_model->getByPasien($id);
        $data['pasien'] = $this->Pasien_model->getById($id);
        $nama = $data['pasien']['nama'];
        $data['title'] = 'Data Lengkap Pasien ' . $nama;
        $data['no'] = 1;
        $dompdf->setPaper('A4', 'Landscape');
        $html = $this->load->view('Pasien/print_detail', $data, true);
        // $html2 =  $this->load->view("layout/header");
        // $html3 =  $this->load->view("layout/footer");
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Detail Pasien ' . $nama, array("Attachment" => false));
    }
    function tambah1()
    {
        $data['judul'] = "Halaman Tambah Pasien";
        $data['pasien'] = $this->Pasien_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Pasien/vw_tambah_pasien", $data);
        $this->load->view("layout/footer");
    }
    function tambah()
    {
        $data['judul'] = "Halaman Tambah Pasien";
        $nama = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $email = substr($nama, 0, 4) . substr($nik, 0, 3) . '@gmail.com';
        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'ttl' => $this->input->post('ttl'),
            'alamat' => $this->input->post('alamat'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'jenis_kelamin' => $this->input->post('kelamin'),
            'email' => $email,
            'goldar' => $this->input->post('goldar'),
            'password' => $nik,
            'status_antrian' => 'Prioritas ON',
        ];
        // print_r($data);
        // die;
        $this->Pasien_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Pasien');
    }


    function hapus($id)
    {
        $this->Pasien_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Pasien');
    }

    //KHUSUS ANDROID
    function cek_login()
    {
        $id = $this->input->post('nik');
        $sqlid = $this->db->get_where('pasien', ['nik' => $id])->row_array();

        if ($sqlid != null) {
            $username = $sqlid['email'];
            $password = $this->input->post('password');
            $user = $this->db->get_where('user', ['nik' => $id])->row_array();
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $pasien = $this->Pasien_model->getByNIK($id);
                    $anggota = $this->Anggota_model->getByNIK($id);
                    if (empty($pasien)) { //jika di data pasien gk ada NIKNYA
                        $data1 = [ //maka akan mengambil data anggota
                            'id' => $anggota['id'],
                            'email' => $anggota['email'],
                            'nama' => $anggota['nama'],
                            'nik' => $anggota['nik'],
                            'tempat_lahir' => $anggota['tempat_lahir'],
                            'ttl' => $anggota['ttl'],
                            'alamat' => $anggota['alamat'],
                            'kelurahan' => $anggota['kelurahan'],
                            'kecamatan' => $anggota['kecamatan'],
                            'jenis_kelamin' => $anggota['jenis_kelamin'],
                            'usia' => $anggota['usia'],
                            'goldar' => $anggota['goldar'],
                        ];
                        $response['user'] = $data1;
                        echo json_encode($response);
                    } else { //SELAIN ITU APALAGI KALAU NIKNYA GK ADA MAKA AMBIL DATA PASIEN PERTAMA
                        $data = [
                            'id' => $pasien['id'],
                            'email' => $pasien['email'],
                            'nama' => $pasien['nama'],
                            'nik' => $pasien['nik'],
                            'tempat_lahir' => $pasien['tempat_lahir'],
                            'ttl' => $pasien['ttl'],
                            'alamat' => $pasien['alamat'],
                            'kelurahan' => $pasien['kelurahan'],
                            'kecamatan' => $pasien['kecamatan'],
                            'jenis_kelamin' => $pasien['jenis_kelamin'],
                            'usia' => $pasien['usia'],
                            'goldar' => $pasien['goldar'],
                        ];
                        $response['user'] = $data;
                        echo json_encode($response);
                    }
                } else {
                    echo json_encode(0);
                }
            } else {
                echo json_encode(1);
            }
        } else {
            echo json_encode(1);
        }
    }



    //KHUSUS ANDROID
    function cek_regis()
    {
        $date = date('Y-m-d');
        //$data['pasien'] = $this->Pasien_model->get();
        $nik = $this->input->post("nik");
        $nama = $this->input->post("nama");
        $tempat_lahir = $this->input->post("tempat_lahir");
        $ttl = $this->input->post("ttl");
        //  $username = $this->input->post("username");
        $password = $this->input->post("password");
        $alamat = $this->input->post("alamat");
        $kecamatan = $this->input->post("kecamatan");
        $kelurahan = $this->input->post("kelurahan");
        $goldar = $this->input->post("goldar");
        $usia = $this->hitungSelisihTahun($ttl, $date);

        $data = [
            //'nama' => $this->input->post('nama'),
            // 'email' => $username,
            'password' => $password,
            'nama' => $nama,
            'nik' => $nik,
            'ttl' => $ttl,
            'alamat' => $alamat,
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'tempat_lahir' => $tempat_lahir,
            'goldar' => $goldar,
            'usia' => $usia,
            'status_antrian' => 'Prioritas ON',
        ];
        $data1 = [
            //'nama' => $this->input->post('nama'),
            'name' => $nama,
            'nik' => $nik,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role_id' => 4,
            'status' => 'Pasien',
        ];
        $dataInsert = $this->User_model->insert($data1);
        $this->load->model('Pasien_model');
        $this->load->database();
        $dataInsert = $this->Pasien_model->insert($data);
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akunmu telah berhasil terdaftar, Silahkan Login! </div>');
        echo json_encode($dataInsert);
    }

    private function hitungSelisihTahun($ttl, $today)
    {
        $selisih = strtotime($today) - strtotime($ttl);
        return floor($selisih / (60 * 60 * 24 * 365));
    }
}
