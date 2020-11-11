<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golongan_model extends CI_Model {

	public function getAll()
	{
        return $this->db->get('tb_golongan');
    }

    public function getById($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('tb_golongan');
    }
    
    public function tambah()
    {
        $data = array(
            'kode' => $this->input->post('kode'),
            'nama' => $this->input->post('nama_golongan'),
            'beban' => $this->input->post('beban'),
            'tempo' => $this->input->post('tempo'),
            'denda' => $this->input->post('denda'),
            'status' => 0,
        );
        $this->db->insert('tb_golongan',$data);   
        $query = $this->db->insert_id(); 
        return $query;
    }

    public function edit($id)
    {
        $data = array(
            'kode' => $this->input->post('kode'),
            'nama' => $this->input->post('nama_golongan'),
            'beban' => $this->input->post('beban'),
            'tempo' => $this->input->post('tempo'),
            'denda' => $this->input->post('denda')
        );
        $this->db->where('id',$id);
        $query = $this->db->update('tb_golongan',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->delete('tb_golongan');
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
        $query = $this->db->update('tb_golongan',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
