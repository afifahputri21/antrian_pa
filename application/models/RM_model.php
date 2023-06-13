<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RM_model extends CI_Model
{
    public $table = 'rekam_medis';
    public $id = 'rekam_medis.id';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('rm.* ');
        $this->db->from('rekam_medis rm');
        //$this->db->join('pasien pa', 'rm.id_pasien = pa.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByPasien($id_pasien)
    {
        $this->db->from($this->table);
        $this->db->where('id_pasien', $id_pasien);
        $query = $this->db->get();
        return $query->result();
    }
    public function getByNIK($nik)
    {
        $this->db->from($this->table);
        $this->db->where('nik', $nik);
        $query = $this->db->get();
        return $query->result();
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
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
