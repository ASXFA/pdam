<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

	public function getAll()
	{
        return $this->db->get('tb_pelanggan');
    }

	public function getById($id)
	{
        $this->db->where('id',$id);
        return $this->db->get('tb_pelanggan');
    }

    public function cekNorek($norek)
    {
        $this->db->where('no_rekening',$norek);
        return $this->db->get('tb_pelanggan');
    }
    
    public function tambah()
    {
        $data = array(
            'no_rekening' => $this->input->post('no_rekening'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'golongan' => $this->input->post('golongan'),
            'no_hp' => $this->input->post('no_hp'),
            'status' => 0,
        );
        $query = $this->db->insert('tb_pelanggan',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function edit($id)
    {
        $data = array(
            'no_rekening' => $this->input->post('no_rekening'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'golongan' => $this->input->post('golongan'),
            'no_hp' => $this->input->post('no_hp')
        );
        $this->db->where('id',$id);
        $query = $this->db->update('tb_pelanggan',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->delete('tb_pelanggan');
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
        $query = $this->db->update('tb_pelanggan',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
