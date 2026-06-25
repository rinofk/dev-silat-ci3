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

    public function detail_layanan()
    {
        $tahun = $this->input->get('tahun', true);
        $tipe = $this->input->get('tipe', true);

        if (!$tahun || !$tipe) {
            show_404();
        }

        $data['title'] = 'Detail Laporan Layanan Selesai';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['tahun'] = $tahun;
        $data['tipe'] = $tipe;

        // Map tipe to human readable label
        $tipe_labels = [
            'all' => 'Semua Layanan',
            'aktif_kuliah' => 'Aktif Kuliah',
            'bebas_perpus' => 'Bebas Perpustakaan',
            'skl_yudisium' => 'SKL Yudisium',
            'skl' => 'SKL',
            'bebas_lab_kedokteran' => 'Bebas Lab Kedokteran',
            'bebas_lab_farmasi' => 'Bebas Lab Farmasi',
            'bebas_lab_keperawatan' => 'Bebas Lab Keperawatan',
            'bebas_lab_ners' => 'Bebas Lab Ners',
            'bebas_lab_dokter' => 'Bebas Lab Dokter',
            'bebas_lab_apoteker' => 'Bebas Lab Apoteker'
        ];
        $data['tipe_label'] = isset($tipe_labels[$tipe]) ? $tipe_labels[$tipe] : $tipe;

        $query_info = $this->_get_detail_layanan_query($tahun, $tipe);
        if ($query_info['sql']) {
            $data['detail_data'] = $this->db->query($query_info['sql'], $query_info['params'])->result_array();
        } else {
            $data['detail_data'] = [];
        }

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operator/detail_layanan', $data);
        $this->load->view('templates/footer_a');
    }

    public function export_layanan_pdf()
    {
        $tahun = $this->input->get('tahun', true);
        $tipe = $this->input->get('tipe', true);

        if (!$tahun || !$tipe) {
            show_404();
        }

        $query_info = $this->_get_detail_layanan_query($tahun, $tipe);
        if ($query_info['sql']) {
            $detail_data = $this->db->query($query_info['sql'], $query_info['params'])->result_array();
        } else {
            $detail_data = [];
        }

        // Map tipe to human readable label
        $tipe_labels = [
            'all' => 'Semua Layanan',
            'aktif_kuliah' => 'Aktif Kuliah',
            'bebas_perpus' => 'Bebas Perpustakaan',
            'skl_yudisium' => 'SKL Yudisium',
            'skl' => 'SKL',
            'bebas_lab_kedokteran' => 'Bebas Lab Kedokteran',
            'bebas_lab_farmasi' => 'Bebas Lab Farmasi',
            'bebas_lab_keperawatan' => 'Bebas Lab Keperawatan',
            'bebas_lab_ners' => 'Bebas Lab Ners',
            'bebas_lab_dokter' => 'Bebas Lab Dokter',
            'bebas_lab_apoteker' => 'Bebas Lab Apoteker'
        ];
        $tipe_label = isset($tipe_labels[$tipe]) ? $tipe_labels[$tipe] : $tipe;

        // Load mpdf
        require_once FCPATH . 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'P']);
        
        $html = '
        <html>
        <head>
            <style>
                body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 10pt; color: #333; }
                h2 { text-align: center; margin-bottom: 5px; font-weight: bold; color: #0284c7; }
                p.subtitle { text-align: center; margin-top: 0; font-size: 11pt; color: #64748b; margin-bottom: 25px; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                th { background-color: #f8fafc; color: #475569; font-weight: bold; border: 1px solid #cbd5e1; padding: 10px 8px; text-transform: uppercase; font-size: 8pt; }
                td { border: 1px solid #cbd5e1; padding: 8px; font-size: 9pt; }
                tr:nth-child(even) { background-color: #f8fafc; }
                .text-center { text-align: center; }
            </style>
        </head>
        <body>
            <h2>Laporan Layanan ' . $tipe_label . ' Tahun ' . $tahun . '</h2>
            <p class="subtitle">Fakultas Kedokteran Universitas Tanjungpura</p>
            <table>
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th width="15%">NIM</th>
                        <th width="27%">Nama Mahasiswa</th>
                        <th width="20%">Tipe Layanan</th>
                        <th width="15%">Nomor Surat</th>
                        <th width="15%">Tanggal</th>
                    </tr>
                </thead>
                <tbody>';

        if (!empty($detail_data)) {
            $no = 1;
            foreach ($detail_data as $row) {
                $nomor_surat = (!empty($row['nomor_surat']) && $row['nomor_surat'] !== '-') ? $row['nomor_surat'] : '-';
                $tanggal_formatted = !empty($row['tanggal']) ? date('d-m-Y', strtotime($row['tanggal'])) : '-';
                $html .= '
                    <tr>
                        <td class="text-center">' . $no++ . '</td>
                        <td class="text-center">' . htmlspecialchars($row['nim']) . '</td>
                        <td>' . htmlspecialchars($row['nama']) . '</td>
                        <td>' . htmlspecialchars($row['tipe_layanan']) . '</td>
                        <td class="text-center">' . htmlspecialchars($nomor_surat) . '</td>
                        <td class="text-center">' . htmlspecialchars($tanggal_formatted) . '</td>
                    </tr>';
            }
        } else {
            $html .= '<tr><td colspan="6" class="text-center">Tidak ada data ditemukan</td></tr>';
        }

        $html .= '
                </tbody>
            </table>
        </body>
        </html>';

        $mpdf->WriteHTML($html);
        $filename = 'Detail_Laporan_Layanan_' . str_replace(' ', '_', $tipe_label) . '_' . $tahun . '.pdf';
        $mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function export_layanan_xlsx()
    {
        $tahun = $this->input->get('tahun', true);
        $tipe = $this->input->get('tipe', true);

        if (!$tahun || !$tipe) {
            show_404();
        }

        $query_info = $this->_get_detail_layanan_query($tahun, $tipe);
        if ($query_info['sql']) {
            $detail_data = $this->db->query($query_info['sql'], $query_info['params'])->result_array();
        } else {
            $detail_data = [];
        }

        // Map tipe to human readable label
        $tipe_labels = [
            'all' => 'Semua Layanan',
            'aktif_kuliah' => 'Aktif Kuliah',
            'bebas_perpus' => 'Bebas Perpustakaan',
            'skl_yudisium' => 'SKL Yudisium',
            'skl' => 'SKL',
            'bebas_lab_kedokteran' => 'Bebas Lab Kedokteran',
            'bebas_lab_farmasi' => 'Bebas Lab Farmasi',
            'bebas_lab_keperawatan' => 'Bebas Lab Keperawatan',
            'bebas_lab_ners' => 'Bebas Lab Ners',
            'bebas_lab_dokter' => 'Bebas Lab Dokter',
            'bebas_lab_apoteker' => 'Bebas Lab Apoteker'
        ];
        $tipe_label = isset($tipe_labels[$tipe]) ? $tipe_labels[$tipe] : $tipe;

        $filename = 'Detail_Laporan_Layanan_' . str_replace(' ', '_', $tipe_label) . '_' . $tahun . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo '<table border="1">';
        echo '<thead>';
        echo '<tr><th colspan="6" style="font-size:14px; font-weight:bold; text-align:center;">Laporan Layanan ' . $tipe_label . ' Tahun ' . $tahun . '</th></tr>';
        echo '<tr><th colspan="6" style="font-size:11px; text-align:center; color:#555; font-weight:normal;">Fakultas Kedokteran Universitas Tanjungpura</th></tr>';
        echo '<tr>';
        echo '<th style="background-color:#0284c7; color:#ffffff; font-weight:bold;">No</th>';
        echo '<th style="background-color:#0284c7; color:#ffffff; font-weight:bold;">NIM</th>';
        echo '<th style="background-color:#0284c7; color:#ffffff; font-weight:bold;">Nama Mahasiswa</th>';
        echo '<th style="background-color:#0284c7; color:#ffffff; font-weight:bold;">Tipe Layanan</th>';
        echo '<th style="background-color:#0284c7; color:#ffffff; font-weight:bold;">Nomor Surat</th>';
        echo '<th style="background-color:#0284c7; color:#ffffff; font-weight:bold;">Tanggal</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        if (!empty($detail_data)) {
            $no = 1;
            foreach ($detail_data as $row) {
                $nomor_surat = (!empty($row['nomor_surat']) && $row['nomor_surat'] !== '-') ? $row['nomor_surat'] : '-';
                $tanggal_formatted = !empty($row['tanggal']) ? date('d-m-Y', strtotime($row['tanggal'])) : '-';
                echo '<tr>';
                echo '<td style="text-align:center;">' . $no++ . '</td>';
                // Force NIM to be treated as text in Excel
                echo '<td style="vnd.ms-excel.numberformat:@; text-align:center;">' . htmlspecialchars($row['nim']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nama']) . '</td>';
                echo '<td>' . htmlspecialchars($row['tipe_layanan']) . '</td>';
                echo '<td style="vnd.ms-excel.numberformat:@; text-align:center;">' . htmlspecialchars($nomor_surat) . '</td>';
                echo '<td style="text-align:center;">' . htmlspecialchars($tanggal_formatted) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6" style="text-align:center;">Tidak ada data ditemukan</td></tr>';
        }

        echo '</tbody>';
        echo '</table>';
    }

    private function _get_detail_layanan_query($tahun, $tipe)
    {
        $queries = [];
        $params = [];

        $tipe_queries = [
            'aktif_kuliah' => "
                SELECT 
                    s.nim_mahasiswa AS nim,
                    m.nama_lengkap AS nama,
                    '-' AS nomor_surat,
                    FROM_UNIXTIME(s.date_finish, '%Y-%m-%d %H:%i:%s') AS tanggal,
                    'Aktif Kuliah' AS tipe_layanan
                FROM tb_suratpengajuan s
                LEFT JOIN mahasiswa m ON s.nim_mahasiswa = m.nim
                WHERE s.status = 'selesai' AND s.date_finish > 0 AND YEAR(FROM_UNIXTIME(s.date_finish)) = ?
            ",
            'bebas_perpus' => "
                SELECT 
                    bp.nim_mahasiswa AS nim,
                    m.nama_lengkap AS nama,
                    CAST(bp.nomor AS CHAR) AS nomor_surat,
                    bp.date_updated AS tanggal,
                    'Bebas Perpustakaan' AS tipe_layanan
                FROM tb_bebasperpus bp
                LEFT JOIN mahasiswa m ON bp.nim_mahasiswa = m.nim
                WHERE bp.status = 'accept' AND bp.date_updated IS NOT NULL AND YEAR(bp.date_updated) = ?
            ",
            'skl_yudisium' => "
                SELECT 
                    sk.nim AS nim,
                    m.nama_lengkap AS nama,
                    '-' AS nomor_surat,
                    sk.date_finish AS tanggal,
                    'SKL Yudisium' AS tipe_layanan
                FROM tb_skl sk
                LEFT JOIN mahasiswa m ON sk.nim = m.nim
                WHERE sk.jenis_skl = 1 AND sk.status = 'selesai' AND sk.date_finish IS NOT NULL AND YEAR(sk.date_finish) = ?
            ",
            'skl' => "
                SELECT 
                    sk.nim AS nim,
                    m.nama_lengkap AS nama,
                    '-' AS nomor_surat,
                    sk.date_finish AS tanggal,
                    'SKL' AS tipe_layanan
                FROM tb_skl sk
                LEFT JOIN mahasiswa m ON sk.nim = m.nim
                WHERE sk.jenis_skl = 2 AND sk.status = 'selesai' AND sk.date_finish IS NOT NULL AND YEAR(sk.date_finish) = ?
            ",
            'bebas_lab_kedokteran' => "
                SELECT 
                    l.nim_mahasiswa AS nim,
                    m.nama_lengkap AS nama,
                    CASE 
                        WHEN l.nomor IS NULL OR l.nomor = '' OR l.nomor = '-' THEN CONCAT(l.id_bebaslab, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        WHEN l.nomor NOT LIKE '%/%' THEN CONCAT(l.nomor, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        ELSE l.nomor 
                    END AS nomor_surat,
                    l.date_finished AS tanggal,
                    'Bebas Lab Kedokteran' AS tipe_layanan
                FROM tb_bebaslab l
                LEFT JOIN mahasiswa m ON l.nim_mahasiswa = m.nim
                WHERE l.status = 'accept' AND l.date_finished IS NOT NULL AND YEAR(l.date_finished) = ? AND m.prodi_id = 1
            ",
            'bebas_lab_farmasi' => "
                SELECT 
                    l.nim_mahasiswa AS nim,
                    m.nama_lengkap AS nama,
                    CASE 
                        WHEN l.nomor IS NULL OR l.nomor = '' OR l.nomor = '-' THEN CONCAT(l.id_bebaslab, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        WHEN l.nomor NOT LIKE '%/%' THEN CONCAT(l.nomor, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        ELSE l.nomor 
                    END AS nomor_surat,
                    l.date_finished AS tanggal,
                    'Bebas Lab Farmasi' AS tipe_layanan
                FROM tb_bebaslab l
                LEFT JOIN mahasiswa m ON l.nim_mahasiswa = m.nim
                WHERE l.status = 'accept' AND l.date_finished IS NOT NULL AND YEAR(l.date_finished) = ? AND m.prodi_id = 2
            ",
            'bebas_lab_keperawatan' => "
                SELECT 
                    l.nim_mahasiswa AS nim,
                    m.nama_lengkap AS nama,
                    CASE 
                        WHEN l.nomor IS NULL OR l.nomor = '' OR l.nomor = '-' THEN CONCAT(l.id_bebaslab, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        WHEN l.nomor NOT LIKE '%/%' THEN CONCAT(l.nomor, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        ELSE l.nomor 
                    END AS nomor_surat,
                    l.date_finished AS tanggal,
                    'Bebas Lab Keperawatan' AS tipe_layanan
                FROM tb_bebaslab l
                LEFT JOIN mahasiswa m ON l.nim_mahasiswa = m.nim
                WHERE l.status = 'accept' AND l.date_finished IS NOT NULL AND YEAR(l.date_finished) = ? AND m.prodi_id = 3
            ",
            'bebas_lab_apoteker' => "
                SELECT 
                    l.nim_mahasiswa AS nim,
                    m.nama_lengkap AS nama,
                    CASE 
                        WHEN l.nomor IS NULL OR l.nomor = '' OR l.nomor = '-' THEN CONCAT(l.id_bebaslab, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        WHEN l.nomor NOT LIKE '%/%' THEN CONCAT(l.nomor, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        ELSE l.nomor 
                    END AS nomor_surat,
                    l.date_finished AS tanggal,
                    'Bebas Lab Apoteker' AS tipe_layanan
                FROM tb_bebaslab l
                LEFT JOIN mahasiswa m ON l.nim_mahasiswa = m.nim
                WHERE l.status = 'accept' AND l.date_finished IS NOT NULL AND YEAR(l.date_finished) = ? AND m.prodi_id = 4
            ",
            'bebas_lab_ners' => "
                SELECT 
                    l.nim_mahasiswa AS nim,
                    m.nama_lengkap AS nama,
                    CASE 
                        WHEN l.nomor IS NULL OR l.nomor = '' OR l.nomor = '-' THEN CONCAT(l.id_bebaslab, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        WHEN l.nomor NOT LIKE '%/%' THEN CONCAT(l.nomor, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        ELSE l.nomor 
                    END AS nomor_surat,
                    l.date_finished AS tanggal,
                    'Bebas Lab Ners' AS tipe_layanan
                FROM tb_bebaslab l
                LEFT JOIN mahasiswa m ON l.nim_mahasiswa = m.nim
                WHERE l.status = 'accept' AND l.date_finished IS NOT NULL AND YEAR(l.date_finished) = ? AND m.prodi_id = 5
            ",
            'bebas_lab_dokter' => "
                SELECT 
                    l.nim_mahasiswa AS nim,
                    m.nama_lengkap AS nama,
                    CASE 
                        WHEN l.nomor IS NULL OR l.nomor = '' OR l.nomor = '-' THEN CONCAT(l.id_bebaslab, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        WHEN l.nomor NOT LIKE '%/%' THEN CONCAT(l.nomor, '/DST/UN22.9/TA.00/', YEAR(l.date_finished))
                        ELSE l.nomor 
                    END AS nomor_surat,
                    l.date_finished AS tanggal,
                    'Bebas Lab Dokter' AS tipe_layanan
                FROM tb_bebaslab l
                LEFT JOIN mahasiswa m ON l.nim_mahasiswa = m.nim
                WHERE l.status = 'accept' AND l.date_finished IS NOT NULL AND YEAR(l.date_finished) = ? AND m.prodi_id = 6
            "
        ];

        if ($tipe === 'all') {
            foreach ($tipe_queries as $key => $sub_sql) {
                $queries[] = $sub_sql;
                $params[] = $tahun;
            }
            $sql = implode(" UNION ALL ", $queries) . " ORDER BY tanggal ASC";
        } else {
            if (isset($tipe_queries[$tipe])) {
                $sql = $tipe_queries[$tipe] . " ORDER BY tanggal ASC";
                $params[] = $tahun;
            } else {
                $sql = "";
            }
        }

        return ['sql' => $sql, 'params' => $params];
    }
}
