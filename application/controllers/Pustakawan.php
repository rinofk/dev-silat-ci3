<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pustakawan extends CI_Controller
{
    private $status_badge = [
        'di ajukan' => 'warning',
        'accept'   => 'success',
        'reject'   => 'danger'
    ];

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Pustakawan_model');
        $this->load->library('pdf');
    }


    public function index()
    {
        $data['title'] = 'Bebas Perpustakaan';
        $data['user']  = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // Ambil filter dari URL
        $tahun  = $this->input->get('tahun', true) ?? date('Y');
        $status = $this->input->get('status', true);

        // Hitungan untuk card dashboard
        $data['count_diajukan'] = $this->Pustakawan_model->count_by_filter($tahun, 'di ajukan');
        $data['count_accept']   = $this->Pustakawan_model->count_by_filter($tahun, 'accept');
        $data['count_reject']   = $this->Pustakawan_model->count_by_filter($tahun, 'reject');
        $data['count_total']    = $this->Pustakawan_model->count_by_filter($tahun, null);

        // Data untuk filter dropdown
        $data['filter_tahun']  = $this->Pustakawan_model->get_tahun_options();
        $data['filter_status'] = array_keys($this->status_badge);

        // Data utama
        $data['perpus'] = $this->Pustakawan_model->get_filtered_data($tahun, $status);
        $data['status_badge'] = $this->status_badge;

        $this->load_view_template('pustakawan/index', $data);
    }

    public function detail($id_bp)
    {
        $data['title']  = 'Detail Bebas Perpustakaan';
        $data['user']   = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['perpus'] = $this->Pustakawan_model->get_Idbp($id_bp);

        $this->load_view_template('pustakawan/detail', $data);
    }

    public function accept($id_bp)
    {
        $this->Pustakawan_model->accept_Idbp($id_bp);
        $this->session->set_flashdata('flash', 'diterima');
        redirect('pustakawan');
    }

    public function reject($id_bp)
    {
        $this->Pustakawan_model->reject_Idbp($id_bp);
        $this->session->set_flashdata('flash', 'ditolak');
        redirect('pustakawan');
    }

    public function tanggal($id_bp)
    {
        $this->Pustakawan_model->tanggal_Idbp($id_bp);
        $this->session->set_flashdata('flash', 'diupdate');
        redirect('pustakawan');
    }

    public function cetak($id_bp)
    {
        $data['tanggal'] = tanggal();
        $data['judul']   = 'PDF Data Mahasiswa';
        $data['bp']      = $this->Pustakawan_model->get_Idbp($id_bp);
        $data['kop']     = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor']   = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '5'])->row_array();

        $this->load->view('bebasperpus/cetak', $data);
    }

    public function hapus($id_bp)
    {
        $this->db->where('id_bp', $id_bp)->delete('tb_bebasperpus');
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('pustakawan');
    }

    /*** Fungsi helper untuk load template ***/
    private function load_view_template($view, $data)
    {
        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/footer_a');
    }
}
