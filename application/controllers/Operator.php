<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // is_logged_in();  saya ganti menjadi cek_login();
        cek_login();
    }


    public function index()
    {
        $data['title'] = 'Dashboard Operator';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $this->load->model('Visitor_model');

        // ambil data visitor per hari
        $visitors = $this->Visitor_model->get_visitors_per_day();
        // $visitors = $this->Visitor_model->get_visitors_by_date($date);

        // siapkan data untuk chart
        $labels = [];
        $totals = [];
        foreach ($visitors as $row) {
            $labels[] = $row->visit_date;
            $totals[] = $row->total;
        }

        $data['labels'] = json_encode($labels);
        $data['totals'] = json_encode($totals);
        $data['visitors'] = $visitors; // untuk tabel

        $data['visitor_logs'] = $this->Visitor_model->get_all();

        // $data['visitordate']   = $this->Visitor_model->get_visitors_by_date($date);
        $data['total_visitors']   = $this->Visitor_model->count_all();
        $data['today_visitors']   = $this->Visitor_model->count_today();
        $data['unique_visitors']  = $this->Visitor_model->count_unique_nim();
        $data['daily_stats']      = $this->Visitor_model->daily_stats(14); // 2 minggu terakhir

        // Statistik per prodi
        $data['statistik_prodi'] = $this->Visitor_model->get_statistik_per_prodi();
        // echo 'Selamat Datang User ' . $data['user']['name'];
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operator/index', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('admin/role');
        }
    }

    public function get_visitors_by_date($date)
    {
        $this->load->model('Visitor_model');
        $data['visitors'] = $this->Visitor_model->get_by_date($date);

        $this->load->view('operator/modal_visitors', $data);
    }
}
