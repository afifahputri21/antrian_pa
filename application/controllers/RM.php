<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RM extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RM_model');
        $this->load->database('rekam_medis');
        //is_logged_in();
    }
    function index()
    {
        $data['judul'] = "Halaman Rekam Medis";
        $data['rm'] = $this->RM_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Rekam_medis/vw_rm", $data);
        $this->load->view("layout/footer");
    }
    function edit1($id)
    {
        $data['judul'] = "Halaman Edit Rekam Medis";
        $data['rm'] = $this->RM_model->getById($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Rekam_Medis/vw_edit_rm", $data);
        $this->load->view("layout/footer");
    }
    function edit($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['rm'] = $this->RM_model->getById($id);
        $data = [
            // 'id_pasien' => $this->input->post('id_pasien'),
            'tanggal_berobat' => $this->input->post('tanggal_berobat'),
            'rujukan' => $this->input->post('rujukan'),
            'keluhan' => $this->input->post('keluhan'),
            'tindakan' => $this->input->post('tindakan'),
            'obat' => $this->input->post('obat'),
        ];
        // print_r($data);
        // die;
        $id = $this->input->post('id');
        $this->RM_model->update(['id' => $id], $data);
        // print_r($db);
        // die;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('RM');
    }

    function tambah1()
    {
        $data['judul'] = "Halaman Tambah Pasien";
        $data['pasien'] = $this->Pasien_model->get();
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header"); //$data);
        $this->load->view("Pasien/vw_tambah_pasien", $data);
        $this->load->view("layout/footer");
    }
    function tambah()
    {
        $data['judul'] = "Halaman Detail Pasien dan Rekam Medis";
        //$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama Lengkap Wajib di isi'
        ]);
        $this->form_validation->set_rules('nik', 'NIK', 'required', [
            'required' => 'NIK Wajib di isi'
        ]);
        $this->form_validation->set_rules('ttl', 'Tempat Tanggal Lahir', 'required', [
            'required' => 'Tanggal Lahir Wajib di isi'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Alamat Wajib di isi'
        ]);
        $this->form_validation->set_rules('kelurahan', 'Keluruhan', 'required', [
            'required' => 'Kelurahan Wajib di isi'
        ]);
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required', [
            'required' => 'Kecamatan Wajib di isi'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("Pasien/vw_tambah_pasien", $data);
            $this->load->view("layout/footer");
        } else {

            $data = [
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'ttl' => $this->input->post('ttl'),
                'alamat' => $this->input->post('alamat'),
                'kelurahan' => $this->input->post('kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kelamin' => $this->input->post('kelamin'),
            ];
            // $upload_image = $_FILES['gambar']['name'];
            // if ($upload_image) {
            //     $config['allowed_types'] = 'gif|jpg|png';
            //     $config['max_size'] = '2048';
            //     $config['upload_path'] = './assets/img/dosen/';
            //     $this->load->library('upload', $config);
            //     if ($this->upload->do_upload('gambar')) {
            //         $new_image = $this->upload->data('file_name');
            //         $this->db->set('gambar', $new_image);
            //     } else {
            //         echo $this->upload->display_errors();
            //     }
        }
        $this->Pasien_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Pasien');
    }


    public function hapus($id)
    {
        $this->RM_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('RM');
    }
    public function getRiwayat()
    {
        // // $this->db->select('rm.*');
        // // $this->db->from('rekam_medis rm');
        // // //$this->db->join('pasien pa', 'rm.id_pasien = pa.id');
        // // // $this->db->join('poli po', 'b.id_poli = po.id');
        // // // $this->db->from($this->table);
        // // $query = $this->db->get();
        // // return $query->result_array();

        // $result = $this->db->query("SELECT * FROM rekam_medis rm");
        // //$list = array();
        // if ($result) {
        //     while ($row = mysqli_fetch_array($result)) {
        //         $list[] = $row;
        //     }
        // }
        // echo json_decode($list);
        // print($result);
        // Creating connection
        $conn = new mysqli('localhost', 'root', '', 'antrian');

        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM booking";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row[] = $result->fetch_assoc()) {

                $item = $row;

                $json = json_encode($item, JSON_NUMERIC_CHECK);
            }
        } else {
            echo "No Data Found.";
        }
        echo $json;
        $conn->close();
    }

    function testing()
    {

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        // Connect to the database
        $mysqli = new mysqli('localhost', 'root', '', 'antrian');

        // Query the database
        $result = $mysqli->query("SELECT name, email FROM user");

        // Convert the results to JSON
        $rows = array();
        while ($r = $result->fetch_assoc()) {
            $rows[] = $r;
        }
        print json_encode($rows);

        // Close the database connection
        $mysqli->close();
    }
}
