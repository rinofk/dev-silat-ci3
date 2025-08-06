<?php

class Stase_model extends CI_model
{

    public function getSuratById($nim)
    {

        $this->db->select('*'); 
        $this->db->from('tb_suratpengajuan');
        $this->db->join('keperluan', 'keperluan.id_keperluan=tb_suratpengajuan.keperluan');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_suratpengajuan.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('nim_mahasiswa', $nim);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getSuratByIdPengajuan($id_suratpengajuan)
    {

        $this->db->select('*');
        $this->db->from('tb_suratpengajuan');
        $this->db->join('keperluan', 'keperluan.id_keperluan=tb_suratpengajuan.keperluan');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_suratpengajuan.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('id_suratpengajuan', $id_suratpengajuan);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getSuratByNim($id)//aktif
    {
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        // $this->db->join('pk_periode', 'pk_periode.id_periode=pk_praktekklinik.id_periode');
        $this->db->join('pk_stase', 'pk_stase.id_stase=pk_praktekklinik.id_stase');

        $this->db->where('id_klinik', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getSuratAktifKuliahById($id_suratpengajuan)
    {

        $this->db->select('*');
        $this->db->from('tb_suratpengajuan');
        $this->db->join('keperluan', 'keperluan.id_keperluan=tb_suratpengajuan.keperluan');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_suratpengajuan.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('id_suratpengajuan', $id_suratpengajuan);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getNaspub($id)
    {
        $this->db->select('*');
        $this->db->from('tb_naspub');

        $this->db->where('nim', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getNaspub_byid($id_naspub)
    {
        $this->db->select('*');
        $this->db->from('tb_naspub');

        $this->db->where('id_naspub', $id_naspub);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function tambahnaspub()
    {
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '4148';
        $config['upload_path'] = './assets/naspub/';
        $config['file_name'] = 'jurnal_' . $this->input->post('nim');
        $this->load->library('upload', $config);

        if (!empty($_FILES['naspub']['name'])) {
            $this->upload->do_upload('naspub');
            $new_image = $this->upload->data();
            $naspub = $new_image['file_name'];
        }

        $status = 'diajukan';
        $data = [
            "nim" => $this->input->post('nim', true),
            "judul_naspub" => $this->input->post('judul_naspub', true),
            "abstrack" => $this->input->post('abstrack'),
            "naspub" => $naspub,
            "pembimbing" => $this->input->post('pembimbing'),
            "nip" => $this->input->post('nip'),
            "date_create" => time(),
            "ket" => $this->input->post('ket'),
            "status" => $status

        ];

        $this->db->insert('tb_naspub', $data);
    }

    // cetak naspub
    public function getBarcode($id_naspub)
    {

        $this->db->select('*');
        $this->db->from('tb_naspub');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_naspub.nim');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');



        $this->db->where('id_naspub', $id_naspub);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getStudip($id)
    {
        $this->db->select('*');
        $this->db->from('tb_studip');


        $this->db->where('nim', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function tambahstudip()
    {
        $status = 'diajukan';
        $data = [
            "nim" => $this->input->post('nim', true),
            "judul_proposal" => $this->input->post('judul_proposal', true),
            "tujuan_surat" => $this->input->post('tujuan_surat'),
            "alamat_tujuan" => $this->input->post('alamat_tujuan'),
            "perihal" => $this->input->post('perihal'),
            "date_create" => time(),
            "status" => $status

        ];

        $this->db->insert('tb_studip', $data);
    }

    // cetak naspub
    public function getAllStudip($id_studip)
    {

        $this->db->select('*');
        $this->db->from('tb_studip');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_studip.nim');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');



        $this->db->where('id_studip', $id_studip);
        $query = $this->db->get();
        return $query->row_array();
    }
}
