<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Android_model extends CI_Model
{
    public $rm = 'rekam_medis';
    public $pasien = 'pasien';
    public $id_rm = 'rekam_medis.id';
    public $id_ps = 'pasien.id';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('rm.*, pa.nama as id_pasien ');
        $this->db->from('rekam_medis rm');
        $this->db->join('pasien pa', 'rm.id_pasien = pa.id');
        // $this->db->join('poli po', 'b.id_poli = po.id');
        // $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    // public function getRiwayat()
    // {
    //     // $this->db->select('rm.*');
    //     // $this->db->from('rekam_medis rm');
    //     // //$this->db->join('pasien pa', 'rm.id_pasien = pa.id');
    //     // // $this->db->join('poli po', 'b.id_poli = po.id');
    //     // // $this->db->from($this->table);
    //     // $query = $this->db->get();
    //     // return $query->result_array();

    //     $result = $db->query("SELECT rm.* FROM rekam_medis rm");
    //     //$list = array();
    //     if ($result) {
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $list[] = $row;
    //         }
    //     }
    //     echo json_decode($list);
    // }
    public function getByUsername($username)
    {
        $this->db->select('id');
        $this->db->from('pasien');
        $this->db->where('id', $username);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByPasien($id_pasien)
    {
        $this->db->from($this->table);
        $this->db->like('id_pasien', $id_pasien);
        $query = $this->db->get();
        return $query->result();
    }
    // public function getByEmail($email)
    // {
    //     $this->db->from($this->table);
    //     $this->db->like('id_pasien', $id_pasien);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
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
