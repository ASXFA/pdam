<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

	public function index()
	{
        $data['users'] = $this->users_model->getAll()->result();
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/users',$data);
        $this->load->view('template/footer');    
    }
    
     
    public function tambah()
    {
        $query = $this->users_model->tambah();
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanUsers','users Berhasil Ditambahkan !');
            redirect('users');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanUsers','users Gagal Ditambahkan !');
            redirect('users');
        }
    }

    public function edit($id)
    {
        $query = $this->users_model->edit($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanUsers','users Berhasil Diedit !');
            redirect('users');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanUsers','users Gagal Diedit !');
            redirect('users');
        }
    }

    public function delete($id)
    {
        $query = $this->users_model->delete($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanUsers','users Berhasil Dihapus !');
            redirect('users');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanUsers','users Gagal Dihapus !');
            redirect('users');
        }
    }

    public function gantiStatus($id,$nilai)
    {
        $query = $this->users_model->editStatus($id,$nilai);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanUsers','Status Berhasil Diganti !');
            redirect('users');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanUsers','Status Gagal Diganti !');
            redirect('users');
        }
    }

    public function cekUsername()
    {
        $norek = $this->input->post('username');
        $query = $this->users_model->cekUsername($norek);
        if ($query->num_rows() > 0) {
            $data = array(
                'kondisi' => 0,
                'pesan' => "Username anda sudah dipakai ! Masukan username yang lain ..."
            );
        }else{
            $data = array(
                'kondisi' => 1,
                'pesan' => "Username anda belum terdaftar dan bisa digunakan :) "
            );
        }
        echo json_encode($data);
    }

    public function cekPassword()
    {
        $queryy = $this->users_model->cekUsername($this->session->userdata('username'));
        $pass = $this->input->post('pswd');
        $query = $queryy->row();
        if (password_verify($pass,$query->password)) {
            $data = array(
                'kondisi' => 1,
                'pesan' => "Password Lama Benar !"
            );
        }else{
            $data = array(
                'kondisi' => 0,
                'pesan' => "Password Lama Salah ! "
            );
        }
        echo json_encode($data);
    }

    public function detail($id)
	{
        if ($this->session->userdata('level') == 2) {
            $this->load->model('pelanggan_model');
            $data['pelanggan'] = $this->pelanggan_model->cekNorek($this->session->userdata('no_rekening'))->row();
        }
        $data['users'] = $this->users_model->getById($id)->row();
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('profil',$data);
        $this->load->view('template/footer');    
    }

    public function gantiPassword($id)
    {
        $query = $this->users_model->gantiPassword($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanUsers','Password Berhasil Diganti !');
            redirect('login/logout');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanUsers','Password Gagal Diganti !');
            redirect('users/detail/'.$id);
        }
    }
}
