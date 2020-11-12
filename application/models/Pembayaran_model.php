<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

	public function getAll()
	{
        return $this->db->get('tb_pembayaran');
    }

    public function getById($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('tb_pembayaran');
    }

    public function getFilter($bulan,$tahun)
    {
        if ($tahun != "Semua") {
            $this->db->where("year(created_at)",$tahun);
        }
        if ($bulan != "Semua") {
            $this->db->where("month(created_at)",$bulan);
        }
        return $this->db->get('tb_pembayaran');
    }

    public function getByPelIdAsc($id)
    {
        $this->db->where('pelanggan_id',$id);
        $this->db->order_by('id','Asc');
        return $this->db->get('tb_pembayaran');
    }
    
    public function tambah($pelanggan_id,$tagihan_id,$cash,$kembalian)
    {
        $data = array(
            'pelanggan_id' => $pelanggan_id,
            'tagihan_id' => $tagihan_id,
            'cash' => $cash,
            'kembalian' => $kembalian,
            'created_by' => $this->session->userdata('id')
        );
        $this->db->insert('tb_pembayaran',$data);
        return $this->db->insert_id();
    }
}
