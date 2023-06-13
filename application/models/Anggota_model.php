<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota_model extends CI_Model
{
    public $table = 'anggota';
    public $id = 'anggota.id';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('an.*, pa.nama as id_root ');
        $this->db->from('anggota an');
        $this->db->join('pasien pa', 'an.id_root = pa.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getByRoot($id)
    {
        $this->db->from($this->table);
        $this->db->like('id_root', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getByUsername($username)
    {
        $this->db->from($this->table);
        $this->db->like('email', $username);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByNIK($nik)
    {
        $this->db->from($this->table);
        $this->db->where('nik', $nik);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByNamaID($nama, $id)
    {
        $this->db->from($this->table);
        $this->db->where('nama', $nama);
        $this->db->where('id_root', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function updateOFF()
    {
        $this->db->set('status_antrian', 'Prioritas OFF', false);
        $this->db->update('anggota');
    }
    public function updateON()
    {
        $this->db->set('status_antrian', 'Prioritas ON', false);
        $this->db->update('anggota');
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
