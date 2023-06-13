<?php
defined('BASEPATH') or exit('No direct script access allowed');
class android extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RM_model');
        $this->load->model('Pasien_model');
        $this->load->model('Poli_model');
        $this->load->model('User_model');
        $this->load->model('Antrian_model');
        $this->load->model('Anggota_model');
        $this->load->database('rekam_medis');
        //is_logged_in();
    }

    function hapusAnggota()
    {
        $id2 = $this->input->post("id");
        $data['id'] = $this->Anggota_model->getById($id2);
        //$data['anggota'] = $this->Pasien_model->getById($id);
        $id3 = $data['id']['id'];
        $this->Anggota_model->delete($id3);
        echo json_decode(200);
    }

    function getpoli()
    {

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        // Connect to the database
        $mysqli = new mysqli('localhost', 'root', '', 'antrian');

        // Query the database
        $result = $mysqli->query("SELECT * FROM poli");

        // Convert the results to JSON
        $rows = array();
        while ($r = $result->fetch_assoc()) {
            $rows[] = $r;
        }
        print json_encode($rows);

        // Close the database connection
        $mysqli->close();
    }

    function riwayatTest()
    {
        $id_pasien = $this->input->post("id_pasien");
        $query = $this->Antrian_model->getByPasien2($id_pasien);
        // $data = [
        //     'no_antrian' => $query['no_antrian'],
        //     'status' => $query['status'],
        //     'tanggal' => $query['tanggal'],
        //     // 'tindakan' => $query['tindakan'],
        //     // 'obat' => $query['obat'],
        // ];

        $response['user'] = $query;
        // $data['pasien'] = $this->db->getByEmail($username);
        // $kirim =  $data['pasien'];
        echo json_encode($response, JSON_NUMERIC_CHECK);
        // $conn->close();
        // $conn->close();
    }

    public function getRiwayat2()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $conn = new mysqli('localhost', 'root', '', 'antrian');
        // $id_pasien = $conn->query($ambil_id);
        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);
        }
        $id_pasien = $this->input->post("id_pasien");

        $sql = "SELECT * FROM booking WHERE id_pasien = $id_pasien";

        $result = $conn->query($sql);

        $rows = array();
        while ($r = $result->fetch_assoc()) {
            $rows[] = $r;
        }
        print json_encode($rows, JSON_NUMERIC_CHECK);
        $conn->close();
    }
    public function pesan()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        //$data['judul'] = "Halaman Tambah Antrian";
        $data['poli'] = $this->Poli_model->get();
        $data['antrian'] = $this->Antrian_model->get();
        $nik = $this->input->post('nik');
        //cari data pasien melalui NIK
        $pasien = $this->Pasien_model->getByNIK($nik);
        //status antrian post;
        $data['pasien'] = $pasien;
        $nama = $data['pasien']['nama'];
        $id_pasien = $data['pasien']['id'];
        //$tanggal = date("Y-m-d");
        $umur = $data['pasien']['usia'];

        $nama_poli = $this->input->post('selectedName');
        $data['nama_poli'] = $this->Poli_model->getByNama($nama_poli);
        $id_poli = $data['nama_poli']['id'];
        $kehamilan = $this->input->post('kehamilan');
        $status = $this->input->post('status');
        $tanggal = $this->input->post('tanggal');
        if ($umur >= 60) {
            $bobot = 9;
        } elseif ($umur <= 5) {
            $bobot = 8;
        } elseif ($kehamilan == 1) {
            $bobot = 7;
        } else {
            $bobot = 6;
        }
        //untuk dapat no antrian
        //IF STATUS_ANTRIAN = 1; Priority Queue
        $antrian =  $this->getNoAntrian2($id_poli, $umur, $kehamilan, $bobot, $tanggal);
        //ELSE 0 = geNoAntrian();
        if ($antrian == null) {
            $antrian = 1;
        }
        $data = [
            'nik' => $nik,
            'id_poli' => $id_poli,
            'nama_poli' => $nama_poli,
            'id_pasien' => $id_pasien,
            'nama' => $nama,
            'umur' => $umur,
            'no_antrian' => $antrian,
            'status' => $status,
            'tanggal' => $tanggal,
            'bobot' => $bobot,
            'sisa' => $antrian,
            //'jam' =>  date("h:i:s"),
        ];

        // print_r($data);
        // die;

        $send = $this->Antrian_model->insert($data);
        $response['antrian'] = $data;
        if ($send) {
            echo json_encode($response); //return;
        } else {
            echo "500";
        }
    }
    //PESANAN UNTUK ANGGOTA KELUARGA
    public function pesanAnggota()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        //$data['judul'] = "Halaman Tambah Antrian";
        $data['poli'] = $this->Poli_model->get();
        $data['antrian'] = $this->Antrian_model->get();
        $nama = $this->input->post('selectedAnggota');
        $id_pasien = $this->input->post('id_pasien');
        $data['anggota'] = $this->Anggota_model->getByNamaID($nama, $id_pasien);
        $umur = $data['anggota']['umur'];
        $nik = $data['anggota']['nik'];
        $umur = $data['anggota']['usia'];
        $nama_poli = $this->input->post('selectedName');
        $data['nama_poli'] = $this->Poli_model->getByNama($nama_poli);
        $id_poli = $data['nama_poli']['id'];
        $kehamilan = $this->input->post('kehamilan');
        $status = $this->input->post('status');
        $tanggal = $this->input->post('tanggal');
        if ($umur >= 60) {
            $bobot = 9;
        } elseif ($umur <= 5) {
            $bobot = 8;
        } elseif ($kehamilan == 1) {
            $bobot = 7;
        } else {
            $bobot = 6;
        }
        $antrian =  $this->getNoAntrian2($id_poli, $umur, $kehamilan, $bobot, $tanggal);
        if ($antrian == null) {
            $antrian = 1;
        }
        $data = [
            'nik' => $nik,
            'id_poli' => $id_poli,
            'nama_poli' => $nama_poli,
            'id_pasien' => $id_pasien,
            'nama' => $nama,
            'umur' => $umur,
            'no_antrian' => $antrian,
            'status' => $status,
            'tanggal' => $tanggal,
            'bobot' => $bobot,
            'sisa' => $antrian,
            //'jam' =>  date("h:i:s"),
        ];

        // print_r($data);
        // die;

        $send = $this->Antrian_model->insert($data);
        $response['antrian'] = $data;
        if ($send) {
            echo json_encode($response); //return;
        } else {
            echo "500";
        }
    }
    //FUNCTION UNTUK PENGGUNAAN FIFO
    function getNoAntrian()
    {
        $nama_poli = $this->input->post('selectedName');
        $data['nama_poli'] = $this->Poli_model->getByNama($nama_poli);
        $id_poli = $data['nama_poli']['id'];
        // $id_poli = $id_poli;
        $tanggal = $this->input->post('tanggal');
        $data['booking'] = $this->Antrian_model->get();
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
            //$maks = $rowPoli->$data['booking']['jam_akhir'];

            // var_dump($rowNo); exit();
            $noAntrian = //$kode1 . 
                $no;
            return $noAntrian;
        }
    }
    //FUNCTION UNTUK PENGGUNAAN PRIORITY QUEUE
    function getNoAntrian2($poli, $umur, $kehamilan, $bobot)
    {
        $id_poli = $poli;
        $usia = $umur;
        $cek_bobot = $bobot;
        $stat_preg = $kehamilan;
        //$tanggal = $date;
        $tanggal = date("Y-m-d");
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
                $this->db->set('sisa', 'sisa+1', false);
                $this->db->where('bobot <', 9);
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->update('booking');
            } elseif ($cek_bobot == 8) {
                $this->db->limit(1);
                $this->db->order_by('no_antrian', "ASC");
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->where('booking.bobot >=', 8);
                $sql = $this->db->get('booking');
                $rowNo = $sql->row();
                $noAntrian = $rowNo->no_antrian + 1;
                //UPDATE NOMOR ANTRIAN DIBAWAHNYA
                // foreach ($query->result_array() as $row) {
                //     $this->db->set('no_antrian', $row['no_antrian'] + 1);
                //     $this->db->where('no_antrian >=', $noAntrian);
                //     $this->db->where('tanggal', $tanggal);
                //     $this->db->where('id_poli', $id_poli);
                //     $this->db->update('booking');
                // }
                $this->db->set('no_antrian', 'no_antrian+1', false);
                $this->db->set('sisa', 'sisa+1', false);
                $this->db->where('bobot <', 8);
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->update('booking');
            } elseif ($cek_bobot == 7) {
                $this->db->limit(1);
                $this->db->order_by('no_antrian', "ASC");
                $this->db->where('booking.id_poli', $id_poli);
                $this->db->where('booking.tanggal', $tanggal);
                $this->db->where('status', 'Pending');
                $this->db->where('booking.bobot >=', 7);

                $sql = $this->db->get('booking');
                $rowNo = $sql->row();
                $noAntrian = $rowNo->no_antrian + 1;
                $this->db->set('no_antrian', 'no_antrian+1', false);
                $this->db->set('sisa', 'sisa+1', false);
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
    function tambah_anggota()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $conn = new mysqli('localhost', 'root', '', 'antrian');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $username1 = $this->input->post("username1");
        $sql = "SELECT * FROM pasien WHERE nik = $username1";
        if ($conn->query($sql)) {
            if ($conn->affected_rows > 0) {
                $sqlid = $this->db->get_where('pasien', ['nik' => $username1])->row_array();
                $id_root = $sqlid['id'];
                $nik = $this->input->post("nik");
                $nama = $this->input->post("nama");
                $tempat_lahir = $this->input->post("tempat_lahir");
                $ttl = $this->input->post("ttl");
                $date = date('Y-m-d');
                //$username = $this->input->post("username");
                //$password = $this->input->post("password");
                $alamat = $this->input->post("alamat");
                $kecamatan = $this->input->post("kecamatan");
                $kelurahan = $this->input->post("kelurahan");
                $goldar = $this->input->post("goldar");
                $status_keluarga = $this->input->post("status_keluarga");
                $usia = $this->hitungSelisihTahun($ttl, $date);

                $data = [
                    //'email' => $username,
                    //'password' => $password,
                    'nama' => $nama,
                    'nik' => $nik,
                    'ttl' => $ttl,
                    'alamat' => $alamat,
                    'kelurahan' => $kelurahan,
                    'kecamatan' => $kecamatan,
                    'tempat_lahir' => $tempat_lahir,
                    'goldar' => $goldar,
                    'status_keluarga' => $status_keluarga,
                    'id_root' => $id_root,
                    'usia' => $usia,
                    'status_antrian' => 'Prioritas OFF',
                ];

                // $data1 = [
                //     'name' => $nama,
                //     'email' => htmlspecialchars($username),
                //     'password' => password_hash($password, PASSWORD_DEFAULT),
                //     'role_id' => 3,
                //     'status' => 'Pasien',
                // ];

                // $dataInsert = $this->User_model->insert($data1);
                $this->load->model('Anggota_model');
                $this->load->database();
                $dataInsert = $this->Anggota_model->insert($data);
                echo "Berhasil";
            } else {
                echo "Terjadi kesalahan";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }
    private function hitungSelisihTahun($ttl, $today)
    {
        $selisih = strtotime($today) - strtotime($ttl);
        return floor($selisih / (60 * 60 * 24 * 365));
    }
    public function getAnggota()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $conn = new mysqli('localhost', 'root', '', 'antrian');
        // $id_pasien = $conn->query($ambil_id);
        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);
        }
        $id_pasien = $this->input->post("id_pasien");

        $sql = "SELECT * FROM anggota WHERE id_root = $id_pasien";

        $result = $conn->query($sql);

        $rows = array();
        while ($r = $result->fetch_assoc()) {
            $rows[] = $r;
        }
        print json_encode($rows, JSON_NUMERIC_CHECK);
        $conn->close();
    }

    public function UpdateData()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $conn = new mysqli('localhost', 'root', '', 'antrian');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $id_pasien = $this->input->post("id_pasien");
        if ($id_pasien !== null) {
            $today = date("Y-m-d");
            $sql = "SELECT * FROM booking WHERE id_pasien = $id_pasien AND status = 'Pending' AND DATE(tanggal) = '$today'";
            $result = $conn->query($sql);
            $rows = array();
            while ($r = $result->fetch_assoc()) {
                $rows[] = $r;
            }
            print json_encode($rows, JSON_NUMERIC_CHECK);
        } else {
            print json_encode(array(), JSON_NUMERIC_CHECK);
        }

        $conn->close();
    }


    public function UpcomingAntrian()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $conn = new mysqli('localhost', 'root', '', 'antrian');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $id_pasien = $this->input->post("id_pasien");
        if ($id_pasien !== null) {
            $today = date("Y-m-d");
            $sql = "SELECT * FROM booking WHERE id_pasien = $id_pasien AND status = 'Pending' AND DATE(tanggal) >= '$today'";
            $result = $conn->query($sql);
            $rows = array();
            while ($r = $result->fetch_assoc()) {
                $rows[] = $r;
            }
            print json_encode($rows, JSON_NUMERIC_CHECK);
        } else {
            print json_encode(array(), JSON_NUMERIC_CHECK);
        }

        $conn->close();
    }


    public function delete_antrian()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $conn = new mysqli('localhost', 'root', '', 'antrian');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $id_booking = $this->input->post("id");
        $id_poli = $this->input->post("poli");
        $id_tanggal = $this->input->post("tanggal");

        $deleteQuery = "DELETE FROM booking WHERE id = $id_booking";
        if ($conn->query($deleteQuery) === TRUE) {
            $updateQuery = "UPDATE booking SET no_antrian = no_antrian - 1, sisa = sisa - 1 WHERE id_poli = $id_poli AND tanggal = '$id_tanggal' AND status = 'Pending'";
            $conn->query($updateQuery);
            echo json_encode(array("message" => "Delete successful"));
        } else {
            echo json_encode(array("message" => "Delete failed"));
        }

        $conn->close();
    }


    //MENYIMPAN NOTIFIKASI TOKEN DARI SETIAP PENGGUNA
    public function save_token()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $conn = new mysqli('localhost', 'root', '', 'antrian');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user_id = $this->input->post('id_pasien');
        $fcm_token = $this->input->post('fcm_token');
        // Membuat query untuk mengupdate token
        $sql = "UPDATE pasien SET token='$fcm_token' WHERE id = $user_id";
        // Melakukan update RESPONSE
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Record updated successfully"]);
        } else {
            echo json_encode(["error" => "Error updating record: " . $conn->error]);
        }
        $conn->close();
    }


    public function forgetpass()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $conn = new mysqli('localhost', 'root', '', 'antrian');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $nik = $this->input->post('nik');
        $token = bin2hex(random_bytes(8));
        $sql = "UPDATE pasien SET password = '$token' WHERE nik = '$nik'";
        if ($conn->query($sql)) {
            if ($conn->affected_rows > 0) {
                echo "Berhasil, NIK ditemukan";
            } else {
                echo "NIK ditemukan atau Belum Registrasi";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }

    public function new_password()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $conn = new mysqli('localhost', 'root', '', 'antrian');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $nik = $this->input->post('nik');
        $password = $this->input->post('password');
        $sql = "UPDATE pasien SET password = '$password' WHERE nik = '$nik'";
        if ($conn->query($sql)) {
            if ($conn->affected_rows > 0) {
                $sqlid = $this->db->get_where('pasien', ['nik' => $nik])->row_array();
                $username = $sqlid['email'];
                $passwordEnc = password_hash($password, PASSWORD_DEFAULT);
                $sqlUser = "UPDATE user SET password = '$passwordEnc' WHERE email = '$username'";
                if ($conn->query($sqlUser)) {
                    if ($conn->affected_rows > 0) {
                        echo "Berhasil";
                    }
                }
            } else {
                echo "Terjadi kesalahan";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }
    function edit_profil()
    {
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $ttl = $this->input->post('ttl');
        $alamat = $this->input->post('alamat');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');
        $goldar = $this->input->post('goldar');
        $data['pasien'] = $this->Pasien_model->getByNIK($nik);
        $data = [
            'nik' => $nik,
            'nama' => $nama,
            'tempat_lahir' => $tempat_lahir,
            'ttl' => $ttl,
            'alamat' => $alamat,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'goldar' => $goldar,
        ];
        // print_r($data);
        // die;
        // $nik = $this->input->post('id');
        $send =  $this->Pasien_model->update(['nik' => $nik], $data);
        $response['user'] = $data;
        if ($send) {
            echo json_encode($response); //return;
        } else {
            echo "500";
        }
    }
    function editAnggota()
    {
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $ttl = $this->input->post('ttl');
        // $alamat = $this->input->post('alamat');
        // $kecamatan = $this->input->post('kecamatan');
        // $kelurahan = $this->input->post('kelurahan');
        $status_keluarga = $this->input->post('status_keluarga');
        $goldar = $this->input->post('goldar');
        $data['anggota'] = $this->Anggota_model->getByNIK($nik);
        $data = [
            'nik' => $nik,
            'nama' => $nama,
            'tempat_lahir' => $tempat_lahir,
            'ttl' => $ttl,
            'goldar' => $goldar,
            'status_keluarga' => $status_keluarga,
        ];
        // print_r($data);
        // die;
        // $nik = $this->input->post('id');
        $send =  $this->Anggota_model->update(['nik' => $nik], $data);
        $response['anggota'] = $data;
        if ($send) {
            echo json_encode($response); //return;
        } else {
            echo "500";
        }
    }
}
