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
            'session_id' => $this->session->userdata('session_id'),
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




}
