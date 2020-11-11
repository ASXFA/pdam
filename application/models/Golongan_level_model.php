<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golongan_level_model extends CI_Model {

	public function getAll()
	{
        return $this->db->get('tb_golongan_level');
    }

    public function getByGolId($golongan_id)
    {
        $this->db->where('golongan_id',$golongan_id);
        return $this->db->get('tb_golongan_level');
    }
    
    public function tambah($id,$level,$harga_level,$deskripsi)
    {
        $data = array(
            'golongan_id' => $id,
            'level' => $level,
            'harga' => $harga_level,
            'deskripsi' => $deskripsi
        );
        $query = $this->db->insert('tb_golongan_level',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function edit($id_level,$level,$harga_level,$deskripsi)
    {
        $data = array(
            'golongan_id' => $id,
            'level' => $level,
            'harga' => $harga_level,
            'deskripsi' => $deskripsi
        );
        $this->db->where('id',$id_level);
        $query = $this->db->update('tb_golongan_level',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('golongan_id',$id);
        $query = $this->db->delete('tb_golongan_level');
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
