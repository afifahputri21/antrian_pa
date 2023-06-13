<?php
defined('BASEPATH') or exit('No direct script access allowed');
class android extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RM_model');
        $this->load->model('Pasien_model');
        $this->load->database('rekam_medis');
        //is_logged_in();
    }

    function index()
    {
    }
}



include "../koneksi.php";



// Mengecek koneksi database

if (!$conn) {

    die("Koneksi gagal: " . mysqli_connect_error());
}



// Menangani request dari client

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Menerima data login dari client

    $username = $_POST['username'];

    $password = $_POST['password'];



    // Query untuk mencari data user di database

    $sql = "SELECT * FROM pasien WHERE email='$username'";

    $result = mysqli_query($conn, $sql);



    // Mengecek apakah data user ditemukan

    if (mysqli_num_rows($result) > 0) {

        // Mengambil data user dari database

        $row = mysqli_fetch_assoc($result);



        // Mengecek apakah password yang diberikan oleh pengguna cocok dengan password yang dienkripsi di database

        if (password_verify($password, $row['password'])) {

            // Menyiapkan respon untuk client

            $response['status'] = 'success';

            $response['message'] = 'Login berhasil';

            $response['user'] = $row;
        } else {

            // Menyiapkan respon untuk client
            http_response_code(401);

            $response['status'] = 'error';

            $response['message'] = 'Username atau password salah';
        }
    } else {

        // Menyiapkan respon untuk client
        http_response_code(405);

        $response['status'] = 'error';

        $response['message'] = 'Username atau password salah';
    }



    // Mengembalikan respon dalam format JSON

    header('Content-Type: application/json');

    echo json_encode($response);
}



// Menutup koneksi database

mysqli_close($conn);
