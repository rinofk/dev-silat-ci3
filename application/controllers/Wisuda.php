<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisuda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    public function index()
    {
        $data['title'] = 'Berkas Wisuda';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['wisuda'] = $this->db->get_where('tb_berkaswisuda', ['nim_bw' => $this->session->userdata('nim')])->row_array();

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('wisuda/index', $data);
        $this->load->view('templates/footer_a');
    }

    public function do_upload()
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['wisuda'] = $this->db->get_where('tb_berkaswisuda', ['nim_bw' => $this->session->userdata('nim')])->row_array();

        $nim = $this->input->post('nim');
        //cek jika ada gambar yang akan di upload
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/berkaswisuda/';
        $this->load->library('upload', $config);

        $upload_kwitansi = $_FILES['kwitansi']['name'];
        if ($upload_kwitansi) {
            $old_image = $data['wisuda']['kwitansi'];
            if ($old_image != 'default.jpg') {
                unlink(FCPATH . 'assets/berkaswisuda/' . $old_image);
            }
            if ($this->upload->do_upload('kwitansi')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('kwitansi', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_biodata = $_FILES['biodata']['name'];
        if ($upload_biodata) {
            $old_biodata = $data['wisuda']['biodata'];
            if ($old_biodata != 'default.jpg') {
                unlink(FCPATH . 'assets/berkaswisuda/' . $old_biodata);
            }
            if ($this->upload->do_upload('biodata')) {
                $new_biodata = $this->upload->data('file_name');
                $this->db->set('biodata', $new_biodata);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->where('nim_bw', $nim);
        $this->db->set('nim_bw', $nim);
        $this->db->update('tb_berkaswisuda');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di UPDATE</div>');
        redirect('wisuda');
    }
}
