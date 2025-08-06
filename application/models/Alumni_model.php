<?php

class Alumni_model extends CI_model
{

    public function tambahAlumni()
    {
        $date_daftar = date('Y-m-d H:i:s');
        $data = [
            "nim_alumni" => $this->input->post('nim_alumni'),
            "tahun_wisuda" => $this->input->post('tahun_wisuda'),
            "jalur_masuk" => $this->input->post('jalur_masuk'),
            "judul_skripsi" => $this->input->post('judul_skripsi'),
            "pesan_kesan" => ucwords(strtolower($this->input->post('pesan_kesan'))),
            "tanggal_daftar" => $date_daftar,
            "tanggal_updatealumni" => $date_daftar,
            "status_alumni" => 0,
            "poto" => 'default.jpg'
        ];

        $this->db->insert('tb_alumni', $data);
    }

    public function getAlumni($id)
    {

        $this->db->select('*');
        $this->db->from('tb_alumni');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_alumni.nim_alumni');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('user', 'user.nim=mahasiswa.nim');
        $this->db->join('agama', 'agama.id_agama=mahasiswa.agama');

        $this->db->where('nim_alumni', $id);
        $query = $this->db->get();
        return $query->row_array();

        //  return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }

    public function getNimAlumni($nim_alumni)
    {

        $this->db->select('*');
        $this->db->from('tb_alumni');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_alumni.nim_alumni');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('user', 'user.nim=mahasiswa.nim');
        $this->db->join('agama', 'agama.id_agama=mahasiswa.agama');

        $this->db->where('nim_alumni', $nim_alumni);
        $query = $this->db->get();
        return $query->row_array();

        //  return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }

    public function getUbahAlumni()
    {

        $date_update = date('Y-m-d H:i:s');
        $data = [

            "tahun_wisuda" => $this->input->post('tahun_wisuda'),
            "judul_skripsi" => $this->input->post('judul_skripsi'),
            "jalur_masuk" => $this->input->post('jalur_masuk'),
            "pesan_kesan" => ucwords(strtolower($this->input->post('pesan_kesan'))),
            "tanggal_updatealumni" => $date_update,
            "status_alumni" => 0
        ];
        $this->db->where('nim_alumni', $this->input->post('nim_alumni'));
        $this->db->update('tb_alumni', $data);
    }

    public function kirimAlumni($nim_alumni)
    {

        $data = [
            "status_alumni" => 1
        ];
        $role = [
            "role_id" => 2
        ];
        // $status_aktif = [
        //     "status_aktif" => 0
        // role id 2 untuk mahasiswa
        // 4 untuk alumni
        // ];
        $wisuda = [
            "nim_bw" => 'I1031151035',
            "kwitansi" => 0,
            "biodata" => 0,
            "date_created" => time(),
            "date_updated" => time()
        ];

        $this->db->where('nim_alumni', $nim_alumni);
        $this->db->update('tb_alumni', $data);

        $this->db->where('nim', $nim_alumni);
        $this->db->update('user', $role);

        $this->db->insert('tb_berkaswisuda', $wisuda);

        // $this->db->where('nim', $nim_alumni);
        // $this->db->update('mahasiswa', $status_aktif);
    }
    // ===================================================================================================
    // Model SKL (Surat Keterangan Lulus)


    public function tambahSkl()
    {
        $status = 'diajukan';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $data = [
            "jenis_skl" => 2,
            "nim" => $this->input->post('nim'),
            "date_create" => $date,
            "date_finish" => $date,
            "status" => $status
        ];
        $alumni = [
            "alamat_sekarang" => $this->input->post('alamat_sekarang'),
            "tgl_lulus_sidang" => $this->input->post('tgl_lulus'),
            "ipk" => $this->input->post('ipk'),
            "predikat" => ucwords(strtolower($this->input->post('predikat'))),

        ];

        $this->db->insert('tb_skl', $data);
        $this->db->where('nim_alumni', $this->input->post('nim'));
        $this->db->update('tb_alumni', $alumni);
    }

    public function getSkl($id)
    {

        $this->db->select('*');
        $this->db->from('tb_skl');
        $this->db->where('jenis_skl', '2');

        $this->db->join('tb_alumni', 'tb_alumni.nim_alumni=tb_skl.nim');


        $this->db->where('nim', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getIdSkl($id_skl)
    {

        $this->db->select('*');
        $this->db->from('tb_skl');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_skl.nim');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('tb_alumni', 'tb_alumni.nim_alumni=mahasiswa.nim');

        $this->db->where('id_skl', $id_skl);
        $query = $this->db->get();
        return $query->row_array();

        //  return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }


    //
    public function tambahSklYudis()
    {
        $status = 'diajukan';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $data = [
            "jenis_skl" => 1,
            "nim" => $this->input->post('nim'),
            "date_create" => $date,
            "date_finish" => $date,
            "status" => $status
        ];
        $alumni = [
            "tgl_lulus_yudisium" => $this->input->post('tgl_lulus'),
            "ipk" => $this->input->post('ipk'),
            "predikat" => ucwords(strtolower($this->input->post('predikat'))),

        ];

        $this->db->insert('tb_skl', $data);
        $this->db->where('nim_alumni', $this->input->post('nim'));
        $this->db->update('tb_alumni', $alumni);
    }
    public function getSklyudis($id)
    {

        $this->db->select('*');
        $this->db->from('tb_skl');
        $this->db->where('jenis_skl', '1');

        $this->db->join('tb_alumni', 'tb_alumni.nim_alumni=tb_skl.nim');


        $this->db->where('nim', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
