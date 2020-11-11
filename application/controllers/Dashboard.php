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
                $data['informasi'] = $this->informasi_model->getAll()->result();
                $this->load->view('template/header');
                $this->load->view('template/sider');
                $this->load->view('template/navbar');
                $this->load->view('dashboard',$data);
                $this->load->view('template/footer');    
	}
}
