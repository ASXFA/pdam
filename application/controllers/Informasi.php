<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('informasi_model');
    }

	public function index()
	{
        // $this->load->model('users_model');
        // $data['users'] = $this->users_model->getAll()->result();
        $data['informasi'] = $this->informasi_model->getAll()->result();
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/informasi',$data);
        $this->load->view('template/footer');    
    }
    
    public function tambah()
    {
        $query = $this->informasi_model->tambah();
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanInformasi','informasi Berhasil Ditambahkan !');
            redirect('informasi');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanInformasi','informasi Gagal Ditambahkan !');
            redirect('informasi');
        }
    }

    public function edit($id)
    {
        $query = $this->informasi_model->edit($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanInformasi','informasi Berhasil Diedit !');
            redirect('informasi');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanInformasi','informasi Gagal Diedit !');
            redirect('informasi');
        }
    }

    public function hapus($id)
    {
        $query = $this->informasi_model->delete($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanInformasi','informasi Berhasil Dihapus !');
            redirect('informasi');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanInformasi','informasi Gagal Dihapus !');
            redirect('informasi');
        }
    }

    public function gantiStatus($id,$nilai)
    {
        $query = $this->informasi_model->editStatus($id,$nilai);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanInformasi','Status Berhasil Diganti !');
            redirect('informasi');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanInformasi','Status Gagal Diganti !');
            redirect('informasi');
        }
    }
}
