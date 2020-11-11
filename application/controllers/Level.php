<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('level_model');
    }

	public function index()
	{
        // $this->load->model('users_model');
        // $data['users'] = $this->users_model->getAll()->result();
        $data['level'] = $this->level_model->getAll()->result();
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/level',$data);
        $this->load->view('template/footer');    
    }
    
    public function tambah()
    {
        $query = $this->level_model->tambah();
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanLevel','level Berhasil Ditambahkan !');
            redirect('level');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanLevel','level Gagal Ditambahkan !');
            redirect('level');
        }
    }

    public function edit($id)
    {
        $query = $this->level_model->edit($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanLevel','level Berhasil Diedit !');
            redirect('level');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanLevel','level Gagal Diedit !');
            redirect('level');
        }
    }

    public function hapus($id)
    {
        $query = $this->level_model->delete($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanLevel','level Berhasil Dihapus !');
            redirect('level');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanLevel','level Gagal Dihapus !');
            redirect('level');
        }
    }

    public function gantiStatus($id,$nilai)
    {
        $query = $this->level_model->editStatus($id,$nilai);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanLevel','Status Berhasil Diganti !');
            redirect('level');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanLevel','Status Gagal Diganti !');
            redirect('level');
        }
    }

    public function getLevelJson()
    {
        $data = $this->level_model->getByStatus()->result();
        echo json_encode($data);
    }
}
