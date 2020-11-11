<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('pembayaran_model');
    }

	public function index()
	{
        $this->load->model('pelanggan_model');
            $data['pelanggan'] = $this->pelanggan_model->getAll()->result();
            $this->load->view('template/header');
            $this->load->view('template/sider');
            $this->load->view('template/navbar');
            $this->load->view('admin/pembayaran',$data);
            $this->load->view('template/footer'); 
    }

    // public function coba()
    // {
    //     $this->load->model('golongan_model');
    //     $this->load->model('pelanggan_model');
    //     $datas['golongan'] = $this->golongan_model->getAll()->result();
    //     $datas['tagihan'] = $this->tagihan_model->getAll()->result();
    //     $datas['pelanggan'] = $this->pelanggan_model->getAll()->result();
	// 	$this->load->view('admin/printTagihan', $datas);
    // }

    // public function printPDF()
	// {
    //     $this->load->model('golongan_model');
    //     $this->load->model('pelanggan_model');
	// 	$mpdf = new \Mpdf\Mpdf();
	// 	$data = $this->load->view('admin/printTagihan','', TRUE);
	// 	$mpdf->WriteHTML($data);
	// 	$mpdf->Output();
	// }
    
    public function tambah()
    {
        $this->load->model('tagihan_model');
        $pelanggan_id = $this->input->post('pelanggan_id');
        $tagihan_id = $this->input->post('tagihan_id');
        $cash = $this->input->post('cash');
        $kembalian = $this->input->post('kembalian');
        $query = $this->pembayaran_model->tambah($pelanggan_id,$tagihan_id,$cash,$kembalian);
        $data = array(
            'kondisi' => 1,
            'pesanPembayaran' => 'Pembayaran berhasil !',
            'pembayaran_id' => $query
        );
        $this->tagihan_model->gantiStatus($tagihan_id,1);
        echo json_encode($data);
    }

    public function getPelanggan()
    {
        $this->load->model('golongan_model');
        $this->load->model('tagihan_model');
        $this->load->model('pelanggan_model');
        $id = $this->input->post('id');
        $pelanggan = $this->pelanggan_model->getById($id)->row();
        $golongan = $this->golongan_model->getById($pelanggan->golongan)->row();
        $tagihann = $this->tagihan_model->getByPelIdStatAsc($id);
        $tagihan = $tagihann->row();
        if ($tagihann->num_rows() > 0) {
            $data = array(
                'konidisi' => 1,
                'tagihan_id' => $tagihan->id,
                'pelanggan_id' => $pelanggan->id,
                'no_rekening' => $pelanggan->no_rekening,
                'nama' => $pelanggan->nama,
                'alamat' => $pelanggan->alamat,
                'no_hp' => $pelanggan->no_hp,
                'periode' => $tagihan->periode,
                'total' => $tagihan->total,
                'denda' => $golongan->denda
            );
        }else{
            $data = array(
                'kondisi' => 0,
                'pesanPembayaran' => 'Pelanggan ini tidak mempunyai tagihan yang belum dibayar !'
            );
        }
        echo json_encode($data);
    }

    public function invoice($id)
    {
        $this->load->model('tagihan_model');
        $this->load->model('pelanggan_model');
        $data['pembayaran'] = $this->pembayaran_model->getById($id)->row();
        $data['pelanggan'] = $this->pelanggan_model->getById($data['pembayaran']->pelanggan_id)->row();
        $data['tagihan'] = $this->tagihan_model->getById($data['pembayaran']->tagihan_id)->row();
        $this->load->view('template/header');
        $this->load->view('admin/invoice',$data);
        $this->load->view('template/footer');
    }

    // public function ambilGolLevel()
    // {
    //     $this->load->model('golongan_model');
    //     $this->load->model('golongan_level_model');
    //     $this->load->model('level_model');
    //     $golId = $this->input->post('golId');
    //     $volume = $this->input->post('volume');
    //     $golongan = $this->golongan_model->getById($golId)->row();
    //     $golonganLevel = $this->golongan_level_model->getByGolId($golId)->result();
    //     $level = $this->level_model->getAll()->result();
    //     foreach($golonganLevel as $gl):
    //         foreach($level as $l):
    //             if ($l->id == $gl->deskripsi) {
    //                 if ($l->status == 1) {
    //                     if(($l->operand == NULL)){
    //                         if ($volume <= $l->nilai_akhir) {
    //                             $hitung = $gl->harga * $volume;
    //                             $data = array(
    //                                 'harga' => $hitung,
    //                                 'beban' => $golongan->beban,
    //                                 'volume' => $volume,
    //                                 'golongan' => $gl->level,
    //                                 'operand' => $l->operand
    //                             );
    //                         }
    //                     }else if($l->nilai_akhir == 0 ){
    //                         if ($l->operand == "<") {
    //                             if ($volume < $l->nilai_awal) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand
    //                                 );
    //                             }
    //                         }else if($l->operand == "<="){
    //                             if ($volume <= $l->nilai_awal) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand
    //                                 );
    //                             }
    //                         }else if($l->operand == "=="){
    //                             if ($volume == $l->nilai_awal) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand
    //                                 );
    //                             }
    //                         }else if($l->operand == ">"){
    //                             if ($volume > $l->nilai_awal) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand
    //                                 );
    //                             }
    //                         }else if($l->operand == ">="){
    //                             if ($volume >= $l->nilai_awal) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand 
    //                                 );
    //                             }
    //                         }
    //                     }else{
    //                         if ($l->operand == "<") {
    //                             if ($volume < $l->nilai_awal && $volume <= $l->nilai_akhir) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand 
    //                                 );
    //                             }
    //                         }else if($l->operand == "<="){
    //                             if ($volume <= $l->nilai_awal && $volume <= $l->nilai_akhir) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand 
    //                                 );
    //                             }
    //                         }else if($l->operand == "=="){
    //                             if ($volume == $l->nilai_awal && $volume <= $l->nilai_akhir) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand 
    //                                 );
    //                             }
    //                         }else if($l->operand == ">"){
    //                             if ($volume > $l->nilai_awal && $volume <= $l->nilai_akhir) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand 
    //                                 );
    //                             }
    //                         }else if($l->operand == ">="){
    //                             if ($volume > $l->nilai_awal && $volume <= $l->nilai_akhir) {
    //                                 $hitung = $gl->harga * $volume;
    //                                 $data = array(
    //                                     'harga' => $hitung,
    //                                     'beban' => $golongan->beban,
    //                                     'volume' => $volume,
    //                                     'golongan' => $gl->level,
    //                                     'operand' => $l->operand 
    //                                 );
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         endforeach;
    //     endforeach;
    //     echo json_encode($data);
    // }

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
