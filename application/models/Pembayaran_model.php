<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

	public function getAll()
	{
        $this->db->select('*');
        $this->db->from('tb_tagihan');
        $this->db->join('tb_pelanggan','tb_pelanggan.id = tb_tagihan.pelanggan_id');
        return $this->db->get();
    }

    public function getById($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('tb_pembayaran');
    }

    public function getFilter($tahun,$bulan,$status)
    {
        if ($tahun != "Semua") {
            $this->db->where("tahun", $tahun);
        }
        if ($bulan != "Semua") {
            $this->db->where('periode', $bulan);
        }
        if ($status != "Semua") {
            $this->db->where('status_tagihan',$status);
        }
        return $this->db->get('tb_tagihan');
    }

    public function getByPelIdDesc($id)
    {
        $this->db->where('pelanggan_id',$id);
        $this->db->order_by('id','DESC');
        return $this->db->get('tb_tagihan');
    }

    public function getByPelIdStatAsc($id)
    {
        $this->db->where('pelanggan_id',$id);
        $this->db->where('status_tagihan',0);
        $this->db->order_by('id','ASC');
        return $this->db->get('tb_tagihan');
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
