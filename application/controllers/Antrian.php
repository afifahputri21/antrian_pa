<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Antrian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
        $this->load->model('Poli_model');
        $this->load->model('Pasien_model');
        $this->load->model('Anggota_model');
        //$this->load->library('export');
        $this->load->helper('url');
        $this->load->database('booking');
        //$this->tabel          = "antrian_poli";
        // is_logged_in();
    }
    function index()
    {
        $data['judul'] = "Halaman Antrian";
        $data['antrian'] = $this->Antrian_model->get();
        $data['kapasitas'] = $this->Antrian_model->getKapasitas();
        $tanggal = date("Y-m-d");
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Antrian/vw_antrian", $data);
        $this->load->view("layout/footer");
    }

    function admin()
    {
        $data['judul'] = "Halaman Antrian";
        $data['antrian'] = $this->Antrian_model->getAdmin();
        $data['kapasitas'] = $this->Antrian_model->getKapasitas();
        $tanggal = date("Y-m-d");
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_antrian", $data);
        $this->load->view("layout/footer");
    }
    function changeKapasitas($id)
    {
        $data['judul'] = "Halaman Edit Pasien";
        $data['kapasitas'] = $this->Antrian_model->getByIdKapasitas($id);
        $data = [
            // 'id_pasien' => $this->input->post('id_pasien'),
            'kapasitas' => $this->input->post('kapasitas'),
        ];
        // print_r($data);
        // die;
        $id = $this->input->post('id');
        $this->Antrian_model->updateKapasitas(['id' => $id], $data);
        // print_r($data);
        // die;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Antrian');
    }

    //FUNCTION TAMBAH3 DIGUNAKAN SELANJUTNYA, MULAI UNTUK BUAT ON OFF SSWITCH PQ
    function tambah3($nik)
    {
        // $this->form_validation->set_rules('nik', 'NIK', 'required', ['required' => 'NIK wajib disi']);
        $this->form_validation->set_rules('poliknik', 'Poliknik', 'required', ['required' => 'Poliknik wajib disi']);
        $data['judul'] = "Halaman Tambah Antrian";
        $data['poli'] = $this->Poli_model->get();
        $data['antrian'] = $this->Antrian_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view("layout/header", $data);
            $this->load->view("Antrian/vw_tambah_antrian", $data);
            $this->load->view("layout/footer");
        } else {
            $nik1 = $nik;
            $pasien = $this->Pasien_model->getByNIK($nik1);
            $anggota = $this->Anggota_model->getByNIK($nik1);
            if (empty($pasien)) {
                $data['anggota'] = $anggota;
                $nama = $data['anggota']['nama'];
                $id_pasien = $data['anggota']['id_root'];
                $tanggal = date("Y-m-d");
                $umur = $data['anggota']['usia'];
                $status_antrian = $data['anggota']['status_antrian'];
            } else {
                $data['pasien'] = $pasien;
                $nama = $data['pasien']['nama'];
                $id_pasien = $data['pasien']['id'];
                $tanggal = date("Y-m-d");
                $umur = $data['pasien']['usia'];
                $status_antrian = $data['pasien']['status_antrian'];
            }
            $poli = $this->input->post('poliknik');
            $kehamilan = $this->input->post('kehamilan');
            $data['nama_poli'] = $this->Poli_model->getById($poli);
            //ON OFF DILAKUKAN POST, KALAU ON = 1 JADINYA 
            $nama_poli = $data['nama_poli']['nama_poli'];
            if ($umur >= 60) {
                $bobot = 9;
            } elseif ($umur <= 5) {
                $bobot = 8;
            } elseif ($kehamilan == 1) {
                $bobot = 7;
            } else {
                $bobot = 6;
            }
            $tanggal = date('Y-m-d');
            // $cekAntrian = $this->Antrian_model->cekRow($poli, $tanggal);
            $cekAntrian = $this->Antrian_model->cekRow($poli, $tanggal);
            $batas = $this->Antrian_model->cekKapasitas(); //cek banya antrian hari ini
            // print_r($cekAntrian);
            // die;
            if ($cekAntrian >= $batas) {
                $date = date('Y-m-d', strtotime('+1 day', strtotime($tanggal)));
                //ubah ke hari esok
            } else {
                $date = date('Y-m-d');
            }
            // print_r($date);
            // die;
            if ($status_antrian == 'Prioritas ON') { // kalau antrian prioritas ON
                $nomor_antrian_baru =  $this->getNoAntrian2($poli, $umur, $kehamilan, $bobot, $date);
            } else {
                $nomor_antrian_baru =  $this->getNoAntrian($poli, $date); //kalau prioritas OFF
            }
            $data = [
                'nik' => $nik1,
                'id_poli' => $poli,
                'id_pasien' => $id_pasien,
                'nama_poli' => $nama_poli,
                'nama' => $nama,
                'umur' => $umur,
                'no_antrian' => $nomor_antrian_baru,
                'status' => "Pending",
                'tanggal' => $date,
                'bobot' => $bobot,
                'sisa' => $nomor_antrian_baru,

                //'jam' =>  date("h:i:s"),
            ];
            //}
            // print_r($data);
            // die;
            $this->Antrian_model->insert($data);
            $this->printNomorAntrian($nomor_antrian_baru, $date, $nama_poli);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
            redirect('Antrian');
            //echo '<script>window.location.href = "' . site_url('Antrian') . '";</script>';
        }
    }
    //PRINT NOMOR ANTRIAN
    public function printNomorAntrian($nomor_antrian_baru, $date, $nama_poli)
    {
        $dompdf = new Dompdf();
        $dompdf->setPaper('A5', 'Landscape');
        $html = $this->load->view('Antrian/print_antrian', compact('nomor_antrian_baru', 'date', 'nama_poli'), true);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();

        // Menyimpan file PDF ke server (Opsional)
        $filename = 'No Antrian ' . $nomor_antrian_baru . ' Poli ' . $nama_poli . '.pdf';
        file_put_contents('C:\Users\User\Downloads' . $filename, $output);

        // Mengirim file PDF ke browser untuk diunduh
        $this->force_download($filename, $output);
        redirect('Antrian');
        // echo '<script>window.location.href = "' . site_url('Antrian') . '";</script>';
    }

    private function force_download($filename, $data)
    {
        ob_clean();
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($data));
        header('Connection: close');
        echo $data;
        // Redirection
        // header('Location: ' . site_url('Antrian'));
        exit();
    }


    //FUNCTION UNTUK FIFO
    function getNoAntrian()
    {
        $id_poli = $this->input->post('poliknik');
        $tanggal = date("Y-m-d");
        //$data['booking'] = $this->Antrian_model->get();
        $this->db->where('booking.id_poli', $id_poli);
        $this->db->where('booking.tanggal', $tanggal);
        $sql = $this->db->get('booking');
        $getPoli = $sql->num_rows(); //cek jumlah row table

        if ($getPoli == 0) { //kondisi jika belum ada yg daftar perhari
            $this->db->where('id_poli', $id_poli);
            $sql2 = $this->db->get('booking');
            $rowPoli = $sql2->row();
            $no = 1;
            //$kode1 = $rowPoli->kode;
            $noAntrian = //$kode1 . 
                $no;
            //$maks = $rowPoli->time('12:00');
        } else {
            //kondisi jika sudah ada data per hari
            $this->db->limit(1);
            $this->db->order_by('no_antrian', "DESC");
            $this->db->where('booking.id_poli', $id_poli);
            $this->db->where('booking.tanggal', $tanggal);
            $sql = $this->db->get('booking');
            $rowNo = $sql->row();

            $this->db->where('id_poli', $id_poli);
            $sql2 = $this->db->get('booking');
            $rowPoli = $sql2->row();
            // $kode1 = $rowPoli->kode;
            $no = $rowNo->no_antrian + 1;
            $noAntrian = //$kode1 . 
                $no;
        }

        // $hasil = array("no_hasil" => $noAntrian, "no" => $no, "maks" => $maks);
        // echo json_encode($hasil);
        return $noAntrian;
    }

    //FUCNTION GETNOANTRIAN2 UNTUK PRIORITY QUEUE
    function getNoAntrian2($poli, $umur, $kehamilan, $bobot, $date)
    {
        $id_poli = $poli;
        $usia = $umur;
        $cek_bobot = $bobot;
        $stat_preg = $kehamilan;
        //$tanggal = $date;
        $tanggal = $date;
        //$data['booking'] = $this->Antrian_model->get();
        $this->db->where('booking.id_poli', $id_poli);
        $this->db->where('booking.tanggal', $tanggal);
        $this->db->where('status', 'Pending');
        $sql = $this->db->get('booking');
        $getPoli = $sql->num_rows(); //cek jumlah row table

        if ($getPoli == 0) { //kondisi jika belum ada yg daftar perhari
            $this->db->where('id_poli', $id_poli);
            $sql2 = $this->db->get('booking');
            $rowPoli = $sql2->row();
            $no = 1;
            return $noAntrian = $no;
        } else if ($getPoli > 0) {
            $this->db->order_by('no_antrian', "ASC");
            $this->db->where('booking.id_poli', $id_poli);
            $this->db->where('booking.tanggal', $tanggal);
            $query = $this->db->get('booking');

            if ($cek_bobot == 9) {
                $this->db->limit(1);
                $this->db->order_by('no_antrian', "ASC");
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where_not_in('status', 'Selesai');
                $this->db->where('booking.bobot >=', 9);
                $sql = $this->db->get('booking');
                $rowNo = $sql->row();
                $noAntrian = $rowNo->no_antrian + 1;
                //UPDATE NOMOR ANTRIAN DIBAWAHNYA
                $this->db->set('no_antrian', 'no_antrian+1', false);
                $this->db->set('sisa', 'no_antrian', false);
                $this->db->where('bobot <', 9);
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->update('booking');
            } elseif ($cek_bobot == 8) {
                $this->db->limit(1);
                $this->db->order_by('no_antrian', "DESC");
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->where('booking.bobot >=', 8);
                $sql = $this->db->get('booking');
                $rowNo1 = $sql->row();
                $noAntrian = $rowNo1->no_antrian + 1;
                //UPDATE NOMOR ANTRIAN DIBAWAHNYA

                $this->db->set('no_antrian', 'no_antrian+1', false);
                $this->db->set('sisa', 'no_antrian', false);
                $this->db->where('bobot <', 8);
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->update('booking');
            } elseif ($cek_bobot == 7) {
                $this->db->limit(1);
                $this->db->order_by('no_antrian', "DESC");
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->where('booking.bobot >=', 7);
                $sql = $this->db->get('booking');
                $rowNo2 = $sql->row();
                $noAntrian = $rowNo2->no_antrian + 1;
                //UPDATE NOMOR ANTRIAN BAWAH
                $this->db->set('no_antrian', 'no_antrian+1', false);
                $this->db->set('sisa', 'no_antrian', false);
                $this->db->where('bobot <', 7);
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->update('booking');
            } else { //BOBOT 6
                $this->db->limit(1);
                $this->db->order_by('no_antrian', "DESC");
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $sql = $this->db->get('booking');
                $rowNo = $sql->row();
                $noAntrian = $rowNo->no_antrian + 1;
            }


            //Jika berada di barisan paling bawah
            //$noAntrian++;

            return $noAntrian;
        }
    }

    //LANJUT KODINGAN NOMOR ANTRIAN

    function hapus($id)
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

    public function off($nik)
    {
        $data['judul'] = "Halaman Tambah Antrian";
        $data['poli'] = $this->Poli_model->get();
        $data['antrian'] = $this->Antrian_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Cek apakah sudah ada pembaruan hari ini
        $lastUpdateDate = $this->session->userdata('last_update_date');
        $currentDate = date('Y-m-d');
        $jumlah = $this->Antrian_model->jumlah($currentDate);
        if ($lastUpdateDate !== $currentDate && $jumlah != 0) {
            $this->db->update('pasien', array('status_antrian' => 'Prioritas OFF'));
            $this->db->update('anggota', array('status_antrian' => 'Prioritas OFF'));

            // Simpan tanggal pembaruan terbaru dalam session
            $this->session->set_userdata('last_update_date', $currentDate);
        } else {
            // Tindakan yang akan diambil jika pembaruan dilakukan lebih dari sekali sehari
            // Misalnya, tampilkan pesan kesalahan atau arahkan pengguna ke halaman lain
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Anda sudah mencapai limit untuk perubahan jenis antrian</div>');
            redirect('Antrian');
        }
        $pasien = $this->Pasien_model->getByNIK($nik);
        $anggota = $this->Anggota_model->getByNIK($nik);
        if (!empty($pasien)) {
            $data['ajuan'] = $pasien;
            //$data['antrian'] = $data['ajuan']['status_antrian'];
        } elseif (!empty($anggota)) {
            $data['ajuan'] = $anggota;
            // $data['antrian'] = $data['ajuan']['status_antrian'];
        } else {
            redirect('Pasien/tambah1');
        }
        $this->load->view('layout\header', $data);
        $this->load->view('Antrian\vw_tambah_antrian', $data);
        $this->load->view('layout\footer');
    }

    public function on($nik)
    {
        $data['judul'] = "Halaman Tambah Antrian";
        $data['poli'] = $this->Poli_model->get();
        $data['antrian'] = $this->Antrian_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Cek apakah sudah ada pembaruan hari ini
        $lastUpdateDate = $this->session->userdata('last_update_date');
        $currentDate = date('Y-m-d');
        if ($lastUpdateDate !== $currentDate) {
            $this->db->update('pasien', array('status_antrian' => 'Prioritas ON'));
            $this->db->update('anggota', array('status_antrian' => 'Prioritas ON'));

            // Simpan tanggal pembaruan terbaru dalam session
            $this->session->set_userdata('last_update_date', $currentDate);
        } else {
            // Tindakan yang akan diambil jika pembaruan dilakukan lebih dari sekali sehari
            // Misalnya, tampilkan pesan kesalahan atau arahkan pengguna ke halaman lain
            redirect('Antrian');
        }
        $pasien = $this->Pasien_model->getByNIK($nik);
        $anggota = $this->Anggota_model->getByNIK($nik);
        if (!empty($pasien)) {
            $data['ajuan'] = $pasien;
            //$data['antrian'] = $data['ajuan']['status_antrian'];
        } elseif (!empty($anggota)) {
            $data['ajuan'] = $anggota;
            // $data['antrian'] = $data['ajuan']['status_antrian'];
        } else {
            redirect('Pasien/tambah1');
        }
        $this->load->view('layout\header', $data);
        $this->load->view('Antrian\vw_tambah_antrian', $data);
        $this->load->view('layout\footer');
    }
    public function search()
    {

        //$this->form_validation->set_rules('nik', 'NIK', 'required', ['required' => 'NIK wajib disi']);
        $data['judul'] = "Halaman Tambah Antrian";
        $data['poli'] = $this->Poli_model->get();
        $data['antrian'] = $this->Antrian_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $nik = $this->input->post('nik');
        $pasien = $this->Pasien_model->getByNIK($nik);
        $anggota = $this->Anggota_model->getByNIK($nik);
        if (!empty($pasien)) {
            $data['ajuan'] = $pasien;
            //$data['antrian'] = $data['ajuan']['status_antrian'];
        } elseif (!empty($anggota)) {
            $data['ajuan'] = $anggota;
            // $data['antrian'] = $data['ajuan']['status_antrian'];
        } else {
            redirect('Pasien/tambah1');
        }

        $this->load->view('layout/header', $data);
        $this->load->view('Antrian/vw_tambah_antrian', $data);
        $this->load->view('layout/footer');
    }
}
