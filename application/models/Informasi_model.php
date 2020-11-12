<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_model extends CI_Model {

	public function getAll()
	{
        return $this->db->get('tb_informasi');
    }
    
    public function tambah()
    {
        $data = array(
            'judul' => $this->input->post('judul'),
            'deskripsi' => $this->input->post('deskripsi'),
            'created_by' => $this->session->userdata('id'),
            'status' => 0
        );
        $query = $this->db->insert('tb_informasi',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function edit($id)
    {
        $data = array(
            'judul' => $this->input->post('judul'),
            'deskripsi' => $this->input->post('deskripsi')
        );
        $this->db->where('id',$id);
        $query = $this->db->update('tb_informasi',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->delete('tb_informasi');
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
        $query = $this->db->update('tb_informasi',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
