<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perawat_model extends CI_Model
{
    public $table = 'pegawai';
    public $id = 'pegawai.id';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getByNIK($nik)
    {
        $this->db->from($this->table);
        $this->db->like('nik', $nik);
        $query = $this->db->get();
        return $query->row_array();
    }

    // public function getByToken($token)
    // {
    //     $this->db->from($this->table);
    //     $this->db->like('token', $token);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    public function getBy()
    {
        $this->db->from($this->table);
        $this->db->where('email', $this->session->userdata('email'));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByEmail($username)
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
    public function insertAnggota($data)
    {
        $this->db->insert('anggota', $data);
        return $this->db->insert_id();
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
