<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level_model extends CI_Model {

	public function getAll()
	{
        return $this->db->get('tb_level');
    }

    public function getByStatus()
    {
        $this->db->where('status','1');
        return $this->db->get('tb_level');
    }
    
    public function tambah()
    {
        $data = array(
            'operand' => $this->input->post('operand'),
            'nilai_awal' => $this->input->post('nilai_awal'),
            'nilai_akhir' => $this->input->post('nilai_akhir')
        );
        $query = $this->db->insert('tb_level',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function edit($id)
    {
        $data = array(
            'operand' => $this->input->post('operand'),
            'nilai_awal' => $this->input->post('nilai_awal'),
            'nilai_akhir' => $this->input->post('nilai_akhir')
        );
        $this->db->where('id',$id);
        $query = $this->db->update('tb_level',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->delete('tb_level');
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
        $query = $this->db->update('tb_level',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
