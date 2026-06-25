<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_model extends CI_Model
{
    private $table = 'visitor_logs';

    /**
     * Catat login.
     * @param string $nim
     * @param bool $unique_per_day Jika TRUE, cegah duplikasi catatan di hari yang sama (per NIM).
     */
    public function log_login($nim, $unique_per_day = true)
    {
        $today = date('Y-m-d');

        if ($unique_per_day) {
            $this->db->where('nim', $nim);
            $this->db->where('visit_date', $today);
            if ($this->db->count_all_results($this->table) > 0) {
                return; // sudah tercatat hari ini
            }
        }

        $data = [
            'nim'        => $nim,
            'session_id' => $this->session->userdata('name'),
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'referrer'   => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
            'uri'        => uri_string(),
            'visit_date' => $today,
            // 'login_at' otomatis oleh DEFAULT CURRENT_TIMESTAMP
        ];

        $this->db->insert($this->table, $data);
    }

    // ---- Beberapa helper untuk statistik (opsional) ----
    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function count_today() {
        $this->db->where('visit_date', date('Y-m-d'));
        return $this->db->count_all_results($this->table);
    }

    public function count_unique_nim() {
        $this->db->select('nim');
        $this->db->group_by('nim');
        return $this->db->get($this->table)->num_rows();
    }

   public function daily_stats($days = 14)
    {
        $this->db->select('visit_date, COUNT(DISTINCT nim) as unique_visitors, COUNT(*) as total_visits');
        $this->db->from('visitor_logs');
        $this->db->where('visit_date >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->group_by('visit_date');
        $this->db->order_by('visit_date', 'ASC');
        return $this->db->get()->result();
    }

    public function get_visitors_per_day()
    {
        $this->db->select('DATE(login_at) as visit_date, COUNT(*) as total');
        $this->db->from('visitor_logs');
        $this->db->group_by('DATE(login_at)');
        $this->db->order_by('login_at', 'DESC');
        return $this->db->get()->result();
    }

    // public function get_visitors_by_date($date)
    // {
    //     $this->db->select('v.nim, m.nama_lengkap, p.nama_prodi, v.login_at');
    //     $this->db->from('visitor_logs v');
    //     $this->db->join('mahasiswa m', 'v.nim = m.nim', 'left');
    //     $this->db->join('prodi p', 'p.id_prodi = m.prodi_id', 'left');
    //     $this->db->where('DATE(v.login_at)', $date);
    //     $this->db->order_by('v.login_at', 'DESC');
    //     return $this->db->get()->result();
    // }

     // Tambahkan fungsi ini
    public function get_all()
    {
        return $this->db->get('visitor_logs')->result();
    }

    public function get_by_date($date)
    {
        $this->db->where('visit_date', $date);
        return $this->db->get('visitor_logs')->result();
    }

  public function get_statistik_per_prodi()
    {
        $this->db->select('p.nama_prodi, COUNT(*) as total');
        $this->db->from('visitor_logs v');
        $this->db->join('mahasiswa m', 'v.nim = m.nim', 'left');
        $this->db->join('prodi p', 'p.id_prodi = m.prodi_id', 'left');
        $this->db->group_by('p.nama_prodi');
        return $this->db->get()->result();
    }

    public function get_visitors_with_letters_by_date($date)
    {
        $escaped_date = $this->db->escape_str($date);
        $query = $this->db->query("
            SELECT 
                v.nim, 
                m.nama_lengkap, 
                u.name AS nama_admin,
                ur.role AS nama_role,
                u.role_id,
                p.nama_prodi, 
                v.session_id, 
                v.login_at,
                (SELECT COUNT(*) FROM tb_suratpengajuan s WHERE s.nim_mahasiswa = v.nim AND FROM_UNIXTIME(s.date_create, '%Y-%m-%d') = '{$escaped_date}') as jml_aktif_kuliah,
                (SELECT COUNT(*) FROM tb_bebaslab l WHERE l.nim_mahasiswa = v.nim AND DATE(l.date_created) = '{$escaped_date}') as jml_bebas_lab,
                (SELECT COUNT(*) FROM tb_skl sk WHERE sk.nim = v.nim AND DATE(sk.date_create) = '{$escaped_date}') as jml_skl,
                (SELECT COUNT(*) FROM tb_bebasperpus bp WHERE bp.nim_mahasiswa = v.nim AND DATE(bp.date_created) = '{$escaped_date}') as jml_bebas_perpus,
                (
                    (SELECT COUNT(*) FROM tb_suratpengajuan s WHERE (s.admin = u.name OR s.admin = v.nim) AND (s.status = 'proses' OR s.status = 'diajukan') AND FROM_UNIXTIME(s.date_create, '%Y-%m-%d') = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_bebaslab l WHERE (l.lab1_admin = u.name OR l.lab1_admin = v.nim) AND (l.status = 'di ajukan' OR l.status = 'pending' OR l.status = 'proses') AND DATE(l.date_created) = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_skl sk WHERE (sk.admin = u.name OR sk.admin = v.nim) AND (sk.status = 'proses' OR sk.status = 'diajukan') AND DATE(sk.date_create) = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_bebasperpus bp WHERE (bp.admin = u.name OR bp.admin = v.nim) AND (bp.status = 'pending' OR bp.status = 'di ajukan') AND DATE(bp.date_created) = '{$escaped_date}')
                ) AS admin_proses,
                (
                    (SELECT COUNT(*) FROM tb_suratpengajuan s WHERE (s.admin = u.name OR s.admin = v.nim) AND (s.status = 'ditolak' OR s.status LIKE 'ditolak%') AND FROM_UNIXTIME(s.date_finish, '%Y-%m-%d') = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_bebaslab l WHERE (l.lab1_admin = u.name OR l.lab1_admin = v.nim) AND (l.status = 'reject' OR l.status = 'rejected') AND DATE(l.date_updated) = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_skl sk WHERE (sk.admin = u.name OR sk.admin = v.nim) AND (sk.status = 'tolak' OR sk.status = 'reject') AND DATE(sk.date_finish) = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_bebasperpus bp WHERE (bp.admin = u.name OR bp.admin = v.nim) AND (bp.status = 'reject' OR bp.status = 'rejected') AND DATE(bp.date_updated) = '{$escaped_date}')
                ) AS admin_reject,
                (
                    (SELECT COUNT(*) FROM tb_suratpengajuan s WHERE (s.admin = u.name OR s.admin = v.nim) AND s.status = 'selesai' AND FROM_UNIXTIME(s.date_finish, '%Y-%m-%d') = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_bebaslab l WHERE (l.lab1_admin = u.name OR l.lab1_admin = v.nim) AND l.status = 'accept' AND DATE(l.date_updated) = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_skl sk WHERE (sk.admin = u.name OR sk.admin = v.nim) AND sk.status = 'selesai' AND DATE(sk.date_finish) = '{$escaped_date}') +
                    (SELECT COUNT(*) FROM tb_bebasperpus bp WHERE (bp.admin = u.name OR bp.admin = v.nim) AND bp.status = 'accept' AND DATE(bp.date_updated) = '{$escaped_date}')
                ) AS admin_selesai
            FROM visitor_logs v
            LEFT JOIN mahasiswa m ON v.nim = m.nim
            LEFT JOIN user u ON v.nim = u.nim
            LEFT JOIN user_role ur ON u.role_id = ur.id
            LEFT JOIN prodi p ON m.prodi_id = p.id_prodi
            WHERE v.visit_date = ?
            ORDER BY v.login_at DESC
        ", array($date));
        return $query->result();
    }
}
