<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminwisuda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Wisuda_model');
    }
    public function index()
    {
        $data['title'] = 'Berkas Wisuda Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // $data['wisuda'] = $this->db->get()->result_array();
        $data['status'] = $this->Wisuda_model->get_statusaccept();
        $data['wisuda'] = $this->Wisuda_model->get_All();
        $data['total_surat'] = $this->Wisuda_model->hitungJumlahSurat();
        $data['total_diajukan'] = $this->Wisuda_model->hitungJumlahdiAjukan();
        $data['total_proses'] = $this->Wisuda_model->hitungJumlahdiProses();
        $data['total_selesai'] = $this->Wisuda_model->hitungJumlahdiSelesai();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('adminwisuda/index', $data);
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
    public function detail($id_bw)
    {
        $data['title'] = 'Berkas Wisuda Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['wisuda'] = $this->Wisuda_model->get_Idbw($id_bw);


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminwisuda/detail', $data);
        $this->load->view('templates/footer_a');
    }
    public function accept($id_bw)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Wisuda_model->accept_Idbw($id_bw);
        $this->session->set_flashdata('flash', 'di TERIMA');
        redirect('adminwisuda/detail/' . $id_bw);
    }
    public function reject($id_bw)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Wisuda_model->reject_Idbw($id_bw);
        $this->session->set_flashdata('flash', 'di REJECT');
        redirect('adminwisuda/detail/' . $id_bw);
    }
}
