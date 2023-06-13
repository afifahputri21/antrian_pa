<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public $table = 'user';
	public $role = 'role_user';
	public $id = 'user.id';
	public function __construct()
	{
		parent::__construct();
	}
	public function get()
	{
		$this->db->select('u.*, ru.id as role_id');
		$this->db->from('user u');
		$this->db->join('role_user ru', 'u.role_id = ru.id');
		$this->db->where_not_in('role_id', 4);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getBy()
	{
		$this->db->from($this->table);
		$this->db->where('email', $this->session->userdata('email'));
		$query = $this->db->get();
		return $query->row_array();
	}
	public function getLevel()
	{
		$this->db->from('role_user');
		$this->db->where_not_in('id', 4);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getAkses()
	{
		$this->db->from('role_user');
		$this->db->where_not_in('id', 4);
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
	public function login($username, $password)
	{
		$this->db->from('pasien');
		$this->db->where('email', $username);
		$this->db->where('password', $password);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function login2($username, $password)
	{
		$user = $this->db
			->where('username', $username)
			->where('password', md5($password))
			->get('users')
			->row_array();

		return $user;
	}
	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function getByRoleId($data)
	{
		$this->db->from('role_user');
		$this->db->where('id', $data);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function updateRole($where, $data)
	{
		$this->db->update('role_user', $data, $where);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}
	public function deleteAkses($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('role_user');
		return $this->db->affected_rows();
	}
	public function tuser()
	{
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
