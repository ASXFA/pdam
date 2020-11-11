<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golongan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('golongan_model');
        $this->load->model('golongan_level_model');
        $this->load->model('level_model');
    }

	public function index()
	{
        $data['golongan'] = $this->golongan_model->getAll()->result();
        $data['golongan_level'] = $this->golongan_level_model->getAll()->result();
        $data['level'] = $this->level_model->getByStatus()->result();
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/golongan',$data);
        $this->load->view('template/footer');    
    }
    
    public function tambah()
    {
        $level = $this->input->post('level');
        $harga_level = $this->input->post('harga_level');
        $deskripsi = $this->input->post('deskripsi');
        $query = $this->golongan_model->tambah();
        for ($i=0; $i < count($level) ; $i++) { 
            $data = $this->golongan_level_model->tambah($query,$level[$i],$harga_level[$i],$deskripsi[$i]);
        }
        if ($data) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanGolongan','Golongan Berhasil Ditambahkan !');
            redirect('golongan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanGolongan','Golongan Gagal Ditambahkan !');
            redirect('golongan');
        }
    }

    public function edit($id)
    {
        $ids = $this->input->post('ids');
        $level = $this->input->post('level');
        $harga_level = $this->input->post('harga_level');
        $deskripsi = $this->input->post('deskripsi');
        $query = $this->golongan_model->edit($id);
        for ($i=0; $i < count($level) ; $i++) { 
            $data = $this->golongan_level_model->edit($id_level,$level[$i],$harga_level[$i],$deskripsi[$i]);
        }
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanGolongan','Golongan Berhasil Diedit !');
            redirect('golongan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanGolongan','Golongan Gagal Diedit !');
            redirect('golongan');
        }
    }

    public function hapus($id)
    {
        $query = $this->golongan_model->delete($id);
        $data = $this->golongan_level_model->delete($id);
        if ($data) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanGolongan','Golongan Berhasil Dihapus !');
            redirect('golongan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanGolongan','Golongan Gagal Dihapus !');
            redirect('golongan');
        }
    }

    public function gantiStatus($id,$nilai)
    {
        $query = $this->golongan_model->editStatus($id,$nilai);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanGolongan','Status Berhasil Diganti !');
            redirect('golongan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanGolongan','Status Gagal Diganti !');
            redirect('golongan');
        }
    }
}
