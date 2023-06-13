<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->model('Poli_model');
        $this->load->database('booking');
        //is_logged_in();
    }
    function index()
    {

        $data['judul'] = "Halaman Laporan";
        $date = date("Y-m-d");
        $data['poli_perhari'] = $this->Laporan_model->poli_perhari();
        // $data['jumklh'] = $this->Laporan_model->getjumpoli();
        $data['nama_poli'] = $this->Laporan_model->getpoli();
        $data['antrian'] = $this->Laporan_model->getjumAntrian();
        $data['kelurahan'] = $this->Laporan_model->all_kelurahan();
        $data['keluhan_hari'] = $this->Laporan_model->keluhan_perhari();
        $data['week_antrian'] = $this->Laporan_model->data_1week();
        $data['week_lurah'] = $this->Laporan_model->lurah_1week();
        $data['week_poli'] = $this->Laporan_model->poli_week();
        $data['week_keluhan'] = $this->Laporan_model->keluhan_perminggu();
        $data['antrian_bulan'] = $this->Laporan_model->antrian_bulan();
        $data['poli_bulan'] = $this->Laporan_model->poli_bulan();
        $data['jam'] = $this->Laporan_model->hour();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("Laporan/view_laporan", $data);
        $this->load->view("layout/footer");
    }

    public function export_harian()
    {
        $dompdf = new Dompdf();
        $date = date("Y-m-d");
        $data['poli_perhari'] = $this->Laporan_model->poli_perhari();
        $data['nama_poli'] = $this->Laporan_model->getpoli();
        $data['antrian'] = $this->Laporan_model->getjumAntrian();
        $data['kelurahan'] = $this->Laporan_model->all_kelurahan();
        $data['keluhan_hari'] = $this->Laporan_model->keluhan_perhari();
        $this->data['title'] = 'Laporan Data Kunjungan Pasien Tanggal ' . $date;
        $this->data['no'] = 1;
        $dompdf->setPaper('A4', 'Landscape');
        $html = $this->load->view('Laporan/report_harian', $this->data, true);
        // $html2 =  $this->load->view("layout/header");
        // $html3 =  $this->load->view("layout/footer");
        $dompdf->load_html($html);
        $dompdf->render("image.png");
        $dompdf->stream('Laporan Data Kunjungan Pasien Puskesmas Umban Sari ' . date('d F Y'), array("Attachment" => false));
        $this->load->view("Laporan/pdf.js");
    }
}
