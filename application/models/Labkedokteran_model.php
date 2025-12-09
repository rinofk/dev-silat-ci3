<?php

class Labkedokteran_model extends CI_model
{
    public function get_AllKedokteran($tahun = null, $status = null)
    {
        $prodiid = array('1'); //id s1 kedokteran
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
    public function get_AllProfesiDokter($tahun = null, $status = null)
    {
        $prodiid = array('6'); // id profesi dokter
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

    public function get_Idbp($id_bebaslab)
    {

        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('user', 'user.nim=mahasiswa.nim');

        $this->db->where('id_bebaslab', $id_bebaslab);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_statusaccept1()
    {
        $accept = 'accept';
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where_in('prodi_id', [1, 6]);
        $this->db->where('status', $accept);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_statusaccept2()
    {
        $accept = 'accept';
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('prodi_id', '2');
        $this->db->where('status', $accept);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_statusaccept3()
    {
        $accept = 'accept';
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('prodi_id', '3');
        $this->db->where('status', $accept);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_statusaccept4()
    {
        $accept = 'accept';
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('prodi_id', '5');
        $this->db->where('status', $accept);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function accept_Idbp($id_bebaslab)
    {
        $proses = 'accept';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $data = [
            'status' => $proses,
            'nomor' => $this->input->post('nomor', true),
            'keterangan' => 'Validasi Lengkap',
            'date_finished' => $date,
            'berlaku_sampai' => date("Y-m-d", strtotime("+90 days")),
            'lab1_admin' => $this->session->userdata('name')

        ];
        $this->db->where('id_bebaslab', $id_bebaslab);
        $this->db->update('tb_bebaslab', $data);
    }
    public function reject_Idbp($id_bebaslab)
    {
        $proses = 'reject';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $data = [
            'status' => $proses,
            'keterangan' => $this->input->post('keterangan'),
            'date_updated' => $date

        ];
        $this->db->where('id_bebaslab', $id_bebaslab);
        $this->db->update('tb_bebaslab', $data);
    }
    public function proses_Idbp($id_bebaslab)
    {
        $proses = 'proses';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $data = [
            'status' => $proses,
            'date_updated' => $date

        ];
        $this->db->where('id_bebaslab', $id_bebaslab);
        $this->db->update('tb_bebaslab', $data);
    }
    public function ajuan($nim)
    {
        $status = 'di ajukan';
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('nim_mahasiswa', $nim);
        $this->db->where('status', $status);
        $query = $this->db->get();
        return $query->row_array();
    }


    //FARMASI
    public function get_AllFarmasi()
    {
        $status = array('di ajukan', 'reject', 'proses');
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->order_by('date_created', 'asc');
        $this->db->where('prodi_id', '2');
        $this->db->where_in('status', $status);

        $query = $this->db->get();
        return $query->result_array();
    }

    //Keperawatan
    public function get_AllKeperawatan()
    {
        $status = array('di ajukan', 'reject', 'proses');
        $prodi = array('3', '5');
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->order_by('date_created', 'asc');
        $this->db->where('prodi_id', '3');
        $this->db->where_in('status', $status);


        $query = $this->db->get();
        return $query->result_array();
    }

    //Ners
    public function get_AllNers()
    {
        $status = array('di ajukan', 'reject', 'proses');
        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->order_by('date_created', 'asc');
        $this->db->where('prodi_id', '5');
        $this->db->where_in('status', $status);


        $query = $this->db->get();
        return $query->result_array();
    }

    public function getBebasLabById($id_bebaslab)
    {

        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->where('id_bebaslab', $id_bebaslab);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function get_tahun_options()
    {
        $this->db->select('YEAR(date_finished) AS tahun', false); //
        $this->db->from('tb_bebaslab');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'ASC');

        return $this->db->get()->result_array();
    }

    public function count_by_filter($tahun = null, $status = null)
    {
        $prodiid = ['1', '6'];
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


    public function profesidoktercount_by_filter($tahun = null, $status = null)
    {
        $prodiid = ['6']; //id profesi dokter
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
