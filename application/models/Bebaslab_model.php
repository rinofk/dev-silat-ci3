<?php
class Bebaslab_model extends CI_Model
{
    // ===============================
    // GET DATA DENGAN FILTER
    // ===============================
    public function getFiltered($prodi = null, $tahun = null, $status = null)
    {
        $this->db->select('
            tb_bebaslab.*,
            mahasiswa.nama_lengkap,
            prodi.nama_prodi,
            prodi.slug
        ');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');

        if (!empty($prodi)) {
            $this->db->where('prodi.slug', $prodi);
        }

        if (!empty($tahun)) {
            $this->db->where('YEAR(tb_bebaslab.date_created)', (int)$tahun);
        }

        if (!empty($status)) {
            $this->db->where('tb_bebaslab.status', $status);
        }

        $this->db->order_by('tb_bebaslab.date_created', 'DESC');
        return $this->db->get()->result();
    }

    // ===============================
    // AMBIL PER ID
    // ===============================
    public function getById($id)
    {
        $this->db->select('
            tb_bebaslab.*,
            mahasiswa.nama_lengkap,
            prodi.nama_prodi,
            prodi.slug

        ');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');
        $this->db->where('tb_bebaslab.id_bebaslab', $id);

        return $this->db->get()->row();
    }

    // ===============================
    // LIST TAHUN
    // ===============================
    public function getTahunList()
    {
        $this->db->select('YEAR(date_created) AS tahun');
        $this->db->from('tb_bebaslab');
        $this->db->group_by('YEAR(date_created)');
        $this->db->order_by('tahun', 'DESC');

        $result = $this->db->get()->result_array();
        return array_column($result, 'tahun');
    }

    // =====================================================================================
    // STATISTIK CARD (TOTAL, DISETUJUI, DITOLAK, MENUNGGU) + FILTER TAHUN & PRODI
    // =====================================================================================
    public function getStatistik($prodi = null, $tahun = null)
    {
        $stats = [];

        // ========== Total Pengajuan ==========
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');
        if ($prodi) $this->db->where('prodi.slug', $prodi);
        if ($tahun) $this->db->where('YEAR(tb_bebaslab.date_created)', $tahun);
        $stats['total'] = $this->db->count_all_results();

        // ========== Disetujui ==========
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');
        $this->db->where('tb_bebaslab.status', 'disetujui');
        if ($prodi) $this->db->where('prodi.slug', $prodi);
        if ($tahun) $this->db->where('YEAR(tb_bebaslab.date_created)', $tahun);
        $stats['disetujui'] = $this->db->count_all_results();

        // ========== Ditolak ==========
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');
        $this->db->where('tb_bebaslab.status', 'ditolak');
        if ($prodi) $this->db->where('prodi.slug', $prodi);
        if ($tahun) $this->db->where('YEAR(tb_bebaslab.date_created)', $tahun);
        $stats['ditolak'] = $this->db->count_all_results();

        // ========== Menunggu ==========
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');
        $this->db->where('tb_bebaslab.status', 'menunggu');
        if ($prodi) $this->db->where('prodi.slug', $prodi);
        if ($tahun) $this->db->where('YEAR(tb_bebaslab.date_created)', $tahun);
        $stats['menunggu'] = $this->db->count_all_results();

        return $stats;
    }

    public function getByStatus($status)
    {
        $this->db->select('tb_bebaslab.*, mahasiswa.nama_lengkap, prodi.nama_prodi');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');
        $this->db->where('tb_bebaslab.status', $status);
        $this->db->order_by('tb_bebaslab.date_created', 'DESC');

        return $this->db->get()->result();
    }
    public function countStatus($status = null, $prodi = null, $tahun = null)
    {
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');

        if (!empty($prodi)) {
            $this->db->where('prodi.slug', $prodi);
        }

        if (!empty($tahun)) {
            $this->db->where('YEAR(tb_bebaslab.date_created)', (int)$tahun);
        }

        if (!empty($status)) {
            $this->db->where('tb_bebaslab.status', $status);
        }

        return $this->db->count_all_results();
    }
}
