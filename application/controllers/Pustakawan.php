<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pustakawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Pustakawan_model');
        $this->load->library('pdf');
    }
    public function index()
    {
        $data['title'] = 'Berkas Wisuda Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // $data['wisuda'] = $this->db->get()->result_array();
        $data['status'] = $this->Pustakawan_model->get_statusaccept();
        $data['perpus'] = $this->Pustakawan_model->get_All();
        $data['total_surat'] = $this->Pustakawan_model->hitungJumlahSurat();
        $data['total_diajukan'] = $this->Pustakawan_model->hitungJumlahdiAjukan();
        $data['total_proses'] = $this->Pustakawan_model->hitungJumlahdiProses();
        $data['total_selesai'] = $this->Pustakawan_model->hitungJumlahdiSelesai();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pustakawan/index', $data);
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
    public function detail($id_bp)
    {
        $data['title'] = 'Berkas Wisuda Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['perpus'] = $this->Pustakawan_model->get_Idbp($id_bp);


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pustakawan/detail', $data);
        $this->load->view('templates/footer_a');
    }
    public function accept($id_bp)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Pustakawan_model->accept_Idbp($id_bp);
        $this->session->set_flashdata('flash', 'di TERIMA');
        redirect('pustakawan');
    }
    public function reject($id_bp)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Pustakawan_model->reject_Idbp($id_bp);
        $this->session->set_flashdata('flash', 'di REJECT');
        redirect('pustakawan');
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
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
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
    public function hapus($id_bp){
        
         $data['tanggal'] = tanggal();
         $data['judul'] = 'Hapus Data Mahasiswa';
        //  $data['surat'] = $this->Labkedokteran_model->getBebasLabById($id_bebaslab);
        
         $this->db->where('id_bp', $id_bp);
         $this->db->delete('tb_bebasperpus');
         
        $this->session->set_flashdata('flash', 'di HAPUS');
        redirect('pustakawan');
    }
}
