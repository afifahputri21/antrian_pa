<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Antrian_model extends CI_Model
{
    public $table = 'booking';
    public $id = 'booking.id';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        // return $query->result_array();
        $tanggal = date("Y-m-d");
        $this->db->select('b.*');
        $this->db->from('booking b');
        $this->db->where("tanggal >=", $tanggal);
        $this->db->where("status", 'Pending');
        $this->db->order_by('no_antrian', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function cekRow($id_poli, $tanggal)
    {
        $this->db->where('booking.id_poli', $id_poli);
        $this->db->where('booking.tanggal', $tanggal);
        $sql = $this->db->get('booking');
        return $sql->num_rows();
    }
    public function lastAntrian($id_poli, $tanggal)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $this->db->where('booking.id_poli', $id_poli);
        $this->db->where('booking.tanggal', $tanggal);
        $query = $this->db->get('booking');
        return $query->row();
        //return $rowNo->no_antrian;
        // if ($query->num_rows() > 0) {
        //     return $query->row_array();
        // }

        // return NULL;
    }
    public function getAdmin()
    {
        // return $query->result_array();
        $tanggal = date("Y-m-d");
        $this->db->select('b.*');
        $this->db->from('booking b');
        // $this->db->where("tanggal >=", $tanggal);
        $this->db->order_by('tanggal', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function jumlah($tanggal)
    {
        //$this->db->where('booking.id_poli', $id_poli);
        $this->db->where('booking.tanggal', $tanggal);
        $sql = $this->db->get('booking');
        return $sql->num_rows();
    }
    public function getKapasitas()
    {
        $this->db->select('k.*');
        $this->db->from('kapasitas_antrian k');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function cekKapasitas()
    {
        $this->db->select('kapasitas');
        $this->db->from('kapasitas_antrian k');
        $query = $this->db->get();
        $sql = $query->row();
        return $sql->kapasitas;
    }
    public function getByIdKapasitas($id)
    {
        $this->db->from('kapasitas_antrian');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function updateKapasitas($where, $data)
    {
        $this->db->update('kapasitas_antrian', $data, $where);
        return $this->db->affected_rows();
    }
    public function getByPasien($id_pasien)
    {
        $this->db->select("p.*");
        $this->db->from("booking b");
        $this->db->join('pasien p', 'b.id_pasien = p.id');
        $this->db->like('id_pasien', $id_pasien);
        $query = $this->db->get();
        return $query->result();
    }
    public function getByPasien2($id_pasien)
    {
        $this->db->select("b.*");
        $this->db->from("booking b");
        $this->db->join('pasien p', 'b.id_pasien = p.id');
        $this->db->like('b.id_pasien', $id_pasien);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getUmurDesc()
    {
        $tanggal = date("Y-m-d");
        $this->db->order_by('umur', "DESC");
        $this->db->where('booking.id_poli', 4);
        $this->db->where('booking.tanggal', $tanggal);
        $sql = $this->db->get('booking');
        $result = $sql->result_array();
    }
    public function getgigi()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*, po.nama_poli as id_poli ');
        $this->db->from('booking b');
        $this->db->where('id_poli', 4);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('status', 'Pending');
        //$this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getgigiproses()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*, po.nama_poli as id_poli ');
        $this->db->from('booking b');
        $this->db->where('id_poli', 4);
        $this->db->where('status', 'Diproses');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getlansiaproses()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*,po.nama_poli as id_poli ');
        $this->db->from('booking b');
        $this->db->where('id_poli', 5);
        $this->db->where('status', 'Diproses');
        //  $this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getkiaproses()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*, po.nama_poli as id_poli ');
        $this->db->from('booking b');
        $this->db->where('id_poli', 3);
        $this->db->where('status', 'Diproses');
        // $this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getumumproses()
    {
        $this->db->select('b.*,po.nama_poli as id_poli ');
        $this->db->from('booking b');
        $this->db->where('id_poli', 1);
        $this->db->where('status', 'Diproses');
        // $this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getanakproses()
    {
        $this->db->select('b.*,po.nama_poli as id_poli ');
        $this->db->from('booking b');
        $this->db->where('id_poli', 2);
        $this->db->where('status', 'Diproses');
        //  $this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getkia()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*,pa.nama as id_pasien, po.nama_poli as id_poli ');
        $this->db->from('booking b');
        $this->db->where('id_poli', 3);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('status', 'Pending');
        $this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getlansia()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*, pa.nama as id_pasien, po.nama_poli as id_poli');
        $this->db->from('booking b');
        $this->db->where('id_poli', 5);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('status', 'Pending');
        $this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getumum()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*, , pa.nama as id_pasien, po.nama_poli as id_poli');
        $this->db->from('booking b');
        $this->db->where('id_poli', 1);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('status', 'Pending');
        $this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getanak()
    {
        $tanggal = date("Y-m-d");
        $this->db->select('b.*, , pa.nama as id_pasien, po.nama_poli as id_poli');
        $this->db->from('booking b');
        $this->db->where('id_poli', 2);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('status', 'Pending');
        $this->db->join('pasien pa', 'b.id_pasien = pa.id');
        $this->db->join('poli po', 'b.id_poli = po.id');
        $this->db->order_by('no_antrian', 'ASC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getrow($id_poli, $tanggal)
    {
        $this->db->select('b.*');
        $this->db->from('booking b');
        $this->db->where('id_poli', $id_poli);
        $this->db->where('tanggal', $tanggal);
        $this->db->order_by('no_antrian', 'DESC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return  $query->num_rows();
    }
    public function getgigi_db($tanggal)
    {
        $this->db->select('b.*');
        $this->db->from('booking b');
        $this->db->where('id_poli', 4);
        $this->db->where('tanggal', $tanggal);
        //$this->db->order_by('no_antrian', 'DESC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return  $query->num_rows();
    }
    public function getumum_db($tanggal)
    {
        $this->db->select('b.*');
        $this->db->from('booking b');
        $this->db->where('id_poli', 1);
        $this->db->where('tanggal', $tanggal);
        //$this->db->order_by('no_antrian', 'DESC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return  $query->num_rows();
    }
    public function getlansia_db($tanggal)
    {
        $this->db->select('b.*');
        $this->db->from('booking b');
        $this->db->where('id_poli', 5);
        $this->db->where('tanggal', $tanggal);
        //$this->db->order_by('no_antrian', 'DESC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return  $query->num_rows();
    }
    public function getanak_db($tanggal)
    {
        $this->db->select('b.*');
        $this->db->from('booking b');
        $this->db->where('id_poli', 2);
        $this->db->where('tanggal', $tanggal);
        //$this->db->order_by('no_antrian', 'DESC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return  $query->num_rows();
    }
    public function getkia_db($tanggal)
    {
        $this->db->select('b.*');
        $this->db->from('booking b');
        $this->db->where('id_poli', 2);
        $this->db->where('tanggal', $tanggal);
        //$this->db->order_by('no_antrian', 'DESC');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return  $query->num_rows();
    }
    public function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByPoli($poli, $tanggal)
    {
        $this->db->select('umur');
        $this->db->from($this->table);
        $this->db->where('id_poli', $poli);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function countPoli($poli, $tanggal)
    {
        $this->db->select('umur');
        $this->db->from($this->table);
        $this->db->where('id_poli', $poli);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function updatestatus1($id, $status)
    {
        $this->db->update($this->table, $status, $id);
        return $this->db->affected_rows();
    }
    public function updatesisa($sisa, $poli, $tanggal)
    {
        // $this->db->set('sisa', 'sisa' - 1);
        $this->db->update('booking', $sisa);
        $this->db->where('id_poli', $poli);
        $this->db->where('tanggal', $tanggal);

        //$this->db->update($this->table, $status, $id);
        return $this->db->affected_rows();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
