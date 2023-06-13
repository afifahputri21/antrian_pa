<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public $table = 'pasien';
    public $id = 'pasien.id';
    public function __construct()
    {
        parent::__construct();
    }
    function charts()
    {
        $this->db->select('keluhan, count(*) as jumlah_keluhan');
        $this->db->from('rekam_medis');
        //$this->db->join('buku b', 'd.id_buku = b.id');
        $this->db->group_by('keluhan');
        $query = $this->db->get();
        return $query->result_array();
    }
    function poli_perhari()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*, po.nama_poli as id_poli, COUNT(b.id_poli) as jumlah ');
        $this->db->from('booking b');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->where('tanggal', $tanggal);
        $this->db->group_by('b.id_poli');
        $query = $this->db->get();
        return $query->result_array();
    }
    function all_kelurahan()
    {
        $tanggal = date("Y-m-d");;
        $this->db->select('p.kelurahan, COUNT(p.kelurahan) as jumlah ');
        $this->db->from('booking b');
        $this->db->join('pasien p', 'b.id_pasien = p.id');
        $this->db->where('tanggal', $tanggal);
        $this->db->group_by('p.kelurahan');
        $query = $this->db->get();
        return $query->result_array();
    }

    function keluhan_perhari()
    {
        $tanggal = date("Y-m-d");;
        $this->db->select('rm.keluhan, COUNT(rm.keluhan) as jumlah ');
        $this->db->from('booking b');
        $this->db->join('pasien p', 'b.id_pasien = p.id');
        $this->db->join('rekam_medis rm', 'rm.id_pasien = p.id');
        $this->db->where('tanggal', $tanggal);
        $this->db->group_by('rm.keluhan');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getjumpoli()
    {
        //$this->db->select('b.*');
        $this->db->from('poli p');
        //$this->db->where('keluhan');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function getjumAntrian()
    {
        $this->db->from('booking');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function getpoli()
    {
        $this->db->from('poli');
        $query = $this->db->get();
        return $query->result_array();
    }
    //PERMINGGU 
    public function data_1week() //kunjungan
    {

        $this->db->select('YEAR(tanggal) as year, DATE_FORMAT(tanggal, "%b %u") AS week, COUNT(*) as total');
        $this->db->from('booking');
        $this->db->where('tanggal >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY');
        $this->db->where('tanggal <= curdate() - INTERVAL DAYOFWEEK(curdate())-6 DAY');
        $this->db->group_by('year, week');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function lurah_1week()
    {

        $this->db->select('p.kelurahan, COUNT(p.kelurahan) as jumlah');
        $this->db->from('booking b');
        $this->db->join('pasien p', 'b.id_pasien = p.id');
        $this->db->where('b.tanggal >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY');
        $this->db->where('b.tanggal <= curdate() - INTERVAL DAYOFWEEK(curdate())-6 DAY');
        $this->db->group_by('p.kelurahan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public  function poli_week()
    {
        //$tanggal = date("Y-m-d");
        $this->db->select('b.*, po.nama_poli as id_poli, COUNT(b.id_poli) as jumlah ');
        $this->db->from('booking b');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->where('b.tanggal >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY');
        $this->db->where('b.tanggal <= curdate() - INTERVAL DAYOFWEEK(curdate())-6 DAY');
        $this->db->group_by('b.id_poli');
        $query = $this->db->get();
        return $query->result_array();
    }
    function keluhan_perminggu()
    {
        $tanggal = date("Y-m-d");;
        $this->db->select('rm.keluhan, COUNT(rm.keluhan) as jumlah ');
        $this->db->from('booking b');
        $this->db->join('pasien p', 'b.id_pasien = p.id');
        $this->db->join('rekam_medis rm', 'rm.id_pasien = p.id');
        $this->db->where('b.tanggal >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY');
        $this->db->where('b.tanggal <= curdate() - INTERVAL DAYOFWEEK(curdate())-6 DAY');
        $this->db->group_by('rm.keluhan');
        $query = $this->db->get();
        return $query->result_array();
    }
    function antrian_bulan()
    {
        $this->db->select('DATE_FORMAT(tanggal, "%M") AS bulan, COUNT(tanggal) as jumlah');
        $this->db->from('booking');
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }
    function poli_bulan()
    {
        $this->db->select('date_format(b.tanggal, "%Y-%M") as bulan, po.nama_poli as id_poli, COUNT(b.id) as jumlah ');
        $this->db->from('booking b');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->where('b.tanggal >= DATE_SUB(NOW(), INTERVAL 1 YEAR)');
        $this->db->group_by('bulan, po.nama_poli');
        $query = $this->db->get();
        return $query->result_array();
    }
    function hour()
    {
        // $sql = "SELECT HOUR(jam) AS hour, COUNT(*) AS visitor_count\n"

        //     . "FROM booking\n"

        //     . "WHERE DATE(jam) = CURRENT_DATE()\n"

        //     . "GROUP BY hour;";
        $this->db->select('HOUR(jam) AS hour, COUNT(*) AS visitor_count');
        $this->db->from('booking b');
        $this->db->where('DATE(jam) = CURRENT_DATE()');
        $this->db->group_by('hour');
        $query = $this->db->get();
        return $query->result_array();
    }
}
