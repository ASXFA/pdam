<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
    }

	public function index()
	{
        $this->load->model('golongan_model');
        $data['golongan'] = $this->golongan_model->getAll()->result();
        $data['pelanggan'] = $this->pelanggan_model->getAll()->result();
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/pelanggan',$data);
        $this->load->view('template/footer');    
    }
    
     
    public function tambah()
    {
        $query = $this->pelanggan_model->tambah();
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanPelanggan','Pelanggan Berhasil Ditambahkan !');
            redirect('pelanggan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanPelanggan','Pelanggan Gagal Ditambahkan !');
            redirect('pelanggan');
        }
    }

    public function edit($id)
    {
        $query = $this->pelanggan_model->edit($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanPelanggan','Pelanggan Berhasil Diedit !');
            redirect('pelanggan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanPelanggan','Pelanggan Gagal Diedit !');
            redirect('pelanggan');
        }
    }

    public function delete($id)
    {
        $query = $this->pelanggan_model->delete($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanPelanggan','Pelanggan Berhasil Dihapus !');
            redirect('pelanggan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanPelanggan','Pelanggan Gagal Dihapus !');
            redirect('pelanggan');
        }
    }

    public function gantiStatus($id,$nilai)
    {
        $query = $this->pelanggan_model->editStatus($id,$nilai);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanPelanggan','Status Berhasil Diganti !');
            redirect('pelanggan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanPelanggan','Status Gagal Diganti !');
            redirect('pelanggan');
        }
    }

    public function detailPelanggan($noRek)
    {
        $this->load->model('golongan_model');
        $this->load->model('tagihan_model');
        $this->load->model('pembayaran_model');
        $data['pelanggan'] = $this->pelanggan_model->cekNorek($noRek)->row();
        $data['golongan'] = $this->golongan_model->getById($data['pelanggan']->golongan)->row();
        $data['tagihan'] = $this->tagihan_model->getByPelIdAsc($data['pelanggan']->id)->result();
        $data['pembayaran'] = $this->pembayaran_model->getByPelIdAsc($data['pelanggan']->id)->result();
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/detailPelanggan',$data);
        $this->load->view('template/footer'); 
    }

    public function cekNorek()
    {
        $norek = $this->input->post('norek');
        $query = $this->pelanggan_model->cekNorek($norek);
        if ($query->num_rows() > 0) {
            $q = $query->row();
            $data = array(
                'kondisi' => 1,
                'pesan' => "No Rekening anda terdaftar. Silahkan masukan Nama, Username dan Password untuk mendaftarkan Akun anda .... ",
                'nama' => $q->nama
            );
        }else{
            $data = array(
                'kondisi' => 0,
                'pesan' => "No Rekening anda belum terdaftar. Silahkan hubungi administrasi .... "
            );
        }
        echo json_encode($data);
    }
    public function cekNorekAdm()
    {
        $norek = $this->input->post('norek');
        $query = $this->pelanggan_model->cekNorek($norek);
        if ($query->num_rows() > 0) {
            $q = $query->row();
            $data = array(
                'kondisi' => 0,
                'pesan' => "No Rekening sudah digunakan. silahkan masukan kembali no rekening lain .... ",
                'nama' => $q->nama
            );
        }else{
            $data = array(
                'kondisi' => 1,
                'pesan' => "No Rekening bisa dipakai.... "
            );
        }
        echo json_encode($data);
    }
}
