<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
        $this->load->model('Poli_model');
        $this->load->database('booking');
        // is_logged_in();
    }
    function index()
    {
        $data['judul'] = "Halaman Antrian";
        $date = date("Y-m-d");
        $data['gigi'] = $this->Antrian_model->getgigi_db($date);
        $data['umum'] = $this->Antrian_model->getumum_db($date);
        $data['lansia'] = $this->Antrian_model->getlansia_db($date);
        $data['anak'] = $this->Antrian_model->getanak_db($date);
        $data['kia'] = $this->Antrian_model->getkia_db($date);
        $data['gigipr'] = $this->Antrian_model->getgigiproses();
        $data['umumpr'] = $this->Antrian_model->getumumproses();
        $data['lansiapr'] = $this->Antrian_model->getlansiaproses();
        $data['anakpr'] = $this->Antrian_model->getanakproses();
        $data['kiapr'] = $this->Antrian_model->getkiaproses();
        // $data['poli'] = $this->Poli_model->get();

        // print_r($data['umumpr']);
        // die;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Dashboard/dashboard", $data);
        $this->load->view("layout/footer");
    }
    function edit1($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['pasien'] = $this->Antrian_model->getById($id);
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header"); //$data);
        $this->load->view("Pasien/vw_edit_pasien", $data);
        $this->load->view("layout/footer");
    }
    function edit($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['antrian'] = $this->Antrian_model->getById($id);

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
        // $upload_image = $_FILES['gambar']['name'];
        // if ($upload_image) {
        //     $config['allowed_types'] = 'gif|jpg|png';
        //     $config['max_size'] = '2048';
        //     $config['upload_path'] = './assets/img/dosen/';
        //     $this->load->library('upload', $config);

        //     if ($this->upload->do_upload('gambar')) {

        //         $new_image = $this->upload->data('file_name');
        //         $this->db->set('gambar', $new_image);
        //         $query = $this->db->set('gambar', $new_image);
        //         if ($query) {
        //             $old_image = $this->db->get_where('dosen', ['id' => $id])->row();
        //             unlink(FCPATH . 'assets/img/dosen/' . $old_image->gambar);
        //         }
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // }
        $id = $this->input->post('id');
        $this->Antrian_model->update(['id' => $id], $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Antrian');
    }

    function tambah1()
    {
        $data['judul'] = "Halaman Tambah Pasien";
        $data['poli'] = $this->Poli_model->get();
        $data['antrian'] = $this->Antrian_model->get();
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header"); //$data);
        $this->load->view("Antrian/vw_tambah_antrian", $data);
        $this->load->view("layout/footer");
    }
    function tambah()
    {
        $data['judul'] = "Halaman Tambah Antrian";

        $data['poli'] = $this->Poli_model->get();
        //$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('pasien', 'Nama Lengkap', 'required', [
            'required' => 'Nama Lengkap Wajib di isi'
        ]);
        $this->form_validation->set_rules('poliknik', 'Poliknik', 'required', [
            'required' => 'Poliknik Wajib di isi'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("Antrian/vw_tambah_antrian", $data);
            $this->load->view("layout/footer");
        } else {
            $data['antrian'] = $this->Antrian_model->get();
            $noAntrian = 1;
            $nowDate = date('Y-m-d');

            $this->db->limit('1');
            $this->db->where('tanggal', $nowDate);
            $this->db->order_by('no_antrian', 'DESC');
            $antrian = $this->db->get('booking')->row();

            if ($antrian) {
                $no = $antrian->no_antrian;
            } else {
                $no = 0;
            }

            $no = $no + 1;
            $data = [
                'pasien' => $this->input->post('pasien'),
                'poliknik' => $this->input->post('poliknik'),
                'no_antrian' => $no,
            ];
            // print_r($data);
            // die;
            $this->Antrian_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
            redirect('Antrian');
        }
    }


    public function hapus($id)
    {
        $this->Antrian_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Antrian');
    }
    public function panggil($id)
    {
        $data['antrian'] = $this->Antrian_model->getById($id);
        $status = $data['antrian']['status'];
        // print_r($status);
        // die;
        $data = [
            'status' => "Diproses",
            // 'id' => $data['antrian']
        ];
        // print_r($data);
        // die;
        //  $id = $this->input->post('id');
        $this->Antrian_model->updatestatus1(['id' => $id], $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Antrian');
    }
}
