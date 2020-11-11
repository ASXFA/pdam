<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
    }
    
    public function daftar()
    {
		$this->load->view('register');
    }

    public function aksi_login()
    {
        $this->load->model('users_model');
        $username = $this->input->post('username');
        $password = $this->input->post('pass');
        $cek = $this->users_model->cekUsername($username);
        if ($cek->num_rows() > 0) {
            $getData = $cek->row();
            if (password_verify($password,$getData->password)) {
                $sessionData = array(
                    'isLogin' => 1,
                    'id' => $getData->id,
                    'no_rekening' => $getData->no_rekening,
                    'nama' => $getData->nama,
                    'username' => $getData->username,
                    'level' => $getData->level
                );
                if ($getData->status == 0) {
                    $this->session->set_flashdata('kondisi','0');
                    $this->session->set_flashdata('pesanLogin','Akun anda belum diaktifkan, mohon hubungi Administrator !');
                    redirect('login');
				}else{
                    $this->session->set_userdata($sessionData);
                    $this->session->set_flashdata('kondisi','1');
                    $this->session->set_flashdata('pesanDashboard','Selamat Datang ');
                    redirect('dashboard');
				}
            }else{
                $this->session->set_flashdata('kondisi','0');
                $this->session->set_flashdata('pesanLogin','Password anda tidak cocok !');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanLogin','Username anda tidak tersedia !');
            redirect('login');
        }
    }

    public function aksi_registrasi()
    {
        $this->load->model('users_model');
        $query = $this->users_model->tambahUser();
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanLogin','Pendaftaran Berhasil !');
            redirect('login');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanDaftar','Pendaftran Gagal !');
            redirect('login/daftar');
        }
    }

    public function logout()
    {
        $this->session->set_flashdata('isLogin',0);
        $this->session->sess_destroy();
        redirect($this);
    }
}
