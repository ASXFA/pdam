<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

	public function getAll()
	{
        $this->db->select('*');
        $this->db->from('tb_tagihan');
        $this->db->join('tb_pelanggan','tb_pelanggan.id = tb_tagihan.pelanggan_id','LEFT');
        return $this->db->get();
    }

    public function getSemua()
    {
        $this->db->order_by('status_tagihan','ASC');
        return $this->db->get('tb_tagihan');
    }

    public function getTagihanUsers()
    {
        $this->db->order_by('pelanggan_id','ASC');
        return $this->db->get('tb_tagihan');
    }

	public function getByIdPrint($bulan,$tahun,$status)
	{
        $this->db->select('*');
        $this->db->from('tb_tagihan');
        if ($tahun != "Semua") {
            $this->db->where("tahun", $tahun);
        }
        if ($bulan != "Semua") {
            $this->db->where('periode', $bulan);
        }
        if ($status != "Semua") {
            $this->db->where('status_tagihan',$status);
        }
        $this->db->join('tb_pelanggan','tb_pelanggan.id = tb_tagihan.pelanggan_id');
        return $this->db->get();
    }

    public function getById($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('tb_tagihan');
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
        $this->db->order_by('status_tagihan','ASC');
        return $this->db->get('tb_tagihan');
    }

    public function getByPelIdDesc($id)
    {
        $this->db->where('pelanggan_id',$id);
        $this->db->order_by('id','DESC');
        return $this->db->get('tb_tagihan');
    }

    public function getByPelIdAsc($id)
    {
        $this->db->where('pelanggan_id',$id);
        $this->db->order_by('id','ASC');
        return $this->db->get('tb_tagihan');
    }

    public function getByPelIdStatAsc($id,$stat="")
    {
        $this->db->where('pelanggan_id',$id);
        $this->db->where('status_tagihan',0);
        $this->db->order_by('id','ASC');
        return $this->db->get('tb_tagihan');
    }
    
    public function tambah()
    {
        $data = array(
            'pelanggan_id' => $this->input->post('pelanggan_id'),
            'periode' => $this->input->post('periode'),
            'tahun' => $this->input->post('tahun'),
            'mtr_lama' => $this->input->post('mtr_lama'),
            'mtr_baru' => $this->input->post('mtr_baru'),
            'volume' => $this->input->post('volume'),
            'total' => $this->input->post('total'),
            'status_tagihan' => 0,
            'created_by' => $this->session->userdata('id')
        );
        $query = $this->db->insert('tb_tagihan',$data);
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
            'nama' => $this->input->post('nama_pelanggan'),
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

    public function gantiStatus($id,$nilai)
    {
        $data = array('status_tagihan' => $nilai);
        $this->db->where('id',$id);
        $query = $this->db->update('tb_tagihan',$data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
