<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('tagihan_model');
    }

	public function index()
	{
        // $this->load->model('users_model');
        $this->load->model('golongan_model');
        $this->load->model('pelanggan_model');
        $this->load->model('pembayaran_model');
        // $data['users'] = $this->users_model->getAll()->result();
        $data['golongan'] = $this->golongan_model->getAll()->result();
        $data['tagihan'] = $this->tagihan_model->getSemua()->result();
        $data['pelanggan'] = $this->pelanggan_model->getAll()->result();
        $data['pembayaran'] = $this->pembayaran_model->getAll()->result();
        if (isset($_GET['filter'])) {
            $tahun = $_GET['tahun'];
            $bulan = $_GET['bulan'];
            $status = $_GET['status_tagihan'];
            $data['tagihan_filter'] = $this->tagihan_model->getFilter($tahun,$bulan,$status)->result();
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            $data['status_tagihan'] = $status;
        }
        if ($this->session->userdata('level')==2) {
            $data['pelanggan'] = $this->pelanggan_model->cekNorek($this->session->userdata('no_rekening'))->row();
            $data['tagihan2'] = $this->tagihan_model->getByPelIdDesc($data['pelanggan']->id)->result();
        }
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/tagihan',$data);
        $this->load->view('template/footer');    
    }

    public function coba()
    {
        $this->load->model('golongan_model');
        $this->load->model('pelanggan_model');
        $datas['golongan'] = $this->golongan_model->getAll()->result();
        $datas['tagihan'] = $this->tagihan_model->getAll()->result();
        $datas['pelanggan'] = $this->pelanggan_model->getAll()->result();
		$this->load->view('admin/printTagihan', $datas);
    }

    public function printPDF()
	{
        $this->load->model('golongan_model');
        $this->load->model('pelanggan_model');
		$mpdf = new \Mpdf\Mpdf(['orientation'=>'L']);
		$data = $this->load->view('admin/printTagihan','', TRUE);
		$mpdf->WriteHTML($data);
		$mpdf->Output();
    }
    
    public function printPDFFilter($bulan,$tahun,$status_tagihan)
	{
        $this->load->model('golongan_model');
        $this->load->model('pelanggan_model');
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['status_tagihan'] = $status_tagihan;
        $data['tagihan'] = $this->tagihan_model->getByIdPrint($bulan,$tahun,$status_tagihan)->result();
		$mpdf = new \Mpdf\Mpdf(['orientation'=>'L']);
		$data = $this->load->view('admin/printTagihanFilter',$data, TRUE);
		$mpdf->WriteHTML($data);
		$mpdf->Output();
	}

    public function tambah()
    {
        $this->load->model('pelanggan_model');
        $data['pelanggan'] = $this->pelanggan_model->getAll()->result();
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/tambahTagihan',$data);
        $this->load->view('template/footer');
    }
    
    public function aksi_tambah()
    {
        $query = $this->tagihan_model->tambah();
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanTagihan','Tagihan Berhasil Ditambahkan !');
            redirect('tagihan');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanTagihan','Tagihan Gagal Ditambahkan !');
            redirect('tagihan');
        }
    }

    public function getPelanggan()
    {
        $this->load->model('pelanggan_model');
        $id = $this->input->post('id');
        $pelanggan = $this->pelanggan_model->getById($id)->row();
        $tagihann = $this->tagihan_model->getByPelIdDesc($id);
        $tagihan = $tagihann->row();
        if ($tagihann->num_rows()==0) {
            $mtr_lama = 0;
        }else{
            $mtr_lama = $tagihan->volume;
        }
        $data = array(
            'pelanggan_id' => $pelanggan->id,
            'no_rekening' => $pelanggan->no_rekening,
            'nama' => $pelanggan->nama,
            'alamat' => $pelanggan->alamat,
            'no_hp' => $pelanggan->no_hp,
            'mtr_lama' => $mtr_lama,
            'golongan' => $pelanggan->golongan
        );
        echo json_encode($data);
    }

    public function ambilGolLevel()
    {
        $this->load->model('golongan_model');
        $this->load->model('golongan_level_model');
        $this->load->model('level_model');
        $golId = $this->input->post('golId');
        $volume = $this->input->post('volume');
        $golongan = $this->golongan_model->getById($golId)->row();
        $golonganLevel = $this->golongan_level_model->getByGolId($golId)->result();
        $level = $this->level_model->getAll()->result();
        foreach($golonganLevel as $gl):
            foreach($level as $l):
                if ($l->id == $gl->deskripsi) {
                    if ($l->status == 1) {
                        if(($l->operand == NULL)){
                            if ($volume <= $l->nilai_akhir) {
                                $hitung = $gl->harga * $volume;
                                $data = array(
                                    'harga' => $hitung,
                                    'beban' => $golongan->beban,
                                    'volume' => $volume,
                                    'golongan' => $gl->level,
                                    'operand' => $l->operand
                                );
                            }
                        }else if($l->nilai_akhir == 0 ){
                            if ($l->operand == "<") {
                                if ($volume < $l->nilai_awal) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand
                                    );
                                }
                            }else if($l->operand == "<="){
                                if ($volume <= $l->nilai_awal) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand
                                    );
                                }
                            }else if($l->operand == "=="){
                                if ($volume == $l->nilai_awal) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand
                                    );
                                }
                            }else if($l->operand == ">"){
                                if ($volume > $l->nilai_awal) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand
                                    );
                                }
                            }else if($l->operand == ">="){
                                if ($volume >= $l->nilai_awal) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand 
                                    );
                                }
                            }
                        }else{
                            if ($l->operand == "<") {
                                if ($volume < $l->nilai_awal && $volume <= $l->nilai_akhir) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand 
                                    );
                                }
                            }else if($l->operand == "<="){
                                if ($volume <= $l->nilai_awal && $volume <= $l->nilai_akhir) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand 
                                    );
                                }
                            }else if($l->operand == "=="){
                                if ($volume == $l->nilai_awal && $volume <= $l->nilai_akhir) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand 
                                    );
                                }
                            }else if($l->operand == ">"){
                                if ($volume > $l->nilai_awal && $volume <= $l->nilai_akhir) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand 
                                    );
                                }
                            }else if($l->operand == ">="){
                                if ($volume > $l->nilai_awal && $volume <= $l->nilai_akhir) {
                                    $hitung = $gl->harga * $volume;
                                    $data = array(
                                        'harga' => $hitung,
                                        'beban' => $golongan->beban,
                                        'volume' => $volume,
                                        'golongan' => $gl->level,
                                        'operand' => $l->operand 
                                    );
                                }
                            }
                        }
                    }
                }
            endforeach;
        endforeach;
        echo json_encode($data);
    }

    public function edit($id)
    {
        $query = $this->informasi_model->edit($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanTagihan','informasi Berhasil Diedit !');
            redirect('informasi');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanTagihan','informasi Gagal Diedit !');
            redirect('informasi');
        }
    }

    public function hapus($id)
    {
        $query = $this->informasi_model->delete($id);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanTagihan','informasi Berhasil Dihapus !');
            redirect('informasi');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanTagihan','informasi Gagal Dihapus !');
            redirect('informasi');
        }
    }

    public function gantiStatus($id,$nilai)
    {
        $query = $this->informasi_model->editStatus($id,$nilai);
        if ($query) {
            $this->session->set_flashdata('kondisi','1');
            $this->session->set_flashdata('pesanTagihan','Status Berhasil Diganti !');
            redirect('informasi');
        }else{
            $this->session->set_flashdata('kondisi','0');
            $this->session->set_flashdata('pesanTagihan','Status Gagal Diganti !');
            redirect('informasi');
        }
    }
}
