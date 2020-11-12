<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

        function __construct()
        {
                parent::__construct();
                if ($this->session->userdata('isLogin')!=1) {
                        redirect('login');
                }
        }

	public function index()
	{
                $this->load->model('informasi_model');
                $this->load->model('pelanggan_model');
                $this->load->model('users_model');
                $this->load->model('tagihan_model');
                $this->load->model('golongan_model');
                $data['informasi'] = $this->informasi_model->getAll()->result();
                $data['pelanggan'] = $this->users_model->getAll()->num_rows();
                $data['users'] = $this->users_model->getAll()->num_rows();
                $data['tagihan'] = $this->tagihan_model->getAll()->num_rows();
                $data['golongan'] = $this->golongan_model->getAll()->num_rows();
                $this->load->view('template/header');
                $this->load->view('template/sider');
                $this->load->view('template/navbar');
                $this->load->view('dashboard',$data);
                $this->load->view('template/footer');    
	}
}
