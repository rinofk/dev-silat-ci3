<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laboran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Labkedokteran_model');
        $this->load->model('Labkeperawatan_model');
        $this->load->model('Labfarmasi_model');

        $this->load->library('pdf');

    }
    public function kedokteran()
    {

        $tahun = $this->input->get('tahun', true) ?? date('Y'); // default ke tahun sekarang
        $status = $this->input->get('status', true) ?? 'diajukan'; // default status

        // Ambil data dari model
        $data['total'] = $this->Labkedokteran_model->count_by_filter($tahun, null);
        $data['total_diajukan'] = $this->Labkedokteran_model->count_by_filter($tahun, 'di ajukan');
        $data['total_proses'] = $this->Labkedokteran_model->count_by_filter($tahun, 'proses');
        $data['total_reject'] = $this->Labkedokteran_model->count_by_filter($tahun, 'reject');
        $data['total_terima'] = $this->Labkedokteran_model->count_by_filter($tahun, 'accept');

        $data['filter_tahun'] = $this->Labkedokteran_model->get_tahun_options();
        $data['filter_status'] = ['di ajukan', 'proses', 'reject', 'accept'];

        $data['bebaslab'] = $this->Labkedokteran_model->get_AllKedokteran($tahun, $status);
    
        $data['title'] = 'Lab Kedokteran';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $data['status'] = $this->Labkedokteran_model->get_statusaccept1();
        $data['bl'] = $this->Labkedokteran_model->get_AllKedokteran($tahun, $status);
        // $data['total_surat'] = $this->Labkedokteran_model->hitungJumlahSurat1();
        // $data['total_diajukan'] = $this->Labkedokteran_model->hitungJumlahdiAjukan1();
        // $data['total_proses'] = $this->Labkedokteran_model->hitungJumlahdiProses1();
        // $data['total_selesai'] = $this->Labkedokteran_model->hitungJumlahdiSelesai1();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('labkedokteran/index', $data);
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
    public function kedokterandetail($id_bebaslab)
    {
        $data['title'] = 'Bebas Lab Prodi Kedokteran';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bl'] = $this->Labkedokteran_model->get_Idbp($id_bebaslab);


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('labkedokteran/detail', $data);
        $this->load->view('templates/footer_a');
    }
    public function kedokteranaccept($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->accept_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di Update');
        redirect('laboran/kedokterandetail/' . $id_bebaslab);
    }
    public function kedokteranreject($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->reject_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di REJECT');
        redirect('laboran/kedokteran');
    }
    public function kedokteranproses($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->proses_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di Proses');
        redirect('laboran/kedokterandetail/' . $id_bebaslab);
    }
    public function farmasiproses($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->proses_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di Proses');
        redirect('laboran/farmasidetail/' . $id_bebaslab);
    }
    public function keperawatanproses($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->proses_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di Proses');
        redirect('laboran/keperawatandetail/' . $id_bebaslab);
    }
        public function nersproses($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->proses_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di Proses');
        redirect('laboran/keperawatandetail/' . $id_bebaslab);
    }
    public function kedokterancetak($id_bebaslab)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['bp'] = $this->Labkedokteran_model->get_Idbp($id_bebaslab);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '6'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bebaslab/cetak1', $data);
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }
    // FARMASI ========================================
    public function farmasi()
    {

        
        $data['title'] = 'Lab Farmasi';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // Filter
        $tahun  = $this->input->get('tahun', true) ?? date('Y'); 
        $status = $this->input->get('status', true) ?? 'di ajukan'; 

        // Statistik card
        $data['total']         = $this->Labfarmasi_model->count_by_filter($tahun, null);
        $data['total_diajukan'] = $this->Labfarmasi_model->count_by_filter($tahun, 'di ajukan');
        $data['total_proses']   = $this->Labfarmasi_model->count_by_filter($tahun, 'proses');
        $data['total_reject']   = $this->Labfarmasi_model->count_by_filter($tahun, 'reject');
        $data['total_selesai']  = $this->Labfarmasi_model->count_by_filter($tahun, 'accept');

        // Dropdown filter
        $data['filter_tahun']  = $this->Labfarmasi_model->get_tahun_options();
        $data['filter_status'] = ['di ajukan', 'proses', 'reject', 'accept'];

         // Data utama
        $data['bebaslab'] = $this->Labfarmasi_model->get_filtered_data($tahun, $status);
        $data['bl']       = $this->Labfarmasi_model->get_filtered_data($tahun, $status);

        // $data['wisuda'] = $this->db->get()->result_array();
  //      $data['status'] = $this->Labkedokteran_model->get_statusaccept2();
  //      $data['bl'] = $this->Labkedokteran_model->get_AllFarmasi();
  //      $data['total_surat'] = $this->Labkedokteran_model->hitungJumlahSurat2();
  //      $data['total_diajukan'] = $this->Labkedokteran_model->hitungJumlahdiAjukan2();
  //      $data['total_proses'] = $this->Labkedokteran_model->hitungJumlahdiProses2();
//        $data['total_selesai'] = $this->Labkedokteran_model->hitungJumlahdiSelesai2();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('labfarmasi/index', $data);
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
    public function farmasidetail($id_bebaslab)
    {
        $data['title'] = 'Bebas Lab Prodi Farmasi';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bl'] = $this->Labkedokteran_model->get_Idbp($id_bebaslab);


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('labfarmasi/detail', $data);
        $this->load->view('templates/footer_a');
    }
    public function farmasiaccept($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->accept_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di Update');
        redirect('laboran/farmasidetail/' . $id_bebaslab);
    }
    public function farmasireject($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->reject_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di REJECT');
        redirect('laboran/farmasi');
    }
    public function farmasicetak($id_bebaslab)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['bp'] = $this->Labkedokteran_model->get_Idbp($id_bebaslab);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '6'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bebaslab/cetak2', $data);
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('laboran/farmasi');
        }
    }

    // KEPERAWATAN ========================================
    public function keperawatan()
    {
        $data['title'] = 'Lab Keperawatan23';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

         $tahun = $this->input->get('tahun', true) ?? date('Y'); // default ke tahun sekarang
        $status = $this->input->get('status', true) ?? 'diajukan'; // default status

        // Ambil data dari model
        $data['total'] = $this->Labkeperawatan_model->count_by_filter($tahun, null);
        $data['total_diajukan'] = $this->Labkeperawatan_model->count_by_filter($tahun, 'di ajukan');
        $data['total_proses'] = $this->Labkeperawatan_model->count_by_filter($tahun, 'proses');
        $data['total_reject'] = $this->Labkeperawatan_model->count_by_filter($tahun, 'reject');
        $data['total_selesai'] = $this->Labkeperawatan_model->count_by_filter($tahun, 'accept');

        $data['filter_tahun'] = $this->Labkeperawatan_model->get_tahun_options();
        $data['filter_status'] = ['di ajukan', 'proses', 'reject', 'accept'];

        $data['bebaslab'] = $this->Labkeperawatan_model->get_filtered_data($tahun, $status);
        $data['bl'] = $this->Labkeperawatan_model->get_filtered_data($tahun, $status);


        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('labkeperawatan/index', $data);
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
    public function keperawatandetail($id_bebaslab)
    {
        $data['title'] = 'Bebas Lab Prodi Keperawatan';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bl'] = $this->Labkedokteran_model->get_Idbp($id_bebaslab);


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('labkeperawatan/detail', $data);
        $this->load->view('templates/footer_a');
    }
    public function keperawatanaccept($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->accept_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di Update');
        redirect('laboran/keperawatandetail/' . $id_bebaslab);
    }
    public function keperawatanreject($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->reject_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di REJECT');
        redirect('laboran/keperawatan');
    }
    public function keperawatancetak($id_bebaslab)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['bp'] = $this->Labkedokteran_model->get_Idbp($id_bebaslab);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '6'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bebaslab/cetak3', $data);
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }
    
    
    // NERS ========================================
    public function ners()
    {
        $data['title'] = 'Lab Ners';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // $data['wisuda'] = $this->db->get()->result_array();
        $data['status'] = $this->Labkedokteran_model->get_statusaccept4();
        $data['bl'] = $this->Labkedokteran_model->get_AllNers();
        $data['total_surat'] = $this->Labkedokteran_model->hitungJumlahSurat3();
        $data['total_diajukan'] = $this->Labkedokteran_model->hitungJumlahdiAjukan3();
        $data['total_proses'] = $this->Labkedokteran_model->hitungJumlahdiProses3();
        $data['total_selesai'] = $this->Labkedokteran_model->hitungJumlahdiSelesai3();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('labners/index', $data);
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
    public function nersdetail($id_bebaslab)
    {
        $data['title'] = 'Bebas Lab Prodi Ners';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bl'] = $this->Labkedokteran_model->get_Idbp($id_bebaslab);


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('labners/detail', $data);
        $this->load->view('templates/footer_a');
    }
    public function nersaccept($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->accept_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di Update');
        redirect('laboran/nersdetail/' . $id_bebaslab);
    }
    public function nersreject($id_bebaslab)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Labkedokteran_model->reject_Idbp($id_bebaslab);
        $this->session->set_flashdata('flash', 'di REJECT');
        redirect('laboran/ners');
    }
    public function nerscetak($id_bebaslab)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['bp'] = $this->Labkedokteran_model->get_Idbp($id_bebaslab);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '6'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bebaslab/cetak4', $data);
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }
    
    public function hapus_ners($id_bebaslab){
        
         $data['tanggal'] = tanggal();
         $data['judul'] = 'Hapus Data Mahasiswa';
         $data['surat'] = $this->Labkedokteran_model->getBebasLabById($id_bebaslab);
        
         $this->db->where('id_bebaslab', $id_bebaslab);
         $this->db->delete('tb_bebaslab');
         
        $this->session->set_flashdata('flash', 'di HAPUS');
        redirect('laboran/ners');
    }

         public function hapus_keperawatan($id_bebaslab){
        
         $data['tanggal'] = tanggal();
         $data['judul'] = 'Hapus Data Mahasiswa';
         $data['surat'] = $this->Labkedokteran_model->getBebasLabById($id_bebaslab);
        
         $this->db->where('id_bebaslab', $id_bebaslab);
         $this->db->delete('tb_bebaslab');
         
        $this->session->set_flashdata('flash', 'di HAPUS');
        redirect('laboran/keperawatan');
    }

     public function hapus_dokter($id_bebaslab){
        
         $data['tanggal'] = tanggal();
         $data['judul'] = 'Hapus Data Mahasiswa';
         $data['surat'] = $this->Labkedokteran_model->getBebasLabById($id_bebaslab);
        
         $this->db->where('id_bebaslab', $id_bebaslab);
         $this->db->delete('tb_bebaslab');
         
        $this->session->set_flashdata('flash', 'di HAPUS');
        redirect('laboran/kedokteran');
    }
     public function hapus_farmasi($id_bebaslab){
        
         $data['tanggal'] = tanggal();
         $data['judul'] = 'Hapus Data Mahasiswa';
         $data['surat'] = $this->Labkedokteran_model->getBebasLabById($id_bebaslab);
        
         $this->db->where('id_bebaslab', $id_bebaslab);
         $this->db->delete('tb_bebaslab');
         
        $this->session->set_flashdata('flash', 'di HAPUS');
        redirect('laboran/farmasi');
    }
    
}
