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

        // Statistik layanan selesai per tahun
        $data['statistik_layanan'] = $this->db->query("
            SELECT 
                tahun,
                SUM(CASE WHEN tipe = 'aktif_kuliah' THEN jumlah ELSE 0 END) AS aktif_kuliah,
                SUM(CASE WHEN tipe = 'bebas_perpus' THEN jumlah ELSE 0 END) AS bebas_perpus,
                SUM(CASE WHEN tipe = 'skl_yudisium' THEN jumlah ELSE 0 END) AS skl_yudisium,
                SUM(CASE WHEN tipe = 'skl' THEN jumlah ELSE 0 END) AS skl,
                SUM(CASE WHEN tipe = 'bebas_lab_kedokteran' THEN jumlah ELSE 0 END) AS bebas_lab_kedokteran,
                SUM(CASE WHEN tipe = 'bebas_lab_farmasi' THEN jumlah ELSE 0 END) AS bebas_lab_farmasi,
                SUM(CASE WHEN tipe = 'bebas_lab_keperawatan' THEN jumlah ELSE 0 END) AS bebas_lab_keperawatan,
                SUM(CASE WHEN tipe = 'bebas_lab_ners' THEN jumlah ELSE 0 END) AS bebas_lab_ners,
                SUM(CASE WHEN tipe = 'bebas_lab_dokter' THEN jumlah ELSE 0 END) AS bebas_lab_dokter,
                SUM(CASE WHEN tipe = 'bebas_lab_apoteker' THEN jumlah ELSE 0 END) AS bebas_lab_apoteker
            FROM (
                SELECT YEAR(FROM_UNIXTIME(date_finish)) AS tahun, 'aktif_kuliah' AS tipe, COUNT(*) AS jumlah
                FROM tb_suratpengajuan
                WHERE status = 'selesai' AND date_finish > 0
                GROUP BY tahun
                
                UNION ALL
                
                SELECT YEAR(l.date_finished) AS tahun,
                       CASE 
                           WHEN m.prodi_id = 1 THEN 'bebas_lab_kedokteran'
                           WHEN m.prodi_id = 3 THEN 'bebas_lab_keperawatan'
                           WHEN m.prodi_id = 2 THEN 'bebas_lab_farmasi'
                           WHEN m.prodi_id = 5 THEN 'bebas_lab_ners'
                           WHEN m.prodi_id = 6 THEN 'bebas_lab_dokter'
                           WHEN m.prodi_id = 4 THEN 'bebas_lab_apoteker'
                           ELSE 'bebas_lab_lain'
                       END AS tipe,
                       COUNT(*) AS jumlah
                FROM tb_bebaslab l
                JOIN mahasiswa m ON l.nim_mahasiswa = m.nim
                WHERE l.status = 'accept' AND l.date_finished IS NOT NULL
                GROUP BY tahun, tipe
                
                UNION ALL
                
                SELECT YEAR(date_finish) AS tahun, 'skl' AS tipe, COUNT(*) AS jumlah
                FROM tb_skl
                WHERE jenis_skl = 2 AND status = 'selesai' AND date_finish IS NOT NULL
                GROUP BY tahun
                
                UNION ALL
                
                SELECT YEAR(date_finish) AS tahun, 'skl_yudisium' AS tipe, COUNT(*) AS jumlah
                FROM tb_skl
                WHERE jenis_skl = 1 AND status = 'selesai' AND date_finish IS NOT NULL
                GROUP BY tahun
                
                UNION ALL
                
                SELECT YEAR(date_updated) AS tahun, 'bebas_perpus' AS tipe, COUNT(*) AS jumlah
                FROM tb_bebasperpus
                WHERE status = 'accept' AND date_updated IS NOT NULL
                GROUP BY tahun
            ) AS combined
            WHERE tahun IS NOT NULL
            GROUP BY tahun
            ORDER BY tahun DESC
        ")->result_array();
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
        $data['visitors'] = $this->Visitor_model->get_visitors_with_letters_by_date($date);
        $data['selected_date'] = $date;

        $this->load->view('operator/modal_visitors', $data);
    }
}
