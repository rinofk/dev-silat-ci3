<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Arsip_model');
        $this->load->library('pdf');
    }
    public function yudisium()
    {
        $data['title'] = 'Admin Arsip Yudisium';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // $data['wisuda'] = $this->db->get()->result_array();
        // $data['status'] = $this->Pustakawan_model->get_statusaccept();
        $data['ay'] = $this->Arsip_model->get_All();
        $data['yl'] = $this->Arsip_model->get_YLengkap();
    
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('arsip/yudisium', $data);
            $this->load->view('templates/footer_a');
        } else {
            $keterangan = $this->input->post('keterangan', true);
            $this->db->set('keterangan', $keterangan);
            $this->db->set('status', 'reject');
            $this->db->where('id_bw', $this->input->post('id_bw'));
            $this->db->update('tb_berkaswisuda');
            // $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('adminwisuda/detail');
        }
    } 
    public function yudisiumdetail($nim_mahasiswa)
    {
        $data['title'] = 'Berkas Wisuda Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['ydetail'] = $this->Arsip_model->get_nimmahasiswa($nim_mahasiswa);


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('arsip/detail', $data);
        $this->load->view('templates/footer_a');
    }

    public function yudisiumperiodedetail($id_periode)
    {
        $data['title'] = 'Daftar Yudisium Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['ypdetail'] = $this->Arsip_model->get_YudisiumPeriodeDetail($id_periode);
        $data['detail'] = $this->db->get_where('a_periode', ['id_periode' => $id_periode])->row_array();


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('arsip/periodedetail', $data);
        $this->load->view('templates/footer_a');
    }

    public function accept($nim_mahasiswa)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Arsip_model->accept_Idbp($nim_mahasiswa);
        $this->session->set_flashdata('flash', 'di TERIMA status Lengkap');
        redirect('arsip/yudisium');
    }
    public function reject($nim_mahasiswa)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Arsip_model->reject_Idbp($nim_mahasiswa);
        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('arsip/yudisium');
    }
    public function tanggal($id_bp)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Pustakawan_model->tanggal_Idbp($id_bp);
        $this->session->set_flashdata('flash', 'di UPDATE');
        redirect('pustakawan');
    }
    
    public function cetak($id_bp)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['bp'] = $this->Pustakawan_model->get_Idbp($id_bp);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '1'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '5'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bebasperpus/cetak', $data);
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }

    public function periodeyudisium()
    {
        $data['title'] = 'Admin Arsip Yudisium';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // $data['wisuda'] = $this->db->get()->result_array();
        // $data['status'] = $this->Pustakawan_model->get_statusaccept();
        $data['periode'] = $this->Arsip_model->get_Periode();
        $data['yl'] = $this->Arsip_model->get_YLengkap();
    
        $this->form_validation->set_rules('nama_periode', 'Nama Periode', 'required');
        // $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        // $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required');
        // $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('arsip/periodeyudisium', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('a_periode', ['nama_periode' => $this->input->post('nama_periode'), 'tgl_mulai' => $this->input->post('tgl_mulai'),'tgl_selesai' => $this->input->post('tgl_selesai'), 'status_periode' => $this->input->post('status_periode'), 'admin' => $this->session->userdata('name')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Periode Tersimpan</div>');
            redirect('arsip/periodeyudisium');
        }
    } 

    public function updateyudisium()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $status = 'Selesai';
        $data = [
            'nama_periode' => $this->input->post('nama_periode'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'tgl_selesai' => $this->input->post('tgl_selesai'),
            'status_periode' => $this->input->post('status_periode'),
            'admin' => $this->session->userdata('name'),
            'date_update' => $date
        ];
        $this->db->where('id_periode', $this->input->post('id_periode'));
        $this->db->update('a_periode', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('arsip/periodeyudisium');
    }
}
