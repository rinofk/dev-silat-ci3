<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistikreset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // PROTEKSI ADMIN
        if (!$this->session->userdata('role_id') || $this->session->userdata('role_id') != 1) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $data['title'] = 'Statistik Reset Akun';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // DEFAULT RANGE (HARI INI)
        $start = $this->input->get('start_date') ?? date('Y-m-d');
        $end   = $this->input->get('end_date') ?? date('Y-m-d');

        $data['start_date'] = $start;
        $data['end_date']   = $end;


        // DATA GRAFIK RESET PER HARI
        $chart = $this->db->query("
            SELECT 
                DATE(created_at) AS tanggal,
                COUNT(*) AS total,
                SUM(status = 'success') AS success,
                SUM(status = 'failed') AS failed
            FROM reset_account_log
            WHERE DATE(created_at) BETWEEN '$start' AND '$end'
            GROUP BY DATE(created_at)
            ORDER BY tanggal ASC
        ")->result();

        // SIAPKAN ARRAY UNTUK CHART.JS
        $data['chart_labels']  = [];
        $data['chart_total']   = [];
        $data['chart_success'] = [];
        $data['chart_failed']  = [];

        foreach ($chart as $row) {
            $data['chart_labels'][]  = date('d M', strtotime($row->tanggal));
            $data['chart_total'][]   = (int) $row->total;
            $data['chart_success'][] = (int) $row->success;
            $data['chart_failed'][]  = (int) $row->failed;
        }

        // TOTAL RESET
        $data['total'] = $this->db
            ->where('DATE(created_at) >=', $start)
            ->where('DATE(created_at) <=', $end)
            ->count_all_results('reset_account_log');

        // BERHASIL
        $data['success'] = $this->db
            ->where('status', 'success')
            ->where('DATE(created_at) >=', $start)
            ->where('DATE(created_at) <=', $end)
            ->count_all_results('reset_account_log');

        // GAGAL
        $data['failed'] = $this->db
            ->where('status', 'failed')
            ->where('DATE(created_at) >=', $start)
            ->where('DATE(created_at) <=', $end)
            ->count_all_results('reset_account_log');

        // TOP NIM
        $data['top_nim'] = $this->db->query("
            SELECT nim, COUNT(*) total
            FROM reset_account_log
            WHERE DATE(created_at) BETWEEN '$start' AND '$end'
            GROUP BY nim
            ORDER BY total DESC
            LIMIT 5
        ")->result();

        // LOG
        $data['logs'] = $this->db
            ->where('DATE(created_at) >=', $start)
            ->where('DATE(created_at) <=', $end)
            ->order_by('created_at', 'DESC')
            ->limit(100)
            ->get('reset_account_log')
            ->result();

        $data['suspicious'] = $this->db->query("
            SELECT nim, ip_address, COUNT(*) total
            FROM reset_account_log
            WHERE status = 'failed'
            AND DATE(created_at) BETWEEN '$start' AND '$end'
            GROUP BY nim, ip_address
            HAVING total >= 3")->result();


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/statistik_reset', $data);
        $this->load->view('templates/footer_a');
    }
}
