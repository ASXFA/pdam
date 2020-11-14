<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function getAll()
	{
        $this->db->not_like('id',$this->session->userdata('id'));
        return $this->db->get('tb_users');
    }

    public function getUSers()
    {
        return $this->db->get('tb_users');
    }

	public function getById($id)
	{
        $this->db->where('id',$id);
        return $this->db->get('tb_users');
    }

    public function cekUsername($username)
    {
        $this->db->where('username',$username);
        return $this->db->get('tb_users');
    }

    public function getByStatus()
    {
        $this->db->where('status','1');
        return $this->db->get('tb_level');
    }
    
    public function tambah()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('username'),PASSWORD_DEFAULT),
            'level' => $this->input->post('level'),
            'status' => 0
        );
        $query = $this->db->insert('tb_users',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function tambahUser()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'no_rekening' => $this->input->post('no_rekening'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('pass'),PASSWORD_DEFAULT),
            'level' => 2,
            'status' => 0
        );
        $query = $this->db->insert('tb_users',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function edit($id)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'level' => $this->input->post('level')
        );
        $this->db->where('id',$id);
        $query = $this->db->update('tb_users',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->delete('tb_users');
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function editStatus($id,$nilai)
    {
        $data = array('status' => $nilai);
        $this->db->where('id',$id);
        $query = $this->db->update('tb_users',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function gantiPassword($id)
    {
        $data = array('password'=>password_hash($this->input->post('pass_baru'),PASSWORD_DEFAULT));
        $this->db->where('id',$id);
        $query = $this->db->update('tb_users',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
