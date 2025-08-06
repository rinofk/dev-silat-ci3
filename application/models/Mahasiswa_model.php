<?php

class Mahasiswa_model extends CI_model
{
    public function getAllMahasiswa()
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }

    public function inputBiodata()
    {
        $data = [
            "nim" => $this->input->post('nim', true),
            "nama_lengkap" => ucwords(strtolower($this->input->post('nama_lengkap', true))),
            "tempat_lahir" => ucwords(strtolower($this->input->post('tempat_lahir', true))),
            "tgl_lahir" => $this->input->post('tgl_lahir'),
            "prodi_id" => $this->input->post('program_studi'),
            "alamat" => $this->input->post('alamat'),
            "no_hp" => $this->input->post('no_hp'),
            "agama" => $this->input->post('agama'),
            "agamaa" => $this->input->post('agamaa'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "nama_ayah" => $this->input->post('nama_ayah'),
            "nama_ibu" => $this->input->post('nama_ibu'),
            "tanggal_update" => time(),
            "status_aktif" => 1
        ];

        $this->db->insert('mahasiswa', $data);
    }


    public function tambahDataMahasiswa()
    {
        $data = [
            "nim" => $this->input->post('nim', true),
            "nama_lengkap" => $this->input->post('nama_lengkap', true),
            "tempat_lahir" => $this->input->post('tempat_lahir', true),
            "tgl_lahir" => $this->input->post('tgl_lahir'),
            "semester" => $this->input->post('semester'),
            "tahun_ajaran" => $this->input->post('tahun_ajaran'),
            "program_studi" => $this->input->post('program_studi'),
            "prodi_id" => $this->input->post('program_studi'),
            "keperluan" => $this->input->post('keperluan'),
            "keperluan_ket" => $this->input->post('keperluan_ket'),
            "alamat" => $this->input->post('alamat'),
            "ortu" => $this->input->post('ortu'),
            "nip" => $this->input->post('nip'),
            "pangkat" => $this->input->post('pangkat'),
            "instansi" => $this->input->post('instansi'),
        ];

        $this->db->insert('mahasiswa', $data);
    }

    public function hapusDataMahasiswa($nim)
    {
        $this->db->where('nim', $nim);
        $this->db->delete('mahasiswa');
    }

    public function getMahasiswaById($nim)
    {

        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        //  $this->db->join('user', 'user.nim=mahasiswa.nim');
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query->row_array();

        //  return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }
    public function getMahasiswaByJoin($nim)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        //  $this->db->join('user', 'user.nim=mahasiswa.nim');
        $this->db->where('nim', $nim);
        $query = $this->db->get();

        return $query->row_array();

        //  return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }
    public function getMahasiswaByNim($nim)
    {

        return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }

    // update dari operator
    public function ubahDataMahasiswa()
    {

        $data = [

            "nama_lengkap" => $this->input->post('nama_lengkap', true),
            "tempat_lahir" => $this->input->post('tempat_lahir', true),
            "tgl_lahir" => ucwords(strtolower($this->input->post('tgl_lahir', true))),
            "prodi_id" => $this->input->post('program_studi'),
            "alamat" => $this->input->post('alamat'),
            "no_hp" => $this->input->post('no_hp'),
            "agama" => $this->input->post('agama'),
            "agamaa" => $this->input->post('agamaa'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "tanggal_update" => time(),
            "status_aktif" => 1
        ];
        $this->db->where('nim', $this->input->post('nim'));
        $this->db->update('mahasiswa', $data);
    }


    // update dari user
    public function ubahBioData()
    {

        $data = [

            "nama_lengkap" => ucwords(strtolower($this->input->post('nama_lengkap', true))),
            "tempat_lahir" => ucwords(strtolower($this->input->post('tempat_lahir', true))),
            "tgl_lahir" => ucwords(strtolower($this->input->post('tgl_lahir', true))),
            "prodi_id" => $this->input->post('program_studi'),
            "alamat" => ucwords(strtolower($this->input->post('alamat'))),
            "no_hp" => $this->input->post('no_hp'),
            "agama" => $this->input->post('agama'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "tanggal_update" => time(),
            "status_aktif" => 1
        ];
        $this->db->where('nim', $this->input->post('nim'));
        $this->db->update('mahasiswa', $data);
    }
    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_lengkap', $keyword);
        $this->db->or_like('nim', $keyword);
        $this->db->or_like('program_studi', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}
