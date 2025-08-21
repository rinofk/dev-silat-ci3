<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Labfarmasi_model extends CI_Model
{
    public function get_filtered_data($tahun = null, $status = null)
    {
        $prodiid = ['2']; // <-- ganti sesuai ID prodi Farmasi
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->order_by('date_created', 'desc');
        $this->db->where_in('prodi_id', $prodiid);

        if ($tahun) {
            $this->db->where('YEAR(tb_bebaslab.date_created)', $tahun);
        }

        if ($status) {
            $this->db->where('tb_bebaslab.status', $status);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_tahun()
    {
        $this->db->select('YEAR(created_at) as tahun');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->where_in('mahasiswa.prodi_id', [4]); // ID Farmasi
        $this->db->group_by('YEAR(created_at)');
        $this->db->order_by('tahun', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_all_status()
    {
        $this->db->select('status_surat');
        $this->db->from('tb_bebaslab');
        $this->db->group_by('status_surat');
        return $this->db->get()->result();
    }

    public function get_tahun_options()
    {
        $this->db->select('YEAR(date_created) AS tahun', false);
        $this->db->from('tb_bebaslab');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'ASC');

        return $this->db->get()->result_array();
    }

    public function count_by_filter($tahun = null, $status = null)
    {
        $prodiid = ['2']; // ID Farmasi
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->where_in('mahasiswa.prodi_id', $prodiid);

        if ($tahun) {
            $this->db->where('YEAR(tb_bebaslab.date_created)', $tahun);
        }

        if ($status) {
            $this->db->where('tb_bebaslab.status', $status);
        }

        return $this->db->count_all_results();
    }
}
