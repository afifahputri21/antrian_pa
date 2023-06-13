<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
        $this->load->model('Poli_model');
        $this->load->model('RM_model');
        $this->load->model('Anggota_model');
        $this->load->model('Pasien_model');
        $this->load->model('User_model');
        $this->load->database('booking');
        //$this->tabel          = "antrian_poli";
        //is_logged_in();
    }
    function gigi()
    {
        $data['judul'] = "List Antrian Poli Gigi Tanggal " . date('Y-m-d');
        $data['antrian'] = $this->Antrian_model->getgigi();
        $data['antrian2'] = $this->Antrian_model->getgigiproses();
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_gigi", $data);
        $this->load->view("layout/footer", $data);
    }
    function lansia()
    {
        $data['judul'] = "List Antrian Poli Lansia Tanggal " . date('Y-m-d');
        $data['antrian'] = $this->Antrian_model->getlansia();
        $data['antrian2'] = $this->Antrian_model->getlansiaproses();
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_lansia", $data);
        $this->load->view("layout/footer");
    }
    function umum()
    {
        $data['judul'] = "List Antrian Poli Umum Tanggal " . date('Y-m-d');
        $data['antrian'] = $this->Antrian_model->getumum();
        $data['antrian2'] = $this->Antrian_model->getumumproses();
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_umum", $data);
        $this->load->view("layout/footer");
    }
    function anak()
    {
        $data['judul'] = "List Antrian Poli Anak Tanggal " . date('Y-m-d');
        $data['antrian'] = $this->Antrian_model->getanak();
        $data['antrian2'] = $this->Antrian_model->getanakproses();
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_anak", $data);
        $this->load->view("layout/footer");
    }

    function send_notification($tokens, $title, $message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $tokens,
            'notification' => array(
                'title' => $title,
                'body' => $message,
            ),
        );

        $headers = array(
            'Authorization:key = AAAAhISZ-F8:APA91bGkavE5C83AHcAnt4chI9pee3ByW4gDrxqdEfsV1sXjOqpSBKRTzaRcMrsOfv7PaR0YXNtISJkWYoUo6c35_YHDqDq3gyC5UixZ_uAjxWvQFftmtEYcphlrQiUTN-VfoTE5AKDX',
            'Content-Type: application/json',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === false) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }


    function panggil_gigi($id)
    {
        $data['antrian'] = $this->Antrian_model->getById($id);
        $tanggal = $data['antrian']['tanggal'];

        $data = [
            'status' => "Diproses",
        ];

        $this->db->set('sisa', 'sisa - 1', FALSE);
        $this->db->where('id_poli', 4);
        $this->db->where('tanggal', $tanggal);
        $this->db->where_not_in('status', 'Selesai');
        $this->db->update('booking');

        // Ambil token FCM dan nama pasien
        $this->db->select('token, nama, id');
        $this->db->from('pasien');
        $query = $this->db->get();
        $tokens = array();
        $pasien_data = array();
        $pasien_id_data = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tokens[] = $row->token;
                $pasien_data[$row->token] = $row->nama;
                $pasien_id_data[$row->token] = $row->id;
            }
        }

        foreach ($tokens as $token) {
            $nama = $pasien_data[$token];
            $title = '';
            $message = '';
            $this->db->select('sisa');
            $this->db->from('booking');
            $this->db->where('id_poli', 4);
            $this->db->where('tanggal', $tanggal);
            $this->db->where('id_pasien', $pasien_id_data[$token]);
            $this->db->where_not_in('status', 'Selesai');
            $this->db->where_not_in('status', 'Diproses');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $sisa = $row->sisa;

                if ($sisa > 0) {
                    $time_remaining = $sisa * 15;
                    $title = 'Antrian Poli';
                    $message = "Halo $nama, Antrian anda akan dipanggil dalam $time_remaining menit lagi, mohon menunggu";
                } else {
                    $title = 'Anda di Panggil';
                    $message = "Halo $nama, Silahkan untuk bertemu dengan perawat di Ruang Periksa";
                }
            }
            $this->send_notification(array($token), $title, $message);
        }
        $this->Antrian_model->updatestatus1(['id' => $id], $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diubah!</div>');
        redirect('Admin/gigi');
    }
    function panggil_anak($id)
    {
        $data['antrian'] = $this->Antrian_model->getById($id);
        //$status = $data['antrian']['status'];
        $status = $data['antrian']['status'];
        $poli = $data['antrian']['id_poli'];
        $tanggal = $data['antrian']['tanggal'];
        //$sisa = $data['antrian']['sisa'];
        // print_r($status);
        // die;
        $data = [
            'status' => "Diproses",
            // 'id' => $data['antrian']
        ];

        $this->db->set('sisa', 'sisa - 1', FALSE);
        $this->db->where('id_poli', 2);
        $this->db->where('tanggal', $tanggal);
        $this->db->where_not_in('status', 'Selesai');
        $this->db->update('booking');

        // Ambil token FCM dan nama pasien
        $this->db->select('token, nama, id');
        $this->db->from('pasien');
        $query = $this->db->get();
        $tokens = array();
        $pasien_data = array();
        $pasien_id_data = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tokens[] = $row->token;
                $pasien_data[$row->token] = $row->nama;
                $pasien_id_data[$row->token] = $row->id;
            }
        }

        foreach ($tokens as $token) {
            $nama = $pasien_data[$token];
            $title = '';
            $message = '';
            $this->db->select('sisa');
            $this->db->from('booking');
            $this->db->where('id_poli', 2);
            $this->db->where('tanggal', $tanggal);
            $this->db->where('id_pasien', $pasien_id_data[$token]);
            $this->db->where_not_in('status', 'Selesai');
            $this->db->where_not_in('status', 'Diproses');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $sisa = $row->sisa;

                if ($sisa > 0) {
                    $time_remaining = $sisa * 5;
                    $title = 'Antrian Poli';
                    $message = "Halo $nama, Antrian anda akan dipanggil dalam $time_remaining menit lagi, mohon menunggu";
                } else {
                    $title = 'Anda di Panggil';
                    $message = "Halo $nama, Silahkan untuk bertemu dengan perawat di Ruang Periksa";
                }
            }
            $this->send_notification(array($token), $title, $message);
        }

        $this->Antrian_model->updatestatus1(['id' => $id], $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Admin/anak');
    }
    function panggil_umum($id)
    {
        $data['antrian'] = $this->Antrian_model->getById($id);
        $poli = $data['antrian']['id_poli'];
        $tanggal = $data['antrian']['tanggal'];
        // print_r($status);
        // die;
        $data = [
            'status' => "Diproses",
            // 'id' => $data['antrian']
        ];
        // print_r($data);
        // die;

        $this->db->set('sisa', 'sisa - 1', FALSE);
        $this->db->where('id_poli', 1);
        $this->db->where('tanggal', $tanggal);
        $this->db->where_not_in('status', 'Selesai');
        $this->db->update('booking');

        // Ambil token FCM dan nama pasien
        $this->db->select('token, nama, id');
        $this->db->from('pasien');
        $query = $this->db->get();
        $tokens = array();
        $pasien_data = array();
        $pasien_id_data = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tokens[] = $row->token;
                $pasien_data[$row->token] = $row->nama;
                $pasien_id_data[$row->token] = $row->id;
            }
        }

        foreach ($tokens as $token) {
            $nama = $pasien_data[$token];
            $title = '';
            $message = '';
            $this->db->select('sisa');
            $this->db->from('booking');
            $this->db->where('id_poli', 1);
            $this->db->where('tanggal', $tanggal);
            $this->db->where('id_pasien', $pasien_id_data[$token]);
            $this->db->where_not_in('status', 'Selesai');
            $this->db->where_not_in('status', 'Diproses');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $sisa = $row->sisa;

                if ($sisa > 0) {
                    $time_remaining = $sisa * 5;
                    $title = 'Antrian Poli';
                    $message = "Halo $nama, Antrian anda akan dipanggil dalam $time_remaining menit lagi, mohon menunggu";
                } else {
                    $title = 'Anda di Panggil';
                    $message = "Halo $nama, Silahkan untuk bertemu dengan perawat di Ruang Periksa";
                }
            }
            $this->send_notification(array($token), $title, $message);
        }
        //KODINGAN PUS NOTIF
        $this->Antrian_model->updatestatus1(['id' => $id], $data);
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        // $this->Antrian_model->updatestatus1(['id' => $id], $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Admin/umum');
    }
    function panggil_kia($id)
    {

        $data['antrian'] = $this->Antrian_model->getById($id);
        $poli = $data['antrian']['id_poli'];
        $tanggal = $data['antrian']['tanggal'];
        $sisa = $data['antrian']['sisa'];
        // print_r($status);
        // die;
        $data = [
            'status' => "Diproses",
            // 'id' => $data['antrian']
        ];

        $this->db->set('sisa', 'sisa - 1', FALSE);
        $this->db->where('id_poli', 3);
        $this->db->where('tanggal', $tanggal);
        $this->db->where_not_in('status', 'Selesai');
        $this->db->update('booking');

        // Ambil token FCM dan nama pasien
        $this->db->select('token, nama, id');
        $this->db->from('pasien');
        $query = $this->db->get();
        $tokens = array();
        $pasien_data = array();
        $pasien_id_data = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tokens[] = $row->token;
                $pasien_data[$row->token] = $row->nama;
                $pasien_id_data[$row->token] = $row->id;
            }
        }

        foreach ($tokens as $token) {
            $nama = $pasien_data[$token];
            $title = '';
            $message = '';
            $this->db->select('sisa');
            $this->db->from('booking');
            $this->db->where('id_poli', 3);
            $this->db->where('tanggal', $tanggal);
            $this->db->where('id_pasien', $pasien_id_data[$token]);
            $this->db->where_not_in('status', 'Selesai');
            $this->db->where_not_in('status', 'Diproses');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $sisa = $row->sisa;

                if ($sisa > 0) {
                    $time_remaining = $sisa * 5;
                    $title = 'Antrian Poli';
                    $message = "Halo $nama, Antrian anda akan dipanggil dalam $time_remaining menit lagi, mohon menunggu";
                } else {
                    $title = 'Anda di Panggil';
                    $message = "Halo $nama, Silahkan untuk bertemu dengan perawat di Ruang Periksa";
                }
            }
            $this->send_notification(array($token), $title, $message);
        }

        $this->Antrian_model->updatestatus1(['id' => $id], $data);
        // $this->Antrian_model->updatestatus1(['id' => $id], $data);
        // print_r($test);
        // die;
        //echo json_encode($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Admin/kia');
    }
    function panggil_lansia($id)
    {
        $data['antrian'] = $this->Antrian_model->getById($id);
        $status = $data['antrian']['status'];
        // print_r($status);
        $poli = $data['antrian']['id_poli'];
        $tanggal = $data['antrian']['tanggal'];
        // die;
        $data = [
            'status' => "Diproses",
            // 'id' => $data['antrian']
        ];


        $this->db->set('sisa', 'sisa - 1', FALSE);
        $this->db->where('id_poli', 5);
        $this->db->where('tanggal', $tanggal);
        $this->db->where_not_in('status', 'Selesai');
        $this->db->update('booking');

        // Ambil token FCM dan nama pasien
        $this->db->select('token, nama, id');
        $this->db->from('pasien');
        $query = $this->db->get();
        $tokens = array();
        $pasien_data = array();
        $pasien_id_data = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tokens[] = $row->token;
                $pasien_data[$row->token] = $row->nama;
                $pasien_id_data[$row->token] = $row->id;
            }
        }

        foreach ($tokens as $token) {
            $nama = $pasien_data[$token];
            $title = '';
            $message = '';
            $this->db->select('sisa');
            $this->db->from('booking');
            $this->db->where('id_poli', 5);
            $this->db->where('tanggal', $tanggal);
            $this->db->where('id_pasien', $pasien_id_data[$token]);
            $this->db->where_not_in('status', 'Selesai');
            $this->db->where_not_in('status', 'Diproses');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $sisa = $row->sisa;

                if ($sisa > 0) {
                    $time_remaining = $sisa * 5;
                    $title = 'Antrian Poli';
                    $message = "Halo $nama, Antrian anda akan dipanggil dalam $time_remaining menit lagi, mohon menunggu";
                } else {
                    $title = 'Anda di Panggil';
                    $message = "Halo $nama, Silahkan untuk bertemu dengan perawat di Ruang Periksa";
                }
            }
            $this->send_notification(array($token), $title, $message);
        }

        $this->Antrian_model->updatestatus1(['id' => $id], $data);
        $this->Antrian_model->updatestatus1(['id' => $id], $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Diubah!</div>');
        redirect('Admin/lansia');
    }
    function kia()
    {
        $data['judul'] = "List Antrian Poli Kesehatan Ibu dan Anak Tanggal " . date('Y-m-d');
        $data['antrian'] = $this->Antrian_model->getkia();
        $data['antrian2'] = $this->Antrian_model->getkiaproses();
        $data['poli'] = $this->Poli_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_kia", $data);
        $this->load->view("layout/footer");
    }
    public function hapusanak($id)
    {
        $this->Antrian_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Admin/anak');
    }
    public function hapusgigi($id)
    {
        $this->Antrian_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Admin/gigi');
    }
    public function hapuslansia($id)
    {
        $this->Antrian_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Admin/lansia');
    }
    public function hapusumum($id)
    {
        $this->Antrian_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Admin/umum');
    }
    public function hapuskia($id)
    {
        $this->Antrian_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Pasien tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Pasien Berhasil Dihapus!</div>');
        }
        redirect('Admin/umum');
    }
    function detailumum($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['booking'] = $this->Antrian_model->getById($id);
        $nik = $data['booking']['nik'];
        $pasien = $this->Pasien_model->getByNIK($nik);
        $anggota = $this->Anggota_model->getByNIK($nik);
        if (!empty($pasien)) {
            $data['detail'] = $pasien;
        } else {
            $data['detail'] = $anggota;
        }
        $data['rm'] = $this->RM_model->getByNIK($nik);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_detail_umum", $data);
        $this->load->view("layout/footer");
        //  } else {

    }
    function detailanak($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['booking'] = $this->Antrian_model->getById($id);
        $nik = $data['booking']['nik'];
        $pasien = $this->Pasien_model->getByNIK($nik);
        $anggota = $this->Anggota_model->getByNIK($nik);
        if (!empty($pasien)) {
            $data['detail'] = $pasien;
        } else {
            $data['detail'] = $anggota;
        }
        $data['rm'] = $this->RM_model->getByNIK($nik);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_detail_anak", $data);
        $this->load->view("layout/footer");
        //  } else {

    }
    function detailkia($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['booking'] = $this->Antrian_model->getById($id);
        $nik = $data['booking']['nik'];
        $pasien = $this->Pasien_model->getByNIK($nik);
        $anggota = $this->Anggota_model->getByNIK($nik);
        if (!empty($pasien)) {
            $data['detail'] = $pasien;
        } else {
            $data['detail'] = $anggota;
        }
        $data['rm'] = $this->RM_model->getByNIK($nik);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_detail_kia", $data);
        $this->load->view("layout/footer");
        //  } else {

    }
    function detailgigi($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['booking'] = $this->Antrian_model->getById($id);
        $nik = $data['booking']['nik'];
        $pasien = $this->Pasien_model->getByNIK($nik);
        $anggota = $this->Anggota_model->getByNIK($nik);
        if (!empty($pasien)) {
            $data['detail'] = $pasien;
        } else {
            $data['detail'] = $anggota;
        }
        $data['rm'] = $this->RM_model->getByNIK($nik);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_detail_gigi", $data);
        $this->load->view("layout/footer");
        //  } else {

    }
    function detaillansia($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['booking'] = $this->Antrian_model->getById($id);
        $nik = $data['booking']['nik'];
        $pasien = $this->Pasien_model->getByNIK($nik);
        $anggota = $this->Anggota_model->getByNIK($nik);
        if (!empty($pasien)) {
            $data['detail'] = $pasien;
        } else {
            $data['detail'] = $anggota;
        }
        $data['rm'] = $this->RM_model->getByNIK($nik);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Admin/vw_detail_lansia", $data);
        $this->load->view("layout/footer");
        //  } else {

    }
    function input_tindakanlansia($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['rm'] = $this->RM_model->get();
        $data['pasien'] = $this->Antrian_model->getById($id);
        $pasien = $data['pasien']['id_pasien'];
        $nik = $data['pasien']['nik'];
        $nama = $data['pasien']['nama'];
        $data = [
            'tanggal_berobat' => $this->input->post('tanggal_berobat'),
            'rujukan' => $this->input->post('rujukan'),
            'keluhan' => $this->input->post('keluhan'),
            'tindakan' => $this->input->post('tindakan'),
            'obat' => $this->input->post('obat'),
            'id_pasien' => $pasien,
            'id_antrian' => $id,
            'nik' => $nik,
            'nama' => $nama,
        ];
        $data1 = [
            'status' => "Selesai",
            // 'id' => $data['antrian']
        ];

        // print_r($data);
        // die;
        $this->RM_model->insert($data);
        $this->Antrian_model->updatestatus1(['id' => $id], $data1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Admin/lansia');
    }
    function input_tindakankia($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['rm'] = $this->RM_model->get();
        $data['pasien'] = $this->Antrian_model->getById($id);
        $pasien = $data['pasien']['id_pasien'];
        $nik = $data['pasien']['nik'];
        $nama = $data['pasien']['nama'];
        $data = [
            'tanggal_berobat' => $this->input->post('tanggal_berobat'),
            'rujukan' => $this->input->post('rujukan'),
            'keluhan' => $this->input->post('keluhan'),
            'tindakan' => $this->input->post('tindakan'),
            'obat' => $this->input->post('obat'),
            'id_pasien' => $pasien,
            'id_antrian' => $id,
            'nik' => $nik,
            'nama' => $nama,
        ];
        $data1 = [
            'status' => "Selesai",
            // 'id' => $data['antrian']
        ];

        // print_r($data);
        // die;
        $this->RM_model->insert($data);
        $this->Antrian_model->updatestatus1(['id' => $id], $data1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Admin/kia');
    }
    function input_tindakanumum($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['rm'] = $this->RM_model->get();
        $data['pasien'] = $this->Antrian_model->getById($id);
        $pasien = $data['pasien']['id_pasien'];
        $nik = $data['pasien']['nik'];
        $nama = $data['pasien']['nama'];
        $data = [
            'tanggal_berobat' => $this->input->post('tanggal_berobat'),
            'rujukan' => $this->input->post('rujukan'),
            'keluhan' => $this->input->post('keluhan'),
            'tindakan' => $this->input->post('tindakan'),
            'obat' => $this->input->post('obat'),
            'id_pasien' => $pasien,
            'id_antrian' => $id,
            'nik' => $nik,
            'nama' => $nama,
        ];
        $data1 = [
            'status' => "Selesai",
            // 'id' => $data['antrian']
        ];

        // print_r($data);
        // die;
        $this->RM_model->insert($data);
        $this->Antrian_model->updatestatus1(['id' => $id], $data1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Admin/umum');
    }
    function input_tindakananak($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['rm'] = $this->RM_model->get();
        $data['pasien'] = $this->Antrian_model->getById($id);
        $pasien = $data['pasien']['id_pasien'];
        $nik = $data['pasien']['nik'];
        $nama = $data['pasien']['nama'];
        $data = [
            'tanggal_berobat' => $this->input->post('tanggal_berobat'),
            'rujukan' => $this->input->post('rujukan'),
            'keluhan' => $this->input->post('keluhan'),
            'tindakan' => $this->input->post('tindakan'),
            'obat' => $this->input->post('obat'),
            'id_pasien' => $pasien,
            'id_antrian' => $id,
            'nik' => $nik,
            'nama' => $nama,
        ];
        $data1 = [
            'status' => "Selesai",
            // 'id' => $data['antrian']
        ];

        // print_r($data);
        // die;
        $this->RM_model->insert($data);
        $this->Antrian_model->updatestatus1(['id' => $id], $data1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Admin/anak');
    }
    function input_tindakangigi($id)
    {
        $data['judul'] = "Halaman Detail Pasien dan Catatan Rekam Medis";
        $data['rm'] = $this->RM_model->get();
        $data['pasien'] = $this->Antrian_model->getById($id);
        $pasien = $data['pasien']['id_pasien'];
        $nik = $data['pasien']['nik'];
        $nama = $data['pasien']['nama'];
        $data = [
            'tanggal_berobat' => $this->input->post('tanggal_berobat'),
            'rujukan' => $this->input->post('rujukan'),
            'keluhan' => $this->input->post('keluhan'),
            'tindakan' => $this->input->post('tindakan'),
            'obat' => $this->input->post('obat'),
            'id_pasien' => $pasien,
            'id_antrian' => $id,
            'nik' => $nik,
            'nama' => $nama,
        ];
        $data1 = [
            'status' => "Selesai",
            // 'id' => $data['antrian']
        ];

        // print_r($data);
        // die;
        $this->RM_model->insert($data);
        $this->Antrian_model->updatestatus1(['id' => $id], $data1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
        redirect('Admin/gigi');
    }
}
