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

    public function laporan()
    {
        $this->load->model('pelanggan_model');
        $this->load->model('tagihan_model');
        $data['judul'] = "laporan";
        if(isset($_GET['filter'])){
            if ($_GET['bulan'] == "Semua" && $_GET['tahun'] == "Semua") {
                $data['pelanggan'] = $this->pelanggan_model->getAll()->result();
                $data['tagihan'] = $this->tagihan_model->getSemua()->result();
                $data['pembayaran'] = $this->pembayaran_model->getAll()->result();
            }else{
                $data['pembayaran'] = $this->pembayaran_model->getFilter($_GET['bulan'],$_GET['tahun'])->result();
                $data['pelanggan'] = $this->pelanggan_model->getAll()->result();
                $data['tagihan'] = $this->tagihan_model->getSemua()->result();
            }
        }
        $this->load->view('template/header');
        $this->load->view('template/sider');
        $this->load->view('template/navbar');
        $this->load->view('admin/laporan',$data);
        $this->load->view('template/footer');
    }

    public function printPDFFilter($bulan,$tahun)
	{
        $this->load->model('tagihan_model');
        $this->load->model('pelanggan_model');
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        if ($bulan == "Semua" && $tahun == "Semua") {
            $data['pelanggan'] = $this->pelanggan_model->getAll()->result();
            $data['tagihan'] = $this->tagihan_model->getSemua()->result();
            $data['pembayaran'] = $this->pembayaran_model->getAll()->result();
        }else{
            $data['pembayaran'] = $this->pembayaran_model->getFilter($bulan,$tahun)->result();
            $data['pelanggan'] = $this->pelanggan_model->getAll()->result();
            $data['tagihan'] = $this->tagihan_model->getSemua()->result();
        }
		$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
		$data = $this->load->view('admin/printPembayaran',$data, TRUE);
		$mpdf->WriteHTML($data);
		$mpdf->Output('laporan.pdf','I');
	}
    
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
            $tglSekarang = date('d');
            if ($tglSekarang > $golongan->tempo) {
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
                    'konidisi' => 1,
                    'tagihan_id' => $tagihan->id,
                    'pelanggan_id' => $pelanggan->id,
                    'no_rekening' => $pelanggan->no_rekening,
                    'nama' => $pelanggan->nama,
                    'alamat' => $pelanggan->alamat,
                    'no_hp' => $pelanggan->no_hp,
                    'periode' => $tagihan->periode,
                    'total' => $tagihan->total,
                    'denda' => 0
                );
            }
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
